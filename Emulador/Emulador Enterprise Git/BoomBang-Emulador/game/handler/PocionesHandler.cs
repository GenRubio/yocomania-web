using BoomBang.game.instances;
using BoomBang.game.manager;
using BoomBang.game.packets;
using BoomBang.server;
using System;
using System.Collections.Generic;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading;
using System.Threading.Tasks;

namespace BoomBang.game.handler
{
    class PocionesHandler
    {
        public static void Start()
        {
            HandlerManager.RegisterHandler(181120120, new ProcessHandler(Pociones));
            HandlerManager.RegisterHandler(181120121, new ProcessHandler(Teleport_Master));
            HandlerManager.RegisterHandler(181120122, new ProcessHandler(Mensaje_Pajaro_1));
        }
        public static List<int> Pociones_No_Upper_Coco = new List<int>() { 8, 9, 10, 13, 15, 16, 18, 19, 21, 22, 23, 25, 26, 27, 28, 29, 30, 31, 42, 43, 44, 45, 46, 47, 48 };
        public static List<int> Pociones_FlowerPower = new List<int>() { 9, 10, 13, 19, 21, 22 };
        private static List<int> Chat_Colores_Catalogo_ID = new List<int>() { 3044, 3045, 3046, 3047, 3116, 3117 };
        public static List<int> Trajes_Catalogo_ID = new List<int>() { 3066, 3067, 3068, 3069, 3063, 3110 };
        private static List<int> Trajes_Halloween_Catalogo_ID = new List<int>() { 3070, 3071 };
        private static void Pociones(SessionInstance Session, string[,] Parameters)
        {
            int OtherUserID = int.Parse(Parameters[0, 0]);
            int Item_ID = int.Parse(Parameters[1, 0]);
            if (Session == null) return;
            if (Session.User == null) return;
            if (Session.User.Sala == null) return;
            if (Session.User.Sala.Ring != null) { Packet_143(Session); return; }
            if (Session.User.Sala.Cocos != null) { Packet_143(Session); return; }
            if (Session.User.Sala.Sendero != null) { Packet_143(Session); return; }
            if (Session.User.Sala.Camino != null) { Packet_143(Session); return; }
            if (Session.User.Sala.Escenario.id == 2) { Packet_143(Session); return; }
            if (Session.User.Sala.Escenario.anti_efecto == true) { NotificacionesManager.NotifiChat(Session, "Sabio: Los efectos estan desactivados en esta Sala."); Packet_143(Session); return; }
            mysql client = new mysql();
            DataRow Compra = client.ExecuteQueryRow("SELECT * FROM objetos_comprados WHERE objeto_id = '" + Item_ID + "' AND usuario_id = '" + Session.User.id + "'");
            if (Compra != null)
            {
                SessionInstance OtherSession = UserManager.ObtenerSession(OtherUserID);
                if (OtherSession == null) return;
                if (OtherSession.User.PreLock_Interactuando == true) { Packet_143(Session); return; }
                if (OtherSession.User.Efecto != 0) { Packet_143(Session); return; }
                if (OtherSession.User.id == Session.User.id)
                {
                    if (Chat_Colores_Catalogo_ID.Contains(Item_ID)) { Chat_Colores(Session, Item_ID); return; }
                    if (Trajes_Catalogo_ID.Contains(Item_ID)) { Trajes_Catalago(Session, Item_ID); return; }
                    if (Trajes_Halloween_Catalogo_ID.Contains(Item_ID)) { Trajes_Halloween_Catalago(Session, Item_ID); return; }
                    if (Item_ID == 3109) { Colores_Black(Session); return; }

                    Primer_Usuario_Manager(Session, Item_ID, false, "", 0, 0);
                }
                else
                {
                    if (Chat_Colores_Catalogo_ID.Contains(Item_ID)) { NotificacionesManager.NotifiChat(Session, "Sabio: Ficha tu personaje para cambiar color de tu chat."); return; }
                    if (Trajes_Catalogo_ID.Contains(Item_ID)) { NotificacionesManager.NotifiChat(Session, "Sabio: Ficha tu personaje para ponerte el traje."); return; }
                    if (Trajes_Halloween_Catalogo_ID.Contains(Item_ID)) { NotificacionesManager.NotifiChat(Session, "Sabio: Ficha tu personaje para ponerte el traje."); return; }
                    if (Item_ID == 3109) { NotificacionesManager.NotifiChat(Session, "Sabio: Ficha tu personaje para activar Anti Upper."); return; }

                    Otro_Usuario_Manager(Session, Item_ID, OtherSession.User.id, false, "");
                }
            }
        }
        private static void Primer_Usuario_Manager(SessionInstance Session, int Item, bool pm, string Mensaje, int x, int y)
        {
            using (mysql efecto = new mysql())
            {
                DataRow ver_objeto = efecto.ExecuteQueryRow("SELECT * FROM objetos WHERE id = '" + Item + "'");
                if (ver_objeto != null)
                {
                    string categoria_objeto = (string)ver_objeto["categoria"];
                    string nombre_objeto = (string)ver_objeto["titulo"];
                    if (categoria_objeto.Contains("7") || categoria_objeto.Contains("8"))
                    {
                        Packet_133(Session, string.Format("{0} abre un " + nombre_objeto + "", Session.User.nombre), true);
                    }
                    else if (categoria_objeto.Contains("4"))
                    {
                        Packet_133(Session, string.Format("{0} consume una poción de " + nombre_objeto + "", Session.User.nombre), true);
                    }
                    else
                    {
                        Packet_133(Session, string.Format("{0} consume una pocion", Session.User.nombre), true);
                    }
                    Pociones_Manager(Session, Item, Session.User.id, pm, Mensaje, x, y);
                }
            }
        }
        private static void Otro_Usuario_Manager(SessionInstance Session, int Item, int id_USUARIO, bool pm, string Mensaje)
        {
            SessionInstance OtherSession = UserManager.ObtenerSession(id_USUARIO);
            if (OtherSession == null) return;
            using (mysql efecto = new mysql())
            {
                DataRow ver_objeto = efecto.ExecuteQueryRow("SELECT * FROM objetos WHERE id = '" + Item + "'");
                if (ver_objeto != null)
                {
                    string categoria_objeto = (string)ver_objeto["categoria"];
                    string nombre_objeto = (string)ver_objeto["titulo"];
                    OtherSession.User.Trayectoria.DetenerMovimiento();
                    if (categoria_objeto.Contains("7") || categoria_objeto.Contains("8"))
                    {
                        Packet_133(Session, string.Format("{0} entrega un " + nombre_objeto + " a {1}", Session.User.nombre, OtherSession.User.nombre), true);
                    }
                    else if (categoria_objeto.Contains("4"))
                    {
                        Packet_133(Session, string.Format("{0} lanza una poción de " + nombre_objeto + " a {1}", Session.User.nombre, OtherSession.User.nombre), true);
                    }
                    else
                    {
                        Packet_133(Session, string.Format("{0} envía una pocion a {1}", Session.User.nombre, OtherSession.User.nombre), true);
                    }
                    Pociones_Manager(Session, Item, OtherSession.User.id, pm, Mensaje, 0, 0);
                }
            }
        }
        private static void Teleport_Master(SessionInstance Session, string[,] Parameters)
        {
            int OtherUserID = int.Parse(Parameters[0, 0]);
            int Item_ID = int.Parse(Parameters[1, 0]);
            int x = int.Parse(Parameters[2, 0]);
            int y = int.Parse(Parameters[3, 0]);
            if (Session == null) return;
            if (Session.User == null) return;
            if (Session.User.Sala == null) return;
            if (Session.User.PreLock_Interactuando) { Packet_143(Session); return; }
            if (Session.User.Sala.Ring != null) { Packet_143(Session); return; }
            if (Session.User.Sala.Cocos != null) { Packet_143(Session); return; }
            if (Session.User.Sala.Sendero != null) { Packet_143(Session); return; }
            if (Session.User.Sala.Camino != null) { Packet_143(Session); return; }
            if (Session.User.Sala.Escenario.id == 2) { Packet_143(Session); return; }
            if (Session.User.Sala.Escenario.anti_efecto == true) { NotificacionesManager.NotifiChat(Session, "Sabio: Los efectos estan desactivados en esta Sala."); Packet_143(Session); return; }
            if (Session == null) return;
            if (Session.User.Efecto != 0) { Packet_143(Session); return; }

            Primer_Usuario_Manager(Session, Item_ID, false, "", x, y);
        }
        private static void Mensaje_Pajaro_1(SessionInstance Session, string[,] Parameters)
        {
            int OtherUserID = int.Parse(Parameters[0, 0]);
            int Item_ID = int.Parse(Parameters[1, 0]);
            string Mensaje = Parameters[2, 0];
            if (Session == null) return;
            if (Session.User == null) return;
            if (Session.User.Sala == null) return;
            if (Session.User.PreLock_Interactuando) { Packet_143(Session); return; }
            if (Session.User.Sala.Ring != null) { Packet_143(Session); return; }
            if (Session.User.Sala.Cocos != null) { Packet_143(Session); return; }
            if (Session.User.Sala.Sendero != null) { Packet_143(Session); return; }
            if (Session.User.Sala.Camino != null) { Packet_143(Session); return; }
            if (Session.User.Sala.Escenario.id == 2) { Packet_143(Session); return; }
            if (Session.User.Sala.Escenario.anti_efecto == true) { NotificacionesManager.NotifiChat(Session, "Sabio: Los efectos estan desactivados en esta Sala."); Packet_143(Session); return; }
            SessionInstance OtherSession = UserManager.ObtenerSession(OtherUserID);
            if (OtherSession == null) return;
            if (OtherSession.User.Efecto != 0) { Packet_143(Session); return; }
            if (OtherSession.User.id == Session.User.id)
            {
                Primer_Usuario_Manager(Session, Item_ID, true, Mensaje, 0, 0);
            }
            else
            {
                Otro_Usuario_Manager(Session, Item_ID, OtherSession.User.id, true, Mensaje);
            }
        }
        private static void Pociones_Manager(SessionInstance Session, int Item, int ID_Usuario, bool pajarito_mensajero, string Mensaje, int x, int y)
        {
            mysql client = new mysql();
            SessionInstance OtherSession = UserManager.ObtenerSession(ID_Usuario);
            if (OtherSession == null) return;
            OtherSession.User.Trayectoria.DetenerMovimiento();
            OtherSession.User.Time_Interactuando = Time.GetCurrentAndAdd(AddType.Segundos, 4);
            DataRow ver_objeto = client.ExecuteQueryRow("SELECT swf,efecto_id,tiempo_pocion FROM objetos WHERE id = '" + Item + "'");
            if (ver_objeto != null)
            {
                String swf = (String)ver_objeto["swf"];
                int id = (byte)ver_objeto["efecto_id"];
                int tiempo = Convert.ToInt16(ver_objeto["tiempo_pocion"]);
                if (id != 0)
                {
                    OtherSession.User.Efecto = id; OtherSession.User.TiempoPocion = tiempo;
                    if (swf == "Miedo_Pipeta_Dark_Red") new Thread(() => Teleport_Master_X(Session, x, y)).Start();
                    else if (swf == "Miedo_Pipeta_Red") new Thread(() => Teleport(OtherSession.User.id)).Start();
                }
            }
            Packet_189_169(Session, -1, Item);
            Packet_184_120(OtherSession, OtherSession.User.Efecto, Mensaje, true);
            Packet_181_120(Session, Item);
            PathfindingHandler.Reprar_Mirada_Z(OtherSession);
            client.ExecuteNonQuery("DELETE FROM objetos_comprados where objeto_id = '" + Item + "' AND usuario_id = '" + Session.User.id + "' LIMIT 1");
        }
        private static void Chat_Colores(SessionInstance Session, int ID_Objeto)
        {
            if (Session == null) return;
            if (Session.User == null) return;
            if (Session.User.Sala == null) return;
            if (Session.User.PreLock_Interactuando) { Packet_143(Session); return; }
            if (Session.User.Sala.Ring != null) { Packet_143(Session); return; }
            if (Session.User.Sala.Cocos != null) { Packet_143(Session); return; }
            if (Session.User.Sala.Camino != null) { Packet_143(Session); return; }
            if (Session.User.Sala.Sendero != null) { Packet_143(Session); return; }
            if (Session == null) return;
            if (Session.User.Efecto != 0) { Packet_143(Session); return; }
            if (Session.User.avatar == 13) { Packet_143(Session); return; }
            if (Session.User.avatar == 14) { Packet_143(Session); return; }
            if (Session.User.ModoNinja == true)
            {
                NotificacionesManager.NotifiChat(Session, "Sabio: Desactiva el traje Ninja para cambiar el color de chat.");
                Packet_143(Session);
                return;
            }
            Session.User.Trayectoria.DetenerMovimiento();
            Session.User.Time_Interactuando = Time.GetCurrentAndAdd(AddType.Segundos, 4);
            string Color_Chat = "";
            if (ID_Objeto == 3117 && Session.User.Color_Chat != 4) { Session.User.Efecto = 42; Session.User.TiempoPocion = 8; Session.User.Color_Chat = 4; Color_Chat = "Helado"; }//Helado
            else if (ID_Objeto == 3117 && Session.User.Color_Chat == 4) { Session.User.Efecto = 42; Session.User.TiempoPocion = 8; Session.User.Color_Chat = 1; Color_Chat = "Normal"; }// 
            if (ID_Objeto == 3116 && Session.User.Color_Chat != 5) { Session.User.Efecto = 42; Session.User.TiempoPocion = 8; Session.User.Color_Chat = 5; Color_Chat = "Oscuro"; }//Oscuro
            else if (ID_Objeto == 3116 && Session.User.Color_Chat == 5) { Session.User.Efecto = 42; Session.User.TiempoPocion = 8; Session.User.Color_Chat = 1; Color_Chat = "Normal"; }// 
            if (ID_Objeto == 3044 && Session.User.Color_Chat != 6) { Session.User.Efecto = 42; Session.User.TiempoPocion = 8; Session.User.Color_Chat = 6; Color_Chat = "Rosa"; }//Rosa
            else if (ID_Objeto == 3044 && Session.User.Color_Chat == 6) { Session.User.Efecto = 42; Session.User.TiempoPocion = 8; Session.User.Color_Chat = 1; Color_Chat = "Normal"; }// 
            if (ID_Objeto == 3045 && Session.User.Color_Chat != 7) { Session.User.Efecto = 42; Session.User.TiempoPocion = 8; Session.User.Color_Chat = 7; Color_Chat = "Rojo"; }//Rojo
            else if (ID_Objeto == 3045 && Session.User.Color_Chat == 7) { Session.User.Efecto = 42; Session.User.TiempoPocion = 8; Session.User.Color_Chat = 1; Color_Chat = "Normal"; }//
            if (ID_Objeto == 3046 && Session.User.Color_Chat != 8) { Session.User.Efecto = 42; Session.User.TiempoPocion = 8; Session.User.Color_Chat = 8; Color_Chat = "Azul"; }//Azul
            else if (ID_Objeto == 3046 && Session.User.Color_Chat == 8) { Session.User.Efecto = 42; Session.User.TiempoPocion = 8; Session.User.Color_Chat = 1; Color_Chat = "Normal"; }//
            if (ID_Objeto == 3047 && Session.User.Color_Chat != 10) { Session.User.Efecto = 42; Session.User.TiempoPocion = 8; Session.User.Color_Chat = 10; Color_Chat = "Verde"; }//Verde
            else if (ID_Objeto == 3047 && Session.User.Color_Chat == 10) { Session.User.Efecto = 42; Session.User.TiempoPocion = 8; Session.User.Color_Chat = 1; Color_Chat = "Normal"; }//
            NotificacionesManager.NotifiChat(Session, "Sabio: has cambiado el color del chat por " + Color_Chat + "");
            Packet_133(Session, string.Format("{0} a cambiado el color de chat.", Session.User.nombre), true);
            Packet_184_120(Session, Session.User.Efecto, "", true);
            Packet_181_120(Session, ID_Objeto);
            PathfindingHandler.Reprar_Mirada_Z(Session);
        }
        private static void Trajes_Catalago(SessionInstance Session, int Item_ID)
        {
            if (Session == null) return;
            if (Session.User == null) return;
            if (Session.User.Sala == null) return;
            if (Session.User.PreLock_Interactuando) { Packet_143(Session); return; }
            if (Session.User.Sala.Ring != null) { Packet_143(Session); return; }
            if (Session.User.Sala.Cocos != null) { Packet_143(Session); return; }
            if (Session.User.Sala.Sendero != null) { Packet_143(Session); return; }
            if (Session.User.Sala.Camino != null) { Packet_143(Session); return; }
            if (Session == null) return;
            if (Session.User.Efecto != 0) { Packet_143(Session); return; }
            if (Session.User.avatar == 13) { Packet_143(Session); return; }
            if (Session.User.avatar == 14) { Packet_143(Session); return; }
            if (Session.User.PreLock_Disfraz == true) { Packet_143(Session); return; }
            Session.User.Trayectoria.DetenerMovimiento();
            Session.User.PreLock_Disfraz = true;
            if (Session.User.ModoNinja == false)
            {
                if (Item_ID == 3069) { Session.User.NinjaColores_Sala = Session.User.Colores_traje_ninja_copiador_de_color(Session); Session.User.Ninja_Copi_color = true; }
                if (Item_ID == 3066) { Session.User.NinjaColores_Sala = Session.User.Colores_traje_oscuro(Session); }
                if (Item_ID == 3067) { Session.User.NinjaColores_Sala = Session.User.Colores_traje_rosa(Session); }
                if (Item_ID == 3068) { Session.User.NinjaColores_Sala = Session.User.Colores_traje_verde(Session); }
                if (Item_ID == 3063) { Session.User.NinjaColores_Sala = Session.User.Colores_traje_purpura(Session); }
                if (Item_ID == 3110) { Session.User.NinjaColores_Sala = Session.User.Colores_traje_selestial(Session); Session.User.ninja_celestial_puesto = true; }//Ninja Celestial
                Session.User.ModoNinja = true;
                if (Session.User.ModoNinja == true && Session.User.NinjaColores_Sala == "") { Session.User.ModoNinja = false; return; }
                Packet_125_120(Session, Session.User.id, 12, Session.User.NinjaColores_Sala, true);
                PathfindingHandler.Reprar_Mirada_Z(Session);
            }
            else if (Session.User.ModoNinja == true)
            {
                Session.User.NinjaColores_Sala = "";
                Session.User.Ninja_Copi_color = false;
                Session.User.ninja_celestial_puesto = false;
                Session.User.ModoNinja = false;
                Packet_125_120(Session, Session.User.id, Session.User.avatar, Session.User.colores, true);
                Packet_125_121(Session);
                PathfindingHandler.Reprar_Mirada_Z(Session);
            }
        }
        private static void Trajes_Halloween_Catalago(SessionInstance Session, int Item_ID)
        {
            if (Session == null) return;
            if (Session.User == null) return;
            if (Session.User.Sala == null) return;
            if (Session.User.PreLock_Interactuando) { Packet_143(Session); return; }
            if (Session.User.Sala.Ring != null || Session.User.Sala.Cocos != null || Session.User.Sala.Sendero != null || Session.User.Sala.Camino != null)
            {
                Packet_143(Session);
            }
            else
            {
                if (Session != null && Session.User.Efecto == 0)
                {
                    if (Session.User.PreLock_Disfraz == true) return;
                    if (Session.User.ModoNinja == true) return;
                    Session.User.PreLock_Disfraz = true;        
                    if (Item_ID == 3070 && Session.User.avatar != 13) { Session.User.KekoAnteriorPocion = Session.User.avatar; Session.User.avatar = 13; Session.User.nombre_halloween = Session.User.nombre; Session.User.nombre = ""; }
                    else if (Item_ID == 3070 && Session.User.avatar == 13) { Session.User.avatar = Session.User.KekoAnteriorPocion; Session.User.nombre = Session.User.nombre_halloween; }
                    if (Item_ID == 3071 && Session.User.avatar != 14) { Session.User.KekoAnteriorPocion = Session.User.avatar; Session.User.avatar = 14; Session.User.nombre_halloween = Session.User.nombre; Session.User.nombre = ""; }
                    else if (Item_ID == 3071 && Session.User.avatar != 14) { Session.User.avatar = Session.User.KekoAnteriorPocion; Session.User.nombre = Session.User.nombre_halloween; }
                    Session.User.Trayectoria.DetenerMovimiento();
                    Packet_125_120(Session, Session.User.id, Session.User.avatar, Session.User.colores, true);
                    PathfindingHandler.Reprar_Mirada_Z(Session);
                }
                else
                {
                    Packet_143(Session);
                }
            }
        }
        private static void Colores_Black(SessionInstance Session)
        {
            if (Session.User.PreLock_Disfraz == true) return;
            if (Session.User.ModoNinja == true) return;
            if (Session.User.Efecto != 0) return;
            Session.User.PreLock_Disfraz = true;
            Session.User.Trayectoria.DetenerMovimiento();
            if (Session.User.avatar >= 1 && Session.User.avatar <= 11 && Session.User.colores_old == "" && Session.User.avatar != 8 && Session.User.avatar != 9) { Session.User.colores_old = Session.User.colores; Session.User.colores = "000000" + Session.User.colores.Substring(6, 6) + Session.User.colores.Substring(12, 6) + Session.User.colores.Substring(18, 6) + Session.User.colores.Substring(24, 6) + Session.User.colores.Substring(30, 6) + Session.User.colores.Substring(36, 6); Session.User.block_coco = true; Session.User.Sala.Alerta("Sabio: Usuario " + Session.User.nombre + " ha activado anti upper."); Session.User.block_upper = true; }
            else if (Session.User.avatar == 8 && Session.User.colores_old == "") { Session.User.colores_old = Session.User.colores; Session.User.colores = Session.User.colores.Substring(0, 6) + "000000" + Session.User.colores.Substring(12, 6) + Session.User.colores.Substring(18, 6) + Session.User.colores.Substring(24, 6) + Session.User.colores.Substring(30, 6) + Session.User.colores.Substring(36, 6); Session.User.block_coco = true; Session.User.Sala.Alerta("Sabio: Usuario " + Session.User.nombre + " ha activado anti upper."); Session.User.block_upper = true; }
            else if (Session.User.avatar == 9 && Session.User.colores_old == "") { Session.User.colores_old = Session.User.colores; Session.User.colores = Session.User.colores.Substring(0, 6) + "000000" + Session.User.colores.Substring(12, 6) + Session.User.colores.Substring(18, 6) + Session.User.colores.Substring(24, 6) + Session.User.colores.Substring(30, 6) + Session.User.colores.Substring(36, 6); Session.User.block_coco = true; Session.User.Sala.Alerta("Sabio: Usuario " + Session.User.nombre + " ha activado anti upper."); Session.User.block_upper = true; }
            else { Session.User.colores = Session.User.colores_old; Session.User.colores_old = ""; Session.User.block_coco = false; Session.User.Sala.Alerta("Sabio: Usuario " + Session.User.nombre + " ha desactivado anti upper."); Session.User.block_upper = false; }
            Packet_125_120(Session, Session.User.id, Session.User.avatar, Session.User.colores, true);
        }
        public static void Devolver_Traje(SessionInstance Session)
        {
            Session.User.avatar = Session.User.KekoAnteriorPocion;
            Packet_125_120(Session, Session.User.id, Session.User.avatar, Session.User.colores, true);
            PathfindingHandler.Reprar_Mirada_Z(Session);
        }
        public static void QuitarPocion(SessionInstance Session)
        {
            if (Session.User.Sala != null) { Packet_184_120(Session, 0, "", true); }
            else { Packet_184_120(Session, 0, "", false); }
        }
        public static void QuitarPocion_FE(SessionInstance Session)
        {
            if (Session.User.Sala != null) { Packet_184_121(Session, "", true); }
            else { Packet_184_121(Session,  "", false); }
        }
        static void Teleport(int Id_User)
        {
            Thread.Sleep(new TimeSpan(0, 0, 7));
            SessionInstance OtherSession = UserManager.ObtenerSession(Id_User);
            Point Location = OtherSession.User.Sala.GetRandomPlace();
            while (!OtherSession.User.Sala.Caminable((new Posicion(Location.X, Location.Y))))
            {
                Location = OtherSession.User.Sala.GetRandomPlace();
            }
            Posicion p1 = new Posicion(Location.X, Location.Y);
            if (OtherSession.User.Sala != null)
            {
                OtherSession.User.Sala.Map[OtherSession.User.Posicion.y, OtherSession.User.Posicion.x].FijarSession(null);
                OtherSession.User.Posicion.x = p1.x;
                OtherSession.User.Posicion.y = p1.y;
                Packet_135(OtherSession, OtherSession.User.Posicion.x, OtherSession.User.Posicion.y, OtherSession.User.Posicion.z);
            }
        }
        static void Teleport_Master_X(SessionInstance Session, int x, int y)
        {
            Thread.Sleep(new TimeSpan(0, 0, 7));
            if (Session.User.Sala != null)
            {
                Session.User.Sala.Map[Session.User.Posicion.y, Session.User.Posicion.x].FijarSession(null);
                if (Session.User.Sala != null)
                {
                    Session.User.Posicion.x = x;
                    Session.User.Posicion.y = y;
                    Packet_135(Session, Session.User.Posicion.x, Session.User.Posicion.y, Session.User.Posicion.z);
                }
            }
        }
        static void Packet_143(SessionInstance Session)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(143);
            server.AppendParameter(1);
            Session.SendDataProtected(server);
        }
        static void Packet_133(SessionInstance Session, string Mensaje, bool Publico)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(133);
            server.AppendParameter(0);
            server.AppendParameter(Mensaje);
            server.AppendParameter(3);
            if (Publico == false) { Session.SendData(server); }
            if (Publico == true) { Session.User.Sala.SendData(server, Session); }
        }
        static void Packet_189_169(SessionInstance Session, int compra_id, int Item)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(189);
            server.AddHead(169);
            server.AppendParameter(compra_id);
            server.AppendParameter(Item);
            server.AppendParameter(1);
            Session.SendData(server);
        }
        static void Packet_184_120(SessionInstance Session, int Efecto, string Mensaje, bool Publico)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(184);
            server.AddHead(120);
          
            if (Mensaje != "")
            {
                server.AppendParameter(Session.User.id);
                server.AppendParameter(10);
                server.AppendParameter(Efecto);// Id de efecto
                server.AppendParameter(Mensaje);
            }
            else
            {
                server.AppendParameter(Session.User.id);
                server.AppendParameter(Efecto);
                server.AppendParameter(Efecto);
            }
            if (Publico == false) { Session.SendData(server); }
            if (Publico == true) { Session.User.Sala.SendData(server, Session); }
        }
        static void Packet_184_121(SessionInstance Session, string Mensaje, bool Publico)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(184);
            server.AddHead(121);
            server.AppendParameter(Session.User.id);
            server.AppendParameter(-1);
            server.AppendParameter(Session.User.Efecto);
            if (Publico == false) { Session.SendData(server); }
            if (Publico == true) { Session.User.Sala.SendData(server, Session); }
        }
        static void Packet_181_120(SessionInstance Session, int Item)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(181);
            server.AddHead(120);
            server.AppendParameter(Session.User.id);
            server.AppendParameter(Item);
            Session.User.Sala.SendData(server, Session);
        }
        static void Packet_125_120(SessionInstance Session, int Usuario_ID, int ID_Personaje, string Colores, bool Publico)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(125);
            server.AddHead(120);
            server.AppendParameter(Usuario_ID);
            server.AppendParameter(ID_Personaje);
            server.AppendParameter(Colores);
            server.AppendParameter(1);
            server.AppendParameter(1);
            server.AppendParameter(1);
            if (Publico == false) { Session.SendData(server); }
            if (Publico == true) { Session.User.Sala.SendData(server, Session); }
        }
        static void Packet_125_121(SessionInstance Session)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(125);
            server.AddHead(121);
            server.AppendParameter(Session.User.id);
            Session.User.Sala.SendData(server, Session);
        }
        static void Packet_135(SessionInstance Session, int x, int y, int z)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(135);
            server.AppendParameter(Session.User.IDEspacial);
            server.AppendParameter(x);
            server.AppendParameter(y);
            server.AppendParameter(z);
            Session.User.Sala.SendData(server, Session);
        }
    }
}