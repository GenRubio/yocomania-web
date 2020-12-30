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
    class NoticiasHandler
    {
        public static void Start()
        {
            HandlerManager.RegisterHandler(208120, new ProcessHandler(CargarNoticias));
            HandlerManager.RegisterHandler(208121, new ProcessHandler(MostrarNoticia));
        }
        static void MostrarNoticia(SessionInstance Session, string[,] Parameters)
        {
            if (Session.User != null)
            {
                if (Session.User.Sala != null) return;
                mysql client = new mysql();
                DataRow row = client.ExecuteQueryRow("SELECT * FROM noticias WHERE id = '" + int.Parse(Parameters[1, 0]) + "'");
                if (row != null)
                {
                    Packet_208_121(Session, row);
                    Session.User.novedades_noticias = 0;
                    client.ExecuteNonQuery("UPDATE usuarios SET novedades_noticias = 0 WHERE id = " + Session.User.id + "");
                }
                Session.User.PreLock__Proteccion_SQL = true;
            }
        }
        static void CargarNoticias(SessionInstance Session, string[,] Parameters)
        {
            if (Session.User != null)
            {
                if (Session.User.Sala != null) return;
                Packet_208_120(Session, Parameters);
            }
        }
        private static void Packet_208_121(SessionInstance Session, DataRow row)
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
        private static void Packet_208_120(SessionInstance Session, string[,] Parameters)
        {
            mysql client = new mysql();
            int page = int.Parse(Parameters[1, 0]);
            ServerMessage server = new ServerMessage();
            server.AddHead(208);
            server.AddHead(120);
            server.AppendParameter(new object[] { 1 });
            server.AppendParameter(new object[] { Session.User.novedades_noticias });
            server.AppendParameter(new object[] { 8 });
            foreach (DataRow row in client.ExecuteQueryTable("SELECT * FROM noticias ORDER BY `noticias`.`id` DESC LIMIT " + page + ",8").Rows)
            {
                server.AppendParameter(new object[] { (int)row["id"], (string)row["titulo"], (string)row["fecha"], 13 });
            }
            Session.SendData(server);
        }
    }
}
