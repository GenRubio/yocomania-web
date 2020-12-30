using BoomBang.game;
using BoomBang.game.handler;
using BoomBang.game.instances;
using BoomBang.game.instances.manager;
using BoomBang.game.instances.MiniGames;
using BoomBang.game.manager;
using BoomBang.game.packets;
using System;
using System.Collections.Generic;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading;
using System.Threading.Tasks;

namespace BoomBang.server
{
    class ServerThreads
    {
        public static void Initialize()
        {
            new Thread(Pathfinder).Start();
            new Thread(Ping).Start();
            new Thread(mGamesCall).Start();
            new Thread(Pocion_Tiempo).Start();
            new Thread(ObjetosSistem).Start();
            new Thread(Fechas).Start();
            new Thread(Alerta_Automatica).Start();
            new Thread(Plantas).Start();
            if (Program.threads_especiales == true)
            {
                new Thread(AntiAutoclick_Sistem).Start();
                new Thread(AntiAutoclickBoomBangTV).Start();
                new Thread(Sestema_Loteria_Semanal).Start();
                new Thread(Sestema_Catalago).Start();
                new Thread(Rankings).Start();
            }        
        }
        static void Rankings()
        {
            while (true)
            {
                Rankings_Manager();
                Thread.Sleep(1000);
            }
        }
        static void Rankings_Manager()
        {
            foreach (var Sala in SalasManager.Salas_Publicas.Values)
            {
                if (Sala.Escenario.nombre != "Beluga Beach") return;
                if (Time.GetDifference(Sala.Escenario.proximo_evento) <= 0 && Time.GetDifference(Sala.Escenario.tiempo_evento) <= 0)//Empezar nuevo evento semanal
                {
                    RankingsManager.start_new_event(Sala);
                }
                if (Time.GetDifference(Sala.Escenario.tiempo_evento) <= 0 && Sala.Escenario.tipo_evento != 0)//Acabar evento semanal
                {
                    RankingsManager.end_event(Sala);
                }
                if (Time.GetDifference(Sala.Escenario.ranking_semanal) <= 0)//Entrega Trofeos Rankign Minijuegos Semanal
                {
                    RankingsManager.rankings_time_remove(Sala);
                }
            }
        }
        static bool Catalago_Viernes = true;
        public static string Fecha_Ranking_Semanal = "";
        public static int intervalo_atv = 75;
        static void Plantas()
        {
            while (true)
            {
                Plantas_Manager();
                Thread.Sleep(1000);
            }
        }
        static void Alerta_Automatica()
        {
            while (true)
            {
                Alerta_Automatica_Manager();
                Thread.Sleep(new TimeSpan(0, 0, 20, 0, 0));
            }
        }
        static void Fechas()
        {
            while (true)
            {
                Fechas_Manager();
                Thread.Sleep(1000);
            }
        }
        static void Sestema_Catalago()
        {
            while (true)
            {
                Sestema_Catalago_Manager();
                Thread.Sleep(1000);
            }
        }
        static void AntiAutoclickBoomBangTV()
        {
            while (true)
            {
                AntiAutoclickBoomBangTV_Manager();
                Thread.Sleep(new TimeSpan(0, 0, 0, 0, intervalo_atv));
            }
        }
        static void AntiAutoclick_Sistem()
        {
            while (true)
            {
                AntiAutoclick_Sistem_Manager();
                Thread.Sleep(1000);
            }

        }
        static void ObjetosSistem()
        {
            while (true)
            {
                ObjetosSistem_Manager();
                Thread.Sleep(1000);
            }
        }
        static void Pocion_Tiempo()
        {
            while (true)
            {
                Pocion_Tiempo_Manager();
                Thread.Sleep(1000);
            }
        }
        static void mGamesCall()
        {
            while (true)
            {
                mGamesCall_Manager();
                Thread.Sleep(1000);
            }
        }
        static void Ping()
        {
            while (true)
            {
                foreach (SessionInstance Session in UserManager.UsuariosOnline.Values.ToList())
                {
                    if (Time.GetDifference(Session.LastPingTime) <= -60 && Session.ping == false)
                    {
                        Session.FinalizarConexion("Ping");
                        continue;
                    }
                }
                Thread.Sleep(1000);
            }
        }
        static void Sestema_Loteria_Semanal()
        {
            while (true)
            {
                Sestema_Loteria_Semanal_Manager();
                Thread.Sleep(1000);
            }
        }
        static void Plantas_Manager()
        {
            foreach (SalaInstance Sala in SalasManager.Salas_Privadas.Values.ToList())
            {
                foreach(BuyObjectInstance Item in Sala.ObjetosEnSala.Values.ToList())
                {
                    if (listas.Plantas.Contains(Item.objeto_id))
                    {
                        foreach (SessionInstance Session in UserManager.UsuariosOnline.Values)
                        {
                            if (Time.GetDifference(Item.Planta_sol) <= 0 && Time.GetDifference(Item.Planta_agua) > 0)
                            {
                                Item.Planta_agua = 0;
                                Item.Planta_sol = 0;
                                PlantasManager.planta_sql(Item);
                                PlantasManager.actualizar_planta(Item.id, Item, Session);
                            }
                        }
                    }
                }
            }
        }
        static void Pathfinder()
        {
            while (true)
            {
                try
                {
                    foreach (SessionInstance Session in UserManager.UsuariosOnline.Values.ToList())
                    {
                        if (Session.User.Sala == null) continue;
                        if (Session.User.Trayectoria == null) continue;
                        if (Session.User.Trayectoria.Movimientos.Count == 0) continue;
                        if (Session.User.PreLock_Interactuando == true) continue;
                        if (Session.User.PreLock_Caminando == true) continue;
                        if (Session.User.Sala.PathFinder == false) continue;
                        if (Session.User.contar_pasos > 0) { Session.User.contar_pasos--; }
                        Posicion SiguienteMovimiento = Session.User.Trayectoria.SiguienteMovimiento();
                        if (!Session.User.Trayectoria.MovementIsVerifield(SiguienteMovimiento)) continue;
                        if (SiguienteMovimiento.y < Session.User.Sala.MapSizeY && SiguienteMovimiento.x < Session.User.Sala.MapSizeX)
                        {
                            if (Session.User.Sala.Caminable(SiguienteMovimiento))
                            {
                                Session.User.Sala.Map[Session.User.Posicion.y, Session.User.Posicion.x].FijarSession(null);
                                Session.User.PreLock_Caminando = true;
                                Session.User.Posicion = SiguienteMovimiento;
                                Session.User.Sala.Map[Session.User.Posicion.y, Session.User.Posicion.x].FijarSession(Session);
                                ServerMessage server = new ServerMessage();
                                server.AddHead(182);
                                server.AppendParameter(1);
                                server.AppendParameter(Session.User.IDEspacial);
                                server.AppendParameter(SiguienteMovimiento.x);
                                server.AppendParameter(SiguienteMovimiento.y);
                                server.AppendParameter(SiguienteMovimiento.z);
                                server.AppendParameter(750);
                                server.AppendParameter((Session.User.Trayectoria.Movimientos.Count >= 1 ? 1 : 0));
                                Session.User.Sala.SendData(server, Session);
                                new Thread(() => ConcursosManager.BuscarObjetoCaido(Session, Session.User.Sala)).Start();
                                new Thread(() => TrampasManager.BuscarTrampa(Session)).Start();
                                new Thread(() => SalasManager.bosque_oso(Session)).Start();
                                if (Session.User.Sala.Sendero != null) new Thread(() => Session.User.Sala.Sendero.VerificarMovimiento(Session)).Start();
                            }
                            else
                            {
                                Session.User.Trayectoria.Movimientos.Clear();
                                Session.User.Trayectoria.BuscarOtroSendero();
                            }
                        }
                        else
                        {
                            Session.User.Trayectoria.Movimientos.Clear();
                            Session.User.Trayectoria.BuscarOtroSendero();
                        }
                    }
                }
                catch
                {
                    continue;
                }
                Thread.Sleep(1);
            }
        }
        
