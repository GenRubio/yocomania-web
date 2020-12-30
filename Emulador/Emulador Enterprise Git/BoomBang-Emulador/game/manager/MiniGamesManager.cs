using BoomBang.game.instances;
using BoomBang.game.instances.MiniGames;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading;
using System.Threading.Tasks;

namespace BoomBang.game.manager
{
    public class Llamada
    {
        public Llamada(List<SessionInstance> Participantes, SalaInstance Sala)
        {
            new Thread(() => Llamar(Participantes, Sala)).Start();
        }
        void Llamar(List<SessionInstance> Sessiones, SalaInstance Sala)
        {
            foreach (SessionInstance Session in Sessiones)
            {
                if (Session.User == null) continue;
                Session.User.Jugando = true;
                if (Session.User.Sala != null)
                {
                    if (Session.User.Sala.Escenario.categoria == 5) continue;
                }
                ServerMessage server = new ServerMessage();
                server.AddHead(207);
                Session.SendData(server);
            }
            Thread.Sleep(new TimeSpan(0, 0, 10));
            foreach (SessionInstance Session in Sessiones)
            {
                if (Session.User == null) continue;
                if (Session.User.Sala != null)
                {
                    if (Session.User.Sala.Escenario.categoria == 5) continue;
                }
                if (SalasManager.Entrar_Sala(Session, Sala, null))
                {
                    Sala.CargarEscenario(Session);
                }
            }
        }
    }
    public class Inscripcion
    {
        public SessionInstance Session { get; private set; }
        public int Type { get; private set; }
        public Inscripcion(SessionInstance Session, int type)
        {
            this.Session = Session;
            this.Type = type;
        }
    }
    public enum GameType
    {
        Ring, Camino, Sendero, CocosLocos, otro, Ninguno
    }
    class MiniGamesManager
    {
        public static Dictionary<int, Inscripcion> Inscripciones_Ring = new Dictionary<int, Inscripcion>();
        public static Dictionary<int, Inscripcion> Inscripciones_CocosLocos = new Dictionary<int, Inscripcion>();
        public static Dictionary<int, Inscripcion> Inscripciones_Camino = new Dictionary<int, Inscripcion>();
        public static Dictionary<int, Inscripcion> Inscripciones_Sendero = new Dictionary<int, Inscripcion>();
        public static void BuscarParticipantes(GameType Game, int Type)
        {
            switch (Game)
            {
                case GameType.Ring: RingInstance.BuscarParticipantes(Type); break;
                case GameType.CocosLocos: CocosInstance.BuscarParticipantes(Type); break;
                case GameType.Camino: CaminoInstance.BuscarParticipantes(Type); break;
                case GameType.Sendero: SenderoInstance.BuscarParticipantes(Type); break;
            }
        }
        public static Posicion ObtenerPuerta(EscenarioInstance info, int IDEspacial)
        {
            if (info.id == 2 || info.id == 3)
            {
                switch (IDEspacial)
                {
                    case 1:
                        return new Posicion(12, 12);
                    case 2:
                        return new Posicion(14, 14);
                    case 3:
                        return new Posicion(16, 16);
                    case 4:
                        return new Posicion(18, 16);
                    case 5:
                        return new Posicion(18, 14);
                    case 6:
                        return new Posicion(16, 12);
                    case 7:
                        return new Posicion(14, 10);
                    case 8:
                        return new Posicion(12, 10);
                }
            }
            if (info.id == 6 || info.id == 7)
            {
                switch (IDEspacial)
                {
                    case 1:
                        return new Posicion(8, 18);
                    case 2:
                        return new Posicion(9, 19);
                    case 3:
                        return new Posicion(10, 20);
                }
            }
            if (info.id == 8 || info.id == 9)
            {
                switch (IDEspacial)
                {
                    case 1:
                        return new Posicion(9, 16);
                    case 2:
                        return new Posicion(9, 17);
                    case 3:
                        return new Posicion(9, 18);
                    case 4:
                        return new Posicion(9, 19);
                    case 5:
                        return new Posicion(10, 20);
                    case 6:
                        return new Posicion(11, 20);
                    case 7:
                        return new Posicion(12, 21);
                    case 8:
                        return new Posicion(13, 21);
                }
            }
            if (info.id == 12 || info.id == 13)
            {
                switch (IDEspacial)
                {
                    case 1:
                        return new Posicion(7, 16);
                    case 2:
                        return new Posicion(8, 17);
                    case 3:
                        return new Posicion(9, 18);
                    case 4:
                        return new Posicion(10, 19);
                    case 5:
                        return new Posicion(11, 20);
                }
            }
            return null;
        }
        public static void DescalificarParticipante(SessionInstance Session)
        {
            if (Session.User.Sala.Ring != null) Session.User.Sala.Ring.Descalificar(Session);
            if (Session.User.Sala.Cocos != null) Session.User.Sala.Cocos.Descalificar(Session);
            if (Session.User.Sala.Camino != null) Session.User.Sala.Camino.Descalificar(Session);
            if (Session.User.Sala.Sendero != null) Session.User.Sala.Sendero.Descalificar(Session);
        }
        public static void Desinscribir(SessionInstance Session, int ID)
        {
            switch (Session.User.Game)
            {
                case GameType.Ring:
                    if (ID == 2) RingInstance.Desinscribir(Session);
                    if (ID == 3) RingInstance.Desinscribir(Session);
                    if (ID == 0) RingInstance.Desinscribir(Session);
                    break;
                case GameType.CocosLocos:
                    if (ID == 8) CocosInstance.Desinscribir(Session);
                    if (ID == 9) CocosInstance.Desinscribir(Session);
                    if (ID == 0) CocosInstance.Desinscribir(Session);
                    break;
                case GameType.Camino:
                    if (ID == 12) CaminoInstance.Desinscribir(Session);
                    if (ID == 13) CaminoInstance.Desinscribir(Session);
                    if (ID == 0) CaminoInstance.Desinscribir(Session);
                    break;
                case GameType.Sendero:
                    if (ID == 6) SenderoInstance.Desinscribir(Session);
                    if (ID == 7) SenderoInstance.Desinscribir(Session);
                    if (ID == 0) SenderoInstance.Desinscribir(Session);
                    break;
            }
        }
        public static void Inscribir(SessionInstance Session, int ID)
        {
            switch (Session.User.Game)
            {
                case GameType.Ring:
                    RingInstance.Inscribir(Session, ID);
                    break;
                case GameType.CocosLocos:
                    CocosInstance.Inscribir(Session, ID);
                    break;
                case GameType.Camino:
                    CaminoInstance.Inscribir(Session, ID);
                    break;
                case GameType.Sendero:
                    SenderoInstance.Inscribir(Session, ID);
                    break;
                default:
                    Output.WriteLine("Inscripcion de juego no pogramada: " + Session.User.Game.ToString() + " -> " + ID);
                    break;
            }
        }
        public static int EstadoDeInscripcion(SessionInstance Session, GameType Game)
        {
            switch (Game)
            {
                case GameType.Ring:
                    if (Inscripciones_Ring.ContainsKey(Session.User.id)) return 1;
                    break;
                case GameType.CocosLocos:
                    if (Inscripciones_CocosLocos.ContainsKey(Session.User.id)) return 1;
                    break;
                case GameType.Camino:
                    if (Inscripciones_Camino.ContainsKey(Session.User.id)) return 1;
                    break;
                case GameType.Sendero:
                    if (Inscripciones_Sendero.ContainsKey(Session.User.id)) return 1;
                    break;
            }
            return 0;
        }
        public static void CargarSabio(SessionInstance Session, int GameID)
        {
            GameType Game = DefineGame(GameID);
            switch (Game)
            {
                case GameType.Ring: RingInstance.CargarSabio(Session); break;
                case GameType.Sendero: SenderoInstance.CargarSabio(Session); break;
                case GameType.CocosLocos: CocosInstance.CargarSabio(Session); break;
                case GameType.Camino: CaminoInstance.CargarSabio(Session); break;
            }
        }
        public static void CancelarInscripciones(UserInstance User)
        {
            if (MiniGamesManager.Inscripciones_Ring.ContainsKey(User.id))
            {
                MiniGamesManager.Inscripciones_Ring.Remove(User.id);
            }
            if (MiniGamesManager.Inscripciones_CocosLocos.ContainsKey(User.id))
            {
                MiniGamesManager.Inscripciones_CocosLocos.Remove(User.id);
            }
            if (MiniGamesManager.Inscripciones_Camino.ContainsKey(User.id))
            {
                MiniGamesManager.Inscripciones_Camino.Remove(User.id);
            }
            if (MiniGamesManager.Inscripciones_Sendero.ContainsKey(User.id))
            {
                MiniGamesManager.Inscripciones_Sendero.Remove(User.id);
            }
        }
        public static GameType DefineGame(int id)
        {
            if (id == 1) return GameType.Ring;
            if (id == 3) return GameType.Sendero;
            if (id == 4) return GameType.CocosLocos;
            if (id == 6) return GameType.Camino;
            return GameType.Ninguno;
        }
    }
}
