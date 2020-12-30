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
    public class SenderoInstance
    {
        public static Dictionary<int, SalaInstance> EndSendero = new Dictionary<int, SalaInstance>();
        private SenderosMapas SenderosMapas = new SenderosMapas();
        private List<Point> Senderos = new List<Point>();
        public Dictionary<int, SessionInstance> Participantes = new Dictionary<int, SessionInstance>();
        public SalaInstance sala { get; set; }
        public int Contador = 45;
        public int Tiempo = 300;
        public bool Ganador = false;
        public bool Iniciado = false;
        public bool NSP = false;
        public SenderoInstance(SalaInstance Sala)
        {
            this.sala = Sala;
            new Thread(() => this.Sendero()).Start();
        }
        private void Sendero()
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
                this.FinalizarSendero();
                return;
            }
            if (Participantes.Count >= 3)
            {
                this.IniciarSendero();
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
                foreach (Point PointToShow in Senderos)
                {
                    ServerMessage server1 = new ServerMessage();
                    server1.AddHead(124);
                    server1.AddHead(120);
                    server1.AppendParameter(PointToShow.X);
                    server1.AppendParameter(PointToShow.Y);
                    server1.AppendParameter(1);
                    sala.SendData(server1);
                }
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
            EndSendero.Remove(sala.id);
        }
        void IniciarSendero()
        {
            sala.PathFinder = true;
            Iniciado = true;
            BuscarSenderos((sala.Escenario.id == 6 ? 3 : 3));
        }
        public void VerificarMovimiento(SessionInstance Session)
        {
            if (!Iniciado) return;
            List<SessionInstance> ParaDescalificar = new List<SessionInstance>();
            if (!Senderos.Contains(new Point(Session.User.Posicion.x, Session.User.Posicion.y)))
            {
                new Thread(() => this.Liana(Session)).Start();
                return;
            }
            if (Session.User.Posicion.x == 15 && Session.User.Posicion.y == 13)
            {
                Iniciado = false;
                if (Participantes.ContainsKey(Session.User.IDEspacial))
                {
                    if (Participantes.Remove(Session.User.IDEspacial))
                    {
                        Session.User.Jugando = false;
                        Session.User.SenderoOculto = null;
                        CancelarInscripcion(Session);
                        switch (sala.Escenario.id)
                        {
                            case 6: //Golden
                                ServerMessage server = new ServerMessage();
                                server.AddHead(160);
                                server.AddHead(129);
                                server.AppendParameter(0);
                                server.AppendParameter(0);
                                server.AppendParameter(Session.User.nombre);
                                server.AppendParameter("Ha ganado: 1 Liana y suma una victoria!");
                                sala.SendData(server);
                                Session.User.senderos_ganados++;
                                sala.ActualizarEstadisticas(Session.User);
                                EntregarLiana(Session, 1230);
                                RankingsManager.agregar_user_ranking(Session.User.id, 3, 2, 1);
                                break;
                            case 7: //Silver
                                ServerMessage server1 = new ServerMessage();
                                server1.AddHead(160);
                                server1.AddHead(129);
                                server1.AppendParameter(0);
                                server1.AppendParameter(0);
                                server1.AppendParameter(Session.User.nombre);
                                server1.AppendParameter("Ha ganado: 5 monedas de plata!");
                                sala.SendData(server1);
                                UserManager.Creditos(Session.User, false, true, Recompensa_Silver);
                                NotificacionesManager.Recompensa_Plata(Session, 5);
                                sala.ActualizarEstadisticas(Session.User);
                                break;
                        }
                        DescalificarUsuarios();
                        FinalizarSendero();
                    }
                }
            }
        }
        void Liana(SessionInstance Session)
        {
            if (Session.User == null) return;
            if (Session.User.Sala == null) return;
            Session.User.Time_Interactuando = Time.GetCurrentAndAdd(AddType.Segundos, 5);
            Session.User.Trayectoria.DetenerMovimiento();
            ServerMessage liana = new ServerMessage();
            liana.AddHead(147);
            liana.AppendParameter(Session.User.IDEspacial);
            sala.SendData(liana);
            Session.User.Sala.Map[Session.User.Posicion.y, Session.User.Posicion.x].FijarSession(null);
            Packet_135(Session, new TimeSpan(0, 0, 5), sala, MiniGamesManager.ObtenerPuerta(sala.Escenario, Session.User.IDEspacial));
        }
        public static bool EntregarLiana(SessionInstance Session, int Objeto)
        {
            using (mysql client = new mysql())
            {
                client.SetParameter("id", Objeto);
                DataRow row = client.ExecuteQueryRow("SELECT * FROM objetos WHERE id = @id");
                CatalogObjectInstance item = new CatalogObjectInstance(row);
                client.SetParameter("item_id", Objeto);
                client.SetParameter("userid", Session.User.id);
                client.SetParameter("hex", item.colores_hex);
                client.SetParameter("rgb", item.colores_rgb);
                client.SetParameter("tam", "tam_n");
                client.SetParameter("default_data", 0);
                if (client.ExecuteNonQuery("INSERT INTO objetos_comprados (`objeto_id`, `colores_hex`, `colores_rgb`, `usuario_id`, `tam`, `data`) VALUES (@item_id, @hex, @rgb, @userid, @tam, @default_data)") == 1)
                {
                    client.SetParameter("id", Objeto);
                    client.SetParameter("UserID", Session.User.id);
                    int compra_id = int.Parse(Convert.ToString(client.ExecuteScalar("SELECT MAX(id) FROM objetos_comprados WHERE objeto_id = @id AND usuario_id = @UserID")));
                    ServerMessage añadir_mochila = new ServerMessage();
                    añadir_mochila.AddHead(189);
                    añadir_mochila.AddHead(139);
                    añadir_mochila.AppendParameter(compra_id);
                    añadir_mochila.AppendParameter(Objeto);
                    añadir_mochila.AppendParameter(item.colores_hex);
                    añadir_mochila.AppendParameter(item.colores_rgb);
                    añadir_mochila.AppendParameter(0);
                    añadir_mochila.AppendParameter(0);
                    añadir_mochila.AppendParameter(0);
                    añadir_mochila.AppendParameter("tam_n");
                    añadir_mochila.AppendParameter(0);
                    añadir_mochila.AppendParameter(0);
                    añadir_mochila.AppendParameter(1);//CantidadObjetos
                    Session.SendData(añadir_mochila);
                }
            }
            return false;
        }
        private static void Packet_135(SessionInstance Session, TimeSpan Time, SalaInstance Sala, Posicion Posicion = null, bool kick = true)
        {
            try
            {
                Thread.Sleep(Time);
                if (Session.User.Sala.id == Sala.id && Session.User.Sala.Escenario.es_categoria == Sala.Escenario.es_categoria)
                {
                    if (kick)
                    {
                        Packet_182(Session, 0, 0, Session.User.Posicion.z);
                        Session.User.Sala.Map[Session.User.Posicion.y, Session.User.Posicion.x].FijarSession(null);
                        Session.User.Posicion = Posicion;
                        Packet_135(Session, Session.User.Posicion.x, Session.User.Posicion.y, 4);
                    }
                    else
                    {
                        Session.User.Sala.Map[Session.User.Posicion.y, Session.User.Posicion.x].FijarSession(null);
                        Session.User.Posicion = new Posicion(0, 0, 4);

                        Packet_182(Session, Session.User.Posicion.x, Session.User.Posicion.y, Session.User.Posicion.z);
                    }
                }
            }
            catch
            {

            }
        }
        private static void Packet_135(SessionInstance Session, int x, int y, int z)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(135);
            server.AppendParameter(Session.User.IDEspacial);
            server.AppendParameter(x);
            server.AppendParameter(y);
            server.AppendParameter(z);
            Session.User.Sala.SendData(server, Session);
        }
        private static void Packet_182(SessionInstance Session, int x, int y, int z)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(182);
            server.AppendParameter(1);
            server.AppendParameter(Session.User.IDEspacial);
            server.AppendParameter(x);
            server.AppendParameter(y);
            server.AppendParameter(z);
            server.AppendParameter(750);
            server.AppendParameter(1);
            Session.User.Sala.SendData(server, Session);
        }
        public void BuscarSenderos(int num)
        {
            Senderos.Add(new Point(15, 13));
            Senderos.Add(new Point(6, 16));
            Senderos.Add(new Point(7, 17));
            Senderos.Add(new Point(8, 18));
            Senderos.Add(new Point(9, 19));
            Senderos.Add(new Point(10, 20));
            List<int> Id_Exportada = new List<int>();
            for (int i = 1; i <= num; i++)
            {
                int id_sendero = new Random().Next(1, 15);
                while (Id_Exportada.Contains(id_sendero))
                {
                    id_sendero = new Random().Next(1, 15);
                }
                Id_Exportada.Add(id_sendero);
                Point[] Sendero = ObtenerCache(id_sendero);
                foreach (Point Puntos in Sendero)
                {
                    if (!Senderos.Contains(Puntos))
                        Senderos.Add(Puntos);
                }
            }
        }
        Point[] ObtenerCache(int id)
        {
            if (id == 1) return SenderosMapas.Sendero_1;
            if (id == 2) return SenderosMapas.Sendero_2;
            if (id == 3) return SenderosMapas.Sendero_3;
            if (id == 4) return SenderosMapas.Sendero_4;
            if (id == 5) return SenderosMapas.Sendero_5;
            if (id == 6) return SenderosMapas.Sendero_6;
            if (id == 7) return SenderosMapas.Sendero_7;
            if (id == 8) return SenderosMapas.Sendero_8;
            if (id == 9) return SenderosMapas.Sendero_9;
            if (id == 10) return SenderosMapas.Sendero_10;
            if (id == 11) return SenderosMapas.Sendero_11;
            if (id == 12) return SenderosMapas.Sendero_12;
            if (id == 13) return SenderosMapas.Sendero_13;
            if (id == 14) return SenderosMapas.Sendero_14;
            if (id == 15) return SenderosMapas.Sendero_15;
            return null;
        }
        public void Cargar_Contador(SessionInstance Session)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(160);
            server.AddHead(125);
            server.AppendParameter(Contador);
            Session.SendData(server);
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
                    case 6:
                        UserManager.Creditos(Session.User, true, false, Precio_Golden);
                        sala.ActualizarEstadisticas(Session.User);
                        break;

                    case 7:
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
            Session.User.SenderoOculto = null;
            if (Participantes.ContainsKey(Session.User.IDEspacial))
            {
                Participantes.Remove(Session.User.IDEspacial);
                CancelarInscripcion(Session);
            }
        }
        public static void Desinscribir(SessionInstance Session)
        {
            if (Session.User.Jugando == true) return;
            CancelarInscripcion(Session);
        }
        public static void CancelarInscripcion(SessionInstance Session)
        {
            if (MiniGamesManager.Inscripciones_Sendero.ContainsKey(Session.User.id))
            {
                MiniGamesManager.Inscripciones_Sendero.Remove(Session.User.id);
            }
        }
        public void FinalizarSendero(bool Instantaneo = false)
        {
            sala.Entrable = false;
            if (!Instantaneo)
            {
                foreach (Point PointToShow in Senderos)
                {
                    ServerMessage server1 = new ServerMessage();
                    server1.AddHead(124);
                    server1.AddHead(120);
                    server1.AppendParameter(PointToShow.X);
                    server1.AppendParameter(PointToShow.Y);
                    server1.AppendParameter(1);
                    sala.SendData(server1);
                }
                Thread.Sleep(new TimeSpan(0, 0, 5));
                ServerMessage server = new ServerMessage();
                server.AddHead(160);
                server.AddHead(125);
                server.AppendParameter(10);
                sala.SendData(server);
                Thread.Sleep(new TimeSpan(0, 0, 10));
            }
            sala.ExpusarUsuarios();
            EndSendero.Remove(sala.id);
        }
        #region SenderoManager
        public static int Precio_Golden = 100;
        public static int Precio_Silver = 1;
        public static int Recompensa_Golden = 100;
        public static int Recompensa_Silver = 5;
        public static int Senderos_Today;
        public static string Descripcion_Silver = "Si ganas, no se te cobrará la partida y conseguirás: \r5 monedas de plata.";
        public static string Descripcion_Golden = "Si ganas, no se te cobrará la partida y conseguirás: \r100 créditos por cada participante.";
        public static void CargarSabio(SessionInstance Session)
        {
            Session.User.Game = GameType.Sendero;
            ServerMessage server = new ServerMessage();
            server.AddHead(160);
            server.AddHead(120);
            server.AppendParameter(MiniGamesManager.EstadoDeInscripcion(Session, GameType.Sendero));
            server.AppendParameter(0);
            server.AppendParameter(6);
            server.AppendParameter(Descripcion_Golden);//Descripcion Golden
            server.AppendParameter(Precio_Golden); //Precio Golden
            server.AppendParameter(0);
            server.AppendParameter(7);
            server.AppendParameter(Descripcion_Silver);//Descripción Silver
            server.AppendParameter(0);
            server.AppendParameter(Precio_Silver);//Precio Silver
            Session.SendData(server);

            RankingsManager.cartel_ranking(Session, 3, 2, ServerThreads.Fecha_Ranking_Semanal);
        }
        public static void BuscarParticipantes(int type)
        {
            List<Inscripcion> Collections = new List<Inscripcion>();
            List<SessionInstance> Participantes = new List<SessionInstance>();
            foreach (var Inscripcion in MiniGamesManager.Inscripciones_Sendero.Values) Collections.Add(Inscripcion);
            foreach (var Inscripcion in Collections)
            {
                try
                {
                    if (!Inscripcion.Session.Client.Connected) continue;
                    if (Inscripcion.Type != type) continue;
                    if (Inscripcion.Session.User.Jugando) continue;
                    Participantes.Add(Inscripcion.Session);
                    if (Participantes.Count == 3) break;
                }
                catch
                {
                    continue;
                }
            }
            if (Participantes.Count == 3)
            {
                SalaInstance Sala = Buscar_Juego(type);
                if (Sala != null) new Llamada(Participantes, Sala);
            }
        }
        public static SalaInstance Buscar_Juego(int ID)
        {
            foreach (SalaInstance Sala in EndSendero.Values)
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
                    while (EndSendero.ContainsKey(Senderos_Today)) Senderos_Today++;
                    EndSendero.Add(Senderos_Today, new SalaInstance(Senderos_Today, new EscenarioInstance(row)));
                    foreach (SalaInstance Sala in EndSendero.Values)
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
            foreach (var Inscripcion in MiniGamesManager.Inscripciones_Sendero.Values)
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
                    if (ID == 6)//Golden
                    {
                        if (Session.User.oro >= SenderoInstance.Precio_Golden)
                        {
                            if (!MiniGamesManager.Inscripciones_Sendero.ContainsKey(Session.User.id))
                            {
                                MiniGamesManager.Inscripciones_Sendero.Add(Session.User.id, new Inscripcion(Session, 6));
                                if (MiniGamesManager.Inscripciones_Sendero.ContainsKey(Session.User.id))
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
                    if (ID == 7)//Silver
                    {
                        if (Session.User.plata >= SenderoInstance.Precio_Silver)
                        {
                            if (!MiniGamesManager.Inscripciones_Sendero.ContainsKey(Session.User.id))
                            {
                                MiniGamesManager.Inscripciones_Sendero.Add(Session.User.id, new Inscripcion(Session, 7));
                                if (MiniGamesManager.Inscripciones_Sendero.ContainsKey(Session.User.id))
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
        public static int Jugadores
        {
            get
            {
                int num = 0;
                foreach (var Sala in EndSendero.Values)
                {
                    num += Sala.Usuarios.Count;
                }
                return num;
            }
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
