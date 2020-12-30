using BoomBang.game.instances;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace BoomBang.game.manager
{
    class NotificacionesManager
    {
        public static void NotifiChat(SessionInstance Session, string Mensaje, SalaInstance Sala = null)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(133);
            server.AppendParameter(0);
            server.AppendParameter(Mensaje);
            server.AppendParameter(3);
            if (Sala == null)
            {
                Session.SendData(server);
                return;
            }
            Sala.SendData(server);
        }
        public static void Chat_Privado(SessionInstance Session, string mensaje)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(136);
            server.AppendParameter(Session.User.IDEspacial);
            server.AppendParameter(mensaje);
            server.AppendParameter((Session.User.admin == 1 ? 2 : 1));
            Session.SendData(server);
        }
        public static void Recompensa_Plata(SessionInstance Session, int Cantidad)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(209);
            server.AddHead(125);
            server.AppendParameter(Cantidad);
            Session.SendData(server);
        }
        public static void Juegos(SessionInstance Session, int game_id)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(209);
            server.AddHead(122);
            server.AppendParameter(0);
            server.AppendParameter(0);
            server.AppendParameter(0);
            server.AppendParameter(0);
            server.AppendParameter(0);
            if (game_id == 2)
            {
                server.AppendParameter(Session.User.UppertLevel());
                server.AppendParameter(1);
                server.AppendParameter(1);
                server.AppendParameter(Session.User.UppertLevel() + 1);
                Session.User.levelup = string.Format("3,1,{0},1,1,{1},{2},{3},{4},1,1,1", Session.User.UppertLevel(), Session.User.UppertLevel() + 1, 1, 1, Session.User.UppertLevel() + 1);
            }
            if (game_id == 3)///Coco
            {
                server.AppendParameter(Session.User.CocoLevel());
                server.AppendParameter(2);
                server.AppendParameter(1);
                server.AppendParameter(Session.User.CocoLevel() + 11);
                Session.User.levelup = string.Format("3,1,{0},1,1,{1},{2},{3},{4},1,1,1", Session.User.CocoLevel(), Session.User.CocoLevel() + 11, 2, 1, Session.User.CocoLevel() + 11);
            }
            if (game_id == 4)///Shurikens
            {
                server.AppendParameter(Session.User.NinjaLevel());
                server.AppendParameter(3);
                server.AppendParameter(1);
                server.AppendParameter(Session.User.NinjaLevel() + 20);
                Session.User.levelup = string.Format("3,1,{0},1,1,{1},{2},{3},{4},1,1,1", Session.User.NinjaLevel(), Session.User.NinjaLevel() + 20, 3, 1, Session.User.NinjaLevel() + 20);
            }
            Session.SendData(server);
        }
    }
}
