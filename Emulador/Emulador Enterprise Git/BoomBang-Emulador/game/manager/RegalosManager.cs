using BoomBang.game.handler;
using BoomBang.game.manager;
using BoomBang.server;
using System;
using System.Collections.Generic;
using System.Data;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace BoomBang.game.instances.manager
{
    class RegalosManager
    {
        public static void mini_gift_manager(SessionInstance Session)
        {
            Random rd = new Random();
            int premio = rd.Next(1, 21);
            if (premio == 2 && premio == 3)
            {
                UserManager.Creditos(Session.User, true, true, 150);
                Packet_120_137(Session, 1, 150);
                UserManager.ActualizarEstadisticas(Session.User);
            }
            else if (premio == 1)
            {
                int Objeto = listas.Lista_Todos_Objetos_Plata.Count;
                int Obtener_Objeto = rd.Next(Objeto);
                int idRandom = listas.Lista_Todos_Objetos_Plata[Obtener_Objeto];
                EntregarRegalo(Session, idRandom);
                Packet_120_137(Session, 2, idRandom);
            }
            else
            {
                UserManager.Creditos(Session.User, true, true, 50);
                Packet_120_137(Session, 1, 50);
                UserManager.ActualizarEstadisticas(Session.User);
            }
        }
        static void Packet_120_137(SessionInstance Session, int tipo, int objeto_id)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(120);
            server.AddHead(137);
            server.AppendParameter(tipo);
            server.AppendParameter(objeto_id);
            Session.SendData(server);
        }
        public static void EntregarRegalo(SessionInstance Session, int Objeto)
        {
            using (mysql client = new mysql())
            {
                client.SetParameter("id", Objeto);
                DataRow row = client.ExecuteQueryRow("SELECT * FROM objetos WHERE id = @id");
                CatalogObjectInstance item = new CatalogObjectInstance(row);
                client.SetParameter("item_id", Objeto);
                client.SetParameter("userid", Session.User.id);
                client.SetParameter("hex", item.colores_hex);
                client.SetParameter("rgb", item.colores_rgb);
                client.SetParameter("tam", "tam_n");
                client.SetParameter("default_data", 0);
                if (client.ExecuteNonQuery("INSERT INTO objetos_comprados (`objeto_id`, `colores_hex`, `colores_rgb`, `usuario_id`, `tam`, `data`) VALUES (@item_id, @hex, @rgb, @userid, @tam, @default_data)") == 1)
                {
                    client.SetParameter("id", Objeto);
                    client.SetParameter("UserID", Session.User.id);
                    int compra_id = int.Parse(Convert.ToString(client.ExecuteScalar("SELECT MAX(id) FROM objetos_comprados WHERE objeto_id = @id AND usuario_id = @UserID")));
                    ServerMessage añadir_mochila = new ServerMessage();
                    añadir_mochila.AddHead(189);
                    añadir_mochila.AddHead(139);
                    añadir_mochila.AppendParameter(compra_id);
                    añadir_mochila.AppendParameter(Objeto);
                    añadir_mochila.AppendParameter(item.colores_hex);
                    añadir_mochila.AppendParameter(item.colores_rgb);
                    añadir_mochila.AppendParameter(0);
                    añadir_mochila.AppendParameter(0);
                    añadir_mochila.AppendParameter(0);
                    añadir_mochila.AppendParameter("tam_n");
                    añadir_mochila.AppendParameter(0);
                    añadir_mochila.AppendParameter(0);
                    añadir_mochila.AppendParameter(1);//CantidadObjetos
                    Session.SendData(añadir_mochila);
                }
            }
        }
        public static void Regalo_Grande(SessionInstance Session, string Regalo, int objeto)
        {
            FlowerHandler.BoomBangTeam(Session, "¡Felicidades " + Session.User.nombre + "! has obtenido: " + Regalo);
            ServerMessage regalito = new ServerMessage();
            regalito.AddHead(209);
            regalito.AddHead(128);
            regalito.AppendParameter(4);
            regalito.AppendParameter(1);
            regalito.AppendParameter(8);
            regalito.AppendParameter(1);
            regalito.AppendParameter(objeto);
            regalito.AppendParameter(null);
            regalito.AppendParameter(9);
            Session.SendData(regalito);
        }
        public static void Sistema_Regalos(SessionInstance Session)
        {
            Random random = new Random();
            mysql client = new mysql();
            bool U = (random.Next(1, 4001) == 5);
            int CU = random.Next(1, 2001);
            int V6M = random.Next(1, 1651);
            int O30 = random.Next(1, 1201);
            int O25 = random.Next(1, 1001);
            int O20 = random.Next(1, 801);
            int O15 = random.Next(1, 601);
            int O10 = random.Next(1, 401);
            int P30 = random.Next(1, 201);
            int P25 = random.Next(1, 161);
            int P20 = random.Next(1, 121);
            int P15 = random.Next(1, 81);
            bool Regalo_Determinado = false;

            if (U)
            {
                int Objeto = listas.Lista_Objetos_Unicos.Count;
                int Obtener_Objeto = random.Next(Objeto);
                int idRandom = listas.Lista_Objetos_Unicos[Obtener_Objeto];
                EntregarRegalo(Session, idRandom);
                // Entrega objeto Unico
                DataRow row = client.ExecuteQueryRow("SELECT * FROM objetos WHERE id = '" + idRandom + "'");
                Regalo_Grande(Session, (string)row["titulo"], 43);
                Regalo_Determinado = true;
            }
            else if (CU == 5 && !Regalo_Determinado)
            {
                int Objeto = listas.Lista_Objetos_CU.Count;
                int Obtener_Objeto = random.Next(Objeto);
                int idRandom = listas.Lista_Objetos_CU[Obtener_Objeto];
                EntregarRegalo(Session, idRandom);
                //Enrega regalo Casi Unico
                DataRow row = client.ExecuteQueryRow("SELECT * FROM objetos WHERE id = '" + idRandom + "'");
                Regalo_Grande(Session, (string)row["titulo"], 43);
                Regalo_Determinado = true;
            }
            else if (V6M == 5 && !Regalo_Determinado)// VIP 6 Meses
            {
                Session.User.vip_double = Time.GetCurrentAndAdd(AddType.Meses, 6);
                Session.User.end_vip = Convert.ToString(DateTime.Now.AddMonths(6));
                FlowerHandler.BoomBangTeam(Session, "¡Felicidades " + Session.User.nombre + " Ahora eres un habitante de BurBian! \r\rTe notificaremos cuando tu suscripción termine faltando 15 días para que puedas renovar tu Membresía.");
                client.SetParameter("id", Session.User.id);
                client.SetParameter("vip_double", Session.User.vip_double);
                client.SetParameter("end_vip", Session.User.end_vip);
                client.ExecuteNonQuery("UPDATE usuarios SET vip = @vip_double, end_vip = @end_vip WHERE id = @id");

                Regalo_Grande(Session, "6 Meses VIP", 45);
                Regalo_Determinado = true;
            }
            else if (O30 == 5 && !Regalo_Determinado)/// ORO 30k
            {
                UserManager.Creditos(Session.User, true, true, 30000);
                Regalo_Grande(Session, "30.000 de oro", 42);
                Regalo_Determinado = true;
            }
            else if (O25 == 5 && !Regalo_Determinado)
            {
                int Regalo_Random = random.Next(1, 4);
                if (Regalo_Random == 1) { UserManager.Creditos(Session.User, true, true, 25000); Regalo_Grande(Session, "25.000 de oro", 41); }///Entrega ORO 25K
                if (Regalo_Random == 2)/// Entrega VIP 3 MESES
                {
                    Session.User.vip_double = Time.GetCurrentAndAdd(AddType.Meses, 3);
                    Session.User.end_vip = Convert.ToString(DateTime.Now.AddMonths(3));
                    FlowerHandler.BoomBangTeam(Session, "¡Felicidades " + Session.User.nombre + " Ahora eres un habitante de BurBian! \r\rTe notificaremos cuando tu suscripción termine faltando 15 días para que puedas renovar tu Membresía.");
                    client.SetParameter("id", Session.User.id);
                    client.SetParameter("vip_double", Session.User.vip_double);
                    client.SetParameter("end_vip", Session.User.end_vip);
                    client.ExecuteNonQuery("UPDATE usuarios SET vip = @vip_double, end_vip = @end_vip WHERE id = @id");
                    Regalo_Grande(Session, "3 Meses VIP", 45);
                }
                if (Regalo_Random == 3)
                {
                    /// Entrega objeto MUY RARE
                    int Objeto = listas.Lista_Objetos_MR.Count;
                    int Obtener_Objeto = random.Next(Objeto);
                    int idRandom = listas.Lista_Objetos_MR[Obtener_Objeto];
                    DataRow row = client.ExecuteQueryRow("SELECT * FROM objetos WHERE id = '" + idRandom + "'");
                    Regalo_Grande(Session, (string)row["titulo"], 43);
                    EntregarRegalo(Session, idRandom);
                }
                Regalo_Determinado = true;
            }
            else if (O20 == 5 && !Regalo_Determinado)/// 20k oro
            {
                UserManager.Creditos(Session.User, true, true, 20000);
                Regalo_Grande(Session, "20.000 de oro", 40);
                Regalo_Determinado = true;
            }
            else if (O15 == 5 && !Regalo_Determinado)/// 15k oro
            {
                UserManager.Creditos(Session.User, true, true, 15000);
                Regalo_Grande(Session, "15.000 de oro", 39);
                Regalo_Determinado = true;
            }
            else if (O10 == 5 && !Regalo_Determinado)
            {
                int Regalo_Random = random.Next(1, 4);
                if (Regalo_Random == 1) { UserManager.Creditos(Session.User, true, true, 10000); Regalo_Grande(Session, "10.000 de oro", 38); }///Entrega ORO 10K
                if (Regalo_Random == 2)/// Entrega VIP 1 MESES
                {
                    Session.User.vip_double = Time.GetCurrentAndAdd(AddType.Meses, 1);
                    Session.User.end_vip = Convert.ToString(DateTime.Now.AddMonths(1));
                    FlowerHandler.BoomBangTeam(Session, "¡Felicidades " + Session.User.nombre + " Ahora eres un habitante de BurBian! \r\rTe notificaremos cuando tu suscripción termine faltando 15 días para que puedas renovar tu Membresía.");
                    client.SetParameter("id", Session.User.id);
                    client.SetParameter("vip_double", Session.User.vip_double);
                    client.SetParameter("end_vip", Session.User.end_vip);
                    client.ExecuteNonQuery("UPDATE usuarios SET vip = @vip_double, end_vip = @end_vip WHERE id = @id");
                    Regalo_Grande(Session, "1 Mes VIP", 44);
                }
                if (Regalo_Random == 3)
                {
                    int Objeto = listas.Lista_Objetos_Rare.Count;
                    int Obtener_Objeto = random.Next(Objeto);
                    int idRandom = listas.Lista_Objetos_Rare[Obtener_Objeto];
                    DataRow row = client.ExecuteQueryRow("SELECT * FROM objetos WHERE id = '" + idRandom + "'");
                    Regalo_Grande(Session, (string)row["titulo"], 43);
                    EntregarRegalo(Session, idRandom);

                    /// Entrega objeto RARE
                }
                Regalo_Determinado = true;
            }
            else if (P30 == 5 && !Regalo_Determinado)
            {
                int Regalo_Random = random.Next(1, 3);
                if (Regalo_Random == 1) { UserManager.Creditos(Session.User, false, true, 3000); Regalo_Grande(Session, "3.000 de plata", 37); }
                if (Regalo_Random == 2 && Session.User.puntos_cocos < 600 || Regalo_Random == 2 && Session.User.puntos_ninja < 1000)
                {
                    int Tipo_Puntos = random.Next(1, 3);
                    if (Tipo_Puntos == 1 && Session.User.puntos_cocos < 600)
                    {
                        Session.User.puntos_cocos += 50;
                        Regalo_Grande(Session, "50 puntos coco", 49);
                        ConcursosManager.Alerta_Nuevo_Nivel(Session, 1);
                    }
                    else if (Tipo_Puntos == 1 && Session.User.puntos_cocos >= 600 && Session.User.puntos_ninja < 1000)
                    {
                        Session.User.puntos_ninja += 50;
                        Regalo_Grande(Session, "50 puntos ninja", 53);
                        ConcursosManager.Alerta_Nuevo_Nivel(Session, 2);
                    }
                    if (Tipo_Puntos == 2)
                    {
                        if (Session.User.puntos_ninja < 1000)
                        {
                            Session.User.puntos_ninja += 50;
                            Regalo_Grande(Session, "50 puntos ninja", 53);
                            ConcursosManager.Alerta_Nuevo_Nivel(Session, 2);
                        }
                        else if (Session.User.puntos_cocos < 600)
                        {
                            Session.User.puntos_cocos += 50;
                            Regalo_Grande(Session, "50 puntos coco", 49);
                            ConcursosManager.Alerta_Nuevo_Nivel(Session, 1);
                        }
                    }
                    UserManager.ActualizarEstadisticas(Session.User);
                }
                Regalo_Determinado = true;
            }
            else if (P25 == 5 && !Regalo_Determinado)// 25k PLATA
            {
                int Regalo_Random = random.Next(1, 3);
                if (Regalo_Random == 1)
                { UserManager.Creditos(Session.User, false, true, 2500); Regalo_Grande(Session, "2.500 de plata", 36); }
                if (Regalo_Random == 2 && Session.User.puntos_cocos < 600 || Regalo_Random == 2 && Session.User.puntos_ninja < 1000)
                {
                    int Tipo_Puntos = random.Next(1, 3);
                    if (Tipo_Puntos == 1)
                    {
                        if (Session.User.puntos_cocos < 600)
                        {
                            Session.User.puntos_cocos += 35;
                            Regalo_Grande(Session, "35 puntos coco", 48);
                            ConcursosManager.Alerta_Nuevo_Nivel(Session, 1);
                        }
                        else if (Session.User.puntos_cocos >= 600 && Session.User.puntos_ninja < 1000)
                        {
                            Session.User.puntos_ninja += 35;
                            Regalo_Grande(Session, "35 puntos ninja", 52);
                            ConcursosManager.Alerta_Nuevo_Nivel(Session, 2);
                        }
                    }
                    else if (Tipo_Puntos == 2)
                    {
                        if (Session.User.puntos_ninja < 1000)
                        {
                            Session.User.puntos_ninja += 35;
                            Regalo_Grande(Session, "35 puntos ninja", 52);
                            ConcursosManager.Alerta_Nuevo_Nivel(Session, 2);
                        }
                        else if (Session.User.puntos_ninja >= 1000 && Session.User.puntos_cocos < 600)
                        {
                            Session.User.puntos_cocos += 35;
                            Regalo_Grande(Session, "35 puntos coco", 48);
                            ConcursosManager.Alerta_Nuevo_Nivel(Session, 1);
                        }
                    }
                    UserManager.ActualizarEstadisticas(Session.User);
                }
                Regalo_Determinado = true;
            }
            else if (P20 == 5 && !Regalo_Determinado)
            {
                int Regalo_Random = random.Next(1, 3);
                if (Regalo_Random == 1) { UserManager.Creditos(Session.User, false, true, 2000); Regalo_Grande(Session, "2.000 de plata", 35); }
                if (Regalo_Random == 2 && Session.User.puntos_cocos < 600 || Regalo_Random == 2 && Session.User.puntos_ninja < 1000)
                {
                    int Tipo_Puntos = random.Next(1, 3);
                    if (Tipo_Puntos == 1 && Session.User.puntos_cocos < 600)
                    {
                        Session.User.puntos_cocos += 25;
                        Regalo_Grande(Session, "25 puntos coco", 47);
                        ConcursosManager.Alerta_Nuevo_Nivel(Session, 1);
                    }
                    else if (Tipo_Puntos == 1 && Session.User.puntos_cocos >= 600 && Session.User.puntos_ninja < 1000)
                    {
                        Session.User.puntos_ninja += 25;
                        Regalo_Grande(Session, "25 puntos ninja", 51);
                        ConcursosManager.Alerta_Nuevo_Nivel(Session, 2);
                    }
                    if (Tipo_Puntos == 2 && Session.User.puntos_ninja < 1000)
                    {
                        Session.User.puntos_ninja += 25;
                        Regalo_Grande(Session, "25 puntos ninja", 51);
                        ConcursosManager.Alerta_Nuevo_Nivel(Session, 2);
                    }
                    else if (Tipo_Puntos == 2 && Session.User.puntos_ninja >= 1000 && Session.User.puntos_cocos < 600)
                    {
                        Session.User.puntos_cocos += 25;
                        Regalo_Grande(Session, "25 puntos coco", 47);
                        ConcursosManager.Alerta_Nuevo_Nivel(Session, 1);
                    }
                    UserManager.ActualizarEstadisticas(Session.User);
                }
                Regalo_Determinado = true;
            }
            else if (P15 == 5 && !Regalo_Determinado)
            {
                int Regalo_Random = random.Next(1, 3);
                if (Regalo_Random == 1) { UserManager.Creditos(Session.User, false, true, 1500); Regalo_Grande(Session, "1.500 de plata", 34); }
                if (Regalo_Random == 2 && Session.User.puntos_cocos < 600 || Regalo_Random == 2 && Session.User.puntos_ninja < 1000)
                {
                    int Tipo_Puntos = random.Next(1, 3);
                    if (Tipo_Puntos == 1)
                    {
                        if (Session.User.puntos_cocos < 600)
                        {
                            Session.User.puntos_cocos += 10;
                            Regalo_Grande(Session, "10 puntos coco", 46);
                            ConcursosManager.Alerta_Nuevo_Nivel(Session, 1);
                        }
                        else if (Session.User.puntos_cocos >= 600 && Session.User.puntos_ninja < 1000)
                        {
                            Session.User.puntos_ninja += 10;
                            Regalo_Grande(Session, "10 puntos ninja", 50);
                            ConcursosManager.Alerta_Nuevo_Nivel(Session, 2);
                        }
                    }
                    else if (Tipo_Puntos == 2)
                    {
                        if (Session.User.puntos_ninja < 1000)
                        {
                            Session.User.puntos_ninja += 10;
                            Regalo_Grande(Session, "10 puntos ninja", 50);
                            ConcursosManager.Alerta_Nuevo_Nivel(Session, 2);
                        }
                        else if (Session.User.puntos_ninja >= 1000 && Session.User.puntos_cocos < 600)
                        {
                            Session.User.puntos_cocos += 10;
                            Regalo_Grande(Session, "10 puntos coco", 46);
                            ConcursosManager.Alerta_Nuevo_Nivel(Session, 1);
                        }
                    }
                    UserManager.ActualizarEstadisticas(Session.User);
                }
                Regalo_Determinado = true;
            }
            else if (!Regalo_Determinado) // 10k PLATA
            {
                UserManager.Creditos(Session.User, false, true, 1000);
                Regalo_Grande(Session, "1.000 de plata", 57);
                Regalo_Determinado = true;
            }
        }
    }
}
