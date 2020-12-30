using BoomBang.game.instances;
using BoomBang.game.instances.MiniGames;
using BoomBang.game.manager;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace BoomBang.game.handler
{
    class MiniGamesHandler
    {
        public static void Start()
        {
            HandlerManager.RegisterHandler(160120, new ProcessHandler(CargarSabio));
            HandlerManager.RegisterHandler(160121, new ProcessHandler(Inscribir));
            HandlerManager.RegisterHandler(160122, new ProcessHandler(Desinscribir));
            HandlerManager.RegisterHandler(160138122, new ProcessHandler(mGame12_ClickPerson));
        }
        private static void mGame12_ClickPerson(SessionInstance Session, string[,] Parameters)
        {
            int KekoID = int.Parse(Parameters[0, 0]);
            if (Session.User.Sala != null)
            {
                if (Session.User.Sala.Camino != null)
                {
                    if (Session.User.Sala.Camino.Iniciado)
                    {
                        KekosLanzados Keko = Session.User.Sala.Camino.ObtenerKekoInfo(KekoID);
                        if (Keko != null)
                        {
                            Session.User.mGame12ActualPoints += Keko.Puntos;
                            ServerMessage server = new ServerMessage();
                            server.AddHead(160);
                            server.AddHead(138);
                            server.AddHead(122);
                            server.AppendParameter(Session.User.id);
                            server.AppendParameter(KekoID);
                            server.AppendParameter(Keko.Puntos);
                            server.AppendParameter(Session.User.mGame12ActualPoints);
                            Session.User.Sala.SendData(server, Session);
                            Session.User.Sala.Camino.KekosParaLanzar.Remove(KekoID);
                            if (Session.User.mGame12ActualPoints >= 100)
                            {
                                Session.User.Sala.Camino.DeclararGanador(Session);
                            }
                        }
                    }
                }
            }
        }
        static void Desinscribir(SessionInstance Session, string[,] Parameters)
        {
            MiniGamesManager.Desinscribir(Session, int.Parse(Parameters[0, 0]));
        }
        static void Inscribir(SessionInstance Session, string[,] Parameters)
        {
            MiniGamesManager.Inscribir(Session, int.Parse(Parameters[0, 0]));
        }
        static void CargarSabio(SessionInstance Session, string[,] Parameters)
        {
            MiniGamesManager.CargarSabio(Session, int.Parse(Parameters[0, 0]));
        }
        public static bool Desactivar_Golden_Minijuegos = false;
    }
}
