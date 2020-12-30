using BoomBang.game.handler;
using BoomBang.game.instances;
using BoomBang.game.instances.manager;
using BoomBang.game.manager.daily_reward;
using BoomBang.server;
using System;
using System.Collections.Generic;
using System.Data;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace BoomBang.game.manager
{
    public delegate void ProcessHandler(SessionInstance Session, string[,] Parameters);
    public class HandlerManager
    {
        public static Dictionary<int, ProcessHandler> Handlers = new Dictionary<int, ProcessHandler>();
        public static int Contrador_Goldens = 0;
        public static void Initialize()
        {
            try
            {
                ConcursosManager.seavItemsObject();//Cargar los items que caen en salas
                TrampasManager.saveTrampasSala();//Cargar las trampas de todas las salas

                LoginHandler.Start();
                FlowerHandler.Start();
                PocionesHandler.Start();
                CasasHandler.Start();
                NavigatorHandler.Start();
                NoticiasHandler.Start();
                BPadHandler.Start();
                CatalogoHandler.Start();
                ConcursosHandler.Start();
                PathfindingHandler.Start();
                IntercambiosHandler.Start();
                InterfazHandler.Start();
                IslasHandler.Start();
                MiniGamesHandler.Start();
                PingHandler.Start();
                npcHandler.Start();
                codigos_promocionales.Iniciar();
                Output.WriteLine("Se han registrado " + Handlers.Count + " handlers.");
                listas.automatic_lists_row();

                UserManager.obtenerUsuariosRegistrados();
            }
            catch(Exception e)
            {
                Program.EditorialResponse(e);
            }
        }
        public static void RegisterHandler(int Header, ProcessHandler Handler)
        {
            if (!Handlers.ContainsKey(Header))
            {
                Handlers.Add(Header, Handler);
            }
        }
    }
}