        static void mGamesCall_Manager()
        {
            MiniGamesManager.BuscarParticipantes(GameType.Ring, 2);
            MiniGamesManager.BuscarParticipantes(GameType.Ring, 3);
            MiniGamesManager.BuscarParticipantes(GameType.CocosLocos, 8);
            MiniGamesManager.BuscarParticipantes(GameType.CocosLocos, 9);
            MiniGamesManager.BuscarParticipantes(GameType.Sendero, 6);
            MiniGamesManager.BuscarParticipantes(GameType.Sendero, 7);
            MiniGamesManager.BuscarParticipantes(GameType.Camino, 12);
            MiniGamesManager.BuscarParticipantes(GameType.Camino, 13);
        }
        static void Pocion_Tiempo_Manager()
        {
            foreach (SessionInstance Session in UserManager.UsuariosOnline.Values)
            {
                if (Session.User.comprobar_conexion > 0) { Session.User.comprobar_conexion--; }
                if (Session.User.comprobar_conexion == 0) { Session.User.comprobar_conexion = 10; }
                if (Session.User.TiempoPocion > 0 && Session.User.Efecto != 0) { Session.User.TiempoPocion -= 1; }
                else if (Session.User.TiempoPocion == 0 && Session.User.Efecto != 0)
                {
                    if (Session.User.PreLock_Interactuando == true) return;
                 
                    if (PocionesHandler.Pociones_FlowerPower.Contains(Session.User.Efecto))
                    {
                        SalasManager.Salir_Sala(Session, true);
                    }
                    else if (Session.User.Efecto == 11 || Session.User.Efecto == 12)
                    {
                        PocionesHandler.QuitarPocion_FE(Session);
                    }
                    else { PocionesHandler.QuitarPocion_FE(Session); }
                    Session.User.Efecto = 0;
                }
            }
        }
        static void ObjetosSistem_Manager()
        {
            foreach (SalaInstance salas_publicas in SalasManager.Salas_Publicas.Values)
            {
                if (salas_publicas.Escenario.modelo == salas_publicas.Escenario.id)
                {
                    if (salas_publicas.Visitantes >= 2)
                    {
                        if (salas_publicas.Escenario.segundos_cofre > 0) { salas_publicas.Escenario.segundos_cofre--; }
                        else//Los contadores de cofres
                        {
                            int cofre_type = new Random().Next(1, 20);
                            if (cofre_type == 10) { ConcursosManager.Lanzar_Objeto(salas_publicas, 1, "segundos_cofre"); }//Oro
                            else if (cofre_type == 5 || cofre_type == 9) { ConcursosManager.Lanzar_Objeto(salas_publicas, 29, "segundos_cofre"); }//Caja Pocion
                            else
                            {
                                ConcursosManager.Lanzar_Objeto(salas_publicas, 2, "segundos_cofre");// Cofre Plata
                            }
                            //Output.WriteLine("Cofre lanzado en area " + salas_publicas.Escenario.nombre);
                        }
                        if (salas_publicas.Escenario.id == 9)//Los contadores de coco - shuriken en Igloo
                        {
                            if (salas_publicas.Escenario.segundos_coco_igloo > 0) { salas_publicas.Escenario.segundos_coco_igloo--; }
                            else//Contador de Coco
                            {
                                ConcursosManager.Lanzar_Objeto(salas_publicas, 5, "segundos_coco_igloo");//Coco
                                Output.WriteLine("Item coco lanzado en area " + salas_publicas.Escenario.nombre);
                            }
                            if (salas_publicas.Escenario.segundos_shuriken_igloo > 0) { salas_publicas.Escenario.segundos_shuriken_igloo--; }
                            else//Contador de Shurikens
                            {
                                ConcursosManager.Lanzar_Objeto(salas_publicas, 6, "segundos_shuriken_igloo");//Shuriken
                            }
                        }
                    }
                    ///****************************************************************************************************************************************************************
                    if (salas_publicas.Visitantes > 2)//Los contadores de eventos semanales cocos-shurikens
                    {
                        if (salas_publicas.Escenario.tipo_evento != 0 && salas_publicas.Escenario.segundos_evento_semanal > 0) { salas_publicas.Escenario.segundos_evento_semanal--; }
                        else
                        {
                            if (salas_publicas.Escenario.tipo_evento == 1) { ConcursosManager.Lanzar_Objeto(salas_publicas, 5, "segundos_evento_semanal"); }//Coco
                            if (salas_publicas.Escenario.tipo_evento == 2) { ConcursosManager.Lanzar_Objeto(salas_publicas, 6, "segundos_evento_semanal"); }//Shuriken
                        }
                    }
                    ///****************************************************************************************************************************************************************
                    if (salas_publicas.Escenario.id >= 26 && salas_publicas.Escenario.id <= 55 || salas_publicas.Escenario.id >= 57 && salas_publicas.Escenario.id <= 74 || salas_publicas.Escenario.id >= 78 && salas_publicas.Escenario.id <= 96)
                    {
                        if (salas_publicas.Escenario.segundos_items_cmb > 0) { salas_publicas.Escenario.segundos_items_cmb--; }//Contadores areas Cementerio - Bosque - Madirguera
                        else
                        {
                            if (salas_publicas.Escenario.id >= 26 && salas_publicas.Escenario.id <= 55) //Items Cementerio
                            {
                                int Type = new Random().Next(1, 3);
                                int ListaObjetos = 0;
                                if (Type == 1) { ListaObjetos = new Random().Next(7, 13); }
                                if (Type == 2) { ListaObjetos = new Random().Next(14, 22); }
                                ConcursosManager.Lanzar_Objeto(salas_publicas, ListaObjetos, "segundos_items_cmb");
                            }
                            if (salas_publicas.Escenario.id >= 57 && salas_publicas.Escenario.id <= 74)//Items Bosque
                            {
                                int Objeto_Bosque = new Random().Next(1, 6);
                                if (Objeto_Bosque == 3)
                                {
                                    ConcursosManager.Lanzar_Objeto(salas_publicas, 22, "segundos_items_cmb");
                                } //Donut congelado
                                else
                                {
                                    ConcursosManager.Lanzar_Objeto(salas_publicas, 23, "segundos_items_cmb");
                                } //Bola de nieve
                            }
                            if (salas_publicas.Escenario.id >= 78 && salas_publicas.Escenario.id <= 96)//Items Madriguera
                            {
                                ConcursosManager.Lanzar_Objeto(salas_publicas, 24, "segundos_items_cmb");
                            }
                        }
                    }
                }
            }
            foreach (SalaInstance salas_privadas in SalasManager.Salas_Privadas.Values)
            {
                if (salas_privadas.Visitantes > 0)//Items que caen en islas
                {
                    if (salas_privadas.Escenario.segundos_cofre > 0) { salas_privadas.Escenario.segundos_cofre--; }
                    else
                    {
                        int cofre_type = new Random().Next(1, 20);
                        if (cofre_type == 10) { ConcursosManager.Lanzar_Objeto(salas_privadas, 1, "segundos_cofre"); }//Oro
                        else if (cofre_type == 5 || cofre_type == 9) { ConcursosManager.Lanzar_Objeto(salas_privadas, 29, "segundos_cofre"); }//Caja Pocion
                        else
                        {
                            ConcursosManager.Lanzar_Objeto(salas_privadas, 2, "segundos_cofre");// Cofre Plata
                        }
                    }
                }
            }
        }
        static void AntiAutoclick_Sistem_Manager()
        {
            foreach (SessionInstance Session in UserManager.UsuariosOnline.Values)
            {
                if (Session.User != null)
                {
                    if (Session.User.Sala != null)
                    {
                        if (Session.User.contador_fa > 0) { Session.User.contador_fa--; }
                        if (Session.User.Clicks_Upper > 0) { Session.User.Clicks_Upper = 0; }
                    }
                }
            }
        }
        static void AntiAutoclickBoomBangTV_Manager()
        {
            foreach (SessionInstance Session in UserManager.UsuariosOnline.Values)
            {
                if (Session.User != null)
                {
                    if (Session.User.Sala != null)
                    {
                        if (Session.User.Clicks_Accion > 0 && Session.User.Click_Caminar > 0) { UserManager.Desactivar_Usuario(Session); }
                        //if (Session.User.Click_Pared > 0 && Session.User.Click_Caminar > 0) { UserManager.Desactivar_Usuario(Session); }
                        if (Session.User.Click_Pared > 0 && Session.User.Clicks_Upper > 0) { UserManager.Desactivar_Usuario(Session); }
                        if (Session.User.Click_Pared > 0 || Session.User.Click_Caminar > 0 || Session.User.Clicks_Accion > 0)
                        {
                            Session.User.Click_Pared = 0;
                            Session.User.Clicks_Accion = 0;
                            Session.User.Click_Caminar = 0;
                        }
                    }
                }
            }
        }
        static void Sestema_Loteria_Semanal_Manager()
        {
            foreach (var Sala in SalasManager.Salas_Publicas.Values)
            {
                if (Sala.Escenario.nombre != "Beluga Beach") return;
                if (Time.GetDifference(Sala.Escenario.loteria_semanal) <= 0)//Entrega Loteria Semanal
                {
                    mysql client = new mysql();

                    Sala.Escenario.loteria_semanal = Time.GetCurrentAndAdd(AddType.Dias, 7);
                    new Thread(() => client.ExecuteNonQuery("UPDATE escenarios_publicos SET loteria_semanal = '" + Sala.Escenario.loteria_semanal + "'")).Start();
                    Entrega_Loteria();
                    Output.WriteLine("[BoomBang Manager] -> Ha terminado la Loteria semanal.");
                }
            }
        }
        static void Sestema_Catalago_Manager()
        {
            DayOfWeek day = DateTime.Now.DayOfWeek;
            DateTime time = DateTime.Now;
            string dayToday = day.ToString();
            if (dayToday == "Friday" && Catalago_Viernes == true && time.Hour == 0)//Friday
            {
                Catalago_Viernes = false;
                mysql client = new mysql();

                Random random = new Random();
                new Thread(() => client.ExecuteNonQuery("UPDATE objetos SET limitado = 0 WHERE limitado = 1")).Start();
                int Objeto = listas.Lista_Todos_Objetos_Oro.Count;
                if (Objeto <= 0) return;
                for (int i = 0; i < 11; i++)
                {
                    int Obtener_Objeto = random.Next(Objeto);
                    int idRandom = listas.Lista_Todos_Objetos_Oro[Obtener_Objeto];
                    new Thread(() => client.ExecuteNonQuery("UPDATE objetos SET limitado = 1 WHERE id = '" + idRandom + "'")).Start();
                }
                Output.WriteLine("[BoomBang Manager] -> El catalago ha sido renovado.");

                new Thread(() => Noticia_Query(client, "¡Catalago Viernes!", "Ya están disponibles los nuevos objetos con un descuento del 20% en set New!. Echale un vistazo y aprovecha las ofertas que tenemos en nuestra SHOP y también las actualizaciones de cada viernes.")).Start();//Poner noticia

            }
            if (dayToday == "Saturday" && Catalago_Viernes == false) { Catalago_Viernes = true; }
        }
        static void Entrega_Loteria()
        {
            mysql client = new mysql();

            int total_tickets = 0;
            bool usuario_online = false;
            foreach (DataRow row in client.ExecuteQueryTable("SELECT * FROM objetos_comprados WHERE objeto_id = 871").Rows)
            {
                total_tickets++;
            }
            if (total_tickets == 0) { Publicar_Noticia_Loteria(true, "", 0); }
            if (total_tickets > 0)
            {
                Random numero = new Random();
                int numero_ganador = numero.Next(1, total_tickets + 1);
                DataRow sacar_el_numero = client.ExecuteQueryRow("SELECT * FROM objetos_comprados WHERE loteria_numero = '" + numero_ganador + "'");
                if (sacar_el_numero != null)
                {
                    foreach (SessionInstance Session in UserManager.UsuariosOnline.Values)
                    {
                        if (Session.User.id == (int)sacar_el_numero["usuario_id"])
                        {
                            int oro_premio = (250 * total_tickets) + 5000;
                            SessionInstance OtherSession = UserManager.ObtenerSession((int)sacar_el_numero["usuario_id"]);
                            UserManager.Creditos(OtherSession.User, true, true, oro_premio);
                            Publicar_Noticia_Loteria(false, OtherSession.User.nombre, oro_premio);
                            client.ExecuteNonQuery("DELETE FROM objetos_comprados WHERE objeto_id = 871");
                            Output.WriteLine("[BoomBang Manager] -> Los premios de Loteria han sido entregados.");
                            usuario_online = true;
                        }
                    }
                    if (usuario_online == true) { return; }
                    DataRow busca_nombre_jugador = client.ExecuteQueryRow("SELECT * FROM usuarios WHERE id = '" + (int)sacar_el_numero["usuario_id"] + "'");
                    int oro_usuario = (int)busca_nombre_jugador["oro"];
                    int oro_ganado = oro_usuario + ((250 * total_tickets) + 5000);
                    client.ExecuteNonQuery("UPDATE usuarios SET oro = '" + oro_ganado + "' WHERE id = '" + (int)sacar_el_numero["usuario_id"] + "'");
                    client.ExecuteNonQuery("DELETE FROM objetos_comprados WHERE objeto_id = 871");
                    Publicar_Noticia_Loteria(false, (string)busca_nombre_jugador["nombre"], 250 * total_tickets + 5000);
                    Output.WriteLine("[BoomBang Manager] -> Los premios de Loteria han sido entregados.");
                }
            }
        }
        static void Publicar_Noticia_Loteria(bool no_hay_ganadores, string Nombre_Ganador, int oro)
        {
            mysql client = new mysql();

            if (no_hay_ganadores == false)
            {
                new Thread(() => Noticia_Query(client, "¡Loteria ha terminado!", "Gracias a todas las personas que participaron en la lotería semanal de BoomBang.\r\rHa empezado nueva ronda de lotería que acaba en 7 días - " + CatalogoHandler.Fecha_Loteria_Final + "\r\rSi deseas participar en la lotería semanal, compra el ticket de lotería en nuestro catálogo. El ticket se localiza en el Set News y su valor es de 2.000 créditos.\r\rGanador de la loteria: " + Nombre_Ganador + " , créditos ganados: " + oro + "")).Start();
            }
            else
            {
                new Thread(() => Noticia_Query(client, "¡Loteria ha terminado!", "Gracias a todas las personas que participaron en la lotería semanal de BoomBang.\r\rDesgraciadamente esta semana no hubo un ganador de la lotería :(\r\rHa empezado nueva ronda de lotería que acaba en 7 días - " + CatalogoHandler.Fecha_Loteria_Final + "\r\rSi deseas participar en la lotería semanal, compra el ticket de lotería en nuestro catálogo.\rEl ticket se localiza en el Set News y su valor es de 2.000 créditos.")).Start();
            }
        }
        static void Fechas_Manager()
        {
            foreach (var Sala in SalasManager.Salas_Publicas.Values)
            {
                if (Sala.Escenario.nombre != "Beluga Beach") return;
                TimeSpan tiempo_ranking_semanal = TimeSpan.FromSeconds(Time.GetDifference(Sala.Escenario.ranking_semanal));
                TimeSpan tiempo_loteria_semanal = TimeSpan.FromSeconds(Time.GetDifference(Sala.Escenario.loteria_semanal));
                DateTime fecha_final_ranking_semanal = DateTime.Now.Add(tiempo_ranking_semanal);
                DateTime fecha_final_loteria_semanal = DateTime.Now.Add(tiempo_loteria_semanal);
                Fecha_Ranking_Semanal = Convert.ToString(fecha_final_ranking_semanal);
                CatalogoHandler.Fecha_Loteria_Final = Convert.ToString(fecha_final_loteria_semanal);
                if (Time.GetDifference(Sala.Escenario.tiempo_evento) > 0)
                {
                    TimeSpan tiempo_evento = TimeSpan.FromSeconds(Time.GetDifference(Sala.Escenario.tiempo_evento));
                    DateTime fecha_final_evento = DateTime.Now.Add(tiempo_evento);
                    InterfazHandler.Fecha_Evento_Semanal = Convert.ToString(fecha_final_evento);
                }
            }
        }
        static void Noticia_Query(mysql client,string titulo, string contenido)
        {
            client.SetParameter("titulo", titulo);
            client.SetParameter("contenido", contenido);
            client.SetParameter("tipo_plantilla", 3);
            client.SetParameter("url_1", "");
            client.SetParameter("fecha", DateTime.Now.Year + "-" + DateTime.Now.Month + "-" + DateTime.Now.Day);
            client.ExecuteNonQuery("INSERT INTO noticias (`titulo`, `contenido`, `tipo_plantilla`, `url_1`, `fecha`) VALUES (@titulo, @contenido, @tipo_plantilla, @url_1, @fecha)");

            client.ExecuteNonQuery("UPDATE usuarios SET novedades_noticias = 1");
            Output.WriteLine("[BoomBang Manager] -> La noticia de Loteria ha sido publicada.");
        }
        static void Alerta_Automatica_Manager()
        {
            foreach (SessionInstance Session in UserManager.UsuariosOnline.Values.ToList())
            {
                if (Session.User != null)
                {
                    if (Session.User.Sala != null)
                    {
                        Random randoom = new Random();
                        int notificacion = randoom.Next(1, 6);
                        if (notificacion == 1) { NotificacionesManager.NotifiChat(Session, "Sabio: Escribe en el chat /info para consultar tus estadísticas especiales."); }
                        if (notificacion == 2) { NotificacionesManager.NotifiChat(Session, "Sabio: Consulta tu posición en ranking de uppers. Escribe en el chat /upper"); }
                        if (notificacion == 3) { NotificacionesManager.NotifiChat(Session, "Sabio: Participa en lotería semanal. Compra un ticket dorado en Set New del catalogo."); }
                        if (notificacion == 4) { NotificacionesManager.NotifiChat(Session, "Sabio: Cada viernes nuevos objetos están de rebaja en Set New del catalogo."); }
                        if (notificacion == 5) { NotificacionesManager.NotifiChat(Session, "Sabio: ¿Has escuchado sobre Igloo? El oso polar dice que caen cocos y shurikens."); }
                    }
                }
            }
        }
    }
}
