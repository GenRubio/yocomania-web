using BoomBang.game.instances;
using BoomBang.game.instances.manager;
using BoomBang.server;
using System;
using System.Collections.Generic;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading;
using System.Threading.Tasks;

namespace BoomBang.game.manager
{
    public class ConcursosManager
    {   
        public static Dictionary<int, ObjetoLanzadoInstance> ObjetosAreas = new Dictionary<int, ObjetoLanzadoInstance>();
        private static Dictionary<int, ItemConcursoInstance> dictionaryItems = new Dictionary<int, ItemConcursoInstance>();
        public static void seavItemsObject()
        {
            mysql client = new mysql();
            foreach(DataRow item in client.ExecuteQueryTable("SELECT * FROM concurso_objetos").Rows)
            {
                int key = (int)item["id"];
                dictionaryItems.Add(key, new ItemConcursoInstance(item));
            }
        }
        private static bool checkObjectItemId(int id)
        {
            try
            {
                foreach (ObjetoLanzadoInstance objetos in ObjetosAreas.Values.ToList())
                {
                    if (objetos.key == id)
                    {
                        return true;
                    }
                }
                return false;
            }
            catch
            {
                return false;
            }   
        }

        public static void Lanzar_Objeto(SalaInstance Sala, int ItemID, string typo)
        {
            int Key = new Random().Next(1, 50000);
            while (checkObjectItemId(Key))
            {
                Key = new Random().Next(1, 50000);
            }
            ItemConcursoInstance ItemToLaunch = dictionaryItems[ItemID];
            if (ItemToLaunch != null)
            {
                Point Location = Sala.GetRandomPlace();
                while (!Sala.Caminable((new Posicion(Location.X, Location.Y))))
                {
                    Location = Sala.GetRandomPlace();
                }
                Posicion Posicion = new Posicion(Location.X, Location.Y);
                ObjetoLanzadoInstance item_valores = new ObjetoLanzadoInstance(Key, ItemToLaunch, Posicion, Sala);
                ObjetosAreas.Add(Key, item_valores);
                items_tiempos_manager(item_valores, typo);
                Thread.Sleep(new TimeSpan(0, 0, 0, 0, 500));
                new Thread(() => borar_item_area(item_valores, typo)).Start();
            }
        }
        static void borar_item_area(ObjetoLanzadoInstance item, string typo)
        {
            while (Time.GetDifference(item.tiempo_desaparicion) > 0)
            {
                Thread.Sleep(new TimeSpan(0, 0, 1));
            }
            ObjetosAreas.Remove(item.key);

            ServerMessage server = new ServerMessage();
            server.AddHead(200);
            server.AddHead(123);
            server.AppendParameter(1);
            server.AppendParameter(item.key);
            item.Sala.SendData(server);
        }
        public static void items_tiempos_manager(ObjetoLanzadoInstance item, string typo)
        {
            if (typo == "segundos_cofre") { item.Sala.Escenario.segundos_cofre = new Random().Next(60, 120); }
            if (typo == "segundos_coco_igloo") { item.Sala.Escenario.segundos_coco_igloo = 360; }
            if (typo == "segundos_shuriken_igloo") { item.Sala.Escenario.segundos_shuriken_igloo = 600; }
            if (typo == "segundos_evento_semanal") { item.Sala.Escenario.segundos_evento_semanal = new Random().Next(120, 300); ; }
            if (typo == "segundos_items_cmb")
            {
                if (item.Item.id >= 7 && item.Item.id <= 21)//Objetos cementerio
                {
                    int[] segundos = { 60, 30, 25, 20, 15, 10 };
                    item.Sala.Escenario.segundos_items_cmb = segundos[new Random().Next(segundos.Length)];
                }
                else//Objetos bosque - madriguera
                {
                    int[] segundos = { 60, 120, 180, 240 };
                    item.Sala.Escenario.segundos_items_cmb = segundos[new Random().Next(segundos.Length)];
                }
            }
        }
        public static void AbrirObjeto(ObjetoLanzadoInstance Item, SessionInstance Session)
        {
            if (!ObjetosAreas.ContainsKey(Item.key)) return;
            if (Item.Item.tipo_caida == 3 || Item.Item.tipo_caida == 2)
            {
                if (Session.User.Posicion.x == Item.Pos.x && Session.User.Posicion.y == Item.Pos.y)
                {
                    ServerMessage server = new ServerMessage();
                    server.AddHead(200);
                    server.AddHead(123);
                    server.AppendParameter(1);
                    server.AppendParameter(Item.key);
                    Item.Sala.SendData(server);
                    switch (Item.Item.nombre)
                    {
                        case "caja_pocion":
                            Random random = new Random();
                            int Objeto = listas.Pociones_Cajas.Count;
                            int Obtener_Objeto = random.Next(Objeto);
                            int idRandom = listas.Pociones_Cajas[Obtener_Objeto];
                            EntregarObjetos(Session, idRandom);
                            Item.Sala.Alerta(Session.User.nombre + " ha atrapado un regalo.");
                            items_tiempos_manager(Item, "segundos_cofre");
                            break;
                        case "coco":
                            UserManager.Sumar_Cocos(Session.User, 1);
                            Session.User.Sala.ActualizarEstadisticas(Session.User);
                            Item.Sala.Alerta(Session.User.nombre + " ha atrapado un coco!");
                            if (Session.User.Sala.id == 9) { items_tiempos_manager(Item, "segundos_coco_igloo"); }
                            else { 
                                Cocos_Shurikens_Manager(Session);
                                items_tiempos_manager(Item, "segundos_evento_semanal");
                            }
                            Alerta_Nuevo_Nivel(Session, 1);
                            break;
                        case "shuriken":
                            UserManager.Sumar_Shurikens(Session.User, 1);
                            Session.User.Sala.ActualizarEstadisticas(Session.User);
                            Item.Sala.Alerta(Session.User.nombre + " ha atrapado un shuriken!");
                            if (Session.User.Sala.id == 9) { items_tiempos_manager(Item, "segundos_shuriken_igloo"); }
                            else { 
                                Cocos_Shurikens_Manager(Session);
                                items_tiempos_manager(Item, "segundos_evento_semanal");
                            }
                            Alerta_Nuevo_Nivel(Session, 2);
                            break;
                        case "corazon_valentin":
                            Item.Sala.Alerta(Session.User.nombre + " ha atrapado un corazon!");
                            Objetos_Cocnursos_Manager(Session);
                            items_tiempos_manager(Item, "segundos_items_cmb");
                            break;
                        case "copo":
                            Item.Sala.Alerta(Session.User.nombre + " ha atrapado un copo!");
                            Objetos_Cocnursos_Manager(Session);
                            items_tiempos_manager(Item, "segundos_items_cmb");
                            break;
                        case "calabaza":
                            Item.Sala.Alerta(Session.User.nombre + " ha atrapado una calabaza!");
                            Objetos_Cocnursos_Manager(Session);
                            items_tiempos_manager(Item, "segundos_items_cmb");
                            break;
                        case "huevo":
                            Item.Sala.Alerta(Session.User.nombre + " ha atrapado un huevo!");
                            Objetos_Cocnursos_Manager(Session);
                            items_tiempos_manager(Item, "segundos_items_cmb");
                            break;
                        case "fr_azul":
                            EntregarObjetos(Session, 754);
                            Item.Sala.Alerta(Session.User.nombre + " ha atrapado una Sangre aristócrata");
                            items_tiempos_manager(Item, "segundos_items_cmb");
                            break;
                        case "fr_lila":
                            EntregarObjetos(Session, 755);
                            Item.Sala.Alerta(Session.User.nombre + " ha atrapado una Sangre dulce");
                            items_tiempos_manager(Item, "segundos_items_cmb");
                            break;
                        case "fr_blanco":
                            EntregarObjetos(Session, 757);
                            Item.Sala.Alerta(Session.User.nombre + " ha atrapado una Ectoplasma");
                            items_tiempos_manager(Item, "segundos_items_cmb");
                            break;
                        case "fr_rojo":
                            EntregarObjetos(Session, 758);
                            Item.Sala.Alerta(Session.User.nombre + " ha atrapado una Sangre fresca");
                            items_tiempos_manager(Item, "segundos_items_cmb");
                            break;
                        case "fr_naranja":
                            EntregarObjetos(Session, 759);
                            Item.Sala.Alerta(Session.User.nombre + " ha atrapado una Sangre de muerto");
                            items_tiempos_manager(Item, "segundos_items_cmb");
                            break;
                        case "fr_negro":
                            EntregarObjetos(Session, 761);
                            Item.Sala.Alerta(Session.User.nombre + " ha atrapado una Sangre de vampiro");
                            items_tiempos_manager(Item, "segundos_items_cmb");
                            break;
                        case "cerebro":
                            EntregarObjetos(Session, 542);
                            Item.Sala.Alerta(Session.User.nombre + " ha atrapado un Cerebro");
                            items_tiempos_manager(Item, "segundos_items_cmb");
                            break;
                        case "pie_azul":
                            EntregarObjetos(Session, 544);
                            Item.Sala.Alerta(Session.User.nombre + " ha atrapado un Pie Izquierdo");
                            items_tiempos_manager(Item, "segundos_items_cmb");
                            break;
                        case "pie_verde":
                            EntregarObjetos(Session, 543);
                            Item.Sala.Alerta(Session.User.nombre + " ha atrapado un Pie Derecho");
                            items_tiempos_manager(Item, "segundos_items_cmb");
                            break;
                        case "br_azul":
                            EntregarObjetos(Session, 546);
                            Item.Sala.Alerta(Session.User.nombre + " ha atrapado una Mano Izquierda");
                            items_tiempos_manager(Item, "segundos_items_cmb");
                            break;
                        case "br_verde":
                            EntregarObjetos(Session, 545);
                            Item.Sala.Alerta(Session.User.nombre + " ha atrapado una Mano Derecha");
                            items_tiempos_manager(Item, "segundos_items_cmb");
                            break;
                        case "corazon":
                            EntregarObjetos(Session, 547);
                            Item.Sala.Alerta(Session.User.nombre + " ha atrapado un Corazón");
                            items_tiempos_manager(Item, "segundos_items_cmb");
                            break;
                        case "sangre":
                            EntregarObjetos(Session, 721);
                            Item.Sala.Alerta(Session.User.nombre + " ha atrapado un Hueso Esqueleto");
                            items_tiempos_manager(Item, "segundos_items_cmb");
                            break;
                        case "dentadura":
                            EntregarObjetos(Session, 720);
                            Item.Sala.Alerta(Session.User.nombre + " ha atrapado una Dentadura Zombie");
                            items_tiempos_manager(Item, "segundos_items_cmb");
                            break;
                        case "donut":
                            EntregarObjetos(Session, 315);
                            Item.Sala.Alerta(Session.User.nombre + " ha atrapado un donut");
                            items_tiempos_manager(Item, "segundos_items_cmb");
                            break;
                        case "bolanieve":
                            EntregarObjetos(Session, 819);
                            Item.Sala.Alerta(Session.User.nombre + " ha atrapado una bola de nieve");
                            items_tiempos_manager(Item, "segundos_items_cmb");
                            break;
                        case "setavenenosa":
                            EntregarObjetos(Session, 118);
                            Item.Sala.Alerta(Session.User.nombre + " ha atrapado una seta");
                            items_tiempos_manager(Item, "segundos_items_cmb");
                            break;
                        case "cofre_oro":
                            UserManager.Creditos(Session.User, true, true, 1000);
                            Item.Sala.Alerta(Session.User.nombre + " ha atrapado un cofre y obtiene: 1000 créditos.");
                            items_tiempos_manager(Item, "segundos_cofre");
                            break;
                        default:
                            return;
                    }
                }
            }
            else
            {
                ServerMessage server = new ServerMessage();
                server.AddHead(200);
                server.AddHead(123);
                server.AppendParameter(1);
                server.AppendParameter(Item.key);
                Item.Sala.SendData(server);
                switch (Item.Item.nombre)
                {
                    case "cofre_plata":
                        Random rd = new Random();
                        int Numero = rd.Next(1, 4);
                        int Creditos = 25;
                        if (Numero == 1) { Creditos = 25; }
                        if (Numero == 2) { Creditos = 50; }
                        if (Numero == 3) { Creditos = 100; }
                        UserManager.Creditos(Session.User, false, true, Creditos);
                        Item.Sala.Alerta(Session.User.nombre + " ha atrapado un cofre y obtiene: " + Creditos + " monedas de plata.");
                        items_tiempos_manager(Item, "segundos_cofre");
                        break;
                }
            }
            ObjetosAreas.Remove(Item.key);
        }
        public static void Encontrar_Objetos(SessionInstance Session, SalaInstance Sala)
        {
            var Collection = ObjetosAreas;
            foreach (var Objetos in Collection)
            {
                if (Objetos.Value.Sala.id == Sala.id)
                {
                    ServerMessage server = new ServerMessage();
                    server.AddHead(200);
                    server.AddHead(120);
                    server.AppendParameter(Objetos.Value.key);
                    server.AppendParameter(Objetos.Value.Item.id);
                    server.AppendParameter(Objetos.Value.Pos.x);
                    server.AppendParameter(Objetos.Value.Pos.y);
                    server.AppendParameter(Objetos.Value.Item.modelo);
                    server.AppendParameter(Objetos.Value.Item.tipo_caida);
                    server.AppendParameter(Objetos.Value.Item.tipo_salida);//TipoApertura
                    server.AppendParameter(Objetos.Value.Item.tiempo_aparicion);//TiempoAparicion
                    Session.SendData(server);
                }
            }
        }
        private static void Cocos_Shurikens_Manager(SessionInstance Session)
        {
            RankingsManager.agregar_user_ranking(Session.User.id, 6, -1, 1);
        }
        private static void Objetos_Cocnursos_Manager(SessionInstance Session)
        {
            mysql client = new mysql();
            DataRow comprobar_usuario = client.ExecuteQueryRow("SELECT * FROM mega_concurso WHERE usuario = '" + Session.User.nombre + "'");
            if (comprobar_usuario != null)
            {
                int goldens = (int)comprobar_usuario["puntos"];
                int actualizar_goldens = goldens + 1;
                client.ExecuteNonQuery("UPDATE mega_concurso SET puntos = '" + actualizar_goldens + "' WHERE usuario = '" + Session.User.nombre + "'");
            }
            else
            {
                client.SetParameter("usuario", Session.User.nombre);
                client.SetParameter("puntos", 1);
                client.ExecuteNonQuery("INSERT INTO mega_concurso (`usuario`, `puntos`) VALUES (@usuario, @puntos)");
            }
        }
        public static ObjetoLanzadoInstance ObtenerLanzamiento(int key)
        {
            if (ObjetosAreas.ContainsKey(key))
            {
                return ObjetosAreas[key];
            }
            return null;
        }
        public static void BuscarObjetoCaido(SessionInstance Session, SalaInstance Sala)
        {
            if (Session.User != null)
            {
                if (Session.User.Sala != null)
                {
                    foreach (var Objetos in ObjetosAreas)
                    {
                        if (Objetos.Value.Sala.id == Sala.id)
                        {
                            if (Session.User.Posicion.x == Objetos.Value.Pos.x && Session.User.Posicion.y == Objetos.Value.Pos.y)
                            {
                                ObjetoLanzadoInstance Item = ObtenerLanzamiento(Objetos.Key);
                                AbrirObjeto(Item, Session);
                                return;
                            }
                        }
                    }
                }
            }
        }
        private static void EntregarObjetos(SessionInstance Session, int Regalo)
        {
            using (mysql client = new mysql())
            {
                client.SetParameter("item_id", Regalo);
                client.SetParameter("userid", Session.User.id);
                client.SetParameter("hex", "");
                client.SetParameter("rgb", "");
                client.SetParameter("tam", 0);
                client.SetParameter("default_data", 0);
                if (client.ExecuteNonQuery("INSERT INTO objetos_comprados (`objeto_id`, `colores_hex`, `colores_rgb`, `usuario_id`, `tam`, `data`) VALUES (@item_id, @hex, @rgb, @userid, @tam, @default_data)") == 1)
                {
                    client.SetParameter("id", Regalo);
                    client.SetParameter("UserID", Session.User.id);
                    int compra_id = int.Parse(Convert.ToString(client.ExecuteScalar("SELECT MAX(id) FROM objetos_comprados WHERE objeto_id = @id AND usuario_id = @UserID")));
                    ServerMessage añadir_mochila = new ServerMessage();
                    añadir_mochila.AddHead(189);
                    añadir_mochila.AddHead(139);
                    añadir_mochila.AppendParameter(compra_id);
                    añadir_mochila.AppendParameter(Regalo);
                    añadir_mochila.AppendParameter("");
                    añadir_mochila.AppendParameter("");
                    añadir_mochila.AppendParameter(0);
                    añadir_mochila.AppendParameter(0);
                    añadir_mochila.AppendParameter(0);
                    añadir_mochila.AppendParameter("");
                    añadir_mochila.AppendParameter(0);
                    añadir_mochila.AppendParameter(0);
                    añadir_mochila.AppendParameter(1);//CantidadObjetos
                    Session.SendData(añadir_mochila);
                }
            }
        }
        public static void Alerta_Nuevo_Nivel(SessionInstance Session, int ID)
        {
            if (ID == 1)///Coco
            {
                if (Session.User.puntos_cocos == 10) NotificacionesManager.Juegos(Session, 3);
                if (Session.User.puntos_cocos == 20) NotificacionesManager.Juegos(Session, 3);
                if (Session.User.puntos_cocos == 50) NotificacionesManager.Juegos(Session, 3);
                if (Session.User.puntos_cocos == 100) NotificacionesManager.Juegos(Session, 3);
                if (Session.User.puntos_cocos == 150) NotificacionesManager.Juegos(Session, 3);
                if (Session.User.puntos_cocos == 200) NotificacionesManager.Juegos(Session, 3);
                if (Session.User.puntos_cocos == 300) NotificacionesManager.Juegos(Session, 3);
                if (Session.User.puntos_cocos == 400) NotificacionesManager.Juegos(Session, 3);
                if (Session.User.puntos_cocos == 600) NotificacionesManager.Juegos(Session, 3);
            }
            if (ID == 2)//Shurikens
            {
                if (Session.User.puntos_ninja == 400) NotificacionesManager.Juegos(Session, 4);
                if (Session.User.puntos_ninja == 410) NotificacionesManager.Juegos(Session, 4);
                if (Session.User.puntos_ninja == 420) NotificacionesManager.Juegos(Session, 4);
                if (Session.User.puntos_ninja == 450) NotificacionesManager.Juegos(Session, 4);
                if (Session.User.puntos_ninja == 500) NotificacionesManager.Juegos(Session, 4);
                if (Session.User.puntos_ninja == 550) NotificacionesManager.Juegos(Session, 4);
                if (Session.User.puntos_ninja == 600) NotificacionesManager.Juegos(Session, 4);
                if (Session.User.puntos_ninja == 700) NotificacionesManager.Juegos(Session, 4);
                if (Session.User.puntos_ninja == 800) NotificacionesManager.Juegos(Session, 4);
                if (Session.User.puntos_ninja == 1000) NotificacionesManager.Juegos(Session, 4);
            }
        }
    }
}
