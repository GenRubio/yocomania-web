using BoomBang.game.handler;
using BoomBang.game.instances;
using BoomBang.server;
using System;
using System.Collections.Generic;
using System.Data;
using System.Linq;
using System.Text;
using System.Threading;
using System.Threading.Tasks;

namespace BoomBang.game.manager
{
    class UserManager
    {
        public static Dictionary<int, SessionInstance> UsuariosOnline = new Dictionary<int, SessionInstance>();
        public static Dictionary<int, UserInstance> usuariosRegistrados = new Dictionary<int, UserInstance>();
        public static void obtenerUsuariosRegistrados()
        {
            mysql client = new mysql();
            foreach(DataRow usuario in client.ExecuteQueryTable("SELECT * FROM usuarios").Rows)
            {
                int userID = (int)usuario["id"];
                usuariosRegistrados.Add(userID, new UserInstance(usuario));
            }
        }
        private static bool usuarioOnline (UserInstance User)
        {
            foreach(SessionInstance sessionOnline in UsuariosOnline.Values.ToList())
            {
                if (sessionOnline.User == User)
                {
                    return true;
                }
            }
            return false;
        }
        public static void IniciarSesion(SessionInstance Session, string user, string pass)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(120);
            server.AddHead(130);

            Session.User = ObtenerUsuario(user, pass);
            if (Session.User != null)
            {
                if (!usuarioOnline(Session.User))
                {
                    UsuariosOnline.Add(Session.User.id, Session);

                    if (Session.User.timespam_regalo_peque == 0) Session.User.timespam_regalo_peque = Time.GetCurrentAndAdd(AddType.Minutos, 30);
                    if (Session.User.timespam_desc_cambios != 0)
                    {
                        if (Time.GetDifference(Session.User.timespam_desc_cambios) <= 0)
                        {
                            Session.User.timespam_desc_cambios = 0;
                            Session.User.security = string.Empty;
                            UserManager.ActualizarEstadisticas(Session.User);
                            FlowerHandler.BoomBangTeam(Session, "¡Se ha completado el proceso de desactivación de la clave de seguridad! \rAhora tu cuenta no está totalmente segura.");
                        }
                    }
                    using (mysql client = new mysql())
                    {
                        client.SetParameter("id", Session.User.id);
                        DataRow row = client.ExecuteQueryRow("SELECT * FROM cuentas_desactivadas WHERE id = @id");
                        if (row != null)
                        {
                            server.AppendParameter(4);
                            server.AppendParameter("Has desactivado tu cuenta, para reactivarla, presiona el botón");
                            server.AppendParameter(1);
                            Session.SendDataProtected(server);
                            return;
                        }
                    }
                    ActualizarVipUsuarios(Session);
                    server.AppendParameter(1);
                    server.AppendParameter(Session.User.nombre);
                    server.AppendParameter(Session.User.avatar);
                    server.AppendParameter(Session.User.colores);
                    server.AppendParameter(Session.User.email);
                    server.AppendParameter(Session.User.edad);
                    server.AppendParameter(2);
                    server.AppendParameter("Hola, Soy nuevo en BoomBang.");
                    server.AppendParameter(0);
                    server.AppendParameter(Session.User.id);
                    server.AppendParameter(Session.User.admin);
                    server.AppendParameter(Session.User.oro);
                    server.AppendParameter(Session.User.plata);
                    server.AppendParameter(200);
                    server.AppendParameter(5);
                    server.AppendParameter(0);
                    server.AppendParameter((Time.GetDifference(Session.User.timespam_regalo_peque) <= 0 ? 0 : Time.GetDifference(Session.User.timespam_regalo_peque)));//Regalo pequeño "tiempo de regalo"
                    server.AppendParameter(0);//Creo que es contador demrd
                    server.AppendParameter(0);//Creo que es contador demrd
                    server.AppendParameter(Session.User.tutorial_islas);
                    server.AppendParameter("ES");
                    server.AppendParameter(1);
                    server.AppendParameter(0);
                    server.AppendParameter(Session.User.vip);
                    server.AppendParameter(Session.User.end_vip);
                    server.AppendParameter((Session.User.ValidarEmail == 0 ? 0 : 1));///Validar email / 1 Cambiar Email
                    server.AppendParameter((Session.User.timespam_desc_cambios == 0 ? Session.User.security != "" ? 1 : 0 : 2));
                    server.AppendParameter(0);//Noticia derecha                            
                    server.AppendParameter(0);
                    server.AppendParameter(new object[] { 1, 0 });
                    server.AppendParameter(0);
                    server.AppendParameter(Session.User.cambio_nombre);//Nombre personaje
                    Session.User.AFKManager = 3600;
                    if (Program.ver_conexion_usuarios == true)
                    {
                        Output.WriteLine("[UserManager] -> Se ha conectado el usuario " + Session.User.nombre + ".");
                    }
                    if (Session.User.avatar >= 1 && Session.User.avatar <= 11 && Session.User.colores.Substring(0, 6) == "000000") { Session.User.colores = Session.User.colores.Replace("000000", "FFFFFF"); ActualizarEstadisticas(Session.User); }
                    if (Session.User.avatar >= 8 && Session.User.avatar <= 9 && Session.User.colores.Substring(6, 6) == "000000") { Session.User.colores = Session.User.colores.Replace("000000", "FFFFFF"); ActualizarEstadisticas(Session.User); }
                    ActualizarUsuarios();
                    Actualizar_conexion(Session.User, Session.IP);
                    repair_gift(Session);

                    new Thread(() => updateOnlineUser(Session)).Start();
                    new Thread(() => AntiScript(Session)).Start();
                }
                else
                {
                    Thread.Sleep(new TimeSpan(0, 0, 0, 0, 500));
                    server.AppendParameter(2);
                }
            }
            else
            {
                Thread.Sleep(new TimeSpan(0, 0, 0, 0, 500));
                server.AppendParameter(0);
            }

