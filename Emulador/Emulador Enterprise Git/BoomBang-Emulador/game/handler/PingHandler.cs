using BoomBang.game.instances;
using BoomBang.game.manager;
using BoomBang.game.packets;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace BoomBang.game.handler
{
    class PingHandler
    {
        public static void Start()
        {
            HandlerManager.RegisterHandler(163, new ProcessHandler(Latency));
        }
        static void Latency(SessionInstance Session, string[,] Parameters)
        {
            if (Session.LastPingTime == 0)
            {
                Session.LastPingTime = Time.GetCurrentAndAdd(AddType.Segundos, 9);
            }
            else
            {
                if (Time.GetDifference(Session.LastPingTime) >= 1)
                {
                    Session.FinalizarConexion("Latency");
                    return;
                }
            }
            Session.LastPingTime = Time.GetCurrentAndAdd(AddType.Segundos, 9);
            ServerMessage server = new ServerMessage();
            server.AddHead(163);
            server.AppendParameter(10);
            Session.SendDataProtected(server);
        }
    }
}
