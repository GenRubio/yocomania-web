using BoomBang.game.instances;
using BoomBang.game.instances.manager;
using BoomBang.game.manager;
using BoomBang.game.packets;
using BoomBang.server;
using System;
using System.Collections.Generic;
using System.Data;
using System.Linq;
using System.Text;
using System.Threading;
using System.Threading.Tasks;

namespace BoomBang.game.handler
{
    class FlowerHandler
    {
        public static void Start()
        {
            HandlerManager.RegisterHandler(120133, handler_120133);
            HandlerManager.RegisterHandler(120141, handler_120141);
            HandlerManager.RegisterHandler(120134, handler_120134);//Concursos
            HandlerManager.RegisterHandler(210120, handler_210120);
            HandlerManager.RegisterHandler(120132, Actualizar_avatar);
            HandlerManager.RegisterHandler(148122, Validar_Email);
            HandlerManager.RegisterHandler(148128, Cambiar_Email);
            HandlerManager.RegisterHandler(148131, cambiar_contraseña_1);
            HandlerManager.RegisterHandler(148126, cambiar_contraseña_2);
            HandlerManager.RegisterHandler(148132, opciones_conexion);
            HandlerManager.RegisterHandler(148127, desactivar_cuenta);
            HandlerManager.RegisterHandler(148120, activar_clave_seguridad);
            HandlerManager.RegisterHandler(148125, validar_clave_seguridad);
            HandlerManager.RegisterHandler(148121, Desactivar_Seguridad);
            HandlerManager.RegisterHandler(148123, Cancelar_Desactivacion_Seguridad);
            HandlerManager.RegisterHandler(126122, comprar_vip);
            HandlerManager.RegisterHandler(126123, detalles_vip);
            //HandlerManager.RegisterHandler(164, ComprarCreditos);
            HandlerManager.RegisterHandler(120147120, handler_120147120Gen);//Regalo Grande
            HandlerManager.RegisterHandler(120147121, handler_120147121);//Abrir Regalo Grande
            HandlerManager.RegisterHandler(120137, handler_120137);//Abrir regalo peque
            HandlerManager.RegisterHandler(120146, handler_120146);//Cambiar nombre de usuario
        }
        static void handler_120146(SessionInstance Session, string[,] Parameters)//Cambiar nombre de usuario
        {
            if (Session.User != null)
            {
                if (Session.User.Sala != null) return;
                if (Session.User.cambio_nombre != 1) return;
                 handler_120146(Session, Parameters[0, 0]);
            }
        }
        static void handler_120137(SessionInstance Session, string[,] Parameters)//Abrir regalo peque premio 50 oro
        {
            if (Session.User != null)
            {
                if (Session.User.Sala != null) return;
                if (Time.GetDifference(Session.User.timespam_regalo_peque) > 0) return;
                handler_120137(Session);
            }
        }
        public static void BoomBangTeam(SessionInstance Session, string Parameters)
        {
             Packet_132_127(Session, Parameters);
        }
        static void Cancelar_Desactivacion_Seguridad(SessionInstance Session, string[,] Parameters)
        {
            if (Session.User != null)
            {
                if (Session.User.Sala != null) return;
                 Packet_148_123(Session, Parameters[0, 0]);
            }
        }
        static void Desactivar_Seguridad(SessionInstance Session, string[,] Parameters)
        {
            if (Session.User != null)
            {
                if (Session.User.Sala != null) return;
                 Packet_148_121(Session);
            }
        }
        static void handler_120147121(SessionInstance Session, string[,] Parameters)//Abrir Regalo Grande
        {
            if (Session.User != null)
            {
                if (Session.User.Sala != null) return;
                handler_120147121(Session);  
            }
        }
        static void handler_120147120Gen(SessionInstance Session, string[,] Parameters)//Regalo Grande
        {
            if (Session.User != null)
            {
                if (Session.User.Sala != null) return;
                Packet_120_147_120(Session);
            }
        }
        public static void Noticia(SessionInstance Session)
        {
            if (Session.User != null)
            {
                if (Session.User.Sala != null) return;
                if (Session.User.noticia_registro == 0) return;
                 Noticia_handler(Session);
                 Packet_209_128(Session);
            }
        }
        static void detalles_vip(SessionInstance Session, string[,] Parameters)
        {
            if (Session.User != null)
            {
                if (Session.User.Sala != null) return;
                 Packet_126_123(Session);
            }
        }
        static void comprar_vip(SessionInstance Session, string[,] Parameters)
        {
            if (Session.User != null)
            {
                if (Session.User.Sala != null) return;
                 Packet_126_122(Session, int.Parse(Parameters[0, 0]));
            }
        }
        static void validar_clave_seguridad(SessionInstance Session, string[,] Parameters)
        {
            if (Session.User != null)
            {
                 Packet_148_125(Session, Parameters[0, 0], int.Parse(Parameters[1, 0]));
            }
        }
        static void activar_clave_seguridad(SessionInstance Session, string[,] Parameters)
        {
            if (Session.User != null)
            {
                 Packet_148_120(Session, Parameters[0, 0]);
            }
        }
        static void desactivar_cuenta(SessionInstance Session, string[,] Parameters)
        {
            if (Session.User != null)
            {
                if (Session.User.Sala != null) return;
                Packet_148_127(Session, Parameters[0, 0]);
            }
        }
        static void opciones_conexion(SessionInstance Session, string[,] Parameters)
        {
            if (Session.User != null)
            {
                if (Session.User.Sala != null) return;
                 Packet_148_132(Session);
            }
        }
        static void cambiar_contraseña_2(SessionInstance Session, string[,] Parameters)
        {
            if (Session.User != null)
            {
                if (Session.User.Sala != null) return;
                 Packet_148_126(Session, Parameters[0, 0], Parameters[2, 0], Parameters[1, 0]);
            }
        }
        static void cambiar_contraseña_1(SessionInstance Session, string[,] Parameters)
        {
            if (Session.User != null)
            {
                if (Session.User.Sala != null) return;
                 Packet_148_131(Session, Parameters[0, 0]);
            }
        }
        static void Validar_Email(SessionInstance Session, string[,] Parameters)
        {
            if (Session.User != null)
            {
                if (Session.User.Sala != null) return;
                 Packet_148_122(Session);
            }
        }
        static void Cambiar_Email(SessionInstance Session, string[,] Parameters)
        {
            if (Session.User != null)
            {
                if (Session.User.Sala != null) return;
                 Packet_148_128(Session, Parameters[0, 0]);
            }
        }
        static void Actualizar_avatar(SessionInstance Session, string[,] Parameters)
        {
            if (Session.User != null)
            {
                if (Session.User.Sala != null) return;
                if (Session.User.PreLock_Cambio_Colores == true) return;
                if (int.Parse(Parameters[1, 0]) >= 1 && int.Parse(Parameters[1, 0]) <= 11)
                {
                    if (int.Parse(Parameters[1, 0]) >= 1 && int.Parse(Parameters[1, 0]) <= 11 && Parameters[0, 0].Substring(0,6) == "000000") { return; }
                    if (int.Parse(Parameters[1, 0]) >= 8 && int.Parse(Parameters[1, 0]) <= 9 && Parameters[0, 0].Substring(6, 6) == "000000") { return; }
                    UserManager.ActualizarAvatar(Session.User, Parameters[0, 0], int.Parse(Parameters[1, 0]));
                    Session.User.Time_Cambio_Colores = Time.GetCurrentAndAdd(AddType.Segundos, 13);
                }
            }
        }
        static void handler_210120(SessionInstance Session, string[,] Parameters)
        {
            if (Session.User != null)
            {
                if (Session.User.Sala != null) return;
                 Packet_210_120(Session);
            }
        }
        static void handler_120134(SessionInstance Session, string[,] Parameters)///Concurso?
        {
            if (Session.User != null)
            {
                if (Session.User.Sala != null) return;
                 Packet_120_134(Session);
            }
        }
        static void handler_120141(SessionInstance Session, string[,] Parameters)
        {
            if (Session.User != null)
            {
                if (Session.User.Sala != null) return;
                 Packet_120_141(Session);
            }
        }
        private static void Noticia_handler(SessionInstance Session)
        {
            mysql client = new mysql();
            client.ExecuteNonQuery("UPDATE usuarios SET noticia_registro = 0 WHERE id = '" + Session.User.id + "'");
            Session.User.noticia_registro = 0;
        }
        private static void handler_120147121(SessionInstance Session)
        {
            if (Time.GetDifference(Session.User.timespam_regalo_grande) >= 1)
            {
                TimeSpan tiempo = TimeSpan.FromSeconds(Time.GetDifference(Session.User.timespam_regalo_grande));
                 Packet_183(Session, "¡Mega Regalo!\rPróximo regalo en: " + tiempo + "\rContenido: Objetos: Rare, Muy Rare, Casi Unicos, Unicos        vv Baja vv\rCreditos: 1k, 1.5k, 2.0k, 2.5k, 3.0k - 10k, 15k, 20k, 25k , 30k (Plata - Oro)\rPuntos: Shurikens: 10 - 25 - 35 - 50 || Coco: 10 - 25 - 35 - 50\rVIP: 1Mes || 3Meses || 6Meses");
            }
            if (Time.GetDifference(Session.User.timespam_regalo_grande) <= 0)
            {
                Session.User.timespam_regalo_grande = 0;
                Session.User.timespam_regalo_grande = Time.GetCurrentAndAdd(AddType.Horas, 8);
                UserManager.ActualizarEstadisticas(Session.User);
                 Packet_120_147_121(Session);
                RegalosManager.Sistema_Regalos(Session);
            }
        }
        private static void handler_120137(SessionInstance Session)
        {
            Session.User.timespam_regalo_peque = 0;
            Session.User.timespam_regalo_peque = Time.GetCurrentAndAdd(AddType.Dias, 1);
            RegalosManager.mini_gift_manager(Session);
        }
        private static void handler_120146(SessionInstance Session, string nombre)
        {
            mysql client = new mysql();
            DataRow objeto = client.ExecuteQueryRow("SELECT * FROM objetos_comprados WHERE objeto_id = '3065' AND usuario_id = '" + Session.User.id + "'");
            if (objeto != null)
            {
                DataRow comprobar_nombre = client.ExecuteQueryRow("SELECT * FROM usuarios WHERE nombre = '" + nombre + "'");
                if (comprobar_nombre != null)
                {
                    Packet_120_146(Session, 0);
                    return;
                }
                client.ExecuteNonQuery("UPDATE usuarios SET nombre_antiguo = '" + Session.User.nombre + "' WHERE id = '" + Session.User.id + "'");
                client.ExecuteNonQuery("UPDATE usuarios SET nombre = '" + nombre + "' WHERE id = '" + Session.User.id + "'");
                client.ExecuteNonQuery("UPDATE usuarios SET cambio_nombre = '0' WHERE id = '" + Session.User.id + "'");
                client.ExecuteNonQuery("DELETE FROM objetos_comprados WHERE objeto_id = '3065' AND usuario_id = '" + Session.User.id + "' LIMIT 1");
                Session.User.nombre = nombre;
                Packet_120_146(Session, 1);
                Packet_189_169(Session, -1, 3065);
            }
        }
        private static void Packet_132_127(SessionInstance Session, string Parameters)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(132);
            server.AddHead(127);
            server.AppendParameter(0);
            server.AppendParameter(Session.User.id);
            server.AppendParameter(Convert.ToString(DateTime.Now).Substring(0, 16));
            server.AppendParameter(Parameters);
            server.AppendParameter(2);
            Session.SendData(server);
        }
        private static void Packet_148_123(SessionInstance Session, string security)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(148);
            server.AddHead(123);
            try
            {
                if (Session.User.security == security)
                {
                    if (Session.User.timespam_desc_cambios != 0)
                    {
                        Session.User.timespam_desc_cambios = 0;
                        UserManager.ActualizarEstadisticas(Session.User);
                        server.AppendParameter(1);
                    }
                    else
                    {
                        server.AppendParameter(-1);
                    }
                }
                else
                {
                    server.AppendParameter(0);
                }
            }
            catch
            {
                server.AppendParameter(-1);
            }
            Session.SendData(server);
        }
        private static void Packet_148_121(SessionInstance Session)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(148);
            server.AddHead(121);
            try
            {
                if (Session.User.timespam_desc_cambios == 0)
                {
                    Session.User.timespam_desc_cambios = Time.GetCurrentAndAdd(AddType.Dias, 7);
                    UserManager.ActualizarEstadisticas(Session.User);
                    server.AppendParameter(1);
                    Packet_132_127(Session, "Has iniciado el proceso de desactivación de la clave de seguridad en tu cuenta, este proceso toma 7 días en realizarse a partir de ahora.");
                    Packet_132_127(Session, "Recuerda que puedes cancelar la desactivación en cualquier momento introduciendo tu clave de seguridad actual.");
                }
            }
            catch
            {
                server.AppendParameter(-1);
            }
            Session.SendData(server);
        }
        private static void Packet_120_147_120(SessionInstance Session)
        {
            Thread.Sleep(new TimeSpan(0, 0, 0, 0, 500));
            ServerMessage server = new ServerMessage();
            server.AddHead(120);
            server.AddHead(147);
            server.AddHead(120);
            server.AppendParameter(1);
            server.AppendParameter(Time.GetDifference(Session.User.timespam_regalo_grande));
            server.AppendParameter(1);
            Session.SendDataProtected(server);
        }
        private static void Packet_209_128(SessionInstance Session)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(209);
            server.AddHead(128);
            server.AppendParameter(0);
            Session.SendData(server);
        }
        private static void Packet_126_123(SessionInstance Session)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(126);
            server.AddHead(123);
            server.AppendParameter(0);
            Session.SendDataProtected(server);
        }
        private static void Packet_126_120(SessionInstance Session)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(126);
            server.AddHead(120);
            server.AppendParameter(Session.User.id);
            server.AppendParameter(1);
            Session.SendData(server);
        }
        private static void Packet_126_122(SessionInstance Session, int type)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(126);
            server.AddHead(122);
            if (Session.User.oro >= 10000)
            {
                if (ComprarVip(Session, Session.User, server, type))
                {
                    Packet_126_120(Session);
                }
            }
            else
            {
                server.AppendParameter(0);
            }
            Session.SendData(server);
        }
        private static void Packet_148_125(SessionInstance Session, string contraseña, int modulo)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(148);
            server.AddHead(125);
            if (contraseña == Session.User.security)
            {
                switch (modulo)
                {
                    case 1://Dar de baja la cuenta
                        server.AppendParameter(1);
                        break;
                    case 2://Cambios
                        server.AppendParameter(1);
                        break;
                    case 3://Cambiar Email
                        server.AppendParameter(1);
                        break;
                    case 4://Cambiar Contraseña
                        server.AppendParameter(1);
                        break;
                    case 5://Opciones de conexion
                        server.AppendParameter(1);
                        break;
                    default:
                        server.AppendParameter(-1);
                        break;
                }
                server.AppendParameter(0);
                server.AppendParameter(Session.User.security);
            }
            else
            {
                server.AppendParameter(0);
            }
            Session.SendData(server);
        }
        private static void Packet_148_120(SessionInstance Session, string clave)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(148);
            server.AddHead(120);
            if (string.IsNullOrEmpty(Session.User.security))
            {
                if (UserManager.ActivarClaveSeguridad(Session.User, clave))
                {
                    server.AppendParameter(1);
                }
                else
                {
                    server.AppendParameter(0);
                }
            }
            else
            {
                server.AppendParameter(0);
            }
            Session.SendData(server);
        }
        private static void Packet_148_127(SessionInstance Session, string security)
        {
            try
            {
                if (Session.User.security != security) return;
                using (mysql client = new mysql())
                {
                    client.SetParameter("id", Session.User.id);
                    client.SetParameter("name", Session.User.nombre);
                    client.SetParameter("time", DateTime.Now);
                    if (client.ExecuteNonQuery("INSERT INTO cuentas_desactivadas (`id`, `Nombre`, `Fecha_Desactivacion`) VALUES (@id, @name, @time)") == 1)
                    {
                        Packet_174(Session);
                        UserManager.Desactivar_Usuario(Session);
                    }
                }
            }
            catch
            {
                ServerMessage server = new ServerMessage();
                server.AddHead(148);
                server.AddHead(127);
                server.AppendParameter(-1);
                Session.SendData(server);
            }
        }
        //³²0³²1³²0
        private static void Packet_174(SessionInstance Session)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(174);
            server.AppendParameter("Has dado de baja esta cuenta.");
            Session.SendData(server);
        }
        private static void Packet_148_132(SessionInstance Session)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(148);
            server.AddHead(132);
            server.AppendParameter(-1);
            Session.SendData(server);
        }
        private static void Packet_148_126(SessionInstance Session, string old, string seguridad, string nueva)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(148);
            server.AddHead(126);
            if (UserManager.Coincidencia_Contraseña(Session.User, UserManager.PasswordEncryptada(old)))
            {
                if (seguridad == Session.User.security)
                {
                    if (UserManager.Actualizar_Contraseña(Session.User, UserManager.PasswordEncryptada(nueva)))
                    {
                        server.AppendParameter(1);
                    }
                    else
                    {
                        server.AppendParameter(0);
                    }
                }
                else
                {
                    server.AppendParameter(0);
                }
            }
            else
            {
                server.AppendParameter(0);
            }
            Session.SendData(server);
        }
        private static void Packet_148_131(SessionInstance Session, string password)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(148);
            server.AddHead(131);
            if (UserManager.Coincidencia_Contraseña(Session.User, UserManager.PasswordEncryptada(password)))
            {
                server.AppendParameter(1);
            }
            else
            {
                server.AppendParameter(0);
            }
            Session.SendData(server);
        }
        private static void Packet_148_122(SessionInstance Session)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(148);
            server.AddHead(122);
            if (Session.User.ValidarEmail == 0)
            {
                server.AppendParameter(1);
                Session.User.ValidarEmail = 1;
                UserManager.ActualizarEstadisticas(Session.User);
            }

            Session.SendData(server);
        }
        private static void Packet_148_128(SessionInstance Session, string email)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(148);
            server.AddHead(128);
            if (Session.User.ValidarEmail == 1 && Session.User.email != email)
            {
                Session.User.email = email;
                UserManager.ActualizarEstadisticas(Session.User);
                server.AppendParameter(1);
            }
            else
            {
                server.AppendParameter(2);
            }
            Session.SendData(server);
        }
        private static void Packet_210_120(SessionInstance Session)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(210);
            server.AddHead(120);
            server.AppendParameter(new object[] { 1, 20, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 2, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 50 });
            server.AppendParameter(new object[] { 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 50 });
            Session.SendDataProtected(server);
        }
        private static void Packet_120_134(SessionInstance Session)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(120);
            server.AddHead(134);
            server.AppendParameter(new object[] { 2, 1 });
            server.AppendParameter(new object[] { 0, 1 });
            Session.SendDataProtected(server);         
        }
        static void handler_120133(SessionInstance Session, string[,] Parameters)
        {
            //Console.WriteLine(Parameters[1, 0]);
            //string tam = Parameters[1, 0];
            //int id = int.Parse(Parameters[0, 0]);
            ServerMessage server = new ServerMessage();
            server.AddHead(120);
            server.AddHead(133);
            server.AppendParameter(1);
            server.AppendParameter(1);
            Session.SendDataProtected(server);
        }
        private static void Packet_120_141(SessionInstance Session)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(120);
            server.AddHead(141);
            server.AppendParameter(0);
            Session.SendDataProtected(server);
        }
        private static void Packet_183(SessionInstance Session, string mensaje)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(183);
            server.AppendParameter(mensaje);
            Session.SendData(server);
        }
        private static void Packet_120_147_121(SessionInstance Session)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(120);
            server.AddHead(147);
            server.AddHead(121);
            server.AppendParameter(1);
            Session.SendData(server);
        }
        private static void Packet_120_146(SessionInstance Session, int parametro)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(120);
            server.AddHead(146);
            server.AppendParameter(parametro);
            Session.SendData(server);
        }
        private static void Packet_189_169(SessionInstance Session, int compra_id, int Item)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(189);
            server.AddHead(169);
            server.AppendParameter(compra_id);
            server.AppendParameter(Item);
            server.AppendParameter(1);
            Session.SendData(server);
        }
        protected static bool ComprarVip(SessionInstance Session, UserInstance User, ServerMessage server, int type)
        {
            if (User.vip == 0)
            {
                using (mysql client = new mysql())
                {
                    switch (type)
                    {
                        case 1:
                            if (User.oro >= 10000)
                            {
                                User.vip_double = Time.GetCurrentAndAdd(AddType.Meses, 1);
                                User.end_vip = Convert.ToString(DateTime.Now.AddMonths(1));
                                UserManager.Creditos(User, true, false, 10000);
                                FlowerHandler.BoomBangTeam(Session, "¡Felicidades " + Session.User.nombre + " Ahora eres un habitante de BurBian! \r\rTe notificaremos cuando tu suscripción termine faltando 15 días para que puedas renovar tu Membresía.");
                                server.AppendParameter(1);
                                server.AppendParameter(User.end_vip);
                            }
                            else
                            {
                                server.AppendParameter(0);
                                return false;
                            }
                            break;
                        case 2:
                            if (User.oro >= 25000)
                            {
                                User.vip_double = Time.GetCurrentAndAdd(AddType.Meses, 3);
                                User.end_vip = Convert.ToString(DateTime.Now.AddMonths(3));
                                UserManager.Creditos(User, true, false, 25000);
                                FlowerHandler.BoomBangTeam(Session, "¡Felicidades " + Session.User.nombre + " Ahora eres un habitante de BurBian! \r\rTe notificaremos cuando tu suscripción termine faltando 15 días para que puedas renovar tu Membresía.");
                                server.AppendParameter(1);
                                server.AppendParameter(User.end_vip);
                            }
                            else
                            {
                                server.AppendParameter(0);
                                return false;
                            }
                            break;

                        case 3:
                            if (User.oro >= 45000)
                            {
                                User.vip_double = Time.GetCurrentAndAdd(AddType.Meses, 6);
                                User.end_vip = Convert.ToString(DateTime.Now.AddMonths(6));
                                UserManager.Creditos(User, true, false, 45000);
                                FlowerHandler.BoomBangTeam(Session, "¡Felicidades " + Session.User.nombre + " Ahora eres un habitante de BurBian! \r\rTe notificaremos cuando tu suscripción termine faltando 15 días para que puedas renovar tu Membresía.");
                                server.AppendParameter(1);
                                server.AppendParameter(User.end_vip);
                            }
                            else
                            {
                                server.AppendParameter(0);
                                return false;
                            }
                            break;
                    }
                    client.SetParameter("id", User.id);
                    client.SetParameter("vip_double", User.vip_double);
                    client.SetParameter("end_vip", User.end_vip);
                    client.ExecuteNonQuery("UPDATE usuarios SET vip = @vip_double, end_vip = @end_vip WHERE id = @id");
                    return true;
                }
            }
            return false;
        }
    }
}