            Session.SendDataProtected(server);
            Program.UpdateTitle();
        }
        //public static void IniciarSesion(SessionInstance Session, string user, string pass)
        //{
        //    if (Session.User == null)
        //    {
        //        ServerMessage server = new ServerMessage();
        //        server.AddHead(120);
        //        server.AddHead(130);
        //        Thread.Sleep(new TimeSpan(0, 0, 0, 0, 500));
        //        //new Thread(() => avisoVerificacionLogin(Session)).Start();
        //        UserInstance User = ObtenerUsuario(user, PasswordEncryptada(pass));
        //        if (User != null)
        //        {
        //            //searchOnlineUserAccountBug(Session);
        //            Session.verificandoCuenta = false;
        //            if (Time.GetDifference(User.baneo) > 0)
        //            {
        //                ServerMessage ban = new ServerMessage();
        //                ban.AddHead(185);
        //                ban.AddHead(0);
        //                TimeSpan ts = TimeSpan.FromSeconds(Time.GetDifference(User.baneo));
        //                ban.AppendParameter("El uso de Autoclick esta prohibido en BoomBang. Podras volver a conectarte en " + ts + ". Créditos: -100 de oro");
        //                Session.SendDataProtected(ban);
        //            }
        //            else if (User.contador_baneo >= 10)/// Desactivada cuenta + Ban IP
        //            {
        //                ServerMessage ban = new ServerMessage();
        //                ban.AddHead(174);
        //                ban.AddHead(0);
        //                ban.AppendParameter(0);
        //                Session.SendDataProtected(ban);
        //            }
        //            else
        //            {
        //                if (UsuariosOnline.ContainsKey(User.id))
        //                {
        //                    server.AppendParameter(2);
        //                    Session.SendDataProtected(server);
        //                    return;
        //                }
        //                else
        //                {

