using BoomBang.game.handler;
using BoomBang.game.instances.manager;
using BoomBang.game.manager;
using BoomBang.server;
using System;
using System.Collections.Generic;
using System.Data;
using System.Linq;
using System.Text;
using System.Threading;
using System.Threading.Tasks;

namespace BoomBang.game.instances.MiniGames
{
    public class RingInstance
    {
        public Dictionary<int, SessionInstance> Participantes = new Dictionary<int, SessionInstance>();
        public SalaInstance sala { get; set; }
        public int Contador = 65;
        public int Tiempo_Atas = 360;
        public bool Iniciado = false;
        public bool Ganador = false;
        public bool NSP = false;
        public RingInstance(SalaInstance Sala)
        {
            this.sala = Sala;
            new Thread(() => this.Ring()).Start();
        }
        private void Ring()
        {
            sala.Entrable = false;
            while (Contador >= 1)
            {
                Contador--;
                ServerMessage server_1 = new ServerMessage();
                server_1.AddHead(160);
                server_1.AddHead(125);
                server_1.AppendParameter(Contador);
                sala.SendData(server_1);
                Thread.Sleep(new TimeSpan(0, 0, 1));
            }
            if (sala.Usuarios.Count == 1)
            {
                this.Iniciado = false;
                this.NSP = true;
                ServerMessage server_3 = new ServerMessage();
                server_3.AddHead(160);
                server_3.AddHead(124);
                server_3.AppendParameter("No hay suficientes jugadores. No te hemos cobrado la partida.");
                sala.SendData(server_3);
                Contador = 10;
                ServerMessage server_4 = new ServerMessage();
                server_4.AddHead(160);
                server_4.AddHead(125);
                server_4.AppendParameter(Contador);
                sala.SendData(server_4);
            }
            else
            {
                this.Iniciado = true;
                sala.PathFinder = true;
                ServerMessage server_2 = new ServerMessage();////Sabio pega el taboro fuerte para indicar que ring ha iniciado
                server_2.AddHead(160);
                server_2.AddHead(126);
                sala.SendData(server_2);
                Contador = 0;
                //Contador = 480;
                while (Tiempo_Atas >= 1)
                {
                    Tiempo_Atas--;
                    if (Tiempo_Atas == 60)
                    {
                        ServerMessage server = new ServerMessage();
                        server.AddHead(160);
                        server.AddHead(123);
                        sala.SendData(server);
                    }
                    if (Tiempo_Atas == 0)
                    {
                        ServerMessage server_45 = new ServerMessage();////Sabio pega el taboro fuerte para indicar que ring ha iniciado
                        server_45.AddHead(160);
                        server_45.AddHead(126);
                        sala.SendData(server_45);
                    }
                    Thread.Sleep(new TimeSpan(0, 0, 1));
                }
                this.Iniciado = false;
                if (!Ganador)
                {
                    ServerMessage server_3 = new ServerMessage();
                    server_3.AddHead(160);
                    server_3.AddHead(124);
                    server_3.AppendParameter("Se ha acabado el tiempo...");
                    sala.SendData(server_3);
                    Contador = 10;
                    ServerMessage server_4 = new ServerMessage();
                    server_4.AddHead(160);
                    server_4.AddHead(125);
                    server_4.AppendParameter(Contador);
                    sala.SendData(server_4);
                }
                else
                {
                    Contador = 30;
                }
            }
            while (Contador >= 1)
            {
                Contador--;
                if (Contador == 10)
                {
                    ServerMessage server_4 = new ServerMessage();
                    server_4.AddHead(160);
                    server_4.AddHead(125);
                    server_4.AppendParameter(Contador);
                    sala.SendData(server_4);
                }
                Thread.Sleep(new TimeSpan(0, 0, 1));
            }
            sala.ExpusarUsuarios();
            Rings.Remove(sala.id);
        }
        public void Descalificar(SessionInstance Session)
        {
            if (Participantes.ContainsKey(Session.User.IDEspacial))
            {
                Session.User.Jugando = false;
                if (sala.Escenario.id == 2 && NSP == false)
                {
                    UserManager.Creditos(Session.User, true, false, Precio_Golden);
                    Session.User.sala_especial = false;
                }
                if (sala.Escenario.id == 3 && NSP == false)
                {
                    UserManager.Creditos(Session.User, false, false, Precio_Silver);
                    Session.User.sala_especial = false;
                }
                Participantes.Remove(Session.User.IDEspacial);
                if (MiniGamesManager.Inscripciones_Ring.ContainsKey(Session.User.id))
                {
                    MiniGamesManager.Inscripciones_Ring.Remove(Session.User.id);
                }
                if (Iniciado == true)
                {
                    if (Participantes.Count == 2)
                    {
                        ServerMessage server = new ServerMessage();
                        server.AddHead(160);
                        server.AddHead(123);
                        sala.SendData(server);
                    }
                }
                if (Participantes.Count == 1 && Iniciado == true)
                {
                    Ganador = true;
                    Tiempo_Atas = 0;
                    SessionInstance SessionWin = null;
                    foreach (var win in Participantes.Values)
                    {
                        SessionWin = win;
                    }
                    CancelarInscripcion(Session);
                    CancelarInscripcion(SessionWin);
                    if (sala.Escenario.id == 2)///Golden Ring
                    {
                        SessionWin.User.sala_especial = false;
                        SessionWin.User.rings_ganados++;
                        SessionWin.User.toneos_ring++;
                        if (InterfazHandler.Cada_X_Goldens.Contains(SessionWin.User.rings_ganados))
                        {
                            RegalosManager.Sistema_Regalos(SessionWin);
                        }
                        SessionWin.User.Sala.ActualizarEstadisticas(SessionWin.User);
                        UserManager.Creditos(SessionWin.User, true, true, Recompensa_Golden);

                        ServerMessage server = new ServerMessage();
                        server.AddHead(160);
                        server.AddHead(129);
                        server.AppendParameter(0);
                        server.AppendParameter(0);
                        server.AppendParameter(SessionWin.User.nombre);
                        server.AppendParameter("Ha ganado: " + Recompensa_Golden +" créditos! Suma una victoria!");
                        sala.SendData(server);

                        RankingsManager.agregar_user_ranking(SessionWin.User.id, 1, 2, 1);
                    }
                    if (sala.Escenario.id == 3)//Silver Ring
                    {
                        SessionWin.User.sala_especial = false;
                        SessionWin.User.rings_ganados++;
                        SessionWin.User.Sala.ActualizarEstadisticas(SessionWin.User);
                        UserManager.Creditos(SessionWin.User, false, true, Recompensa_Silver);

                        if (InterfazHandler.Cada_X_Goldens.Contains(SessionWin.User.rings_ganados))
                        {
                            RegalosManager.Sistema_Regalos(SessionWin);
                        }

                        ServerMessage server = new ServerMessage();
                        server.AddHead(160);
                        server.AddHead(129);
                        server.AppendParameter(0);
                        server.AppendParameter(0);
                        server.AppendParameter(SessionWin.User.nombre);
                        server.AppendParameter("Ha ganado: " + Recompensa_Silver +" monedas de plata! Suma una victoria!");
                        sala.SendData(server);

                        RankingsManager.agregar_user_ranking(SessionWin.User.id, 1, 1, 1);
                    }
                    Participantes.Remove(SessionWin.User.IDEspacial);
                    SessionWin.User.Jugando = false;
                }
            }
        }
        public void Cargar_Contador(SessionInstance Session)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(160);
            server.AddHead(125);
            server.AppendParameter(Contador);
            Session.SendData(server);
            
        }
        #region RingManager
        public static Dictionary<int, SalaInstance> Rings = new Dictionary<int, SalaInstance>();
        public static string Descripcion_Silver = "Si ganas, no se te cobrará la partida y conseguirás: \r100 monedas de plata y 1 victoria.";
        public static string Descripcion_Golden = "Si ganas, no se te cobrará la partida y conseguirás: \r500 créditos y 1 victoria.";
        public static int Precio_Golden = 100;
        public static int Precio_Silver = 1;
        public static int Recompensa_Golden = 500;
        public static int Recompensa_Silver = 100;
        public static int Rings_Today;
        public static void CargarSabio(SessionInstance Session)
        {
            Session.User.Game = GameType.Ring;
            ServerMessage server = new ServerMessage();
            server.AddHead(160);
            server.AddHead(120);
            server.AppendParameter(MiniGamesManager.EstadoDeInscripcion(Session, GameType.Ring));

            server.AppendParameter(0);
            server.AppendParameter(3);
            server.AppendParameter(Descripcion_Silver);//Descripcion Silver
            server.AppendParameter(0);
            server.AppendParameter(Precio_Silver);//Precio Silver
            server.AppendParameter(2);
            server.AppendParameter(Descripcion_Golden);//Descripción Golden
            server.AppendParameter(Precio_Golden);//Precio Golden
            server.AppendParameter(0);
            Session.SendData(server);

            if (Session.User.ver_ranking == 1)
            {
                RankingsManager.cartel_ranking(Session, 1, 2, ServerThreads.Fecha_Ranking_Semanal);//2 Golden
            }
            if (Session.User.ver_ranking == 2)
            {
                RankingsManager.cartel_ranking(Session, 1, 1, ServerThreads.Fecha_Ranking_Semanal);//1 Silver
            }
        }
        public static bool FiltroDePago(SessionInstance Session, int type)///Hay que activarlo despues
        {
            foreach (var Inscripcion in MiniGamesManager.Inscripciones_Ring.Values)
            {
                //if (Inscripcion.Type == type && Inscripcion.Session.IP == Session.IP) return true;
            }
            return false;
        }
        public static void Inscribir(SessionInstance Session, int ID)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(160);
            server.AddHead(121);
            server.AppendParameter(ID);
            try
            {
                if (!FiltroDePago(Session, ID) && MiniGamesHandler.Desactivar_Golden_Minijuegos == false)
                {
                    if (ID == 2)//Golden
                    {
                        if (Session.User.oro >= RingInstance.Precio_Golden)
                        {
                            if (!MiniGamesManager.Inscripciones_Ring.ContainsKey(Session.User.id))
                            {
                                MiniGamesManager.Inscripciones_Ring.Add(Session.User.id, new Inscripcion(Session, 2));
                                if (MiniGamesManager.Inscripciones_Ring.ContainsKey(Session.User.id))
                                {
                                    server.AppendParameter(1);
                                }
                            }
                            else
                            {
                                server.AppendParameter(-1);
                            }
                        }
                        else
                        {
                            server.AppendParameter(2);
                        }
                    }
                }
                if (!FiltroDePago(Session, ID) && MiniGamesHandler.Desactivar_Golden_Minijuegos == false)
                {
                    if (ID == 3)//Silver
                    {
                        if (Session.User.plata >= RingInstance.Precio_Silver)
                        {
                            if (!MiniGamesManager.Inscripciones_Ring.ContainsKey(Session.User.id))
                            {
                                MiniGamesManager.Inscripciones_Ring.Add(Session.User.id, new Inscripcion(Session, 3));
                                if (MiniGamesManager.Inscripciones_Ring.ContainsKey(Session.User.id))
                                {
                                    server.AppendParameter(1);
                                }
                            }
                            else
                            {
                                server.AppendParameter(-1);
                            }
                        }
                        else
                        {
                            server.AppendParameter(2);
                        }
                    }
                }
                else
                {
                    server.AppendParameter(-1);
                }
            }
            catch
            {
                server.AppendParameter(-1);
            }
            Session.SendData(server);
        }
        public static void Desinscribir(SessionInstance Session)
        {
            if (Session.User.Jugando == true) return;
            CancelarInscripcion(Session);
        }
        public static void CancelarInscripcion(SessionInstance Session)
        {
            if (MiniGamesManager.Inscripciones_Ring.ContainsKey(Session.User.id))
            {
                MiniGamesManager.Inscripciones_Ring.Remove(Session.User.id);
            }
        }
        public static void BuscarParticipantes(int type)
        {
            List<Inscripcion> Collections = new List<Inscripcion>();
            List<SessionInstance> Participantes = new List<SessionInstance>();
            foreach (var Inscripcion in MiniGamesManager.Inscripciones_Ring.Values) Collections.Add(Inscripcion);
            foreach (var Inscripcion in Collections)
            {
                try
                {
                    if (!Inscripcion.Session.Client.Connected) continue;
                    if (Inscripcion.Type != type) continue;
                    if (Inscripcion.Session.User.Jugando) continue;
                    Participantes.Add(Inscripcion.Session);
                    if (Participantes.Count == 4) break;///Llamada ring
                }
                catch
                {
                    continue;
                }
            }
            if (Participantes.Count == 4)///Llamada ring
            {
                SalaInstance Sala = Buscar_Juego(type);
                if (Sala != null) new Llamada(Participantes, Sala);
            }
        }
        public static SalaInstance Buscar_Juego(int ID)
        {
            foreach (SalaInstance Sala in Rings.Values)
            {
                if (Sala.Escenario.id != ID) continue;
                if (Sala.Usuarios.Count >= Sala.Escenario.max_visitantes) continue;
                if (Sala.Entrable == false) continue;
                return Sala;
            }
            using (mysql client = new mysql())
            {
                client.SetParameter("id", ID);
                DataRow row = client.ExecuteQueryRow("SELECT * FROM escenarios_mgame WHERE id = @id");
                if (row != null)
                {
                    while (Rings.ContainsKey(Rings_Today)) Rings_Today++;
                    Rings.Add(Rings_Today, new SalaInstance(Rings_Today, new EscenarioInstance(row)));
                    foreach (SalaInstance Sala in Rings.Values)
                    {
                        if (Sala.Escenario.id != ID) continue;
                        if (Sala.Usuarios.Count >= Sala.Escenario.max_visitantes) continue;
                        if (Sala.Entrable == false) continue;
                        return Sala;
                    }
                }
            }
            return null;
        }
        public static int Jugadores
        {
            get
            {
                int num = 0;
                foreach (var Sala in Rings.Values)
                {
                    num += Sala.Usuarios.Count;
                }
                return num;
            }
        }
        public static void Entrega_Trofeo_Semanal(SessionInstance Session)
        {

        }
        public bool Participando(SessionInstance Session)
        {
            if (Participantes.ContainsKey(Session.User.IDEspacial))
                return true;
            return false;
        }
        #endregion
    }
}
