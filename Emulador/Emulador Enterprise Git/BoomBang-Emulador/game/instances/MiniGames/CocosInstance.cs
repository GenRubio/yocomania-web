using BoomBang.game.handler;
using BoomBang.game.instances.manager;
using BoomBang.game.manager;
using BoomBang.server;
using System;
using System.Collections.Generic;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading;
using System.Threading.Tasks;

namespace BoomBang.game.instances.MiniGames
{
    public class CocosInstance
    {
        public Dictionary<int, SessionInstance> Participantes = new Dictionary<int, SessionInstance>();
        public SalaInstance sala { get; set; }
        public int Contador = 70;
        public bool Iniciado = false;
        public CocosInstance(SalaInstance Sala)
        {
            this.sala = Sala;
            new Thread(() => this.Cocos()).Start();
        }
        public bool Participando(SessionInstance Session)
        {
            if (Participantes.ContainsKey(Session.User.IDEspacial))
                return true;
            return false;
        }
        private void Cocos()
        {
            while (Contador >= 1)
            {
                Contador--;
                if (Contador == 10 || Contador == 30)
                {
                    ServerMessage server_1 = new ServerMessage();
                    server_1.AddHead(160);
                    server_1.AddHead(125);
                    server_1.AppendParameter(Contador);
                    sala.SendData(server_1);
                    sala.Entrable = false;
                }
                Thread.Sleep(new TimeSpan(0, 0, 1));
            }
            if (Participantes.Count >= 4)
            {
                this.IniciarCocos();
                return;
            }
            ServerMessage server_2 = new ServerMessage();
            server_2.AddHead(160);
            server_2.AddHead(124);
            server_2.AppendParameter("Ups!, al parecer no hay suficientes jugadores...");
            sala.SendData(server_2);
            this.FinalizarCocos();
        }
        void IniciarCocos()
        {
            Iniciado = true;
            int TotalRondas = 7;
            List<Point> Puntos = new List<Point>();
            while (TotalRondas > 0)
            {
                Puntos.Clear();
                for (int i = 1; i <= TotalRondas; i++)
                {
                    Point PosGeneratedByMap = sala.GetRandomPlace();
                    while (Puntos.Contains(PosGeneratedByMap) || !sala.Caminable(new Posicion(PosGeneratedByMap.X, PosGeneratedByMap.Y)))
                    {
                        PosGeneratedByMap = sala.GetRandomPlace();
                    }
                    Puntos.Add(PosGeneratedByMap);
                }
                TotalRondas--;
                Thread.Sleep(new TimeSpan(0, 0, 5));
                foreach (Point PointToShow in Puntos)
                {
                    ServerMessage server_1 = new ServerMessage();
                    server_1.AddHead(124);
                    server_1.AddHead(120);
                    server_1.AppendParameter(PointToShow.X);
                    server_1.AppendParameter(PointToShow.Y);
                    server_1.AppendParameter(1);
                    sala.SendData(server_1);
                }
                Thread.Sleep(new TimeSpan(0, 0, 5));
                foreach (Point PointToHidden in Puntos)
                {

                    ServerMessage server_2 = new ServerMessage();
                    server_2.AddHead(124);
                    server_2.AddHead(121);
                    server_2.AppendParameter(PointToHidden.X);
                    server_2.AppendParameter(PointToHidden.Y);
                    server_2.AppendParameter(1);
                    sala.SendData(server_2);
                }
                ServerMessage server_3 = new ServerMessage();
                server_3.AddHead(160);
                server_3.AddHead(125);
                server_3.AppendParameter(30);
                sala.SendData(server_3);
                sala.PathFinder = true;
                Thread.Sleep(new TimeSpan(0, 0, 30));
                sala.PathFinder = false;
                List<SessionInstance> ParaDescalificar = new List<SessionInstance>();
                foreach (SessionInstance Session in Participantes.Values)
                {
                    if (!Puntos.Contains(new Point(Session.User.Posicion.x, Session.User.Posicion.y)))
                    {
                        ParaDescalificar.Add(Session);
                    }
                }
                foreach (SessionInstance Session in ParaDescalificar)
                {
                    Descalificar(Session);
                    LanzarCoco(Session);
                    UserManager.Sumar_Cocos(Session.User, 1);

                    RankingsManager.agregar_user_ranking(Session.User.id, 2, 2, 1);

                    //using (mysql client = new mysql())
                    //{
                    //    string Nombre = Session.User.nombre;
                    //    if (Nombre == "") { Session.User.nombre = Session.User.nombre_halloween; }
                    //    DataRow comprobar_usuario = client.ExecuteQueryRow("SELECT * FROM coco_semanal WHERE usuario = '" + Nombre + "'");
                    //    if (comprobar_usuario != null)
                    //    {
                    //        int goldens = (int)comprobar_usuario["goldens"];
                    //        int actualizar_goldens = goldens + 1;
                    //        client.ExecuteNonQuery("UPDATE coco_semanal SET goldens = '" + actualizar_goldens + "' WHERE usuario = '" + Nombre + "'");
                    //    }
                    //    else
                    //    {
                    //        client.SetParameter("usuario", Nombre);
                    //        client.SetParameter("goldens", 1);
                    //        client.ExecuteNonQuery("INSERT INTO coco_semanal (`usuario`, `goldens`) VALUES (@usuario, @goldens)");
                    //    }
                    //}
                }
                Thread.Sleep(new TimeSpan(0, 0, 10));
                if (Participantes.Count == 0 || Participantes.Count == 1) break;
            }
            if (Participantes.Count == 0)
            {
                ServerMessage server_4 = new ServerMessage();
                server_4.AddHead(160);
                server_4.AddHead(124);
                server_4.AppendParameter("Ups!, al parecer no hay ganadores en esta ronda...");
                sala.SendData(server_4);
            }
            else
            {
                SessionInstance SessionWin = null;
                foreach (SessionInstance Session in Participantes.Values)
                {
                    SessionWin = Session;
                }
                if (SessionWin != null)
                {
                    Participantes.Remove(SessionWin.User.id);
                    switch (sala.Escenario.id)
                    {
                        case 8:

                            ServerMessage server_5 = new ServerMessage();
                            server_5.AddHead(160);
                            server_5.AddHead(129);
                            server_5.AppendParameter(1);
                            server_5.AppendParameter(SessionWin.User.id);
                            server_5.AppendParameter(SessionWin.User.nombre);
                            server_5.AppendParameter("Ha ganado: " + Recompensa_Golden + " créditos! y Suma " + 3 + " puntos y está más cerca de conseguir un nuevo coco!");
                            sala.SendData(server_5);

                            RankingsManager.agregar_user_ranking(SessionWin.User.id, 2, 2, 3);

                            UserManager.Creditos(SessionWin.User, true, true, Recompensa_Golden);
                            UserManager.Sumar_Cocos(SessionWin.User, 3);
                            SessionWin.User.torneos_coco++;
                            if (SessionWin.User.torneos_coco == 300)
                            {
                                using (mysql client = new mysql())
                                {
                                    client.SetParameter("usuario_id", SessionWin.User.id);
                                    client.SetParameter("objeto_id", 3069);
                                    client.ExecuteNonQuery("INSERT INTO objetos_comprados (`usuario_id`, `objeto_id`) VALUES (@usuario_id, @objeto_id)");
                                }
                            }
                            UserManager.ActualizarEstadisticas(SessionWin.User);
                            break;
                        case 9:
                            ServerMessage server_6 = new ServerMessage();
                            server_6.AddHead(160);
                            server_6.AddHead(129);
                            server_6.AppendParameter(1);
                            server_6.AppendParameter(SessionWin.User.id);
                            server_6.AppendParameter(SessionWin.User.nombre);
                            server_6.AppendParameter("Ha ganado: " + Recompensa_Silver + " monedas de plata! y Suma " + 1 + " puntos y está más cerca de conseguir un nuevo coco!");
                            sala.SendData(server_6);
                            UserManager.Creditos(SessionWin.User, false, true, Recompensa_Silver);
                            UserManager.Sumar_Cocos(SessionWin.User, 1);
                            break;
                    }
                    SessionWin.User.Jugando = false;
                }
            }
            FinalizarCocos();
        }
        void FinalizarCocos()
        {
            Contador = 30;
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
            CocosLocos.Remove(sala.id);
        }
        void LanzarCoco(SessionInstance Session)
        {
            if (Session.User == null) return;
            Session.User.Trayectoria.DetenerMovimiento();
            Session.User.Time_Interactuando = Time.GetCurrentAndAdd(AddType.Segundos, 6);
            ServerMessage coco = new ServerMessage();
            coco.AddHead(184);
            coco.AddHead(120);
            coco.AppendParameter(Session.User.id);
            coco.AppendParameter(0);
            coco.AppendParameter(35);
            sala.SendData(coco);
            new Thread(() => InterfazHandler.Coco_Thread(Session, new TimeSpan(0, 0, 0, 6, 0), 35, Session.User.Sala, new Posicion(0, 0))).Start();
            Session.User.Sala.Map[Session.User.Posicion.y, Session.User.Posicion.x].FijarSession(null);
        }
        public void Descalificar(SessionInstance Session)
        {
            //if (Iniciado == false) return;
            if (Participantes.ContainsKey(Session.User.IDEspacial))
            {
                Session.User.Jugando = false;
                Session.User.CocosLocos = null;
                if (sala.Escenario.id == 8)
                {
                    UserManager.Creditos(Session.User, true, false, Precio_Golden);
                }
                if (sala.Escenario.id == 9)
                {
                    UserManager.Creditos(Session.User, false, false, Precio_Silver);
                }
                Participantes.Remove(Session.User.IDEspacial);
                if (MiniGamesManager.Inscripciones_CocosLocos.ContainsKey(Session.User.id))
                {
                    MiniGamesManager.Inscripciones_CocosLocos.Remove(Session.User.id);
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
        public static int Cocos_Today = 0;
        public static int Precio_Golden = 100;
        public static int Precio_Silver = 1;
        public static int Recompensa_Golden = 500;
        public static int Recompensa_Silver = 100;
        public static string Descripcion_Silver = "Si ganas, no se te cobrará la partida y conseguirás: \r100 monedas de plata y 1 punto.";
        public static string Descripcion_Golden = "Si ganas, no se te cobrará la partida y conseguirás: \r500 créditos y 3 puntos.";
        public static void CargarSabio(SessionInstance Session)
        {
            Session.User.Game = GameType.CocosLocos;
            ServerMessage server = new ServerMessage();
            server.AddHead(160);
            server.AddHead(120);
            server.AppendParameter(MiniGamesManager.EstadoDeInscripcion(Session, GameType.CocosLocos));
            server.AppendParameter(0);
            server.AppendParameter(9);
            server.AppendParameter(Descripcion_Silver);//Descripcion Silver
            server.AppendParameter(0);
            server.AppendParameter(Precio_Silver);//Precio Silver
            server.AppendParameter(8);
            server.AppendParameter(Descripcion_Golden);//Descripción Golden
            server.AppendParameter(Precio_Golden);//Precio Golden
            server.AppendParameter(0);
            Session.SendData(server);

            RankingsManager.cartel_ranking(Session, 2, 2, ServerThreads.Fecha_Ranking_Semanal);

        }
        public static bool FiltroDePago(SessionInstance Session, int type)///Hay que activarlo despues
        {
            foreach (var Inscripcion in MiniGamesManager.Inscripciones_CocosLocos.Values)
            {
                if (Inscripcion.Type == type && Inscripcion.Session.IP == Session.IP) return true;
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
                    if (ID == 8)//Golden
                    {
                        if (Session.User.oro >= CocosInstance.Precio_Golden)
                        {
                            if (!MiniGamesManager.Inscripciones_CocosLocos.ContainsKey(Session.User.id))
                            {
                                MiniGamesManager.Inscripciones_CocosLocos.Add(Session.User.id, new Inscripcion(Session, 8));
                                if (MiniGamesManager.Inscripciones_CocosLocos.ContainsKey(Session.User.id))
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
                    if (ID == 9)//Silver
                    {
                        server.AppendParameter(-1);
                        if (Session.User.plata >= CocosInstance.Precio_Silver)
                        {
                            if (!MiniGamesManager.Inscripciones_CocosLocos.ContainsKey(Session.User.id))
                            {
                                MiniGamesManager.Inscripciones_CocosLocos.Add(Session.User.id, new Inscripcion(Session, 9));
                                if (MiniGamesManager.Inscripciones_CocosLocos.ContainsKey(Session.User.id))
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
        public static void BuscarParticipantes(int type)
        {
            List<Inscripcion> Collections = new List<Inscripcion>();
            List<SessionInstance> Participantes = new List<SessionInstance>();
            foreach (var Inscripcion in MiniGamesManager.Inscripciones_CocosLocos.Values) Collections.Add(Inscripcion);
            foreach (var Inscripcion in Collections)
            {
                try
                {
                    if (!Inscripcion.Session.Client.Connected) continue;
                    if (Inscripcion.Type != type) continue;
                    if (Inscripcion.Session.User.Jugando) continue;
                    Participantes.Add(Inscripcion.Session);
                    if (Participantes.Count == 4) break;
                }
                catch
                {
                    continue;
                }
            }
            if (Participantes.Count == 4)
            {
                SalaInstance Sala = Buscar_Juego(type);
                if (Sala != null) new Llamada(Participantes, Sala);
            }
        }
        public static Dictionary<int, SalaInstance> CocosLocos = new Dictionary<int, SalaInstance>();
        public static SalaInstance Buscar_Juego(int ID)
        {
            foreach (SalaInstance Sala in CocosLocos.Values)
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
                    while (CocosLocos.ContainsKey(Cocos_Today)) Cocos_Today++;
                    CocosLocos.Add(Cocos_Today, new SalaInstance(Cocos_Today, new EscenarioInstance(row)));
                    foreach (SalaInstance Sala in CocosLocos.Values)
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
                foreach (var Sala in CocosLocos.Values)
                {
                    num += Sala.Usuarios.Count;
                }
                return num;
            }
        }
        public static void Desinscribir(SessionInstance Session)
        {
            if (Session.User.Jugando == true) return;
            CancelarInscripcion(Session);
        }
        public static void CancelarInscripcion(SessionInstance Session)
        {
            if (MiniGamesManager.Inscripciones_CocosLocos.ContainsKey(Session.User.id))
            {
                MiniGamesManager.Inscripciones_CocosLocos.Remove(Session.User.id);
            }
        }
    }
}