        //                    UsuariosOnline.Add(User.id, Session);
        //                    if (UsuariosOnline.ContainsKey(User.id))
        //                    {
        //                        Session.User = User;
        //                        if (Session.User.timespam_regalo_peque == 0) Session.User.timespam_regalo_peque = Time.GetCurrentAndAdd(AddType.Minutos, 30);
        //                        if (Session.User.timespam_desc_cambios != 0)
        //                        {
        //                            if (Time.GetDifference(Session.User.timespam_desc_cambios) <= 0)
        //                            {
        //                                Session.User.timespam_desc_cambios = 0;
        //                                Session.User.security = string.Empty;
        //                                UserManager.ActualizarEstadisticas(Session.User);
        //                                FlowerHandler.BoomBangTeam(Session, "¡Se ha completado el proceso de desactivación de la clave de seguridad! \rAhora tu cuenta no está totalmente segura.");
        //                            }
        //                        }
        //                        using (mysql client = new mysql())
        //                        {
        //                            client.SetParameter("id", Session.User.id);
        //                            DataRow row = client.ExecuteQueryRow("SELECT * FROM cuentas_desactivadas WHERE id = @id");
        //                            if (row != null)
        //                            {
        //                                server.AppendParameter(4);
        //                                server.AppendParameter("Has desactivado tu cuenta, para reactivarla, presiona el botón");
        //                                server.AppendParameter(1);
        //                                Session.SendDataProtected(server);
        //                                return;
        //                            }
        //                        }
        //                        ActualizarVipUsuarios(Session);
        //                        server.AppendParameter(1);
        //                        server.AppendParameter(Session.User.nombre);
        //                        server.AppendParameter(Session.User.avatar);
        //                        server.AppendParameter(Session.User.colores);
        //                        server.AppendParameter(Session.User.email);
        //                        server.AppendParameter(Session.User.edad);
        //                        server.AppendParameter(2);
        //                        server.AppendParameter("Hola, Soy nuevo en BoomBang.");
        //                        server.AppendParameter(0);
        //                        server.AppendParameter(Session.User.id);
        //                        server.AppendParameter(Session.User.admin);
        //                        server.AppendParameter(Session.User.oro);
        //                        server.AppendParameter(Session.User.plata);
        //                        server.AppendParameter(200);
        //                        server.AppendParameter(5);
        //                        server.AppendParameter(0);
        //                        server.AppendParameter((Time.GetDifference(Session.User.timespam_regalo_peque) <= 0 ? 0 : Time.GetDifference(Session.User.timespam_regalo_peque)));//Regalo pequeño "tiempo de regalo"
        //                        server.AppendParameter(0);//Creo que es contador demrd
        //                        server.AppendParameter(0);//Creo que es contador demrd
        //                        server.AppendParameter(Session.User.tutorial_islas);
        //                        server.AppendParameter("ES");
        //                        server.AppendParameter(1);
        //                        server.AppendParameter(0);
        //                        server.AppendParameter(Session.User.vip);
        //                        server.AppendParameter(Session.User.end_vip);
        //                        server.AppendParameter((Session.User.ValidarEmail == 0 ? 0 : 1));///Validar email / 1 Cambiar Email
        //                        server.AppendParameter((Session.User.timespam_desc_cambios == 0 ? Session.User.security != "" ? 1 : 0 : 2));
        //                        server.AppendParameter(0);//Noticia derecha                            
        //                        server.AppendParameter(0);
        //                        server.AppendParameter(new object[] { 1, 0 });
        //                        server.AppendParameter(0);
        //                        server.AppendParameter(Session.User.cambio_nombre);//Nombre personaje
        //                        Session.User.AFKManager = 3600;
        //                        if (Program.ver_conexion_usuarios == true)
        //                        {
        //                            Output.WriteLine("[UserManager] -> Se ha conectado el usuario " + Session.User.nombre + ".");
        //                        }
        //                        if (Session.User.avatar >= 1 && Session.User.avatar <= 11 && Session.User.colores.Substring(0, 6) == "000000") { Session.User.colores = Session.User.colores.Replace("000000", "FFFFFF"); ActualizarEstadisticas(Session.User); }
        //                        if (Session.User.avatar >= 8 && Session.User.avatar <= 9 && Session.User.colores.Substring(6, 6) == "000000") { Session.User.colores = Session.User.colores.Replace("000000", "FFFFFF"); ActualizarEstadisticas(Session.User); }
        //                        ActualizarUsuarios();
        //                        Actualizar_conexion(Session.User, Session.IP);
        //                        repair_gift(Session);

