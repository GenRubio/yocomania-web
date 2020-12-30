using BoomBang.game.instances;
using BoomBang.game.manager;
using BoomBang.game.packets;
using BoomBang.server;
using System;
using System.Collections.Generic;
using System.Data;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace BoomBang.game.handler
{
    class CasasHandler
    {
        public static void Start()
        {
            HandlerManager.RegisterHandler(120143, new ProcessHandler(MyHouseID));
            HandlerManager.RegisterHandler(189174, new ProcessHandler(Actualizar_Terreno));
            HandlerManager.RegisterHandler(189175, new ProcessHandler(Open_Puertas));
        }
        private static void Open_Puertas(SessionInstance Session, string[,] Parameters)
        {
            mysql client = new mysql();
            int[] llaves = { 0, 0, 0, 578, 631, 149, 210, 319, 0, 445, 1120, 0, 0 };
            string[] puertas = { "puerta_1", "puerta_2", "puerta_3", "puerta_4", "puerta_5", "puerta_6", "puerta_7", "puerta_8", "puerta_9", "puerta_10", "puerta_11", "puerta_12", "puerta_13" };
            int id = Convert.ToInt32(Parameters[0, 0]);
            client.SetParameter("id", llaves[id - 1]);
            client.SetParameter("user", Session.User.id);
            DataRow muchila = client.ExecuteQueryRow("SELECT * FROM objetos_comprados WHERE objeto_id = @id AND usuario_id = @user");
            if (muchila != null)
            {
                client.SetParameter("user", Session.User.id);
                client.SetParameter("sala", Session.User.Sala.id);
                client.ExecuteNonQuery("UPDATE escenarios_privados SET " + puertas[id - 1] + " = 1 WHERE CreadorID = @user AND id = @sala AND modelo = 26");

                client.SetParameter("user", Session.User.id);
                client.SetParameter("objeto", llaves[id - 1]);
                client.ExecuteNonQuery("DELETE FROM objetos_comprados WHERE objeto_id = @objeto AND usuario_id = @user");

                ServerMessage Handler_189_175 = new ServerMessage();
                Handler_189_175.AddHead(189);
                Handler_189_175.AddHead(175);
                Handler_189_175.AppendParameter(1);
                Handler_189_175.AppendParameter(1);
                Session.SendData(Handler_189_175);

                ServerMessage borrar_llave = new ServerMessage();
                borrar_llave.AddHead(189);
                borrar_llave.AddHead(169);
                borrar_llave.AppendParameter(-1);
                borrar_llave.AppendParameter(llaves[id - 1]);
                borrar_llave.AppendParameter(1);
                Session.SendData(borrar_llave);

                ServerMessage server = new ServerMessage();
                server.AddHead(203);
                server.AddHead(120);
                server.AppendParameter(id);
                server.AppendParameter(4);
                server.AppendParameter(0);
                server.AppendParameter(Session.User.Sala.Escenario.id);
                server.AppendParameter("Puerta1");
                server.AppendParameter(1);
                server.AppendParameter(0);
                Session.SendData(server);
                //ServerMessage message2 = new ServerMessage(203, 120);
                //message2.AppendParameter($"{ide}³²4³²0³²{Session.Doors[ide - 1]}³²Puerta1³²1³²0", false);
                //instance.BroadcastMessage(message2);

                SalasManager.Salas_Privadas.Remove(Session.User.Sala.Escenario.id);
                client.SetParameter("id", Session.User.Sala.Escenario.id);
                DataRow row = client.ExecuteQueryRow("SELECT * FROM escenarios_privados WHERE id = @id");
                EscenarioInstance Escenario = new EscenarioInstance(row);
                SalasManager.Salas_Privadas.Add(Session.User.Sala.Escenario.id, new SalaInstance(Escenario.id, Escenario));

                NotificacionesManager.NotifiChat(Session, "Sabio: Sal al jardin de casita y vuelve a entrar para poder acceder a la puerta.");
            }
        }
        static void Actualizar_Terreno(SessionInstance Session, string[,] Parameters)
        {
            Packet_189_174(Session, Parameters);
        }
        static void MyHouseID(SessionInstance Session, string[,] Parameters)
        {
            if (CasasManager.GetZoneID(Session.User.id, 1) == 0)
            {
                CasasManager.RegistrarCasa(Session.User);
            }
            Packet_120_123(Session);
        }
        private static void Packet_189_174(SessionInstance Session, string[,] Parameters)
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
                        Session.User.Sala.SendData(server);
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
                        Session.User.Sala.SendData(server);
                    }
                }
            }
        }
        private static void Packet_120_123(SessionInstance Session)
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
    }
}
