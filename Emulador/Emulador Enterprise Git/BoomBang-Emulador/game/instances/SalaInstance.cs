using BoomBang.game.handler;
using BoomBang.game.instances.manager;
using BoomBang.game.instances.MiniGames;
using BoomBang.game.manager;
using BoomBang.game.packets;
using BoomBang.server;
using System;
using System.Collections.Generic;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Text.RegularExpressions;
using System.Threading;
using System.Threading.Tasks;

namespace BoomBang.game.instances
{
    public class Chutas
    {
        public bool Usable;
        public SessionInstance Session;
        public BuyObjectInstance Compra;
        public Chutas(bool Usable, SessionInstance Session = null, BuyObjectInstance Compra = null)
        {
            this.Usable = Usable;
            this.Session = Session;
            this.Compra = Compra;
        }
        public void FijarSession(SessionInstance Session)
        {
            this.Session = Session;
        }
        public void FijarCompra(BuyObjectInstance Compra)
        {
            this.Compra = Compra;
        }
        public bool Disponible
        {
            get
            {
                if (this.Usable == false) return false;
                if (this.Session != null) return false;
                if (this.Compra != null) return false;
                return true;
            }
        }
        public SessionInstance ObtenerSession
        {
            get
            {
                return this.Session;
            }
        }
        public BuyObjectInstance ObtenerCompra
        {
            get
            {
                return this.Compra;
            }
        }
    }
    public class SalaInstance
    {
        public int id { get; private set; }
        public EscenarioInstance Escenario { get; private set; }
        public Dictionary<int, SessionInstance> Usuarios;
        public Dictionary<int, BuyObjectInstance> ObjetosEnSala;
        public static Dictionary<int, UsuarioEnObjeto> UsuariosEnObjetos = new Dictionary<int, UsuarioEnObjeto>();
        public Chutas[,] Map { get; private set; }
        public int MapSizeX { get; set; }
        public int MapSizeY { get; set; }
        public Posicion Puerta { get; private set; }
        public int Contar_Objetos { get; set; }
        //Codigo Luis
        public bool DesplazarObjeto(SessionInstance Session, BuyObjectInstance Item, Point Desplazamiento)
        {
            if (Session.User == null) return false;
            if (Session.User.Sala == null) return false;
            if (!Usuarios.ContainsKey(Session.User.IDEspacial)) return false;
            if (Usuarios[Session.User.IDEspacial].User.id != Session.User.id) return false;
            if (UsuariosEnObjetos.ContainsKey(Session.User.id))
            {
                UsuariosEnObjetos[Session.User.id].Desplazable = Desplazamiento;
                return true;
            }
            return false;
        }
        public bool SubirEnObjeto(SessionInstance Session, BuyObjectInstance Item, int pos)
        {
            if (Session.User == null) return false;
            if (Session.User.Sala == null) return false;
            if (!Usuarios.ContainsKey(Session.User.IDEspacial)) return false;
            if (Usuarios[Session.User.IDEspacial].User.id != Session.User.id) return false;
            if (!UsuariosEnObjetos.ContainsKey(Session.User.id))
            {
                foreach (var UsuarioEnObjeto in UsuariosEnObjetos.Values)
                {
                    if (UsuarioEnObjeto.Item.id == Item.id && UsuarioEnObjeto.Posicion == pos) return false;
                }
                UsuariosEnObjetos.Add(Session.User.id, new UsuarioEnObjeto(Item, Session, pos));
                if (UsuariosEnObjetos.ContainsKey(Session.User.id))
                {
                    Packet(Session, new TimeSpan(0, 0, 0), this, null, true);
                    return true;
                }
            }
            return false;
        }
        public bool BajarEnObjeto(SessionInstance Session, bool ByExit)
        {
            if (Session.User == null) return false;
            if (Session.User.Sala == null) return false;
            if (UsuariosEnObjetos.ContainsKey(Session.User.id))
            {
                UsuarioEnObjeto UsuarioEnObjeto = UsuariosEnObjetos[Session.User.id];
                if (UsuariosEnObjetos.Remove(Session.User.id))
                {
                    ServerMessage server = new ServerMessage();
                    server.AddHead(189);
                    server.AddHead(167);
                    server.AppendParameter(UsuarioEnObjeto.Item.id);
                    server.AppendParameter(UsuarioEnObjeto.Session.User.id);
                    server.AppendParameter(UsuarioEnObjeto.Posicion);
                    this.SendData(server);
                    if (!ByExit)
                    {
                        Session.User.Posicion.x = Session.User.Sala.Puerta.x;
                        Session.User.Posicion.y = Session.User.Sala.Puerta.y;
                        Session.User.Sala.Map[Session.User.Posicion.y, Session.User.Posicion.x].FijarSession(null);
                        Packet(Session, new TimeSpan(0, 0, 0), this, Session.User.Posicion, true);
                        return true;
                    }
                }
            }
            return false;
        }
        private static void Packet(SessionInstance Session, TimeSpan Time, SalaInstance Sala, Posicion Posicion = null, bool UsingLook = false)
        {
            Thread.Sleep(Time);
            if (Session.User == null) return;
            if (Session.User.Sala == null) return;
            if (Session.User.Sala.id == Sala.id && Session.User.Sala.Escenario.categoria == Sala.Escenario.categoria)
            {
                if (Posicion != null)
                {
                    Session.User.Posicion = Posicion;
                }
                else
                {
                    Session.User.Posicion = new Posicion(0, 0, 4);
                }
                if (UsingLook)
                {
                    ServerMessage server = new ServerMessage();
                    server.AddHead(135);
                    server.AppendParameter(Session.User.IDEspacial);
                    server.AppendParameter(Session.User.Posicion.x);
                    server.AppendParameter(Session.User.Posicion.y);
                    server.AppendParameter(Session.User.Posicion.z);
                    Session.User.Sala.SendData(server, Session);
                }
                else
                {
                    ServerMessage server = new ServerMessage();
                    server.AddHead(182);
                    server.AppendParameter(1);
                    server.AppendParameter(Session.User.IDEspacial);
                    server.AppendParameter(Session.User.Posicion.x);
                    server.AppendParameter(Session.User.Posicion.y);
                    server.AppendParameter(Session.User.Posicion.z);
                    server.AppendParameter(750);
                    server.AppendParameter(1);
                    Sala.SendData(server);
                }
            }
        }
        //End Codigo
        public Point GetRandomPlace()
        {
            List<Point> Output = new List<Point>();

            for (int Y = 0; Y < this.Map.GetLength(0) - 1; Y++)
            {
                for (int X = 0; X < this.Map.GetLength(1) - 1; X++)
                {
                    if (this.Map[Y, X].Usable)
                    {

                        Output.Add(new Point(X, Y));
                    }
                }
            }
            return (Output.Count > 0) ? Output[new Random().Next(0, Output.Count - 1)] : new Point(-1, -1);
        }
        public Posicion GeneratePosition()
        {
            int PosX = GetRandomPlace().X;
            int PosY = GetRandomPlace().Y;
            Posicion position = null;
            while (position == null)
            {
                position = new Posicion(PosX, PosY, 0);
                if (!Caminable(position))
                {
                    position = null;
                }
                //Thread.Sleep(500);
            }
            return position;
        }
        public bool Entrable = true;
        public bool PathFinder = true;
        public SalaInstance(int id, EscenarioInstance Escenario)
        {
            this.id = id;
            this.Escenario = Escenario;
            this.Usuarios = new Dictionary<int, SessionInstance>();
            this.ObjetosEnSala = new Dictionary<int, BuyObjectInstance>();
            this.ConfigurarSala();
            if (this.Escenario.es_categoria == 0) LoadObjects();
            if (this.Escenario.es_categoria == 2) DoGame();
        }
        #region GameInstance
        public RingInstance Ring;
        public CocosInstance Cocos;
        public CaminoInstance Camino;
        public SenderoInstance Sendero;
        private void DoGame()
        {
            this.PathFinder = false;
            switch (Escenario.id)
            {
                case 2: this.Ring = new RingInstance(this); break;
                case 3: this.Ring = new RingInstance(this); break;
                case 8: this.Cocos = new CocosInstance(this); break;
                case 9: this.Cocos = new CocosInstance(this); break;
                case 12: this.Camino = new CaminoInstance(this); break;
                case 13: this.Camino = new CaminoInstance(this); break;
                case 6: this.Sendero = new SenderoInstance(this); break;
                case 7: this.Sendero = new SenderoInstance(this); break;
            }
        }
        #endregion
        public void FijarChutas(BuyObjectInstance Compra)
        {
            foreach (var Posicion in ObtenerPoscionesByChutas(Compra.espacio_ocupado))
            {
                try
                {
                    if (!CatalogoManager.lianas_cocos.Contains(Compra.objeto_id))
                    {
                        this.Map[Posicion.y, Posicion.x].FijarCompra(Compra);
                    }             
                }
                catch
                {
                    continue;
                }
            }
        }
        public void EliminarChutas(BuyObjectInstance Compra)
        {
            foreach (var Posicion in ObtenerPoscionesByChutas(Compra.espacio_ocupado))
            {
                try
                {
                    this.Map[Posicion.y, Posicion.x].FijarCompra(null);
                }
                catch
                {
                    continue;
                }
            }
        }
        private List<Posicion> ObtenerPoscionesByChutas(string ChutaString)
        {
            List<Posicion> Posiciones = new List<Posicion>();
            int x = 0;
            int y = 0;
            string[] Valores = Regex.Split(ChutaString, ",");
            foreach (string posicion in Valores)
            {
                try
                {
                    if (x == 0)
                    {
                        x = int.Parse(posicion);
                        continue;
                    }
                    y = int.Parse(posicion);
                    if (x != 0 && y != 0)
                    {
                        Posiciones.Add(new Posicion(x, y));
                        x = 0;
                        y = 0;
                    }
                }
                catch
                {
                    continue;
                }
            }
            return Posiciones;
        }
        private void LoadObjects()
        {
            using (mysql client = new mysql())
            {
                ObjetosEnSala.Clear();
                client.SetParameter("Id", Escenario.id);
                foreach (DataRow row in client.ExecuteQueryTable("SELECT * FROM objetos_comprados WHERE sala_id = @Id").Rows)
                {
                    BuyObjectInstance Item = new BuyObjectInstance(row);
                    ObjetosEnSala.Add(Item.id, Item);
                    FijarChutas(Item);
                }
            }
        }
        public void Alerta(string texto)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(133);
            server.AppendParameter(0);
            server.AppendParameter(texto);
            server.AppendParameter(3);
            SendData(server);
        }
        private void ConfigurarSala()
        {
            try
            {
                int x = 11;
                int y = 11;
                string mapa = string.Empty;
                using (mysql client = new mysql())
                {
                    client.SetParameter("id", Escenario.modelo);
                    if (Escenario.es_categoria == 2)//mgame
                    {
                        DataRow row = client.ExecuteQueryRow("SELECT * FROM mapas_mgame WHERE id = @id");
                        if (row != null)
                        {
                            mapa = (string)row["mapa"];
                        }
                    }
                    if (Escenario.es_categoria == 1)//publico
                    {
                        DataRow row = client.ExecuteQueryRow("SELECT * FROM mapas_publicos WHERE id = @id");
                        if (row != null)
                        {
                            x = (int)row["PosX"];
                            y = (int)row["PosY"];
                            mapa = (string)row["mapa"];
                        }
                    }
                    if (Escenario.es_categoria == 0)//privado
                    {
                        DataRow row = client.ExecuteQueryRow("SELECT * FROM mapas_privados WHERE id = @id");
                        if (row != null)
                        {
                            x = (int)row["PosX"];
                            y = (int)row["PosY"];
                            mapa = (string)row["mapa"];
                        }
                    }
                    this.Puerta = new Posicion(x, y);
                    string[] MapaString = mapa.Split(Convert.ToChar("\n"));
                    this.Map = new Chutas[MapaString.Length, MapaString[0].Length];
                    this.MapSizeX = MapaString.Length;
                    this.MapSizeY = MapaString[0].Length;
                    for (int Y = 0; Y < MapaString.Length - 1; Y++)
                    {
                        for (int X = 0; X < MapaString[0].Length; X++)
                        {
                            this.Map[Y, X] = (MapaString[Y][X] == '0') ? new Chutas(true) : new Chutas(false);
                        }
                    }
                }
            }
            catch (Exception ex)
            {
                Output.WriteLine(ex.ToString());Program.EditorialResponse(ex);
            }
        }
        public bool Caminable(Posicion Posicion)
        {
            return Map[Posicion.y, Posicion.x].Disponible;
        }
        public void CargarEscenario(SessionInstance Session)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(128);
            server.AddHead(120);
            server.AppendParameter(1);
            if (Escenario.categoria == 4) { server.AppendParameter(Escenario.categoria); }
            else
            {
                server.AppendParameter(Escenario.es_categoria);
            }
            server.AppendParameter(0);
            server.AppendParameter(0);
            server.AppendParameter(0);
            server.AppendParameter(0);
            server.AppendParameter(Escenario.modelo);
            server.AppendParameter(Escenario.nombre);
            server.AppendParameter(0);
            Session.SendData(server);
        }
        public void ActualizarEstadisticas(UserInstance User)
        {
            ServerMessage server_1 = new ServerMessage();
            server_1.AddHead(146);
            server_1.AppendParameter(User.id);
            server_1.AppendParameter(1);
            server_1.AppendParameter(User.besos_enviados);
            server_1.AppendParameter(User.besos_recibidos);
            server_1.AppendParameter(new object[] { User.id, 1, User.besos_enviados, User.besos_recibidos });
            SendData(server_1);

            ServerMessage server_2 = new ServerMessage();
            server_2.AddHead(146);
            server_2.AppendParameter(User.id);
            server_2.AppendParameter(2);
            server_2.AppendParameter(User.jugos_enviados);
            server_2.AppendParameter(User.jugos_recibidos);
            SendData(server_2);

            ServerMessage server_3 = new ServerMessage();
            server_3.AddHead(146);
            server_3.AppendParameter(User.id);
            server_3.AppendParameter(3);
            server_3.AppendParameter(User.flores_enviadas);
            server_3.AppendParameter(User.flores_recibidas);
            SendData(server_3);

            ServerMessage server_4 = new ServerMessage();
            server_4.AddHead(146);
            server_4.AppendParameter(User.id);
            server_4.AppendParameter(4);
            server_4.AppendParameter(User.uppers_enviados);
            server_4.AppendParameter(User.uppers_recibidos);
            SendData(server_4);

            ServerMessage server_5 = new ServerMessage();
            server_5.AddHead(146);
            server_5.AppendParameter(User.id);
            server_5.AppendParameter(5);
            server_5.AppendParameter(User.cocos_enviados);
            server_5.AppendParameter(User.cocos_recibidos);
            SendData(server_5);

            ServerMessage server_10 = new ServerMessage();
            server_10.AddHead(146);
            server_10.AppendParameter(User.id);
            server_10.AppendParameter(10);
            server_10.AppendParameter((User.nivel_coco + 1));
            server_10.AppendParameter(User.puntos_cocos);
            SendData(server_10);

            ServerMessage server_11 = new ServerMessage();
            server_11.AddHead(146);
            server_11.AppendParameter(User.id);
            server_11.AppendParameter(11);
            server_11.AppendParameter(0);
            server_11.AppendParameter(User.puntos_coco_limite);
            SendData(server_11);

            ServerMessage server_12 = new ServerMessage();
            server_12.AddHead(146);
            server_12.AppendParameter(User.id);
            server_12.AppendParameter(12);
            server_12.AppendParameter((User.nivel_ninja));
            server_12.AppendParameter(User.puntos_ninja);
            SendData(server_12);

            ServerMessage server_13 = new ServerMessage();
            server_13.AddHead(146);
            server_13.AppendParameter(User.id);
            server_13.AppendParameter(13);
            server_13.AppendParameter(0);
            server_13.AppendParameter(User.puntos_ninja_limite);
            SendData(server_13);

            UserManager.ActualizarEstadisticas(User);
        }
        public SessionInstance ObtenerSession(string name)
        {
            try
            {
                foreach (var Session in Usuarios.Values)
                {
                    if (Session.User.nombre == name)
                    {
                        return Session;
                    }
                }
                return null;
            }
            catch
            {
                return null;
            }
        }
        public SessionInstance ObtenerSession(int id)
        {
            if (Usuarios.ContainsKey(id))
            {
                return Usuarios[id];
            }
            return null;
        }
        public SessionInstance ObtenerSession(Posicion Posicion)
        {
            try
            {
                return Map[Posicion.y, Posicion.x].ObtenerSession;
            }
            catch
            {
                return null;
            }
        }
        public void SendData(ServerMessage server, SessionInstance MySession = null)
        {
            try
            {
                List<SessionInstance> Sessions = new List<SessionInstance>();
                foreach (var Session in Usuarios.Values.ToList())
                {
                    if (MySession != null)
                    {
                        if (MySession.User.id != Session.User.id)
                        {
                            Sessions.Add(Session);
                        }
                        else
                        {
                            MySession.SendData(server);
                        }
                    }
                    else
                    {
                        Sessions.Add(Session);
                    }
                }
                foreach (var Session in Sessions)
                {
                    Session.SendDataProtected(server);
                }
            }
            catch
            {

            }
        }
        public void ExpusarUsuarios()
        {
            try
            {
                while (Usuarios.Count >= 1)
                {
                    List<SessionInstance> SessionToRemove = new List<SessionInstance>();
                    foreach (var Session in Usuarios.Values)
                    {
                        SessionToRemove.Add(Session);
                    }
                    foreach (var Session in SessionToRemove)
                    {
                        SalasManager.Salir_Sala(Session, true);
                    }
                }
            }
            catch
            {

            }
        }
        public void LoadObjects(SessionInstance Session)
        {
            ServerMessage server = new ServerMessage();
            Random rd = new Random();
            if (Escenario.es_categoria == 2)
            {
                server.AddHead(128);
                server.AddHead(121);
                server.AddHead(122);
                server.AppendParameter(1);
                if (Escenario.modelo == 2 || Escenario.modelo == 3) server.AppendParameter(1);
                if (Escenario.modelo == 6 || Escenario.modelo == 7) server.AppendParameter(1);
                if (Escenario.modelo == 8) server.AppendParameter(1);
                if (Escenario.modelo == 9) server.AppendParameter(1);
                if (Escenario.modelo == 12 || Escenario.modelo == 13) server.AppendParameter(1);
                server.AppendParameter(0);
            }
            if (Escenario.es_categoria == 1)
            {
                server.AddHead(128);
                server.AddHead(121);
                server.AddHead(120);
                npcManager.ObtenerNPC(server, Session.User.Sala.Escenario.id);
            }
            if (Escenario.es_categoria == 0)
            {
                server.AddHead(128);
                server.AddHead(121);
                server.AddHead(121);
                if (Escenario.categoria == 2) server.AppendParameter(1);
                if (Escenario.categoria == 4) server.AppendParameter(3);
                server.AppendParameter(0);
                server.AppendParameter(Escenario.IslaID);
                server.AppendParameter(Escenario.id);
                server.AppendParameter(Escenario.id);
                server.AppendParameter(Escenario.color_1);
                server.AppendParameter(Escenario.color_2);
                server.AppendParameter(0);
                server.AppendParameter(Escenario.Creador.id);
                server.AppendParameter(new object[] { 1, -1, -1, 4, 5, 6, 7, 8, 9, 10, 0, -1, 13, 14, -1, 16 });
                server.AppendParameter(new object[] { 4, -1, -1, 4, 4, 4, 4, 4, 4, 4, 0, -1, 4, 4, -1, 4 });
                server.AppendParameter(new object[] { 0, -1, -1, 0, 0, 0, 0, 0, 0, 0, 0, -1, 0, 0, -1, 0 });//Puerta Categoría
                server.AppendParameter(CasasManager.Get_Door_Location_Model(Escenario, Escenario.Creador.id));
                server.AppendParameter(new object[] { "puerta_1", "puerta_2", "puerta_3", "puerta_4", "puerta_5", "puerta_6", "puerta_7", "puerta_8", "puerta_9", "puerta_10", "puerta_11", "puerta_12", "puerta_13", "puerta_14", "puerta_15", "puerta_16" });
                server.AppendParameter(CasasManager.Get_Key(Escenario.modelo));
                server.AppendParameter(new object[] { 0, 0, 0, 578, 631, 149, 210, 319, 0, 445, 1120, 0, 0});//Aqui van las llaves de las casas
                server.AppendParameter(new object[] { Escenario.terreno_something_1, Escenario.object_something_1 });
                server.AppendParameter(new object[] { Escenario.terreno_something_2, Escenario.object_something_2 });
                server.AppendParameter(new object[] { Escenario.terreno_something_3, Escenario.object_something_3 });
                server.AppendParameter(new object[] { Escenario.terreno_config, Escenario.object_config });
                server.AppendParameter(new object[] { Escenario.terreno_colores, Escenario.object_colores });
                server.AppendParameter(new object[] { Escenario.terreno_rgb, Escenario.object_rgb });

                LoadObjects();
                server.AppendParameter(ObjetosEnSala.Count);
                foreach (BuyObjectInstance Item in ObjetosEnSala.Values)
                {
                    if (listas.Plantas.Contains(Item.objeto_id))
                    {
                        PlantasManager.cargar_planta(Session, Item);
                    }
                    server.AppendParameter(Item.id);
                    server.AppendParameter(Item.objeto_id);
                    server.AppendParameter(Item.posX);
                    server.AppendParameter(Item.posY);
                    server.AppendParameter(Item.rotation);//rotation
                    server.AppendParameter(Item.tam);
                    server.AppendParameter(0);
                    if (CatalogoManager.lianas_cocos.Contains(Item.objeto_id))
                    {
                        server.AppendParameter(""); //Espacio Ocupado
                    }
                    else
                    {
                        server.AppendParameter(Item.espacio_ocupado); //Espacio Ocupado
                    }
                    server.AppendParameter(Item.colores_hex);//color_1
                    server.AppendParameter(Item.colores_rgb);//color_2
                    server.AppendParameter("0");//Data
                    server.AppendParameter("0");//Other
                    if (Item.objeto_id == 370)//Contador de visitas de islas
                    {
                        mysql client = new mysql();
                        int contador_islas = Convert.ToInt32(Item.data) + 1;
                        Item.data = Convert.ToString(contador_islas);
                        client.SetParameter("id", Item.id);
                        client.SetParameter("data", Item.data);
                        client.ExecuteNonQuery("UPDATE objetos_comprados SET data = @data WHERE id = @id");
                        server.AppendParameter(Item.data);
                    }
                    else if (listas.Objetos_Area.Contains(Item.objeto_id))
                    {
                        mysql client = new mysql();
                        client.SetParameter("id", Item.id);
                        DataRow objeto = client.ExecuteQueryRow("SELECT * FROM objetos_comprados WHERE id = @id");
                        if (objeto != null)
                        {
                            client.SetParameter("id", Item.id);
                            DataRow row = client.ExecuteQueryRow("SELECT * FROM escenarios_privados WHERE objeto_id = @id");
                            if (row != null)
                            {
                                Item.open = (int)objeto["open"];
                                server.AppendParameter(new object[] { Item.id, 0, Item.data, Item.open == 0 ? "": "1",
                                Item.data, 12, SalasManager.UsuariosEnSala(new EscenarioInstance(row)) });
                            }
                        }
                    }
                    else {  server.AppendParameter(Item.data); }
                }
                server.AppendParameter(0);
                server.AppendParameter(Usuarios.Count);
            }
            foreach (SessionInstance OtherSession in Usuarios.Values)
            {
                server.AppendParameter(OtherSession.User.IDEspacial);
                server.AppendParameter(OtherSession.User.nombre);
                server.AppendParameter((OtherSession.User.ModoNinja ? 12 : OtherSession.User.avatar));
                if (Escenario.tipo_evento == 2 && OtherSession.User.nivel_ninja == 0 && OtherSession.User.NinjaColores_Sala == "" || Escenario.tipo_evento_isla == 2 && OtherSession.User.nivel_ninja == 0 && OtherSession.User.NinjaColores_Sala == "")
                {
                    server.AppendParameter((OtherSession.User.ModoNinja ? OtherSession.User.Colores_traje_blanco(Session) : OtherSession.User.colores));
                }
                else if (OtherSession.User.NinjaColores_Sala != "")
                {
                    server.AppendParameter((OtherSession.User.ModoNinja ? OtherSession.User.NinjaColores_Sala : OtherSession.User.colores));
                }
                else
                {
                    server.AppendParameter((OtherSession.User.ModoNinja ? OtherSession.User.Colores_traje(Session) : OtherSession.User.colores));
                }
                server.AppendParameter(OtherSession.User.Posicion.x);
                server.AppendParameter(OtherSession.User.Posicion.y);
                server.AppendParameter(OtherSession.User.Posicion.z);
                server.AppendParameter("BoomBang");
                server.AppendParameter(OtherSession.User.edad);
                server.AppendParameter(MonthDifference(Convert.ToDateTime(OtherSession.User.fecha_registro), DateTime.Now));//Tiempo registrado   MonthDifference(DateTime.Now, Convert.ToDateTime(Session.User.fecha_registro))
                server.AppendParameter((OtherSession.User.ModoNinja == true ? 1 : 0));
                if (Session.User.Sala.Escenario.tipo_evento == 2 && OtherSession.User.puntos_ninja < 400 || Escenario.tipo_evento_isla == 2 && OtherSession.User.puntos_ninja < 400)
                {
                    server.AppendParameter(12);//traje ninja
                }
                else
                {
                    server.AppendParameter((OtherSession.User.puntos_ninja >= 400 || OtherSession.User.Traje_Ninja_Principal != 0 ? 12 : 0));//traje ninja
                }
                server.AppendParameter(OtherSession.User.UppertSelect);
                server.AppendParameter(OtherSession.User.UppertLevel());
                server.AppendParameter(OtherSession.User.CocoSelect);
                server.AppendParameter(OtherSession.User.nivel_coco);
                server.AppendParameter(new object[] { OtherSession.User.hobby_1, OtherSession.User.hobby_2, OtherSession.User.hobby_3 });
                server.AppendParameter(new object[] { OtherSession.User.deseo_1, OtherSession.User.deseo_2, OtherSession.User.deseo_3 });
                server.AppendParameter(new object[] { OtherSession.User.Votos_Legal, OtherSession.User.Votos_Sexy, OtherSession.User.Votos_Simpatico});
                server.AppendParameter(OtherSession.User.bocadillo);
                server.AppendParameter(new object[] { OtherSession.User.besos_enviados, OtherSession.User.besos_recibidos, OtherSession.User.jugos_enviados, OtherSession.User.jugos_recibidos, OtherSession.User.flores_enviadas, OtherSession.User.flores_recibidas, OtherSession.User.uppers_enviados, OtherSession.User.uppers_recibidos, OtherSession.User.cocos_enviados, OtherSession.User.cocos_recibidos, "0³" + OtherSession.User.rings_ganados + "³1³1³1³" + Session.User.senderos_ganados + "³1³1³" + (OtherSession.User.nivel_coco + 1) + "³" + OtherSession.User.puntos_cocos + "³1³" + OtherSession.User.puntos_coco_limite + "³" + OtherSession.User.nivel_ninja + "³" + OtherSession.User.puntos_ninja + "³1³" + OtherSession.User.puntos_ninja_limite });
                server.AppendParameter((OtherSession.User.toneos_ring >= 2000 && OtherSession.User.vip <= 0 ? 1: OtherSession.User.admin));//Ficha dorada para las personas con mas de 2k torneos
                server.AppendParameter(OtherSession.User.vip);//vip
                server.AppendParameter(OtherSession.User.Cambios);//cambios
                server.AppendParameter(Escenario.id == 2 || OtherSession.User.Sala.Ring != null || OtherSession.User.Sala.Cocos != null || OtherSession.User.Sala.Sendero != null || OtherSession.User.Sala.Camino != null ? 0 : OtherSession.User.Efecto);
                server.AppendParameter(OtherSession.User.id);
            }
            if (Escenario.es_categoria == 0)
            {
                server.AppendParameter(0);
                server.AppendParameter(0);
                server.AppendParameter(0);
                server.AppendParameter(0);
                server.AppendParameter(0);
            }
            Session.SendData(server);
            if (Escenario.Clave != "")
            {
                new Thread(() => Cerar_Ceradura(Session, Escenario)).Start();
            }
        }
        static void Cerar_Ceradura(SessionInstance Session, EscenarioInstance Escenario)
        {
            try
            {
                Thread.Sleep(new TimeSpan(0, 0, 1));
                ServerMessage server1 = new ServerMessage();
                server1.AddHead(189);
                server1.AddHead(153);
                server1.AppendParameter(1);
                server1.AppendParameter(1);
                server1.AppendParameter(1);
                server1.AppendParameter(1);
                server1.AppendParameter(Convert.ToString(Escenario.id));
                server1.AppendParameter(1);
                server1.AppendParameter("1");
                Session.User.Sala.SendData(server1);
            }
            catch
            {

            }
        }
        //Packet que carga el objeto (Usuario) en la sala
        public void EnviarRegistro(SessionInstance Session)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(128);
            server.AddHead(122);
            server.AppendParameter(Session.User.IDEspacial);
            server.AppendParameter(Session.User.nombre);
            server.AppendParameter((Session.User.ModoNinja ? 12 : Session.User.avatar));
            if (Escenario.tipo_evento == 2 && Session.User.nivel_ninja == 0 && Session.User.NinjaColores_Sala == "" || Escenario.tipo_evento_isla == 2 && Session.User.nivel_ninja == 0 && Session.User.NinjaColores_Sala == "")
            {
                server.AppendParameter((Session.User.ModoNinja ? Session.User.Colores_traje_blanco(Session) : Session.User.colores));
            }
            else if (Session.User.NinjaColores_Sala != "")
            {
                server.AppendParameter((Session.User.ModoNinja ? Session.User.NinjaColores_Sala : Session.User.colores));
            }
            else
            {
                server.AppendParameter((Session.User.ModoNinja ? Session.User.Colores_traje(Session) : Session.User.colores));
            }
            server.AppendParameter(Session.User.Posicion.x);
            server.AppendParameter(Session.User.Posicion.y);
            server.AppendParameter(Session.User.Posicion.z);
            server.AppendParameter("BoomBang");
            server.AppendParameter(Session.User.edad);
            server.AppendParameter(MonthDifference(Convert.ToDateTime(Session.User.fecha_registro), DateTime.Now));//Tiempo registrado   MonthDifference(DateTime.Now, Convert.ToDateTime(Session.User.fecha_registro))
            server.AppendParameter((Session.User.ModoNinja == true ? 1 : 0));
            if (Session.User.Sala.Escenario.tipo_evento == 2 && Session.User.puntos_ninja < 400 || Escenario.tipo_evento_isla == 2 && Session.User.puntos_ninja < 400)
            {
                server.AppendParameter(12);//traje ninja
            }
            else
            {
                server.AppendParameter((Session.User.puntos_ninja >= 400 || Session.User.Traje_Ninja_Principal != 0 ? 12 : 0));//traje ninja
            }
            server.AppendParameter(Session.User.UppertSelect);
            server.AppendParameter(Session.User.UppertLevel());
            server.AppendParameter(Session.User.CocoSelect);
            server.AppendParameter(Session.User.nivel_coco);
            server.AppendParameter(new object[] { Session.User.hobby_1, Session.User.hobby_2, Session.User.hobby_3 });
            server.AppendParameter(new object[] { Session.User.deseo_1, Session.User.deseo_2, Session.User.deseo_3 });
            server.AppendParameter(new object[] { Session.User.Votos_Legal, Session.User.Votos_Sexy, Session.User.Votos_Simpatico });
            server.AppendParameter(Session.User.bocadillo);
            server.AppendParameter(new object[] { Session.User.besos_enviados, Session.User.besos_recibidos, Session.User.jugos_enviados, Session.User.jugos_recibidos, Session.User.flores_enviadas, Session.User.flores_recibidas, Session.User.uppers_enviados, Session.User.uppers_recibidos, Session.User.cocos_enviados, Session.User.cocos_recibidos, "0³" + Session.User.rings_ganados + "³1³1³1³" + Session.User.senderos_ganados + "³1³1³" + (Session.User.nivel_coco + 1) + "³" + Session.User.puntos_cocos + "³1³" + Session.User.puntos_coco_limite + "³" + Session.User.nivel_ninja + "³" + Session.User.puntos_ninja + "³1³" + Session.User.puntos_ninja_limite });
            server.AppendParameter((Session.User.toneos_ring >= 2000 && Session.User.vip <= 0 ? 1 : Session.User.admin));//Ficha dorada para las personas con mas de 2k torneos
            server.AppendParameter(Session.User.vip);//vip
            server.AppendParameter(Session.User.Cambios);//cambios
            server.AppendParameter(Escenario.id == 2 || Session.User.Sala.Ring != null || Session.User.Sala.Cocos != null || Session.User.Sala.Sendero != null || Session.User.Sala.Camino != null ? 0 : Session.User.Efecto);
            server.AppendParameter(Session.User.id);
            SendData(server, Session);
          
        }
        #region InteractionSecurity
        public Dictionary<int, Interactions> ListaDeInteracciones = new Dictionary<int, Interactions>();
        public bool AñadirInteraccion(int id_1, int id_2)
        {
            try
            {
                if (PuedeMandarInteraccion(id_1, id_2))
                {
                    int key = 0;
                    while (ListaDeInteracciones.ContainsKey(key))
                    {
                        key++;
                    }
                    ListaDeInteracciones.Add(key, new Interactions(key, id_1, id_2));
                    return true;
                }
                else
                {
                    return false;
                }
            }
            catch
            {
                return false;
            }
        }
        public bool EliminarInteraccion(int id_1, int id_2)
        {
            if (ValidarInteraccion(id_1, id_2))
            {
                Interactions InteractionToRemove = null;
                foreach (Interactions interacciones in ListaDeInteracciones.Values)
                {
                    if (interacciones.User_1 == id_1 && interacciones.User_2 == id_2)
                    {
                        InteractionToRemove = interacciones;
                    }
                }
                if (InteractionToRemove != null)
                {
                    ListaDeInteracciones.Remove(InteractionToRemove.ID);
                }
                return true;
            }
            return false;
        }
        public bool ValidarInteraccion(int id_1, int id_2)
        {
            foreach (Interactions Inter in ListaDeInteracciones.Values)
            {
                if (Inter.User_1 == id_1 && Inter.User_2 == id_2)
                {
                    return true;
                }
            }
            return false;
        }
        bool PuedeMandarInteraccion(int id_1, int id_2)
        {
            foreach (Interactions interacciones in ListaDeInteracciones.Values)
            {
                if (interacciones.User_1 == id_1 && interacciones.User_2 == id_2)
                {
                    return false;
                }
            }
            return true;
        }
        public void EliminarInteraccionesDeUsuario(int id_1)
        {
            List<Interactions> ToRemove = new List<Interactions>();
            foreach (Interactions Inter in ListaDeInteracciones.Values)
                if (Inter.User_1 == id_1 || Inter.User_2 == id_1) ToRemove.Add(Inter);
            foreach (Interactions Inter in ToRemove)
                if (ListaDeInteracciones.ContainsKey(Inter.ID)) ListaDeInteracciones.Remove(Inter.ID);
        }
        #endregion
        public static decimal MonthDifference(DateTime FechaFin, DateTime FechaInicio)
        {
            return Math.Abs((FechaFin.Month - FechaInicio.Month) + 12 * (FechaFin.Year - FechaInicio.Year));
        }
        public int Visitantes
        {
            get
            {
                return Usuarios.Count;
            }
        }
    }
    public class Interactions
    {
        public int ID;
        public int User_1;
        public int User_2;
        public Interactions(int ID, int user_1, int user_2)
        {
            this.ID = ID;
            this.User_1 = user_1;
            this.User_2 = user_2;
        }
    }
}
