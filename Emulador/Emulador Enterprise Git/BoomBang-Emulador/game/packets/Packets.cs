using BoomBang.game.handler;
using BoomBang.game.instances;
using BoomBang.game.manager;
using BoomBang.server;
using System;
using System.Collections.Generic;
using System.Data;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace BoomBang.game.packets
{
    class Packets
    {
        public static void Packet_189_173(SessionInstance Session, BuyObjectInstance Compra)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(189);
            server.AddHead(173);
            server.AppendParameter(Compra.id);
            server.AppendParameter((86400 - Time.GetDifference(Compra.Planta_agua)) / 12);
            server.AppendParameter(Time.GetDifference(Compra.Planta_agua));
            server.AppendParameter((604800 - Time.GetDifference(Compra.Planta_sol)) / 4);
            server.AppendParameter(Time.GetDifference(Compra.Planta_sol));
            server.AppendParameter(1);
            Session.User.Sala.SendData(server, Session);
        }
        public static void Packet_189_180(SessionInstance Session, mysql client)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(189);
            server.AddHead(180);
            Int64 total_item = 0;
            foreach (DataRow dRow in client.ExecuteQueryTable("SELECT distinct objeto_id from objetos_comprados WHERE usuario_id = '"+ Session.User.id+"' AND sala_id = 0").Rows)
            {
                client.SetParameter("KekoID", Session.User.id);
                client.SetParameter("Item", Convert.ToInt32(dRow["objeto_id"]));
                total_item = (Int64)client.ExecuteScalar("SELECT COUNT(id) FROM objetos_comprados WHERE objeto_id = @Item AND sala_id = 0 AND usuario_id = '" + Session.User.id + "'");
                server.AppendParameter(Convert.ToInt32(dRow["objeto_id"]));
                server.AppendParameter(total_item);
            }
            Session.SendData(server);
        }
        public static void Packet_210_125(SessionInstance Session)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(210);
            server.AddHead(125);
            server.AppendParameter(1);
            server.AppendParameter(1);
            Session.SendData(server);
        }
        public static void Packet_167(SessionInstance Session)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(167);
            server.AppendParameter(Session.User.VotosRestantes);
            Session.User.Sala.SendData(server, Session);
        }
        public static void Packet_120_123(SessionInstance Session)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(120);
            server.AddHead(143);
            server.AppendParameter(0);
            server.AppendParameter(-1);
            server.AppendParameter(CasasManager.GetZoneID(Session.User.id, 1));
            server.AppendParameter(25);
            Session.SendData(server);
        }
        public static void Packet_189_174(SessionInstance Session, string[,] Parameters)
        {
            mysql client = new mysql();
            ServerMessage server = new ServerMessage();
            server.AddHead(189);
            server.AddHead(174);
            server.AppendParameter(int.Parse(Parameters[0, 0]));
            server.AppendParameter(int.Parse(Parameters[1, 0]));
            server.AppendParameter(Parameters[2, 0]);
            server.AppendParameter(Parameters[3, 0]);
            server.AppendParameter(Parameters[4, 0]);
            server.AppendParameter(Parameters[5, 0]);
            if (Session.User.Sala.Escenario.Creador.id == Session.User.id)
            {
                if (int.Parse(Parameters[0, 0]) == 0)
                {
                    client.SetParameter("id", Session.User.Sala.Escenario.id);
                    client.SetParameter("terreno_something_1", int.Parse(Parameters[0, 0]));
                    client.SetParameter("terreno_something_2", int.Parse(Parameters[1, 0]));
                    client.SetParameter("terreno_something_3", Parameters[2, 0]);
                    client.SetParameter("terreno_config", Parameters[3, 0]);
                    client.SetParameter("terreno_colores", Parameters[4, 0]);
                    client.SetParameter("terreno_rgb", Parameters[5, 0]);
                    if (client.ExecuteNonQuery("UPDATE escenarios_privados SET terreno_something_1 = @terreno_something_1, terreno_something_2 = @terreno_something_2, terreno_something_3 = @terreno_something_3, terreno_config = @terreno_config, terreno_colores = @terreno_colores, terreno_rgb = @terreno_rgb WHERE id = @id") == 1)
                    {
                        Session.User.Sala.Escenario.terreno_something_1 = int.Parse(Parameters[0, 0]);
                        Session.User.Sala.Escenario.terreno_something_2 = int.Parse(Parameters[1, 0]);
                        Session.User.Sala.Escenario.terreno_something_3 = Parameters[2, 0];
                        Session.User.Sala.Escenario.terreno_config = Parameters[3, 0];
                        Session.User.Sala.Escenario.terreno_colores = Parameters[4, 0];
                        Session.User.Sala.Escenario.terreno_rgb = Parameters[5, 0];
                        Session.User.Sala.SendData(server, Session);
                    }
                }
                if (int.Parse(Parameters[0, 0]) == 1)
                {
                    client.SetParameter("id", Session.User.Sala.Escenario.id);
                    client.SetParameter("object_something_1", int.Parse(Parameters[0, 0]));
                    client.SetParameter("object_something_2", int.Parse(Parameters[1, 0]));
                    client.SetParameter("object_something_3", Parameters[2, 0]);
                    client.SetParameter("object_config", Parameters[3, 0]);
                    client.SetParameter("object_colores", Parameters[4, 0]);
                    client.SetParameter("object_rgb", Parameters[5, 0]);
                    if (client.ExecuteNonQuery("UPDATE escenarios_privados SET object_something_1 = @object_something_1, object_something_2 = @object_something_2, object_something_3 = @object_something_3, object_config = @object_config, object_colores = @object_colores, object_rgb = @object_rgb WHERE id = @id") == 1)
                    {
                        Session.User.Sala.Escenario.object_something_1 = int.Parse(Parameters[0, 0]);
                        Session.User.Sala.Escenario.object_something_2 = int.Parse(Parameters[1, 0]);
                        Session.User.Sala.Escenario.object_something_3 = Parameters[2, 0];
                        Session.User.Sala.Escenario.object_config = Parameters[3, 0];
                        Session.User.Sala.Escenario.object_colores = Parameters[4, 0];
                        Session.User.Sala.Escenario.object_rgb = Parameters[5, 0];
                        Session.User.Sala.SendData(server, Session);
                    }
                }
            }
        }
        public static void Packet_189_181(SessionInstance Session, string[,] Parameters)
        {
            mysql client = new mysql();
            ServerMessage server = new ServerMessage();
            server.AddHead(189);
            server.AddHead(181);
            foreach (DataRow row in client.ExecuteQueryTable("SELECT * FROM objetos_comprados WHERE usuario_id = '"+ Session.User.id+"' AND objeto_id = '"+ int.Parse(Parameters[0, 0]) +"' AND sala_id = '0'").Rows)
            {
                BuyObjectInstance Item = new BuyObjectInstance(row);
                server.AppendParameter(Item.id);
                server.AppendParameter(Item.objeto_id);
                server.AppendParameter(Item.colores_hex);
                server.AppendParameter(Item.colores_rgb);
                server.AppendParameter(0);
                server.AppendParameter(0);
                server.AppendParameter(Item.tam);
                server.AppendParameter(0);
                server.AppendParameter(0);
                server.AppendParameter(0);
                server.AppendParameter(1);
            }
            Session.SendData(server);
        }
        public static void Packet_189_136(SessionInstance Session, BuyObjectInstance Compra)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(189);
            server.AddHead(136);
            server.AppendParameter(Compra.id);
            server.AppendParameter(Compra.objeto_id);
            server.AppendParameter(Session.User.Sala.Escenario.id);
            server.AppendParameter(Session.User.id);
            server.AppendParameter(Compra.posX);
            server.AppendParameter(Compra.posY);
            server.AppendParameter(Compra.rotation);//rotation
            server.AppendParameter(Compra.tam);
            server.AppendParameter("Gen");///Ranking Position Premio
            server.AppendParameter(Compra.espacio_ocupado); //Espacio Ocupado
            server.AppendParameter(Compra.colores_hex);//color_1
            server.AppendParameter(Compra.colores_rgb);//color_2
            server.AppendParameter("0");//Other
            server.AppendParameter("0");//Other
            server.AppendParameter(Compra.data);
            Session.User.Sala.SendData(server, Session);
        }
        public static void Packet_189_142(SessionInstance Session, BuyObjectInstance Compra, string[,] Parameters)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(189);
            server.AddHead(142);
            server.AppendParameter(Session.User.Sala.ObjetosEnSala[Compra.id].id);
            server.AppendParameter(Session.User.Sala.ObjetosEnSala[Compra.id].colores_hex);
            server.AppendParameter(Session.User.Sala.ObjetosEnSala[Compra.id].colores_rgb);
            server.AppendParameter(Parameters[3, 0]);
            server.AppendParameter(Parameters[4, 0]);
            server.AppendParameter(Parameters[5, 0]);
            Session.User.Sala.SendData(server, Session);
        }
        public static void Packet_189_145(SessionInstance Session, BuyObjectInstance Compra)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(189);
            server.AddHead(145);
            server.AppendParameter(Session.User.Sala.ObjetosEnSala[Compra.id].id);
            server.AppendParameter(Session.User.Sala.ObjetosEnSala[Compra.id].posX);
            server.AppendParameter(Session.User.Sala.ObjetosEnSala[Compra.id].posY);
            server.AppendParameter(Session.User.Sala.ObjetosEnSala[Compra.id].espacio_ocupado);
            server.AppendParameter(Session.User.Sala.ObjetosEnSala[Compra.id].tam);
            server.AppendParameter(Session.User.Sala.ObjetosEnSala[Compra.id].rotation);
            Session.User.Sala.SendData(server, Session);
        }
        public static void Packet_189_140(SessionInstance Session, BuyObjectInstance Compra)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(189);
            server.AddHead(140);
            server.AppendParameter(Compra.id);
            Session.User.Sala.SendData(server, Session);
        }
        public static void Packet_189_143(SessionInstance Session, int ID, int NewRotation, string coor)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(189);
            server.AddHead(143);
            server.AppendParameter(ID);
            server.AppendParameter(NewRotation);
            server.AppendParameter(coor);
            Session.User.Sala.SendData(server, Session);
        }
        public static void Packet_189_157(SessionInstance Session, BuyObjectInstance Item, int ID)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(189);
            server.AddHead(157);
            server.AppendParameter(ID);
            server.AppendParameter(Session.User.Sala.ObjetosEnSala[Item.id].posX);
            server.AppendParameter(Session.User.Sala.ObjetosEnSala[Item.id].posY);
            Session.User.Sala.SendData(server, Session);
        }
        public static void Packet_189_158(SessionInstance Session, int ID, int Estado)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(189);
            server.AddHead(158);
            server.AppendParameter(ID);
            server.AppendParameter(Estado);
            Session.User.Sala.SendData(server, Session);
        }
        public static void Packet_189_156(SessionInstance Session, int ID, int apartado, string data)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(189);
            server.AddHead(156);
            server.AppendParameter(ID);
            server.AppendParameter(apartado);
            server.AppendParameter(data);
            Session.User.Sala.SendData(server, Session);
        }
        public static void Packet_189_164(SessionInstance Session, string[,] Parameters)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(189);
            server.AddHead(164);
            server.AppendParameter(Parameters[0, 0]);
            server.AppendParameter(Parameters[1, 0]);
            server.AppendParameter(Parameters[2, 0]);
            Session.User.Sala.SendData(server, Session);
        }
        public static void Packet_189_159(SessionInstance Session, string[,] Parameters)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(189);
            server.AddHead(159);
            server.AppendParameter(Parameters[0, 0]);
            server.AppendParameter(Parameters[1, 0]);
            Session.User.Sala.SendData(server, Session);
        }
        public static void Packet_189_144(SessionInstance Session, int ID, string size_rotation, string coor)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(189);
            server.AddHead(144);
            server.AppendParameter(ID);
            server.AppendParameter(size_rotation);
            server.AppendParameter(coor);
            Session.User.Sala.SendData(server, Session);
        }
        public static void Packet_189_160_121(SessionInstance Session, int ID, int accion)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(189);
            server.AddHead(160);
            server.AddHead(121);
            server.AppendParameter(ID);
            server.AppendParameter(accion);
            Session.User.Sala.SendData(server, Session);
        }
        public static void Packet_189_134(SessionInstance Session)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(189);
            server.AddHead(134);
            server.AppendParameter(1);
            Session.SendData(server);
        }
        public static void Packet_189_161(SessionInstance Session, int ID)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(189);
            server.AddHead(161);
            server.AppendParameter(ID);
            server.AppendParameter(2);
            Session.User.Sala.SendData(server, Session);
        }
        public static void Packet_189_139(SessionInstance Session, CatalogObjectInstance item, int compra_id, int Cantidad, string tam)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(189);
            server.AddHead(139);
            server.AppendParameter(compra_id);
            server.AppendParameter(item.id);
            server.AppendParameter(item.colores_hex);
            server.AppendParameter(item.colores_rgb);
            server.AppendParameter(0);
            server.AppendParameter(0);
            server.AppendParameter(tam);
            server.AppendParameter(item.espacio_ocupado_n);
            server.AppendParameter(0);
            server.AppendParameter(0);
            server.AppendParameter(Cantidad);
            Session.SendData(server);
        }
        public static void Packet_189_137(SessionInstance Session)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(189);
            server.AddHead(137);
            server.AppendParameter(1);
            Session.SendData(server);
        }
        public static void Packet_120_146(SessionInstance Session, int parametro)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(120);
            server.AddHead(146);
            server.AppendParameter(parametro);
            Session.SendData(server);
        }
        public static void Packet_120_137(SessionInstance Session)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(120);
            server.AddHead(137);
            server.AppendParameter(1);
            server.AppendParameter(50);
            Session.SendData(server);
        }
        public static void Packet_148_121(SessionInstance Session)
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
        public static void Packet_132_127(SessionInstance Session, string Parameters)
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
        public static void Packet_148_123(SessionInstance Session, string security)
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
        public static void Packet_183(SessionInstance Session, string mensaje)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(183);
            server.AppendParameter(mensaje);
            Session.SendData(server);
        }
        public static void Packet_120_147_121(SessionInstance Session)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(120);
            server.AddHead(147);
            server.AddHead(121);
            server.AppendParameter(1);
            Session.SendData(server);
        }
        public static void Packet_120_147_120(SessionInstance Session)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(120);
            server.AddHead(147);
            server.AddHead(120);
            server.AppendParameter(1);
            server.AppendParameter(Time.GetDifference(Session.User.timespam_regalo_grande));
            server.AppendParameter(1);
            Session.SendData(server);
        }
        public static void Packet_209_128(SessionInstance Session)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(209);
            server.AddHead(128);
            server.AppendParameter(0);
            Session.SendData(server);
        }
        public static void Packet_126_123(SessionInstance Session)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(126);
            server.AddHead(123);
            server.AppendParameter(0);
            Session.SendData(server);
        }
        public static void Packet_126_120(SessionInstance Session)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(126);
            server.AddHead(120);
            server.AppendParameter(Session.User.id);
            server.AppendParameter(1);
            Session.SendData(server);
        }
        public static void Packet_148_125(SessionInstance Session, string contraseña, int modulo)
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
        public static void Packet_148_120(SessionInstance Session, string clave)
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
        public static void Packet_148_127(SessionInstance Session)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(148);
            server.AddHead(127);
            server.AppendParameter(-1);
            Session.SendData(server);
        }
        public static void Packet_148_132(SessionInstance Session)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(148);
            server.AddHead(132);
            server.AppendParameter(-1);
            Session.SendData(server);
        }
        public static void Packet_148_126(SessionInstance Session, string old, string seguridad,string nueva)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(148);
            server.AddHead(126);
            if (UserManager.Coincidencia_Contraseña(Session.User, old))
            {
                if (seguridad == Session.User.security)
                {
                    if (UserManager.Actualizar_Contraseña(Session.User, nueva))
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
        public static void Packet_148_131(SessionInstance Session, string password)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(148);
            server.AddHead(131);
            if (UserManager.Coincidencia_Contraseña(Session.User, password))
            {
                server.AppendParameter(1);
            }
            else
            {
                server.AppendParameter(0);
            }
            Session.SendData(server);
        }
        public static void Packet_148_122(SessionInstance Session)
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
        public static void Packet_148_128(SessionInstance Session, string email)
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
        public static void Packet_210_120(SessionInstance Session)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(210);
            server.AddHead(120);
            server.AppendParameter(new object[] { 1, 20, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 2, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 50 });
            server.AppendParameter(new object[] { 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 50 });
            Session.SendData(server);
        }
        public static void Packet_120_134(SessionInstance Session)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(120);
            server.AddHead(134);
            server.AppendParameter(0);
            Session.SendData(server);
        }
        public static void Packet_120_141(SessionInstance Session)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(120);
            server.AddHead(141);
            server.AppendParameter(0);
            Session.SendData(server);
        }
        public static void Packet_120_139(SessionInstance Session, string nombre)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(120);
            server.AddHead(139);
            UserInstance User = UserManager.ObtenerUsuario(nombre);
            if (User != null)
            {
                server.AppendParameter(1);
            }
            else
            {
                server.AppendParameter(2);
            }
            Session.SendData(server);
        }
        public static void Packet_148_130(SessionInstance Session, int Estado)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(148);
            server.AddHead(130);
            server.AppendParameter(Session.User.id);
            server.AppendParameter(Estado);
            Session.User.Sala.SendData(server, Session);
        }
        public static void Packet_202_120(SessionInstance Session)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(202);
            server.AddHead(120);
            server.AppendParameter(1);
            Session.SendData(server);
        }
        public static void Packet_155(SessionInstance Session, int UserID, int Box_ID, int Value)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(155);
            server.AppendParameter(UserID);
            server.AppendParameter(Box_ID);
            server.AppendParameter(Value);
            Session.User.Sala.SendData(server, Session);
        }
        public static void Packet_152(SessionInstance Session)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(152);
            server.AppendParameter(Time.GetDifference(Session.User.coins_remain_double));
            Session.SendData(server);
        }
        public static void Packet_157(SessionInstance Session, int BoxID, string Texto)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(157);
            server.AppendParameter(Session.User.IDEspacial);
            server.AppendParameter(BoxID);
            server.AppendParameter(Texto);
            Session.User.Sala.SendData(server, Session);
        }
        public static void Packet_156(SessionInstance Session, int BoxID, string Texto)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(156);
            server.AppendParameter(Session.User.IDEspacial);
            server.AppendParameter(BoxID);
            server.AppendParameter(Texto);
            Session.User.Sala.SendData(server, Session);
        }
        public static void Packet_158(SessionInstance Session)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(158);
            server.AppendParameter(Session.User.IDEspacial);
            server.AppendParameter(Session.User.bocadillo);
            Session.User.Sala.SendData(server, Session);
            Session.User.PreLock_Ficha = true;
        }
        public static void Packet_139(SessionInstance Session, SessionInstance OtherSession, int InteraccionID)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(139);
            server.AppendParameter(InteraccionID);
            server.AppendParameter(OtherSession.User.IDEspacial);
            server.AppendParameter(OtherSession.User.Posicion.x);
            server.AppendParameter(OtherSession.User.Posicion.y);
            server.AppendParameter(Session.User.IDEspacial);
            server.AppendParameter(Session.User.Posicion.x);
            server.AppendParameter(Session.User.Posicion.y);
            Session.User.Sala.SendData(server, Session);
        }
        public static void Packet_140(SessionInstance Session, SessionInstance OtherSession, int InteraccionID)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(140);
            server.AppendParameter(InteraccionID);
            server.AppendParameter(Session.User.IDEspacial);
            server.AppendParameter(1);
            OtherSession.SendData(server);
        }
        public static void Packet_141(SessionInstance Session, SessionInstance OtherSession, int InteraccionID)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(141);
            server.AppendParameter(InteraccionID);
            server.AppendParameter(Session.User.IDEspacial);
            server.AppendParameter(1);
            OtherSession.SendData(server);
        }
        public static void Packet_137(SessionInstance Session, SessionInstance OtherSession, int InteraccionID)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(137);
            server.AppendParameter(InteraccionID);
            server.AppendParameter(Session.User.IDEspacial);
            server.AppendParameter(1);
            OtherSession.SendData(server);
        }
        public static void Packet_129(SessionInstance Session)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(129);
            server.AppendParameter(Session.User.id);
            server.AppendParameter(Session.User.UppertSelect);
            Session.User.Sala.SendData(server, Session);
        }
        public static void Packet_131(SessionInstance Session, int nivel)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(131);
            server.AppendParameter(Session.User.id);
            server.AppendParameter(nivel);
            Session.User.Sala.SendData(server, Session);
        }
        public static void Packet_184_120(SessionInstance Session, SessionInstance OtherSession, int coco)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(184);
            server.AddHead(120);
            server.AppendParameter(OtherSession.User.id);
            server.AppendParameter(0);
            server.AppendParameter(coco);
            Session.User.Sala.SendData(server, Session);
        }
        public static void Packet_184_121(SessionInstance Session, int modelo)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(184);
            server.AddHead(121);
            server.AppendParameter(Session.User.id);
            server.AppendParameter(0);
            server.AppendParameter(modelo);
            Session.User.Sala.SendData(server, Session);
        }
        public static void Packet_145(SessionInstance Session, SessionInstance OtherSession)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(145);
            server.AppendParameter(4);
            server.AppendParameter(Session.User.IDEspacial);
            server.AppendParameter(Session.User.Posicion.x);
            server.AppendParameter(Session.User.Posicion.y);
            server.AppendParameter(OtherSession.User.IDEspacial);
            server.AppendParameter(OtherSession.User.Posicion.x);
            server.AppendParameter(OtherSession.User.Posicion.y);
            Session.User.Sala.SendData(server, Session);
        }
        public static void Packet_144(SessionInstance Session)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(144);
            Session.SendData(server);
        }
        public static void Packet_182(SessionInstance Session, int x, int y, int z)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(182);
            server.AppendParameter(1);
            server.AppendParameter(Session.User.IDEspacial);
            server.AppendParameter(x);
            server.AppendParameter(y);
            server.AppendParameter(z);
            server.AppendParameter(750);
            server.AppendParameter(1);
            Session.User.Sala.SendData(server, Session);
        }
        public static void Packet_134(SessionInstance Session, int accion)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(134);
            server.AppendParameter(Session.User.IDEspacial);
            server.AppendParameter(accion);
            Session.User.Sala.SendData(server, Session);
        }
        public static void Packet_136(SessionInstance Session, string mensaje, int usuario_2)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(136);
            server.AppendParameter(Session.User.IDEspacial);
            server.AppendParameter(mensaje);
            server.AppendParameter((Session.User.admin == 1 ? 2 : 1));
            Session.SendData(server);
            SessionInstance OtherSession = Session.User.Sala.ObtenerSession(usuario_2);
            if (OtherSession != null)
            {
                OtherSession.SendData(server);
            }
        }
        public static int parametro = 0;
        public static void Packet_133(SessionInstance Session, string mensaje)
        {
            if (Session.ValidarEntrada(mensaje, false))
            {
                ServerMessage server = new ServerMessage();
                server.AddHead(133);
                server.AppendParameter(Session.User.IDEspacial);
                server.AppendParameter(mensaje);
                //server.AppendParameter(parametro);
                server.AppendParameter((Session.User.admin == 1 && Session.User.Color_Chat == 1 ? 2 : Session.User.vip >= 1 && Session.User.Color_Chat == 1 ? 9 : Session.User.Color_Chat));
                Session.User.Sala.SendData(server, Session);
            }
        }
        public static void Packet_189_123(SessionInstance Session)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(189);
            server.AddHead(123);
            server.AppendParameter(0);
            Session.SendData(server);
        }
        public static void Packet_189_146(SessionInstance Session, string HEX, string Dec)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(189);
            server.AddHead(146);
            server.AppendParameter(Session.User.Sala.Escenario.id);
            server.AppendParameter(HEX);
            server.AppendParameter(Dec);
            Session.User.Sala.SendData(server, Session);
        }
        public static void Packet_189_129(SessionInstance Session, IslaInstance Isla, string Nombre)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(189);
            server.AddHead(129);
            if (IslasManager.ObtenerIsla(Nombre) == null)
            {
                if (IslasManager.RenombrarIsla(Isla, Nombre))
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
        public static void Packet_189_121(SessionInstance Session, EscenarioInstance Escenario)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(189);
            server.AddHead(121);
            server.AppendParameter(0);
            server.AppendParameter(Escenario.es_categoria);
            server.AppendParameter(0);
            server.AppendParameter(0);
            server.AppendParameter(Escenario.id);
            Session.SendData(server);
        }
        public static void Packet_189_124(SessionInstance Session, int IslaID)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(189);
            server.AddHead(124);
            IslaInstance Isla = IslasManager.ObtenerIsla(IslaID);
            if (Isla != null)
            {
                IslasManager.Diccionario_AñadirIsla(Isla);
                List<EscenarioInstance> Escenarios = IslasManager.ZonasIsla(Isla);
                server.AppendParameter(Isla.id);
                server.AppendParameter(Isla.nombre);
                server.AppendParameter(Isla.descripcion);
                server.AppendParameter(Isla.modelo);
                server.AppendParameter(Isla.uppert);
                server.AppendParameter(Isla.Creador.id);
                server.AppendParameter(Isla.Creador.nombre);
                server.AppendParameter(Isla.Creador.avatar);
                server.AppendParameter(Isla.Creador.colores);
                server.AppendParameter(Isla.mamigos_1);
                server.AppendParameter(Isla.mamigos_2);
                server.AppendParameter(Isla.mamigos_3);
                server.AppendParameter(Isla.mamigos_4);
                server.AppendParameter(Isla.mamigos_5);
                server.AppendParameter(Isla.mamigos_6);
                server.AppendParameter(Isla.mamigos_7);
                server.AppendParameter(Isla.mamigos_8);
                server.AppendParameter(Isla.noverlo_1);
                server.AppendParameter(Isla.noverlo_2);
                server.AppendParameter(Isla.noverlo_3);
                server.AppendParameter(Isla.noverlo_4);
                server.AppendParameter(Isla.noverlo_5);
                server.AppendParameter(Isla.noverlo_6);
                server.AppendParameter(Isla.noverlo_7);
                server.AppendParameter(Isla.noverlo_8);
                server.AppendParameter(Escenarios.Count);
                foreach (EscenarioInstance Escenario in Escenarios)
                {
                    server.AppendParameter(0);
                    server.AppendParameter(Escenario.es_categoria);
                    server.AppendParameter(Escenario.id);
                    server.AppendParameter(Escenario.id);
                    server.AppendParameter(Escenario.nombre);
                    server.AppendParameter(Escenario.modelo);
                    server.AppendParameter(0);
                    server.AppendParameter(0);
                    server.AppendParameter(0);
                    server.AppendParameter(SalasManager.UsuariosEnSala(Escenario));//Visitantes
                    server.AppendParameter(0);
                    if (Isla.noverlo_1.Contains(Session.User.nombre) || Isla.noverlo_2.Contains(Session.User.nombre) || Isla.noverlo_3.Contains(Session.User.nombre) || Isla.noverlo_4.Contains(Session.User.nombre) || Isla.noverlo_5.Contains(Session.User.nombre) || Isla.noverlo_6.Contains(Session.User.nombre) || Isla.noverlo_7.Contains(Session.User.nombre) || Isla.noverlo_8.Contains(Session.User.nombre))
                    {
                        server.AppendParameter(1);//Usuario no puede acceder a la isla
                        server.AppendParameter(1);
                    }
                    else
                    {
                        if (Isla.mamigos_1.Contains(Session.User.nombre) || Isla.mamigos_2.Contains(Session.User.nombre) || Isla.mamigos_3.Contains(Session.User.nombre) || Isla.mamigos_4.Contains(Session.User.nombre) || Isla.mamigos_5.Contains(Session.User.nombre) || Isla.mamigos_6.Contains(Session.User.nombre) || Isla.mamigos_7.Contains(Session.User.nombre) || Isla.mamigos_8.Contains(Session.User.nombre))
                        {
                            server.AppendParameter(0);
                        }
                        else
                        {
                            server.AppendParameter((string.IsNullOrEmpty(Escenario.Clave) ? 0 : 1));
                        }
                    }
                }

            }
            else
            {
                server.AppendParameter(0);
            }
            Session.SendData(server);
        }
        public static void Packet_189_120(SessionInstance Session, string Nombre, int Modelo)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(189);
            server.AddHead(120);
            if (IslasManager.IslasCreadas(Session.User) < 25)
            {
                if (Nombre == "") { Session.FinalizarConexion("Packet_189_120"); return; }
                if (Session.ValidarEntrada(Nombre, false))
                {
                    if (IslasManager.ObtenerIsla(Nombre) == null)
                    {
                        server.AppendParameter(IslasManager.CrearIsla(Session.User, Nombre, Modelo));
                    }
                    else
                    {
                        server.AppendParameter(0);
                    }
                }     
            }
            else
            {
                server.AppendParameter(0);
            }
            Session.SendData(server);
        }
        public static void Packet_195(SessionInstance Session, string Nombre)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(195);
            foreach (IslaInstance Isla in IslasManager.ObtenerIslasNombre(Nombre))
            {
                if (Isla.noverlo_1.Contains(Session.User.nombre) || Isla.noverlo_2.Contains(Session.User.nombre) || Isla.noverlo_3.Contains(Session.User.nombre) || Isla.noverlo_4.Contains(Session.User.nombre) || Isla.noverlo_5.Contains(Session.User.nombre) || Isla.noverlo_6.Contains(Session.User.nombre) || Isla.noverlo_7.Contains(Session.User.nombre) || Isla.noverlo_8.Contains(Session.User.nombre)) return;
                server.AppendParameter(0);
                server.AppendParameter(0);
                server.AppendParameter(Isla.id);
                server.AppendParameter(0);
                server.AppendParameter(0);
                server.AppendParameter(0);
                server.AppendParameter(Isla.nombre);
                server.AppendParameter(0);
                server.AppendParameter(IslasManager.Visitantes(Isla));//Visitantes
                server.AppendParameter(0);
            }
            Session.SendData(server);
        }
        public static void Packet_194(SessionInstance Session, string Nombre)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(194);
            foreach (IslaInstance Isla in IslasManager.ObtenerIslas(Nombre))
            {
                if (Isla.noverlo_1.Contains(Session.User.nombre) || Isla.noverlo_2.Contains(Session.User.nombre) || Isla.noverlo_3.Contains(Session.User.nombre) || Isla.noverlo_4.Contains(Session.User.nombre) || Isla.noverlo_5.Contains(Session.User.nombre) || Isla.noverlo_6.Contains(Session.User.nombre) || Isla.noverlo_7.Contains(Session.User.nombre) || Isla.noverlo_8.Contains(Session.User.nombre)) return;
                server.AppendParameter(0);
                server.AppendParameter(0);
                server.AppendParameter(Isla.id);
                server.AppendParameter(0);
                server.AppendParameter(0);
                server.AppendParameter(0);
                server.AppendParameter(Isla.nombre);
                server.AppendParameter(0);
                server.AppendParameter(IslasManager.Visitantes(Isla));//Visitantes
                server.AppendParameter(0);
            }
            Session.SendData(server);
        }
        public static void Packet_191(SessionInstance Session)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(191);
            foreach (IslaInstance Isla in IslasManager.ObtenerIslasFavoritos(Session.User.id))
            {
                server.AppendParameter(0);
                server.AppendParameter(0);
                server.AppendParameter(Isla.id);
                server.AppendParameter(0);
                server.AppendParameter(0);
                server.AppendParameter(0);
                server.AppendParameter(Isla.nombre);
                server.AppendParameter(0);
                server.AppendParameter(IslasManager.Visitantes(Isla));//Visitantes
                server.AppendParameter(0);
            }
            Session.SendData(server);
        }
        public static void Packet_187(SessionInstance Session)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(187);
            foreach (var IslaID in IslasManager.IslasActivas.Values)
            {
                IslaInstance Isla = IslasManager.ObtenerIsla(IslaID);
                if (Isla != null)
                {
                    if (IslasManager.Visitantes(Isla) > 0)
                    {
                        server.AppendParameter(0);
                        server.AppendParameter(0);
                        server.AppendParameter(Isla.id);
                        server.AppendParameter(0);
                        server.AppendParameter(0);
                        server.AppendParameter(0);
                        server.AppendParameter(Isla.nombre);
                        server.AppendParameter(0);
                        server.AppendParameter(IslasManager.Visitantes(Isla)); //visitantes
                        server.AppendParameter(0);
                    }
                }
            }
            Session.SendData(server);
        }
        public static void Packet_193(SessionInstance Session)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(193);
            foreach (IslaInstance Isla in IslasManager.ObtenerIslas(Session.User.id))
            {
                server.AppendParameter(0);
                server.AppendParameter(0);
                server.AppendParameter(Isla.id);
                server.AppendParameter(0);
                server.AppendParameter(0);
                server.AppendParameter(0);
                server.AppendParameter(Isla.nombre);
                server.AppendParameter(0);
                server.AppendParameter(IslasManager.Visitantes(Isla));//Visitantes
                server.AppendParameter(0);
            }
            Session.SendData(server);
        }
        public static void Packet_175(SessionInstance Session)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(175);
            if (Session.User.Sala.Escenario.es_categoria == 2)
            {
                server.AppendParameter(new object[] { 1, -1, 0 });
                server.AppendParameter(new object[] { 2, -1, 0 });
                server.AppendParameter(new object[] { 3, -1, 0 });
            }
            else
            {
                server.AppendParameter(new object[] { 1, 0, 0 });
                server.AppendParameter(new object[] { 2, 0, 0 });
                server.AppendParameter(new object[] { 3, 0, 0 });
            }
            if (Session.User.Sala.Escenario.categoria == 2)
            {
                IslaInstance Isla = IslasManager.ObtenerIsla(Session.User.Sala.Escenario.IslaID);
                if (Isla != null)
                {
                    server.AppendParameter(new object[] { 4, (Isla.uppert == 0 ? -1 : 0), 1 });///Modificado
                    server.AppendParameter(new object[] { 5, 0, 1 });
                }
            }
            else
            {
                server.AppendParameter(new object[] { 4, Session.User.Sala.Escenario.uppert, 1 });
                server.AppendParameter(new object[] { 5, 0, 1 });
            }
            Session.SendData(server);
        }
        public static void Packet_128_120(SessionInstance Session)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(128);
            server.AddHead(120);
            server.AppendParameter(-1);
            Session.SendData(server);
        }
        public static void Packet_154_33(SessionInstance Session, int modelo_id)
        {
            int identificador = 0;
            ServerMessage server = new ServerMessage();
            server.AddHead(154);
            server.AddHead(33);
            foreach (var sala in SalasManager.Salas_Publicas.Values)
            {
                if (sala.Escenario.id == modelo_id)
                {
                    identificador++;
                    server.AppendParameter(1);
                    server.AppendParameter(sala.Escenario.es_categoria);
                    server.AppendParameter(0);
                    server.AppendParameter(0);
                    server.AppendParameter(sala.id);
                    server.AppendParameter(modelo_id);
                    server.AppendParameter((sala.Escenario.nombre + " " + identificador));
                    server.AppendParameter(sala.Usuarios.Count);
                    server.AppendParameter(sala.Escenario.max_visitantes);
                }
            }
            Session.SendData(server);
        }
        public static void Packet_154_32(SessionInstance Session)
        {
            mysql client = new mysql();
            ServerMessage server = new ServerMessage();
            server.AddHead(154);
            server.AddHead(32);
            foreach (DataRow row in client.ExecuteQueryTable("SELECT * FROM escenarios_publicos WHERE visible = '1' ORDER BY prioridad ASC").Rows)
            {
                server.AppendParameter(row["categoria"]);
                server.AppendParameter(row["es_categoria"]);
                server.AppendParameter(row["id"]);
                server.AppendParameter(row["nombre"]);
                server.AppendParameter(SalasManager.UsuariosEnSala(new EscenarioInstance(row)));
            }
            Session.SendData(server);
        }
        public static void Packet_208_120(SessionInstance Session)
        {
            mysql client = new mysql();
            int cantidad_noticias = Convert.ToInt32(client.ExecuteScalar("SELECT COUNT(id) FROM noticias"));
            if (cantidad_noticias > 7) cantidad_noticias = 7;
            ServerMessage server = new ServerMessage();
            server.AddHead(208);
            server.AddHead(120);
            server.AppendParameter(1);
            server.AppendParameter(Session.User.novedades_noticias);
            server.AppendParameter(cantidad_noticias);
            foreach (DataRow row in client.ExecuteQueryTable("SELECT * FROM noticias ORDER BY id DESC LIMIT 7").Rows)
            {
                server.AppendParameter(new object[] { (int)row["id"], (string)row["titulo"], (string)row["fecha"] });
            }
            Session.SendData(server);
        }
        public static void Packet_208_121(SessionInstance Session, DataRow row)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(208);
            server.AddHead(121);
            server.AppendParameter(0);
            server.AppendParameter(0);
            server.AppendParameter(row["titulo"]);
            server.AppendParameter(row["contenido"]);
            server.AppendParameter(row["fecha"]);
            server.AppendParameter(row["tipo_plantilla"]);
            server.AppendParameter(row["url_1"]);
            server.AppendParameter(row["url_2"]);
            server.AppendParameter(row["url_3"]);
            server.AppendParameter(row["url_4"]);
            Session.SendData(server);
        }
        public static void Packet_163(SessionInstance Session)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(163);
            server.AppendParameter(1);
            Session.SendData(server);
        }
        public static void Packet_135(SessionInstance Session, int x, int y, int z)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(135);
            server.AppendParameter(Session.User.IDEspacial);
            server.AppendParameter(x);
            server.AppendParameter(y);
            server.AppendParameter(z);
            Session.User.Sala.SendData(server, Session);
        }
        public static void Packet_125_121(SessionInstance Session)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(125);
            server.AddHead(121);
            server.AppendParameter(Session.User.id);
            Session.User.Sala.SendData(server, Session);
        }
        public static void Packet_125_120(SessionInstance Session,int Usuario_ID, int ID_Personaje, string Colores, bool Publico)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(125);
            server.AddHead(120);
            server.AppendParameter(Usuario_ID);
            server.AppendParameter(ID_Personaje);
            server.AppendParameter(Colores);
            server.AppendParameter(1);
            server.AppendParameter(1);
            server.AppendParameter(1);
            if (Publico == false) { Session.SendData(server); }
            if (Publico == true) { Session.User.Sala.SendData(server, Session); }
        }
        public static void Packet_181_120(SessionInstance Session, int Item)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(181);
            server.AddHead(120);
            server.AppendParameter(Session.User.id);
            server.AppendParameter(Item);
            Session.User.Sala.SendData(server, Session);
        }
        public static void Packet_184_120(SessionInstance Session, int Efecto, string Mensaje, bool Publico)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(184);
            server.AddHead(120);
            server.AppendParameter(Session.User.id);
            server.AppendParameter(Efecto);
            server.AppendParameter(Efecto);
            server.AppendParameter(Mensaje);
            if (Publico == false) { Session.SendData(server); }
            if (Publico == true) { Session.User.Sala.SendData(server, Session); }
        }
        public static void Packet_189_169(SessionInstance Session, int compra_id, int Item)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(189);
            server.AddHead(169);
            server.AppendParameter(compra_id);
            server.AppendParameter(Item);
            server.AppendParameter(1);
            Session.SendData(server);
        }
        public static void Packet_133(SessionInstance Session, string Mensaje, bool Publico)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(133);
            server.AppendParameter(0);
            server.AppendParameter(Mensaje);
            server.AppendParameter(3);
            if (Publico == false) { Session.SendData(server); }
            if (Publico == true) { Session.User.Sala.SendData(server, Session); } 
        }
        public static void Packet_143(SessionInstance Session)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(143);
            server.AppendParameter(1);
            Session.SendData(server);
        }
    }
}