        //                        new Thread(() => AntiScript(Session)).Start();
        //                    }
        //                }
        //            }
        //        }
        //        else
        //        {
        //            server.AppendParameter(0);
        //        }
        //        Session.SendDataProtected(server);
        //        Program.UpdateTitle();
        //    }
        //}
        private static void updateOnlineUser(SessionInstance Session)
        {
            mysql client = new mysql();
            client.SetParameter("user", Session.User.nombre);
            client.ExecuteNonQuery("UPDATE usuarios SET Online = 1 WHERE nombre = @user");
        }
        private static void AntiScript(SessionInstance Session)
        {
            while (true)
            {
                if (Session.User.startAntiScript)
                {
                    if (Session.User.sendDataUser > 3)
                    {
                        new Thread(() => deleteAlertScript(Session)).Start();
                        Session.User.avisosScript += 1;
                        Session.User.sendDataUser = 0;
                    }
                    else
                    {
                        Session.User.sendDataUser = 0;
                    }
                }
                Thread.Sleep(1000);
            }
        }
        private static void deleteAlertScript(SessionInstance Session)
        {
            int countTime = 2;
            while(countTime > 0)
            {
                countTime -= 1;
                Thread.Sleep(1000);
            }
            if (Session.User.avisosScript > 1)
            {
                Session.FinalizarConexion("script");
            }
            Session.User.avisosScript = 0;
        }
        private static void avisoVerificacionLogin(SessionInstance Session)
        {
            int segundos = 5;
            while(segundos > 0)
            {
                segundos--;
                Thread.Sleep(new TimeSpan(0, 0, 1));
            }
            if (Session.verificandoCuenta != false)
            {
                ServerMessage server = new ServerMessage();
                server.AddHead(183);
                server.AppendParameter("Cargando...\n" +
                    "Estamos cargando tu cuenta. Este proceso puede tardar unos segundos.");
                Session.SendData(server);
            }
        }
        public static bool ActivarClaveSeguridad(UserInstance User, string clave)
        {
            using (mysql client = new mysql())
            {
                client.SetParameter("id", User.id);
                client.SetParameter("pass", clave);
                if (client.ExecuteNonQuery("UPDATE usuarios SET security = @pass WHERE id = @id") == 1)
                {
                    User.security = clave;
                    return true;
                }
            }
            return false;
        }
        public static void Ajustar_Remuneracion(UserInstance User)
        {
            using (mysql client = new mysql())
            {
                client.SetParameter("id", User.id);
                client.SetParameter("coins_remain", Time.GetDifference(User.coins_remain_double));
                client.ExecuteNonQuery("UPDATE usuarios SET coins_remain = @coins_remain WHERE id = @id");
            }
        }
        public static void Sumar_Cocos(UserInstance User, int Puntos)
        {
            User.puntos_cocos++;
            using (mysql client = new mysql())
            {
                client.SetParameter("id", User.id);
                client.SetParameter("puntos_cocos", User.puntos_cocos);
                client.ExecuteNonQuery("UPDATE usuarios SET puntos_cocos = @puntos_cocos WHERE id = @id");
            }
        }
        public static void Sumar_Shurikens(UserInstance User, int Puntos)
        {
            User.puntos_ninja++;
            using (mysql client = new mysql())
            {
                client.SetParameter("id", User.id);
                client.SetParameter("puntos_ninja", User.puntos_ninja);
                client.ExecuteNonQuery("UPDATE usuarios SET puntos_ninja = @puntos_ninja WHERE id = @id");
            }
        }
        public static void Actualizar_conexion(UserInstance User, string ip)
        {
            using (mysql client = new mysql())
            {
                client.SetParameter("id", User.id);
                client.SetParameter("ip", ip);
                client.SetParameter("time", DateTime.Now);
                client.ExecuteNonQuery("UPDATE usuarios SET ultima_conexion = @time, ip_actual = @ip WHERE id = @id");
            }
        }
        public static bool Actualizar_Contraseña(UserInstance User, string contraseña)
        {
            if (User != null)
            {
                using (mysql client = new mysql())
                {
                    client.SetParameter("id", User.id);
                    client.SetParameter("pass", contraseña);
                    if (client.ExecuteNonQuery("UPDATE usuarios SET password = @pass WHERE id = @id") == 1)
                    {
                        User.password = contraseña;
                        return true;
                    }
                }
            }
            return false;
        }
        public static bool Coincidencia_Contraseña(UserInstance User, string password)
        {
            if (User != null)
            {
                if (password == User.password)
                {
                    return true;
                }
            }
            return false;
        }
        public static void ActualizarAvatar(UserInstance User, string colores, int avatar)
        {
            if (User != null)
            {
                using (mysql client = new mysql())
                {
                    client.SetParameter("id", User.id);
                    client.SetParameter("colores", colores);
                    client.SetParameter("avatar", avatar);
                    if (client.ExecuteNonQuery("UPDATE usuarios SET colores = @colores, avatar = @avatar WHERE id = @id") == 1)
                    {
                        User.colores = colores;
                        User.avatar = avatar;
                    }
                }
            }
        }
        public static void ActualizarEstadisticas(UserInstance User)
        {
            using (mysql client = new mysql())
            {
                client.SetParameter("id", User.id);
                client.SetParameter("besos_enviados", User.besos_enviados);
                client.SetParameter("besos_recibidos", User.besos_recibidos);
                client.SetParameter("jugos_enviados", User.jugos_enviados);
                client.SetParameter("jugos_recibidos", User.jugos_recibidos);
                client.SetParameter("flores_enviadas", User.flores_enviadas);
                client.SetParameter("flores_recibidas", User.flores_recibidas);
                client.SetParameter("uppers_enviados", User.uppers_enviados);
                client.SetParameter("uppers_recibidos", User.uppers_recibidos);
                client.SetParameter("cocos_enviados", User.cocos_enviados);
                client.SetParameter("cocos_recibidos", User.cocos_recibidos);
                client.SetParameter("rings_ganados", User.rings_ganados);
                client.SetParameter("senderos_ganados", User.senderos_ganados);
                client.SetParameter("tutorial_islas", User.tutorial_islas);
                client.SetParameter("timespam_desc_cambios", User.timespam_desc_cambios);
                client.SetParameter("timespam_regalo_grande", User.timespam_regalo_grande);
                client.SetParameter("puntos_cocos", User.puntos_cocos);
                client.SetParameter("puntos_ninja", User.puntos_ninja);
                client.SetParameter("timespam_regalo_peque", User.timespam_regalo_peque);
                client.SetParameter("toneos_ring", User.toneos_ring);
                client.SetParameter("contador_baneo", User.contador_baneo);
                client.SetParameter("t_n_p", User.Traje_Ninja_Principal);
                client.SetParameter("torneos_coco", User.torneos_coco);
                client.SetParameter("email_validado", User.ValidarEmail);
                client.SetParameter("email", User.email);
                client.SetParameter("ver_ranking", User.ver_ranking);
                client.ExecuteNonQuery("UPDATE usuarios SET senderos_ganados = @senderos_ganados, rings_ganados = @rings_ganados, besos_enviados = @besos_enviados, besos_recibidos = @besos_recibidos, jugos_enviados = @jugos_enviados, jugos_recibidos = @jugos_recibidos, flores_enviadas = @flores_enviadas, flores_recibidas = @flores_recibidas, uppers_enviados = @uppers_enviados, uppers_recibidos = @uppers_recibidos, cocos_enviados = @cocos_enviados, cocos_recibidos = @cocos_recibidos, tutorial_islas = @tutorial_islas, timespam_desc_cambios = @timespam_desc_cambios, timespam_regalo_grande = @timespam_regalo_grande, puntos_cocos = @puntos_cocos, puntos_ninja = @puntos_ninja, timespam_regalo_peque = @timespam_regalo_peque, toneos_ring = @toneos_ring, contador_baneo = @contador_baneo, t_n_p = @t_n_p, torneos_coco = @torneos_coco, email_validado = @email_validado, email = @email, ver_ranking = @ver_ranking WHERE id = @id");
            }
        }
        public static void Creditos(UserInstance User, bool Oro, bool sumar, int cantidad)
        {
            SessionInstance Session = UserManager.ObtenerSession(User.id);
            using (mysql client = new mysql())
            {
                client.SetParameter("id", User.id);
                client.SetParameter("cantidad", cantidad);
                if (Session != null)
                {
                    if (Oro)
                    {
                        if (sumar)
                        {
                            if (client.ExecuteNonQuery("UPDATE usuarios SET oro = (oro + @cantidad) WHERE id = @id") == 1)
                            {
                                User.oro += cantidad;
                                ServerMessage server = new ServerMessage();
                                server.AddHead(162);
                                server.AppendParameter(cantidad);
                                Session.SendData(server);
                            }
                        }
                        else
                        {
                            try
                            {
                                if (client.ExecuteNonQuery("UPDATE usuarios SET oro = (oro - @cantidad) WHERE id = @id") == 1)
                                {
                                    User.oro -= cantidad;
                                    ServerMessage server = new ServerMessage();
                                    server.AddHead(161);
                                    server.AppendParameter(cantidad);
                                    Session.SendData(server);
                                }
                            }
                            catch (Exception ex)
                            {
                                Output.WriteLine(ex.ToString()); Program.EditorialResponse(ex);
                            }
                        }
                    }
                    else
                    {
                        if (sumar)
                        {
                            if (client.ExecuteNonQuery("UPDATE usuarios SET plata = (plata + @cantidad) WHERE id = @id") == 1)
                            {
                                User.plata += cantidad;
                                ServerMessage server = new ServerMessage();
                                server.AddHead(166);
                                server.AppendParameter(cantidad);
                                Session.SendData(server);
                            }
                        }
                        else
                        {
                            if (client.ExecuteNonQuery("UPDATE usuarios SET plata = (plata - @cantidad) WHERE id = @id") == 1)
                            {
                                User.plata -= cantidad;
                                ServerMessage server = new ServerMessage();
                                server.AddHead(168);
                                server.AppendParameter(cantidad);
                                Session.SendData(server);
                            }
                        }
                    }
                }
            }
        }
        public static void ActualizarUsuarios()
        {
            using (mysql client = new mysql())
            {
                client.SetParameter("users", UsuariosOnline.Count);
                client.ExecuteNonQuery("UPDATE web SET users_online = @users");
            }
        }
        public static void CerrarSesion(SessionInstance Session, string error)
        {
            if (Session.User != null)
            {
                UserManager.Ajustar_Remuneracion(Session.User);
                MiniGamesManager.CancelarInscripciones(Session.User);
                if (Session.User.Sala != null) SalasManager.Salir_Sala(Session);
                UsuariosOnline.Remove(Session.User.id);
                if (Program.ver_conexion_usuarios == true)
                {
                    Output.WriteLine("[UserManager] -> Se ha desconectado " + Session.User.nombre + ". > " + error);
                }  
                ActualizarUsuarios();
                Program.UpdateTitle();
            }
        }
        public static void ActualizarVipUsuarios(SessionInstance Session)
        {
            if (Session.User != null)
            {
                int Meses_Usuario = Convert.ToInt32(SalaInstance.MonthDifference(Convert.ToDateTime(Session.User.fecha_registro), DateTime.Now));
                if (Meses_Usuario == 12|| Meses_Usuario == 24 || Meses_Usuario == 36 || Meses_Usuario == 48 || Meses_Usuario == 60)
                {
                    if (Time.GetDifference(Session.User.vip) > 0) return;
                    ServerMessage server = new ServerMessage();
                    server.AddHead(126);
                    server.AddHead(122);
                    Session.User.vip_double = Time.GetCurrentAndAdd(AddType.Meses, 1);
                    Session.User.end_vip = Convert.ToString(DateTime.Now.AddMonths(1));
                    FlowerHandler.BoomBangTeam(Session, "¡Felicidades " + Session.User.nombre + "! has cumplido un año mas en BoomBang. De parte de todo BoomBang Team te regalamos 1 Mes de VIP gratis.");
                    FlowerHandler.BoomBangTeam(Session, "¡Felicidades " + Session.User.nombre + " Ahora eres un habitante de BurBian! \r\rTe notificaremos cuando tu suscripción termine faltando 15 días para que puedas renovar tu Membresía.");
                    server.AppendParameter(1);
                    server.AppendParameter(Session.User.end_vip);
                    Session.SendData(server);
                    ServerMessage vip = new ServerMessage();
                    vip.AddHead(126);
                    vip.AddHead(120);
                    vip.AppendParameter(Session.User.id);
                    vip.AppendParameter(1);
                    Session.SendData(vip);
                }
            }
        }
        public static void Desactivar_Usuario(SessionInstance Session)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(163);
            server.AddHead(0);
            server.AppendParameter(0);
            Session.SendData(server);
        }
        
        private static void repair_gift(SessionInstance Session)
        {
            ServerMessage server2 = new ServerMessage();
            server2.AddHead(120);
            server2.AddHead(147);
            server2.AddHead(120);
            server2.AppendParameter(1);
            server2.AppendParameter(Time.GetDifference(Session.User.timespam_regalo_grande));
            server2.AppendParameter(1);
            Session.SendData(server2);
        }
        public static bool RegistrarUsuario(string nombre, string contraseña, int avatar, string colores, int edad, string email, string ip_actual)
        {
            mysql client = new mysql();
            try
            {
                client.SetParameter("nombre", nombre);
                client.SetParameter("contra", contraseña = PasswordEncryptada(contraseña));
                client.SetParameter("avatar", avatar);
                client.SetParameter("colores", colores);
                client.SetParameter("edad", edad);
                client.SetParameter("email", email);
                client.SetParameter("ip_actual", ip_actual);
                client.SetParameter("date", DateTime.Now);
                if (client.ExecuteNonQuery("INSERT INTO usuarios (`nombre`, `password`, `avatar`, `colores`, `email`, `edad`, `ip_registro`, `ip_actual`, `fecha_registro`) VALUES (@nombre, @contra, @avatar, @colores, @email, @edad, @ip_actual, @ip_actual, @date)") == 1)
                {
                    return true;
                }
            }
            catch
            {
                return false;
            }
            return false;
        }
        public static UserInstance ObtenerUsuario(int id)
        {
            using (mysql client = new mysql())
            {
                client.SetParameter("id", id);
                DataRow row = client.ExecuteQueryRow("SELECT * FROM usuarios WHERE id = @id");
                if (row != null)
                {
                    UserInstance user = new UserInstance(row);
                    return user;
                }
            }
            return null;
        }
        public static UserInstance ObtenerUsuario(string nombre)
        {
            mysql client = new mysql();
            client.SetParameter("nombre", nombre);
            DataRow usuario = client.ExecuteQueryRow("SELECT * FROM usuarios WHERE nombre = @nombre");
            if (usuario != null)
            {
                UserInstance user = new UserInstance(usuario);
                return user;
            }
            return null;
        }
        public static UserInstance ObtenerUsuario(string nombre, string contraseña)
        {
            mysql client = new mysql();
            client.SetParameter("nombre", nombre);
            client.SetParameter("password", Gcrypt(contraseña));
            DataRow usuario = client.ExecuteQueryRow("SELECT * FROM usuarios WHERE nombre = @nombre AND password = @password LIMIT 1");
            if (usuario != null)
            {
                UserInstance user = new UserInstance(usuario);
                return user;
            }
            return null;
        }
        public static SessionInstance ObtenerSession(int user_id)
        {
            if (UsuariosOnline.ContainsKey(user_id))
            {
                return UsuariosOnline[user_id];
            }
            return null;
        }
        private static string Gcrypt(string password)
        {
            int key = 54642;
            string crypt = "";
            foreach (char c in password)
            {
                crypt += Convert.ToInt32(c);
            }
            crypt = crypt + key;
            string h2 = new String(crypt.OrderBy(x => x).ToArray());
            string gcrypt = "";
            foreach (char c in h2)
            {
                gcrypt += Convert.ToInt32(c);
            }
            return new String(gcrypt.OrderBy(x => x).ToArray());
        }
        public static string PasswordEncryptada(string Password)
        {
            byte[] Encrypt = EncryptPassword(Encoding.Default.GetBytes(Password));
            char[] Chars = Encoding.Default.GetChars(Encrypt);
            string newString = "";
            foreach (Char Char in Chars)
            {
                int value = Convert.ToInt32(Char);
                newString = newString += value.ToString();
            }
            return newString;
        }
        private static byte[] EncryptPassword(byte[] Data)
        {
            int EncipherConstant = 12337;
            int EncipherMorph = 0;
            int Length = Data.Length;
            int ActualByte;
            int Morph;
            byte[] Buffer = new byte[Length];
            int Index = 0;
            while (Length-- > 0)
            {
                ActualByte = Data[Index];
                Morph = (ActualByte ^ EncipherConstant) ^ EncipherMorph;
                Buffer[Index] = (byte)Morph;
                Index++;
                EncipherConstant = ((EncipherConstant * EncipherConstant));
                EncipherMorph = ActualByte;
            }
            return Buffer;
        }
    }
}

