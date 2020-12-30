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
    public class KekosLanzados
    {
        public int ID;
        public int KekoID;
        public int Posicion;
        public int Puntos;
        public KekosLanzados(int id, int keko, int pos, int Puntos)
        {
            this.ID = id;
            this.KekoID = keko;
            this.Posicion = pos;
            this.Puntos = Puntos;
        }
    }
    public class CaminoInstance
    {
        public Dictionary<int, KekosLanzados> KekosParaLanzar = new Dictionary<int, KekosLanzados>();
        public Dictionary<int, SessionInstance> Participantes = new Dictionary<int, SessionInstance>();
        public static int[] Posicion_1 = new int[] { 2, 6, 10, 14, 18, 6, 14, 6 };
        public static int[] Posicion_2 = new int[] { 3, 7, 11, 15, 19, 3, 11, 19 };
        public static int[] Posicion_3 = new int[] { 3, 7, 11, 15, 19, 2, 6, 10, 14, 18, 3, 11, 19, 6, 14 };
        public static int[] Posicion_4 = new int[] { 3, 7, 11, 15, 19, 2, 6, 10, 14, 18, 7, 15, 2, 10, 18 };
        public static int[] Posicion_5 = new int[] { 4, 8, 12, 16, 20, 8, 16 };
        public static int[] Posicion_6 = new int[] { 3, 7, 11, 15, 19, 15, 7, 3 };
        public static int[] Posicion_7 = new int[] { 4, 8, 12, 16, 20, 12, 4, 20 };
        public static int[] Posicion_8 = new int[] { 4, 8, 12, 16, 20, 20, 8, 12 };
        public static int[] Posicion_9 = new int[] { 3, 7, 11, 15, 19, 2, 6, 10, 14, 18, 3, 7, 15, 19, 2, 6, 10 };
        public static int[] Posicion_10 = new int[] { 1, 5, 9, 13, 17, 1, 9, 9, 5 };
        public static int[] Posicion_11 = new int[] { 4, 8, 12, 16, 20, 4, 12, 20 };
        public static int[] Posicion_12 = new int[] { 4, 8, 12, 16, 20, 16, 20, 20 };
        public static int[] Posicion_13 = new int[] { 1, 5, 9, 13, 17, 5, 9, 13, 17 };
        public static int[] Posicion_14 = new int[] { 2, 6, 10, 14, 18, 2, 6, 14 };
        public static int[] Posicion_16 = new int[] { 21 };
        public static int[] Posicion_17 = new int[] { 21, 22, 24, 25 };
        public static int[] Posicion_18 = new int[] { 23, 25 };
        public static int[] Posicion_19 = new int[] { 25 };
        public static int[] Posicion_20 = new int[] { 21, 24, 25 };
        public static int[] Posicion_21 = new int[] { 22, 25 };
        public static int[] Posicion_22 = new int[] { 21, 22, 25 };
        public static int[] Posicion_23 = new int[] { 26 };
        public SalaInstance sala { get; set; }
        public int Contador = 45;
        public int Tiempo = 300;
        public bool Ganador = false;
        public bool Iniciado = false;
        public CaminoInstance(SalaInstance Sala)
        {
            this.sala = Sala;
            new Thread(() => this.Camino()).Start();
        }
        private void Camino()
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
            if (Participantes.Count <= 1)
            {
                ServerMessage server_5 = new ServerMessage();
                server_5.AddHead(160);
                server_5.AddHead(124);
                server_5.AppendParameter("Ups!, al parecer no hay suficientes jugadores...");
                sala.SendData(server_5);
                this.FinalizarCamino();
                return;
            }
            if (Participantes.Count >= 4)
            {
                this.IniciarCamino();
            }
            this.Iniciado = true;
            sala.PathFinder = true;
            ServerMessage server_2 = new ServerMessage();
            server_2.AddHead(160);
            server_2.AddHead(126);
            sala.SendData(server_2);
            Contador = 0;
            while (Tiempo >= 1)
            {
                Tiempo--;
                Thread.Sleep(new TimeSpan(0, 0, 1));
            }
            this.Iniciado = false;
            if (!Ganador)
            {
                ServerMessage server_3 = new ServerMessage();
                server_3.AddHead(160);
                server_3.AddHead(124);
                server_3.AppendParameter("Se ha acabado el Contador...");
                sala.SendData(server_3);
            }
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
            Caminos.Remove(sala.id);
        }
        void IniciarCamino()
        {
            Iniciado = true;
            Disfrazar_Participantes();
            ServerMessage server_4 = new ServerMessage();
            server_4.AddHead(160);
            server_4.AddHead(126);
            sala.SendData(server_4); ;
            new Thread(() => this.GenerarKekos()).Start();
        }
        void GenerarKekos()
        {
            while (Iniciado)
            {
                KekosParaLanzar.Clear();
                int NumKekos = new Random().Next(3, 8);
                LanzarKekos(NumKekos);
                Thread.Sleep(new TimeSpan(0, 0, new Random().Next(1, 5)));
            }
            FinalizarCamino();
        }
        void LanzarKekos(int NumKekos)
        {
            List<KekosLanzados> KekosLanzados = new List<KekosLanzados>();
            for (int KekoID = 1; KekoID <= NumKekos; KekoID++)
            {
                int PosID = new Random().Next(1, 23);
                while (!PosicionDisponible(PosID))
                {
                    PosID = new Random().Next(1, 23);
                }
                int AvatarToLaunch = ObtenerKeko(PosID);
                KekosParaLanzar.Add(KekoID, new KekosLanzados(KekoID, AvatarToLaunch, PosID, ObtenerPuntos(AvatarToLaunch)));
            }
            Thread.Sleep(new TimeSpan(0, 0, 1));
            foreach (KekosLanzados kekos in KekosParaLanzar.Values)
            {
                KekosLanzados.Add(kekos);
            }
            foreach (KekosLanzados kekos in KekosLanzados)
            {
                if (KekosParaLanzar.ContainsKey(kekos.ID))
                {
                    ServerMessage server = new ServerMessage();
                    server.AddHead(160);
                    server.AddHead(138);
                    server.AddHead(120);
                    server.AppendParameter(kekos.ID);
                    server.AppendParameter(kekos.KekoID);
                    server.AppendParameter(kekos.Posicion);
                    sala.SendData(server);
                }
            }
            Thread.Sleep(new TimeSpan(0, 0, 2));
            foreach (KekosLanzados KekosSobrantes in KekosLanzados)
            {
                if (KekosParaLanzar.ContainsKey(KekosSobrantes.ID))
                {
                    ServerMessage server = new ServerMessage();
                    server.AddHead(160);
                    server.AddHead(138);
                    server.AddHead(121);
                    server.AppendParameter(KekosSobrantes.ID);
                    sala.SendData(server);
                }
            }
        }
        public KekosLanzados ObtenerKekoInfo(int Key)
        {
            if (KekosParaLanzar.ContainsKey(Key))
            {
                return KekosParaLanzar[Key];
            }
            return null;
        }
        int ObtenerKeko(int pos)
        {
            int keko;
            int getIDFromArray;
            int rand;
            switch (pos)
            {
                case 1:
                    rand = new Random().Next(0, Posicion_1.Length);
                    getIDFromArray = Posicion_1[rand];
                    break;
                case 2:
                    rand = new Random().Next(0, Posicion_2.Length);
                    getIDFromArray = Posicion_2[rand];
                    break;
                case 3:
                    rand = new Random().Next(0, Posicion_3.Length);
                    getIDFromArray = Posicion_3[rand];
                    break;
                case 4:
                    rand = new Random().Next(0, Posicion_4.Length);
                    getIDFromArray = Posicion_4[rand];
                    break;
                case 5:
                    rand = new Random().Next(0, Posicion_5.Length);
                    getIDFromArray = Posicion_5[rand];
                    break;
                case 6:
                    rand = new Random().Next(0, Posicion_6.Length);
                    getIDFromArray = Posicion_6[rand];
                    break;
                case 7:
                    rand = new Random().Next(0, Posicion_7.Length);
                    getIDFromArray = Posicion_7[rand];
                    break;
                case 8:
                    rand = new Random().Next(0, Posicion_8.Length);
                    getIDFromArray = Posicion_8[rand];
                    break;
                case 9:
                    rand = new Random().Next(0, Posicion_9.Length);
                    getIDFromArray = Posicion_9[rand];
                    break;
                case 10:
                    rand = new Random().Next(0, Posicion_10.Length);
                    getIDFromArray = Posicion_10[rand];
                    break;
                case 11:
                    rand = new Random().Next(0, Posicion_11.Length);
                    getIDFromArray = Posicion_11[rand];
                    break;
                case 12:
                    rand = new Random().Next(0, Posicion_12.Length);
                    getIDFromArray = Posicion_12[rand];
                    break;
                case 13:
                    rand = new Random().Next(0, Posicion_13.Length);
                    getIDFromArray = Posicion_13[rand];
                    break;
                case 14:
                    rand = new Random().Next(0, Posicion_14.Length);
                    getIDFromArray = Posicion_14[rand];
                    break;
                case 16:
                    rand = new Random().Next(0, Posicion_16.Length);
                    getIDFromArray = Posicion_16[rand];
                    break;
                case 17:
                    rand = new Random().Next(0, Posicion_17.Length);
                    getIDFromArray = Posicion_17[rand];
                    break;
                case 18:
                    rand = new Random().Next(0, Posicion_18.Length);
                    getIDFromArray = Posicion_18[rand];
                    break;
                case 19:
                    rand = new Random().Next(0, Posicion_19.Length);
                    getIDFromArray = Posicion_19[rand];
                    break;
                case 20:
                    rand = new Random().Next(0, Posicion_20.Length);
                    getIDFromArray = Posicion_20[rand];
                    break;
                case 21:
                    rand = new Random().Next(0, Posicion_21.Length);
                    getIDFromArray = Posicion_21[rand];
                    break;
                case 22:
                    rand = new Random().Next(0, Posicion_22.Length);
                    getIDFromArray = Posicion_22[rand];
                    break;
                case 23:
                    rand = new Random().Next(0, Posicion_23.Length);
                    getIDFromArray = Posicion_23[rand];
                    break;
                default:
                    getIDFromArray = 0;
                    break;
            }
            keko = getIDFromArray;
            return keko;
        }
        int ObtenerPuntos(int KekoID)
        {
            if (KekoID == 1) return 5;
            if (KekoID == 2) return 5;
            if (KekoID == 3) return 5;
            if (KekoID == 4) return 5;
            if (KekoID == 5) return -5;
            if (KekoID == 6) return -5;
            if (KekoID == 7) return -5;
            if (KekoID == 8) return -5;
            if (KekoID == 9) return -10;
            if (KekoID == 10) return -10;
            if (KekoID == 11) return -10;
            if (KekoID == 12) return -10;
            if (KekoID == 13) return -15;
            if (KekoID == 14) return -15;
            if (KekoID == 15) return -15;
            if (KekoID == 16) return -15;
            if (KekoID == 17) return -20;
            if (KekoID == 18) return -20;
            if (KekoID == 19) return -20;
            if (KekoID == 20) return -20;
            if (KekoID == 21) return 5;
            if (KekoID == 22) return 10;
            if (KekoID == 23) return 15;
            if (KekoID == 24) return 15;
            if (KekoID == 25) return 5;
            if (KekoID == 26) return 25;
            return 0;
        }
        bool PosicionDisponible(int pos)
        {
            List<KekosLanzados> ListaDeKekos = new List<KekosLanzados>();
            foreach (KekosLanzados kekos in KekosParaLanzar.Values)
            {
                ListaDeKekos.Add(kekos);
            }
            foreach (KekosLanzados kekos in ListaDeKekos)
            {
                if (KekosParaLanzar.ContainsKey(kekos.ID))
                {
                    if (kekos.Posicion == pos)
                    {
                        return false;
                    }
                }
            }
            return true;
        }
        void Disfrazar_Participantes()
        {
            List<SessionInstance> ParaDisfrazar = new List<SessionInstance>();
            foreach (SessionInstance Session in Participantes.Values)
            {
                ParaDisfrazar.Add(Session);
            }
            foreach (var Session in ParaDisfrazar)
            {
                if (Session.User == null) return;
                if (Participantes.ContainsKey(Session.User.IDEspacial))
                {
                    ServerMessage server = new ServerMessage();
                    server.AddHead(125);
                    server.AddHead(120);
                    server.AppendParameter(Session.User.id);
                    server.AppendParameter(12);
                    server.AppendParameter(Colores_traje(Session));
                    server.AppendParameter(1);
                    sala.SendData(server);
                }
            }
        }
        public void DeclararGanador(SessionInstance Session)
        {
            if (Participantes.ContainsKey(Session.User.IDEspacial))
            {
                Participantes.Remove(Session.User.IDEspacial);
                Iniciado = false;
                CancelarInscripcion(Session);
                switch (sala.Escenario.modelo)
                {
                    case 12:  //Golden
                        ServerMessage server = new ServerMessage();
                        server.AddHead(160);
                        server.AddHead(129);
                        server.AppendParameter(1);
                        server.AppendParameter(Session.User.id);
                        server.AppendParameter(Session.User.nombre);
                        server.AppendParameter("Ha ganado: " + GoldenOro + " créditos! y Suma " + Recompensa_Golden + " puntos y mejora su habilidad Ninja.");
                        sala.SendData(server);
                        UserManager.Creditos(Session.User, true, true, GoldenOro);
                        Session.User.puntos_ninja += Recompensa_Golden;
                        sala.ActualizarEstadisticas(Session.User);
                        break;

                    case 13:  //Silver
                        ServerMessage server1 = new ServerMessage();
                        server1.AddHead(160);
                        server1.AddHead(129);
                        server1.AppendParameter(1);
                        server1.AppendParameter(Session.User.id);
                        server1.AppendParameter(Session.User.nombre);
                        server1.AppendParameter("Ha ganado: " + 500 + " monedas de plata");
                        sala.SendData(server1);
                        UserManager.Creditos(Session.User, false, true, Recompensa_Silver);
                        sala.ActualizarEstadisticas(Session.User);
                        break;
                }
                Session.User.mGame12ActualPoints = 0;
                DescalificarUsuarios();
                new Thread(() => FinalizarCamino()).Start();
            }
        }
        private void DescalificarUsuarios()
        {
            List<SessionInstance> ParaDescalificar = new List<SessionInstance>();
            foreach (SessionInstance Session in Participantes.Values)
            {
                ParaDescalificar.Add(Session);
            }
            foreach (SessionInstance Session in ParaDescalificar)
            {
                switch (sala.Escenario.modelo)
                {
                    case 12:
                        UserManager.Creditos(Session.User, true, false, Precio_Golden);
                        Session.User.puntos_ninja += Golden_Lost;
                        sala.ActualizarEstadisticas(Session.User);
                        break;

                    case 13:
                        UserManager.Creditos(Session.User, false, false, Precio_Silver);
                        sala.ActualizarEstadisticas(Session.User);
                        break;
                }
                Descalificar(Session);
            }
        }
        public void Descalificar(SessionInstance Session)
        {
            Session.User.Jugando = false;
            Session.User.CaminoNinja = null;
            if (Participantes.ContainsKey(Session.User.IDEspacial))
            {
                Participantes.Remove(Session.User.IDEspacial);
                CancelarInscripcion(Session);
                Session.User.mGame12ActualPoints = 0;
            }
        }
        public static void Desinscribir(SessionInstance Session)
        {
            if (Session.User.Jugando == true) return;
            CancelarInscripcion(Session);
        }
        public static void CancelarInscripcion(SessionInstance Session)
        {
            if (MiniGamesManager.Inscripciones_Camino.ContainsKey(Session.User.id))
            {
                MiniGamesManager.Inscripciones_Camino.Remove(Session.User.id);
            }
        }
        public void FinalizarCamino(bool Instantaneo = false)
        {
            sala.Entrable = false;
            if (!Instantaneo)
            {
                int count = 10;
                while (count > 0)
                {
                    if (count == 10)
                    {
                        Thread.Sleep(new TimeSpan(0, 0, 5));
                        ServerMessage server = new ServerMessage();
                        server.AddHead(160);
                        server.AddHead(125);
                        server.AppendParameter(count);
                        sala.SendData(server);
                    }
                    count--;
                    Thread.Sleep(new TimeSpan(0, 0, 1));
                }
            }
            sala.ExpusarUsuarios();
            Caminos.Remove(sala.id);
        }
        #region CaminoManager
        public static int GoldenOro = 100;
        public static int Precio_Golden = 100;
        public static int Precio_Silver = 50;
        public static int Recompensa_Golden = 3;
        public static int Recompensa_Silver = 500;
        public static int Silver_Lost = 10;
        public static int Golden_Lost = 1;
        public static string Descripcion_Silver = "Si ganas, no se te cobrará la partida y conseguirás: \r5 monedas de plata.";
        public static string Descripcion_Golden = "Si ganas, no se te cobrará la partida y conseguirás: \r100 créditos y 1 victoria.";
        public static void CargarSabio(SessionInstance Session)
        {
            Session.User.Game = GameType.Camino;
            ServerMessage server = new ServerMessage();
            server.AddHead(160);
            server.AddHead(120);
            server.AppendParameter(MiniGamesManager.EstadoDeInscripcion(Session, GameType.Camino));
            server.AppendParameter(0);
            server.AppendParameter(13);
            server.AppendParameter(Descripcion_Silver);//Descripcion Silver
            server.AppendParameter(0);
            server.AppendParameter(Precio_Silver);//Precio Silver
            server.AppendParameter(12); // Parametro 12 camino Golden
            server.AppendParameter(Descripcion_Golden);//Descripción Golden
            server.AppendParameter(Precio_Golden);//Precio Golden
            server.AppendParameter(0);
            Session.SendData(server);

            //RankingsManager.cartel_ranking(Session, 4, 1, ServerThreads.Fecha_Ranking_Semanal);
        }
        public void Cargar_Contador(SessionInstance Session)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(160);
            server.AddHead(125);
            server.AppendParameter(Contador);
            Session.SendData(server);
        }
        public static int Camino_Today;
        public static Dictionary<int, SalaInstance> Caminos = new Dictionary<int, SalaInstance>();
        public static SalaInstance Buscar_Juego(int ID)
        {
            foreach (SalaInstance Sala in Caminos.Values)
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
                    while (Caminos.ContainsKey(Camino_Today)) Camino_Today++;
                    Caminos.Add(Camino_Today, new SalaInstance(Camino_Today, new EscenarioInstance(row)));
                    foreach (SalaInstance Sala in Caminos.Values)
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
        public static bool FiltroDePago(SessionInstance Session, int type)
        {
            foreach (var Inscripcion in MiniGamesManager.Inscripciones_Camino.Values)
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
                if (ID == 12)//Golden
                {
                    if (Session.User.oro >= CaminoInstance.Precio_Golden)
                    {
                        if (!MiniGamesManager.Inscripciones_Camino.ContainsKey(Session.User.id))
                        {
                            MiniGamesManager.Inscripciones_Camino.Add(Session.User.id, new Inscripcion(Session, 12));
                            if (MiniGamesManager.Inscripciones_Camino.ContainsKey(Session.User.id))
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
                if (ID == 13)//Silver
                {
                    if (Session.User.plata >= CaminoInstance.Precio_Silver)
                    {
                        if (!MiniGamesManager.Inscripciones_Camino.ContainsKey(Session.User.id))
                        {
                            MiniGamesManager.Inscripciones_Camino.Add(Session.User.id, new Inscripcion(Session, 13));
                            if (MiniGamesManager.Inscripciones_Camino.ContainsKey(Session.User.id))
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
            foreach (var Inscripcion in MiniGamesManager.Inscripciones_Camino.Values) Collections.Add(Inscripcion);
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
        public static string Colores_traje(SessionInstance Session)
        {
            string EXTRA_COLORS = "AAAAAAAAAAAAAAAAAA";
            return Session.User.nivel_ninja == 0 ? "FFFFFF" + Session.User.colores.Substring(0, 6) + ObtenerCinta(Session.User.nivel_ninja) + Session.User.colores.Substring(18, 6) + EXTRA_COLORS : "000000" + Session.User.colores.Substring(0, 6) + ObtenerCinta(Session.User.nivel_ninja) + Session.User.colores.Substring(18, 6) + EXTRA_COLORS;
        }
        private static string ObtenerCinta(int NinjaLevel)
        {
            switch (NinjaLevel)
            {
                case 1:
                    return "FF0000";
                case 2:
                    return "FF3399";
                case 3:
                    return "FF6600";
                case 4:
                    return "00CC00";
                case 5:
                    return "0066CC";
                case 6:
                    return "FFFFFF";
                case 7:
                    return "660099";
                case 8:
                    return "653232";
                case 9:
                    return "222222";
                case 10:
                    return "FFCC00";
                default:
                    return "FFFFFF";
            }
        }
        public static int Jugadores
        {
            get
            {
                int num = 0;
                foreach (var Sala in Caminos.Values)
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
    }
    #endregion
}
