using BoomBang.game.instances;
using BoomBang.game.manager;
using BoomBang.server;
using System;
using System.Collections.Generic;
using System.Data;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace BoomBang.game.handler
{
    class npcHandler
    {
        public static void Start()
        {
            HandlerManager.RegisterHandler(123120, new ProcessHandler(CreacionObjeto));
            HandlerManager.RegisterHandler(123121, new ProcessHandler(ComprarObjetosNPC));
        }
        static void ComprarObjetosNPC(SessionInstance Session, string[,] Parameters)
        {
            int createID = int.Parse(Parameters[0, 0]);
            Console.WriteLine(createID);
            mysql client = new mysql();
            DataRow row = client.ExecuteQueryRow("SELECT * FROM object_npc WHERE id = '" + createID + "'");
            bool permitir_compra = true;
            if ((int)row["gold"] > 0 && Session.User.oro >= (int)row["gold"])
            {
                Console.WriteLine("Objeto vale oro");
                foreach (DataRow r in client.ExecuteQueryTable("SELECT * FROM object_npc_id WHERE obj_id = '" + (int)row["obj_id"] + "'").Rows)
                {
                    if ((int)r["sk_obj_id"] > 0)
                    {
                        int objeto_en_muchila = int.Parse(Convert.ToString(client.ExecuteScalar("select count(objeto_id)from objetos_comprados where objeto_id = '" + (int)r["sk_obj_id"] + "' and usuario_id = '" + Session.User.id + "'")));
                        if (objeto_en_muchila < (int)r["obj_cantidad"])
                        {
                            permitir_compra = false;
                        }
                    }
                }
                if (permitir_compra == true)
                {
                    foreach (DataRow r in client.ExecuteQueryTable("SELECT * FROM object_npc_id WHERE obj_id = '" + (int)row["obj_id"] + "'").Rows)
                    {
                        if ((int)r["sk_obj_id"] > 0)
                        {
                            Com_Obj_Much(Session, (int)r["sk_obj_id"], (int)r["obj_cantidad"], false);
                        }
                    }
                    UserManager.Creditos(Session.User, true, false, (int)row["gold"]);
                    Com_Obj_Much(Session, (int)row["obj_id"], 0, true);
                }
                else
                {
                    cancel_packet_buy(Session);
                }
            }
            else if ((int)row["silver"] > 0 && Session.User.plata >= (int)row["silver"])
            {
                foreach (DataRow r in client.ExecuteQueryTable("SELECT * FROM object_npc_id WHERE obj_id = '" + (int)row["obj_id"] + "'").Rows)
                {
                    if ((int)r["sk_obj_id"] > 0)
                    {
                        int objeto_en_muchila = int.Parse(Convert.ToString(client.ExecuteScalar("select count(objeto_id)from objetos_comprados where objeto_id = '" + (int)r["sk_obj_id"] + "' and usuario_id = '" + Session.User.id + "'")));
                        if (objeto_en_muchila < (int)r["obj_cantidad"])
                        {
                            permitir_compra = false;
                        }
                    }
                }
                if (permitir_compra == true)
                {
                    foreach (DataRow r in client.ExecuteQueryTable("SELECT * FROM object_npc_id WHERE obj_id = '" + (int)row["obj_id"] + "'").Rows)
                    {
                        if ((int)r["sk_obj_id"] > 0)
                        {
                            Com_Obj_Much(Session, (int)r["sk_obj_id"], (int)r["obj_cantidad"], false);
                        }
                    }
                    UserManager.Creditos(Session.User, false, false, (int)row["silver"]);
                    Com_Obj_Much(Session, (int)row["obj_id"], 0, true);
                }
                else
                {
                    cancel_packet_buy(Session);
                }
            }
            else if ((int)row["gold"] == 0 && (int)row["silver"] == 0)
            {
                foreach (DataRow r in client.ExecuteQueryTable("SELECT * FROM object_npc_id WHERE obj_id = '" + (int)row["obj_id"] + "'").Rows)
                {
                    if ((int)r["sk_obj_id"] > 0)
                    {
                        int objeto_en_muchila = int.Parse(Convert.ToString(client.ExecuteScalar("select count(objeto_id)from objetos_comprados where objeto_id = '" + (int)r["sk_obj_id"] + "' and usuario_id = '" + Session.User.id + "'")));
                        if (objeto_en_muchila < (int)r["obj_cantidad"])
                        {
                            permitir_compra = false;
                        }
                    }
                }
                if (permitir_compra == true)
                {
                    foreach (DataRow r in client.ExecuteQueryTable("SELECT * FROM object_npc_id WHERE obj_id = '" + (int)row["obj_id"] + "'").Rows)
                    {
                        if ((int)r["sk_obj_id"] > 0)
                        {
                            Com_Obj_Much(Session, (int)r["sk_obj_id"], (int)r["obj_cantidad"], false);
                        }
                    }
                    Com_Obj_Much(Session, (int)row["obj_id"], 0, true);
                }
                else
                {
                    cancel_packet_buy(Session);
                }
            }
            else
            {
                cancel_packet_buy(Session);
            }
        }
        private static void Com_Obj_Much(SessionInstance Session, int id_object, int count, bool status)
        {
            mysql client = new mysql();
            if (status == false)
            {
                for (int id = 0; id < count; id++)
                {
                    client.SetParameter("user", Session.User.id);
                    client.SetParameter("item", id_object);
                    client.ExecuteNonQuery("DELETE FROM objetos_comprados where objeto_id = @item AND usuario_id = @user LIMIT 1");
                    ServerMessage server = new ServerMessage();
                    server.AddHead(189);
                    server.AddHead(169);
                    server.AppendParameter(-1);
                    server.AppendParameter(id_object);
                    server.AppendParameter(1);
                    Session.SendData(server);
                }
            }
            else
            {
                client.SetParameter("id", id_object);
                DataRow row = client.ExecuteQueryRow("SELECT * FROM objetos WHERE id = @id");
                CatalogObjectInstance item = new CatalogObjectInstance(row);
                client.SetParameter("item_id", id_object);
                client.SetParameter("userid", Session.User.id);
                client.SetParameter("hex", item.colores_hex);
                client.SetParameter("rgb", item.colores_rgb);
                client.SetParameter("tam", "tam_n");
                client.SetParameter("default_data", 0);
                if (client.ExecuteNonQuery("INSERT INTO objetos_comprados (`objeto_id`, `colores_hex`, `colores_rgb`, `usuario_id`, `tam`, `data`) VALUES (@item_id, @hex, @rgb, @userid, @tam, @default_data)") == 1)
                {
                    client.SetParameter("id", id_object);
                    client.SetParameter("UserID", Session.User.id);
                    int compra_id = int.Parse(Convert.ToString(client.ExecuteScalar("SELECT MAX(id) FROM objetos_comprados WHERE objeto_id = @id AND usuario_id = @UserID")));
                    ServerMessage añadir_mochila = new ServerMessage();
                    añadir_mochila.AddHead(189);
                    añadir_mochila.AddHead(139);
                    añadir_mochila.AppendParameter(compra_id);
                    añadir_mochila.AppendParameter(id_object);
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
        static void CreacionObjeto(SessionInstance Session, string[,] Parameters)
        {
            mysql client = new mysql();
            int funcion = int.Parse(Parameters[0, 0]);
            if (funcion == 22)//Santa claus de bosque nevada
            {
                npc_packet_manager(Session, 22);
                return;
            }
            if (funcion == 20)//Duende de cueva de bosque nevada
            {
                npc_packet_manager(Session, 20);
                return;
            }
            DataRow sala_id_npc = client.ExecuteQueryRow("SELECT * FROM escenarios_npc WHERE EscenarioID = '" + Session.User.Sala.Escenario.id + "'");
            if (sala_id_npc != null)
            {
                npc_packet_manager(Session, (int)sala_id_npc["function"]);
            }
        }
        static void npc_packet_manager(SessionInstance Session, int function)
        {
            mysql client = new mysql();
            ServerMessage server = new ServerMessage();
            server.AddHead(123);
            server.AddHead(120);
            server.AppendParameter(function);
            foreach (DataRow row in client.ExecuteQueryTable("SELECT * FROM object_npc WHERE sala_id = '" + Session.User.Sala.Escenario.id + "'").Rows)
            {
                server.AppendParameter((int)row["id"]);
                server.AppendParameter(0);
                server.AppendParameter((int)row["gold"]);
                server.AppendParameter((int)row["silver"]);
                server.AppendParameter((int)row["obj_id"]);
                string sk_obj_id = "";
                string obj_cantidad = "";
                mysql client2 = new mysql();
                foreach (DataRow row_2 in client2.ExecuteQueryTable("SELECT * FROM object_npc_id WHERE obj_id = '" + (int)row["obj_id"] + "'").Rows)
                {
                    sk_obj_id += (int)row_2["sk_obj_id"] + "³";
                    obj_cantidad += (int)row_2["obj_cantidad"] + "³";
                }
                if (sk_obj_id.Length != 0)
                {
                    sk_obj_id = sk_obj_id.Remove(sk_obj_id.Length - 1, 1);
                }
                server.AppendParameter(sk_obj_id);
                server.AppendParameter(obj_cantidad);
            }
            Session.SendDataProtected(server);
        }
        private static void cancel_packet_buy(SessionInstance Session)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(123);
            server.AddHead(121);
            server.AppendParameter(0);
            Session.SendDataProtected(server);
        }
    }
}
