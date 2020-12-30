using BoomBang.game.instances;
using BoomBang.game.manager;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace BoomBang.game.handler
{
    class ConcursosHandler
    {
        public static void Start()
        {
            HandlerManager.RegisterHandler(200121, new ProcessHandler(Atrapar));
        }
        static void Atrapar(SessionInstance Session, string[,] Parameters)
        {
            int key = int.Parse(Parameters[0, 0]);
            ObjetoLanzadoInstance Item = ConcursosManager.ObtenerLanzamiento(key);
            if (Item != null)
            {
                ConcursosManager.AbrirObjeto(Item, Session);
            }
        }
    }
}
