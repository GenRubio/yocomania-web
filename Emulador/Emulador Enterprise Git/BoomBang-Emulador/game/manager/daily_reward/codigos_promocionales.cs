using BoomBang.game.instances;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace BoomBang.game.manager.daily_reward
{
    class codigos_promocionales
    {
        private static List<int> recompensa = new List<int>();
        public static void Iniciar()
        {
            HandlerManager.RegisterHandler(164, new ProcessHandler(codigos));
        }
        public static void Iniciar_Codigo()
        {
            fixarRecompensas();
        }
        private static void codigos(SessionInstance Session, string[,] Parameters)
        {
            string clave = Parameters[0, 0];
            ServerMessage server = new ServerMessage();
            server.AddHead(164);
            server.AppendParameter(1);//0 no es valida | 
            Session.SendData(server);
        }
        private static void fixarRecompensas()
        {
   
        }
        
    }
}
