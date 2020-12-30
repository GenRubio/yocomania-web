using BoomBang.game.instances;
using BoomBang.game.instances.manager;
using BoomBang.game.manager;
using BoomBang.game.packets;
using BoomBang.server;
using System;
using System.Collections.Generic;
using System.Data;
using System.Linq;
using System.Text;
using System.Text.RegularExpressions;
using System.Threading;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace BoomBang.game.handler
{
    class InterfazHandler
    {
        public static void Start()
        {
            HandlerManager.RegisterHandler(133, new ProcessHandler(ChatPublico));
            HandlerManager.RegisterHandler(136, new ProcessHandler(ChatPrivado));
            HandlerManager.RegisterHandler(134, new ProcessHandler(Acciones));
            HandlerManager.RegisterHandler(145, new ProcessHandler(UppertPower));
            HandlerManager.RegisterHandler(131, new ProcessHandler(CambiarCoco));
            HandlerManager.RegisterHandler(149, new ProcessHandler(Coco));
            HandlerManager.RegisterHandler(129, new ProcessHandler(Cambiar_Uppercut));
            HandlerManager.RegisterHandler(137, new ProcessHandler(Enviar_Interaccion));
            HandlerManager.RegisterHandler(141, new ProcessHandler(Cancelar_Interaccion));
            HandlerManager.RegisterHandler(140, new ProcessHandler(Rechazar_Interaccion));
            HandlerManager.RegisterHandler(139, new ProcessHandler(Aceptar_Interaccion));
            HandlerManager.RegisterHandler(158, new ProcessHandler(Bocadillo));
            HandlerManager.RegisterHandler(156, new ProcessHandler(Hobbies));
            HandlerManager.RegisterHandler(157, new ProcessHandler(Deseos));
            HandlerManager.RegisterHandler(152, new ProcessHandler(remuneracion_plata));
            HandlerManager.RegisterHandler(125120, new ProcessHandler(ActivarTraje));
            HandlerManager.RegisterHandler(125121, new ProcessHandler(DesactivarTraje));
            HandlerManager.RegisterHandler(167, new ProcessHandler(Votos_Restantes));
            HandlerManager.RegisterHandler(155, new ProcessHandler(Votos));
            HandlerManager.RegisterHandler(210125, new ProcessHandler(None_210_125));
            HandlerManager.RegisterHandler(202120, new ProcessHandler(ver_informacion_user));
            HandlerManager.RegisterHandler(142, new ProcessHandler(None_142));
            HandlerManager.RegisterHandler(138, new ProcessHandler(None_138));
        }
        public static string Fecha_Evento_Semanal = "";
        public static string Fecha_Evento_Global = "";
        static void None_138(SessionInstance Session, string[,] Parameter)
        {

        }
        static void None_142(SessionInstance Session, string[,] Parameter)
        {

        }
        static void ver_informacion_user(SessionInstance Session, string[,] Parameter)
        {
            if (Session.User != null)
            {
                if (Session.User.PreLock__Proteccion_SQL == true) return;
                if (Session.User.Sala != null)
                {
                    if (Session.User.id == Convert.ToInt32(Parameter[0, 0])) return;
                    ver_informacion_user_Manager(Session, Parameter);
                    Packet_202_120(Session);
                    Session.User.PreLock__Proteccion_SQL = true;
                }
            }
        }
        static void None_210_125(SessionInstance Session, string[,] Parameter)
        {
             Packet_210_125(Session);
        }
        static void Votos(SessionInstance Session, string[,] Parameters)
        {
            if (Session != null)
            {
                if (Session.User != null)
                {
                    if (Session.User.Sala != null)
                    {
                        if (Session.User.VotosRestantes >= 1)
                        {
                            SessionInstance OtherSession = Session.User.Sala.ObtenerSession(int.Parse(Parameters[0, 0]));
                            if (OtherSession != null)
                            {
                                if (OtherSession.User.Sala != null)
                                {
                                    if (Session.User.Sala.Escenario.id != OtherSession.User.Sala.Escenario.id) return;
                                    if (Session.User.id == OtherSession.User.id) { Session.FinalizarConexion("Votos"); return; }
                                    Votos(Session, OtherSession, Parameters);
                                    Packet_155(Session, int.Parse(Parameters[0, 0]), int.Parse(Parameters[1, 0]), int.Parse(Parameters[2, 0]));
                                }
                            }
                        }
                    }
                }
            }
        }
        static void Votos_Restantes(SessionInstance Session, string[,] Parameters)
        {
            if (Session.User != null)
            {
                if (Session.User.Sala != null)
                {
                    Votos_Restantes(Session);
                    Packet_167(Session);
                }
            }
        }
        public static void Desactivar_Usuario_Conexion(SessionInstance Session)
        {
            Session.FinalizarConexion("Desactivar_Usuario_Conexion");
        }
        static void remuneracion_plata(SessionInstance Session, string[,] Parameters)
        {
            if (Session.User != null)
            {
                remuneracion_plata(Session);
                 Packet_152(Session);
            }
        }
        static void DesactivarTraje(SessionInstance Session, string[,] Parameters)
        {
            if (Session.User != null)
            {
                if (Session.User.Sala != null)
                {
                    if (Session.User.Efecto != 0) return;
                    if (Session.User.PreLock_Disfraz == true) { Packet_143(Session); return; }
                    if (Session.User.ModoNinja == true)
                    {
                        DesactivarTraje(Session);
                        Packet_125_120(Session, Session.User.id, Session.User.avatar, Session.User.colores, true);
                        Packet_125_121(Session);
                    }
                }
            }
        }
        static void ActivarTraje(SessionInstance Session, string[,] Parameters)
        {
            if (Session.User != null)
            {
                if (Session.User.Sala != null)
                {
                    if (Session.User.PreLock_Interactuando == true) return;
                    if (Session.User.PreLock_Disfraz == true) {  Packet_143(Session); return; }
                    if (Session.User.ModoNinja == true) return;
                    ActivarTraje_Manager(Session, Parameters);
                }
            }
        }
        static void Deseos(SessionInstance Session, string[,] Parameters)
        {
            if (Session.User != null)
            {
                if (Session.User.Sala != null)
                {
                    if (Session.User.PreLock_Ficha == true) return;
                    Deseos_Manager(Session, Parameters);
                     Packet_157(Session, int.Parse(Parameters[1, 0]), Parameters[2, 0]);
                    Session.User.PreLock_Ficha = true;
                }
            }
        }
        static void Hobbies(SessionInstance Session, string[,] Parameters)
        {
            if (Session.User != null)
            {
                if (Session.User.Sala != null)
                {
                    if (Session.User.PreLock_Ficha == true) return;
                    Hobbies_Manager(Session, Parameters);
                     Packet_156(Session, int.Parse(Parameters[1, 0]), Parameters[2, 0]);
                    Session.User.PreLock_Ficha = true;
                }
            }
        }
        static void Bocadillo(SessionInstance Session, string[,] Parameters)
        {
            if (Session.User != null)
            {
                if (Session.User.Sala != null)
                {
                    if (Session.User.PreLock_Ficha == true) return;
                    Bocadillo_Manager(Session, Parameters);
                }
            }
        }
        static void Aceptar_Interaccion(SessionInstance Session, string[,] Parameters)
        {
            if (Session.User != null)
            {
                if (Session.User.Sala != null)
                {
                    if (Session.User.Sala.Escenario.es_categoria == 2) return;
                   Aceptar_Interaccion_Manager(Session, Parameters);
                }
            }
        }
        static void Rechazar_Interaccion(SessionInstance Session, string[,] Parameters)
        {
            if (Session.User != null)
            {
                if (Session.User.Sala != null)
                {
                    if (Session.User.Sala.Escenario.es_categoria == 2) return;
                    SessionInstance OtherSession = Session.User.Sala.ObtenerSession(int.Parse(Parameters[1, 0]));
                    if (OtherSession != null)
                    {
                        if (Session.User.Sala.EliminarInteraccion(OtherSession.User.IDEspacial, Session.User.IDEspacial))
                        {
                             Packet_140(Session, OtherSession, int.Parse(Parameters[0, 0]));
                        }
                    }
                }
            }
        }
        static void Cancelar_Interaccion(SessionInstance Session, string[,] Parameters)
        {
            if (Session.User != null)
            {
                if (Session.User.Sala != null)
                {
                    SessionInstance OtherSession = Session.User.Sala.ObtenerSession(int.Parse(Parameters[2, 0]));
                    if (OtherSession != null)
                    {
                        if (Session.User.Sala.Escenario.es_categoria == 2) return;
                        if (Session.User.Sala.Escenario.id != OtherSession.User.Sala.Escenario.id) return;
                        if (Session.User.Sala.EliminarInteraccion(Session.User.IDEspacial, OtherSession.User.IDEspacial))
                        {
                             Packet_141(Session, OtherSession, int.Parse(Parameters[0, 0]));
                        }
                    }
                }
            }
        }
        static void Enviar_Interaccion(SessionInstance Session, string[,] Parameters)
        {
            if (Session.User != null)
            {
                if (Session.User.Sala != null)
                {
                    SessionInstance OtherSession = Session.User.Sala.ObtenerSession(int.Parse(Parameters[2, 0]));
                    if (OtherSession != null)
                    {
                        if (Session.User.Sala.Escenario.es_categoria == 2) return;
                        if (Session.User.Sala.Escenario.id != OtherSession.User.Sala.Escenario.id) return;
                        if (Session.User.Sala.AñadirInteraccion(Session.User.IDEspacial, OtherSession.User.IDEspacial))
                        {
                             Packet_137(Session, OtherSession, int.Parse(Parameters[0, 0]));
                        }
                    }
                }
            }
        }
        static void Cambiar_Uppercut(SessionInstance Session, string[,] Parameters)
        {
            if (Session.User != null)
            {
                if (Session.User.Sala != null)
                {
                    int Nivel = int.Parse(Parameters[0, 0]);
                    if (Nivel < 0) return;
                    if (Nivel > Session.User.UppertLevel()) return;
                    Session.User.UppertSelect = Nivel;
                     Packet_129(Session);
                }
            }
        }
        static void CambiarCoco(SessionInstance Session, string[,] Parameters)
        {
            if (Session.User != null)
            {
                if (Session.User.Sala != null)
                {
                    int nivel = int.Parse(Parameters[0, 0]);
                    if (nivel >= 0 && nivel <= (Session.User.nivel_coco + 1))
                    {
                        Session.User.CocoSelect = nivel;
                         Packet_131(Session, Session.User.CocoSelect);
                    }
                }
            }
        }
        static void Coco(SessionInstance Session, string[,] Parameters)
        {
            if (Session.User != null)
            {
                if (Session.User.Sala != null)
                {
                    if (Session.User.Sala.Escenario.coco == -1) { return; }
                    if (Session.User.Sala.Escenario.es_categoria == 2)
                    {
                        if (Session.User.Sala.Ring != null)
                        {
                            if (Session.User.Sala.Ring.Iniciado == false) return;
                            if (Session.User.Sala.Ring.Participando(Session) == false) return;
                        }
                        if (Session.User.Sala.Cocos != null)
                        {
                            if (Session.User.Sala.Cocos.Iniciado == false) return;
                            if (Session.User.Sala.Cocos.Participando(Session) == false) return;
                            if (Session.User.Sala.PathFinder == false) return;
                        }
                        if (Session.User.Sala.Sendero != null)
                        {
                            if (Session.User.Sala.Sendero.Iniciado == false) return;
                            if (Session.User.Sala.Sendero.Participando(Session) == false) return;
                            if (Session.User.Sala.PathFinder == false) return;
                        }
                        if (Session.User.Sala.Camino != null)
                        {
                            if (Session.User.Sala.Camino.Iniciado == false) return;
                            if (Session.User.Sala.Camino.Participando(Session) == false) return;
                            if (Session.User.Sala.PathFinder == false) return;
                        }
                    }
                    if (Session.User.oro >= 0)
                    {
                        if (Session.User.Sala.Escenario.anti_coco == true) { NotificacionesManager.NotifiChat(Session, "Sabio: Los cocos estan desactivados en esta Sala."); return;  }
                        SessionInstance MySession = Session.User.Sala.ObtenerSession(int.Parse(Parameters[0, 0]));
                        SessionInstance OtherSession = Session.User.Sala.ObtenerSession(int.Parse(Parameters[1, 0]));
                        if (MySession != null && OtherSession != null)
                        {
                            if (MySession.User.id == OtherSession.User.id) { Session.FinalizarConexion("Coco"); return; }
                            if (MySession.User.id != Session.User.id) { Session.FinalizarConexion("Coco"); return; }
                            if (MySession.User.Sala.Escenario.id != OtherSession.User.Sala.Escenario.id) return;
                            if (OtherSession.User.PreLock_Interactuando != true && !PocionesHandler.Pociones_No_Upper_Coco.Contains(OtherSession.User.Efecto) && !PocionesHandler.Pociones_No_Upper_Coco.Contains(Session.User.Efecto))
                            {
                                Coco(Session, OtherSession, 0);
                            }
                            else
                            {
                                 Packet_143(Session);
                            }
                        }
                    }
                }
            }
        }
        public static List<int> Cada_X_Goldens = new List<int>();
        private static void UppertPower(SessionInstance Session, string[,] Parameters)
        {
            try
            {
                if (Session.User != null)
                {
                    if (Session.User.Sala != null)
                    {
                        Session.User.Clicks_Upper++;
                        if (Session.User.Clicks_Upper > 9)
                        {
                            Packet_144(Session);
                            return;
                        }
                        if (Session.User.Sala.Usuarios.ContainsKey(int.Parse(Parameters[1, 0])) && Session.User.Sala.Usuarios.ContainsKey(int.Parse(Parameters[4, 0])))
                        {
                            SessionInstance OtherSession = Session.User.Sala.Usuarios[int.Parse(Parameters[4, 0])];
                            if (Session.User.Posicion.x != int.Parse(Parameters[2, 0]) || Session.User.Posicion.y != int.Parse(Parameters[3, 0])) return;
                            if (OtherSession.User.Posicion.x != int.Parse(Parameters[5, 0]) || OtherSession.User.Posicion.y != int.Parse(Parameters[6, 0])) return;
                            if (Session.User.Sala.Escenario.uppert == -1 || Session.User.IDEspacial == int.Parse(Parameters[4, 0])) { Session.FinalizarConexion("UppertPower"); return; }
                            if (Session.User.Sala.Escenario.categoria == 2)
                            {
                                IslaInstance Isla = IslasManager.ObtenerIsla(Session.User.Sala.Escenario.IslaID);
                                if (Isla != null) { if (Isla.uppert == 0) return; }
                            }
                            if (Session.User.oro >= 0)
                            {
                                if (Session.User.block_upper == true) return;
                                if (OtherSession.User.block_upper == true) return;
                                int Derecha = Session.User.Posicion.x - OtherSession.User.Posicion.x;
                                int Izquierda = Session.User.Posicion.y - OtherSession.User.Posicion.y;
                                if (Derecha == 1 && Izquierda == 1 && !PocionesHandler.Pociones_No_Upper_Coco.Contains(OtherSession.User.Efecto) && !PocionesHandler.Pociones_No_Upper_Coco.Contains(Session.User.Efecto) || Derecha == -1 && Izquierda == -1 && !PocionesHandler.Pociones_No_Upper_Coco.Contains(OtherSession.User.Efecto) && !PocionesHandler.Pociones_No_Upper_Coco.Contains(Session.User.Efecto))
                                {
                                    if (Session.User.PreLock_Interactuando != true && OtherSession.User.PreLock_Interactuando != true)
                                    {
                                        Session.User.Trayectoria.DetenerMovimiento();
                                        OtherSession.User.Trayectoria.DetenerMovimiento();
                                        UppertPower(Session, OtherSession, Parameters);

                                    }
                                    else { Packet_143(Session); }
                                }
                                else
                                {
                                    Packet_144(Session);
                                }
                            }
                        }
                    }
                }
            }
            catch
            {
                return;
            }
        }
        static void Acciones(SessionInstance Session, string[,] Parameters)
        {
            if (Session.User != null)
            {
                if (Session.User.Sala != null)
                {
                    Session.User.Clicks_Accion++;
                    if (Session.User.contar_pasos > 0) return;
                    if (Session.User.PreLock_Acciones_Ficha == true) return;
                    if (Session.User.contador_fa != 0) return;
                    if (Session.User.Click_Caminar > 0) return;
                    int accion = int.Parse(Parameters[1, 0]);
                    if (accion == 1) { Session.User.Time_Acciones_Ficha = Time.GetCurrentAndAdd(AddType.Segundos, 2); Session.User.contador_fa = 2; }
                    if (accion == 2) { Session.User.Time_Acciones_Ficha = Time.GetCurrentAndAdd(AddType.Segundos, 3); Session.User.contador_fa = 3; }
                    if (accion == 3) { Session.User.Time_Acciones_Ficha = Time.GetCurrentAndAdd(AddType.Segundos, 3); Session.User.contador_fa = 3; }
                    if (accion == 4) { Session.User.Time_Acciones_Ficha = Time.GetCurrentAndAdd(AddType.Segundos, 2); Session.User.contador_fa = 2; }
                    if (accion == 5) { Session.User.Time_Acciones_Ficha = Time.GetCurrentAndAdd(AddType.Segundos, 2); Session.User.contador_fa = 2; }
                    if (accion == 6) { Session.User.Time_Acciones_Ficha = Time.GetCurrentAndAdd(AddType.Segundos, 4); Session.User.contador_fa = 4; }
                    if (accion == 7) { Session.User.Time_Acciones_Ficha = Time.GetCurrentAndAdd(AddType.Segundos, 3); Session.User.contador_fa = 3; }
                    if (accion == 8) { Session.User.Time_Acciones_Ficha = Time.GetCurrentAndAdd(AddType.Segundos, 8); Session.User.contador_fa = 8; }
                    Session.User.Trayectoria.DetenerMovimiento();
                    Packet_134(Session, accion);
                }
            }
        }
        static void ChatPrivado(SessionInstance Session, string[,] Parameters)
        {
            if (Session.User.PreLock_BloqueoChat) return;
            Session.User.PreLock_BloqueoChat = true;
            int OtherUserID = int.Parse(Parameters[0, 0]);
            string mensaje = Parameters[1, 0];
             Packet_136(Session, mensaje, OtherUserID);
        }
        static void ChatPublico(SessionInstance Session, string[,] Parameters)
        {
            if (Session.User.PreLock_BloqueoChat) return;
            Session.User.PreLock_BloqueoChat = true;
            if (Session.User.Sala != null)
            {
                string mensaje = Parameters[1, 0];
                if (mensaje.StartsWith("@") && Session.User.admin == 1)
                {
                    if (Session.User.admin != 1) return;
                    if (!Command_Invoker(Session, mensaje)) NotificacionesManager.NotifiChat(Session, "¡El comando ingresado no existe!");
                    return;
                }
                if (mensaje.StartsWith("/"))
                {
                    if (!Command_Invoker_Client(Session, mensaje))
                        return;
                }
                if (Session.User.Efecto == 4) { NotificacionesManager.NotifiChat(Session, "Sabio: No podras escribir hasta que se acabe el efecto"); return; }
                if (Session.User.Efecto == 5)
                {
                    if (mensaje.Contains("a")) { mensaje = mensaje.Replace("a", "ñ"); }
                    if (mensaje.Contains("A")) { mensaje = mensaje.Replace("A", "!"); }
                    if (mensaje.Contains("S")) { mensaje = mensaje.Replace("S", "."); }
                    if (mensaje.Contains("s")) { mensaje = mensaje.Replace("s", "@"); }
                    if (mensaje.Contains("R")) { mensaje = mensaje.Replace("R", "-"); }
                    if (mensaje.Contains("r")) { mensaje = mensaje.Replace("r", "("); }
                    if (mensaje.Contains("N")) { mensaje = mensaje.Replace("N", ")"); }
                    if (mensaje.Contains("n")) { mensaje = mensaje.Replace("n", "*"); }
                    if (mensaje.Contains("D")) { mensaje = mensaje.Replace("D", "ñ"); }
                    if (mensaje.Contains("d")) { mensaje = mensaje.Replace("d", ";"); }
                    if (mensaje.Contains("L")) { mensaje = mensaje.Replace("L", "{"); }
                    if (mensaje.Contains("l")) { mensaje = mensaje.Replace("l", "#"); }
                    if (mensaje.Contains("C")) { mensaje = mensaje.Replace("C", "+"); }
                    if (mensaje.Contains("c")) { mensaje = mensaje.Replace("c", "_"); }
                    if (mensaje.Contains("t")) { mensaje = mensaje.Replace("t", "%"); }
                    if (mensaje.Contains("m")) { mensaje = mensaje.Replace("m", "&"); }
                     Packet_133(Session, mensaje);
                    return;
                }
                if (Session.User.Efecto == 6)
                {
                    string mensaje_new = "";
                    for (int x = mensaje.Length - 1;x >= 0; x--)
                    {
                        mensaje_new += mensaje[x];
                    }
                     Packet_133(Session, mensaje_new);
                    return;
                }
                if (Session.User.contador_frase == 0) { Session.User.contador_frase++; Session.User.primera_frase = mensaje; }
                if (mensaje != Session.User.primera_frase) { Session.User.contador_frase = 0; }
                else if (mensaje == Session.User.primera_frase) { Session.User.contador_frase++; }
                 Packet_133(Session, mensaje);
                if (Session.User.contador_frase == 7) { Session.FinalizarConexion("ChatPublico"); }
            }
        }
        //Codigo Luis
        private static void SendUppercut(SessionInstance Session, SessionInstance OtherSession)
        {
            if (Session.User.oro >= Session.User.Sala.Escenario.uppert)
            {
                if (Session.User.PreLock_Interactuando != true && OtherSession.User.PreLock_Interactuando != true)
                {
                    Session.User.Time_Interactuando = Time.GetCurrentAndAdd(AddType.Segundos, 14);
                    OtherSession.User.Time_Interactuando = Time.GetCurrentAndAdd(AddType.Segundos, 17);
                    Session.User.Trayectoria.DetenerMovimiento();
                    OtherSession.User.Trayectoria.DetenerMovimiento();
                    if (Session.User.Sala.Escenario.es_categoria == 2)
                    {
                        if (Session.User.Sala.Ring != null)
                        {
                            if (Session.User.Sala.Ring.Iniciado == false) return;
                            Session.User.Sala.Ring.Descalificar(OtherSession);
                            new Thread(() => Uppert_Kick(OtherSession, Session.User.Sala, false)).Start();
                        }
                    }
                    else
                    {
                        new Thread(() => Uppert_Kick(OtherSession, Session.User.Sala)).Start();
                        Session.User.uppers_enviados++;
                        OtherSession.User.uppers_recibidos++;
                        Session.User.Sala.ActualizarEstadisticas(Session.User);
                        Session.User.Sala.ActualizarEstadisticas(OtherSession.User);
                        UserManager.Creditos(Session.User, true, false, Session.User.Sala.Escenario.uppert);
                    }
                    ServerMessage SendUppert = new ServerMessage();
                    SendUppert.AddHead(145);
                    SendUppert.AppendParameter(4);
                    SendUppert.AppendParameter(Session.User.IDEspacial);
                    SendUppert.AppendParameter(Session.User.Posicion.x);
                    SendUppert.AppendParameter(Session.User.Posicion.y);
                    SendUppert.AppendParameter(OtherSession.User.IDEspacial);
                    SendUppert.AppendParameter(OtherSession.User.Posicion.x);
                    SendUppert.AppendParameter(OtherSession.User.Posicion.y);
                    Session.User.Sala.SendData(SendUppert);
                }
            }
        }
        //End Codigo
        private static void UppertPower(SessionInstance Session, SessionInstance OtherSession, string[,] Parameters)
        {
            if (OtherSession.User.Posicion.x == Session.User.Sala.Puerta.x && Session.User.Sala.Usuarios[int.Parse(Parameters[4, 0])].User.Posicion.y == Session.User.Sala.Puerta.y || Session.User.Posicion.x == Session.User.Sala.Puerta.x && Session.User.Posicion.y == Session.User.Sala.Puerta.y)
            {
                return;
            }
            Session.User.Time_Interactuando = Time.GetCurrentAndAdd(AddType.Segundos, 14);
            OtherSession.User.Time_Interactuando = Time.GetCurrentAndAdd(AddType.Segundos, 17);
            Session.User.Trayectoria.DetenerMovimiento();
            OtherSession.User.Trayectoria.DetenerMovimiento();

            if (Session.User.Sala.Escenario.es_categoria == 2)
            {
                if (Session.User.Sala.Ring != null)
                {
                    if (Session.User.Sala.Ring.Iniciado == false) return;
                    Session.User.Sala.Ring.Descalificar(OtherSession);
                    new Thread(() => Uppert_Kick(OtherSession, Session.User.Sala, false)).Start();
                    Session.User.PreLock_Disfraz = true;
                    if (OtherSession.User.ModoNinja == true)
                    {
                        if (Session.User.Ninja_Copi_color == true || Session.User.Traje_Ninja_Principal == 5) { Session.User.NinjaColores_Sala = OtherSession.User.NinjaColores_Sala; new Thread(() => Copiar_traje(Session)).Start(); }
                    }
                    Session.User.uppers_enviados++;
                    OtherSession.User.uppers_recibidos++;
                    Session.User.Sala.ActualizarEstadisticas(Session.User);
                    Session.User.Sala.ActualizarEstadisticas(OtherSession.User);
                }
            }
            else
            {
                new Thread(() => Uppert_Kick(OtherSession, Session.User.Sala)).Start();
                Session.User.PreLock_Disfraz = true;
                if (OtherSession.User.ModoNinja == true)
                {
                    if (Session.User.Ninja_Copi_color == true || Session.User.Traje_Ninja_Principal == 5) { Session.User.NinjaColores_Sala = OtherSession.User.NinjaColores_Sala; new Thread(() => Copiar_traje(Session)).Start(); }
                }
                if (Session.User.ninja_celestial_puesto == true) { Session.User.ninja_celestial = true; new Thread(() => Ninja_Celestial_Tiempo(Session)).Start(); }
                Session.User.uppers_enviados++;
                OtherSession.User.uppers_recibidos++;
                Session.User.Sala.ActualizarEstadisticas(Session.User);
                Session.User.Sala.ActualizarEstadisticas(OtherSession.User);
            }
            if (Session.User.uppers_enviados == 25 || Session.User.uppers_enviados == 50 || Session.User.uppers_enviados == 100 || Session.User.uppers_enviados == 200 || Session.User.uppers_enviados == 500 || Session.User.uppers_enviados == 1500 || Session.User.uppers_enviados == 3000 || Session.User.uppers_enviados == 6000 || Session.User.uppers_enviados == 9000)
            {
                NotificacionesManager.NotifiChat(Session, "Sabio: Felicidades has subido de Upper :)");
                Session.User.UppertSelect = Session.User.UppertLevel();
                NotificacionesManager.Juegos(Session, 2);
            }
            Packet_145(Session, OtherSession);
            RankingsManager.agregar_user_ranking(Session.User.id, 5, -1, 1);
        }
        private static void Coco(SessionInstance Session, SessionInstance OtherSession, int coco)
        {
            bool coco_viejo = false;
            if (OtherSession.User.Posicion.x == Session.User.Sala.Puerta.x && OtherSession.User.Posicion.y == Session.User.Sala.Puerta.y || Session.User.Posicion.x == Session.User.Sala.Puerta.x && Session.User.Posicion.y == Session.User.Sala.Puerta.y || OtherSession.User.block_coco == true)
            {
                return;
            }
            OtherSession.User.Trayectoria.DetenerMovimiento();
            if (Session.User.Sala.Escenario.es_categoria != 2)
            {
                switch (Session.User.CocoSelect)
                {
                    case 0:
                        OtherSession.User.Time_Interactuando = Time.GetCurrentAndAdd(AddType.Segundos, 6);
                        if (Session.User.vip == 1)
                        {
                            coco = 0;
                            coco_viejo = true;
                            new Thread(() => Coco_Thread(OtherSession, new TimeSpan(0, 0, 0, 6, 0), 0, Session.User.Sala)).Start();
                        }
                        else
                        {
                            coco = 35;
                            new Thread(() => Coco_Thread(OtherSession, new TimeSpan(0, 0, 0, 6, 0), 35, Session.User.Sala)).Start();
                        }                         
                        break;
                    case 1:
                        coco = 40;
                        OtherSession.User.Time_Interactuando = Time.GetCurrentAndAdd(AddType.Segundos, 2);
                        new Thread(() => Coco_Thread(OtherSession, new TimeSpan(0, 0, 0, 2, 0), 40, Session.User.Sala)).Start();
                        break;
                    case 2:
                        coco = 39;
                        OtherSession.User.Time_Interactuando = Time.GetCurrentAndAdd(AddType.Milisegundos, 4750);
                        new Thread(() => Coco_Thread(OtherSession, new TimeSpan(0, 0, 0, 4, 750), 39, Session.User.Sala)).Start();
                        break;
                    case 3:
                        coco = 38;
                        OtherSession.User.Time_Interactuando = Time.GetCurrentAndAdd(AddType.Milisegundos, 9300);
                        new Thread(() => Coco_Thread(OtherSession, new TimeSpan(0, 0, 0, 9, 300), 38, Session.User.Sala)).Start();
                        break;
                    case 4:
                        coco = 32;
                        OtherSession.User.Time_Interactuando = Time.GetCurrentAndAdd(AddType.Segundos, 7);
                        new Thread(() => Coco_Thread(OtherSession, new TimeSpan(0, 0, 0, 7, 0), 32, Session.User.Sala)).Start();
                        break;
                    case 5:
                        coco = 34;
                        OtherSession.User.Time_Interactuando = Time.GetCurrentAndAdd(AddType.Milisegundos, 14800);
                        new Thread(() => Coco_Thread(OtherSession, new TimeSpan(0, 0, 0, 14, 800), 34, Session.User.Sala)).Start();
                        break;
                    case 6:
                        coco = 37;
                        OtherSession.User.Time_Interactuando = Time.GetCurrentAndAdd(AddType.Milisegundos, 13200);
                        new Thread(() => Coco_Thread(OtherSession, new TimeSpan(0, 0, 0, 13, 200), 37, Session.User.Sala)).Start();
                        break;
                    case 7:
                        coco = 33;
                        OtherSession.User.Time_Interactuando = Time.GetCurrentAndAdd(AddType.Milisegundos, 9800);
                        new Thread(() => Coco_Thread(OtherSession, new TimeSpan(0, 0, 0, 9, 800), 33, Session.User.Sala)).Start();
                        break;
                    case 8:
                        coco = 36;
                        OtherSession.User.Time_Interactuando = Time.GetCurrentAndAdd(AddType.Milisegundos, 13700);
                        new Thread(() => Coco_Thread(OtherSession, new TimeSpan(0, 0, 0, 13, 700), 36, Session.User.Sala)).Start();
                        break;
                    case 9:
                        coco = 41;
                        OtherSession.User.Time_Interactuando = Time.GetCurrentAndAdd(AddType.Milisegundos, 16800);
                        new Thread(() => Coco_Thread(OtherSession, new TimeSpan(0, 0, 0, 16, 800), 41, Session.User.Sala)).Start();
                        break;

                    default: return;
                }
            }
            else
            {
                if (Session.User.CocosRestantes == 0) return;
                Session.User.CocosRestantes--;
                if (Session.User.CocosRestantes == 0)
                {
                    ServerMessage server3 = new ServerMessage();
                    server3.AddHead(175);
                    server3.AppendParameter(new object[] { 5, -1, 0 });
                    Session.SendData(server3);
                }
                coco = 35;
                OtherSession.User.Time_Interactuando = Time.GetCurrentAndAdd(AddType.Segundos, 6);
                new Thread(() => Coco_Thread(OtherSession, new TimeSpan(0, 0, 0, 6, 0), 35, Session.User.Sala)).Start();
            }
            if (!coco_viejo == true) { Packet_184_120(Session, OtherSession, coco); }
            else { Packet_149(OtherSession); }
            if (Session.User.Sala.Escenario.es_categoria != 2)
            {
                OtherSession.User.Trayectoria.DetenerMovimiento();
                OtherSession.User.cocos_recibidos++;
                Session.User.cocos_enviados++;
                Session.User.Sala.ActualizarEstadisticas(Session.User);
                Session.User.Sala.ActualizarEstadisticas(OtherSession.User);
            }
        }
        public static int key = 1;
        public static int modelo = 69;
        private static bool Command_Invoker(SessionInstance Session, string msg)
        {
            try
            {
                string[] array = Regex.Split(msg, " ");
                string WordStart = Regex.Split(array[0], "@")[1];
                switch (WordStart)
                {
                    case "a":
                        new Thread(() => change_planta(Session)).Start();
                        return true;
                    case "go":
                        SalasManager.IrAlli(Session, 1, 66);
                        return true;
                    case "mensaje":
                        ServerMessage mensaje = new ServerMessage();
                        mensaje.AddHead(209);
                        mensaje.AddHead(128);
                        mensaje.AppendParameter(0);
                        Session.SendData(mensaje);
                        return true;
                    case "alerta":
                        Packet_183();
                        return true;
                    case "cofre":
                        modelo++;
                        key++;
                        ServerMessage cofre = new ServerMessage();
                        cofre.AddHead(200);
                        cofre.AddHead(120);
                        cofre.AppendParameter(key);
                        cofre.AppendParameter(key);
                        cofre.AppendParameter(12);
                        cofre.AppendParameter(15);
                        cofre.AppendParameter(modelo);
                        cofre.AppendParameter(1);
                        cofre.AppendParameter(1);//TipoApertura
                        cofre.AppendParameter(3);//TiempoAparicion
                        Session.User.Sala.SendData(cofre);
                        return true;
                    case "objeto_npc":
                        NotificacionesManager.NotifiChat(Session, "Has colocado un objeto dentro de npc");
                        return true;

                    case "area":
                        int area_id = int.Parse(array[1]);
                        SalasManager.IrAlli(Session, 0, Convert.ToInt32(area_id), null);

                        return true;
                    case "npc":
                        string id = array[1];
                        mysql client = new mysql();
                        client.SetParameter("Modelo", id);
                        client.SetParameter("nombre", "npc" + id);
                        client.SetParameter("x", Session.User.Posicion.x);
                        client.SetParameter("y", Session.User.Posicion.y);
                        client.SetParameter("function", id);
                        client.SetParameter("EscenarioID", Session.User.Sala.Escenario.id);
                        client.ExecuteNonQuery("INSERT INTO escenarios_npc (`Modelo`, `nombre`, `x`, `y`, `function`, `EscenarioID`) VALUES (@Modelo, @nombre, @x, @y, @function, @EscenarioID)");
                        return true;
                    case "pos":
                        NotificacionesManager.NotifiChat(Session, "X: " + Session.User.Posicion.x + " Y: " + Session.User.Posicion.y + " Z: " + Session.User.Posicion.z + " modelo:" + Session.User.Sala.Escenario.modelo + " id:" + Session.User.Sala.Escenario.id + " es:" + Session.User.Sala.Escenario.es_categoria);
                        return true;
                    case "coco":
                        ServerMessage server = new ServerMessage();
                        server.AddHead(149);
                        server.AppendParameter(1);
                        server.AppendParameter(Session.User.IDEspacial);
                        server.AppendParameter(1);
                        Session.User.Sala.SendData(server, Session);
                        return true;
                    case "planta":
                        BuyObjectInstance Compra = CatalogoManager.ObtenerCompra(13965);
                        Packet_189_173(Session, Compra);
                        return true;
                    case "intervalo":
                        int numero = Convert.ToInt32(array[1]);
                        ServerThreads.intervalo_atv = numero;
                        NotificacionesManager.NotifiChat(Session, "Intervalo fijado en = " + numero);
                        return true;
                }
            }
            catch
            {
                NotificacionesManager.NotifiChat(Session, "Hubo un error al ejecutar el comando, intenta nuevamente.");
            }
            return false;
        }
        private static void actualizarFicha(SessionInstance session)
        {
            mysql client = new mysql();
            client.SetParameter("id", session.User.id);
            client.SetParameter("edad", session.User.edad);
            client.ExecuteNonQuery("UPDATE usuarios SET edad = @edad WHERE id = @id");
        }
        private static bool Command_Invoker_Client(SessionInstance Session, string msg)
        {
            try
            {
                string[] array = Regex.Split(msg, " ");
                string WordStart = Regex.Split(array[0], "/")[1];
                switch (WordStart)
                {
                    case "ficha":
                        if (Convert.ToDateTime(Session.User.fecha_registro) < Convert.ToDateTime("15/07/2020"))
                        {
                            string Titulo = "null";
                            string body = "null";
                            string footer = "null";
                            if (array.Length == 1)
                            {
                                Titulo = "Ficha Avatar" + "\n";
                                body = "Para poner tu ficha Beta usa el comando ' /ficha beta '" +
                                    "\n" +
                                    "Para quitar tu ficha Beta usa el comando ' /ficha normal ' ";
                                Packet_183(Session, Titulo + body + "\n" + footer);
                            }
                            else
                            {
                                string ficha = array[1];
                                if (ficha != "normal" && ficha != "beta")
                                {
                                    Titulo = "Ficha Avatar" + "\n";
                                    body = "Para poner tu ficha Beta usa el comando ' /ficha beta '" +
                                        "\n" +
                                        "Para quitar tu ficha Beta usa el comando ' /ficha normal ' ";
                                    Packet_183(Session, Titulo + body + "\n" + footer);
                                }
                                else
                                {
                                    if (ficha == "normal")
                                    {
                                        if (Session.User.edad != 1000)
                                        {
                                            NotificacionesManager.NotifiChat(Session, "Sabio: Ya tienes la ficha normal puesta.");
                                        }
                                        else
                                        {
                                            Session.User.edad = 19;
                                            NotificacionesManager.NotifiChat(Session, "Sabio: Has cambiado la ficha. Sal de la sala y " +
                                                "vuelve a entrar.");
                                            new Thread(() => actualizarFicha(Session)).Start();
                                        }
                                    }
                                    else if (ficha == "beta")
                                    {
                                        if (Session.User.edad == 1000)
                                        {
                                            NotificacionesManager.NotifiChat(Session, "Sabio: Ya tienes la ficha beta puesta.");
                                        }
                                        else
                                        {
                                            Session.User.edad = 1000;
                                            NotificacionesManager.NotifiChat(Session, "Sabio: Has cambiado la ficha. Sal de la sala y " +
                                                "vuelve a entrar.");
                                            new Thread(() => actualizarFicha(Session)).Start();
                                        }
                                    }
                                    else
                                    {
                                        Titulo = "Ficha Avatar" + "\n";
                                        body = "Para poner tu ficha Beta usa el comando ' /ficha beta '" +
                                            "\n" +
                                            "Para quitar tu ficha Beta usa el comando ' /ficha normal ' ";
                                        Packet_183(Session, Titulo + body + "\n" + footer);
                                    }
                                }
                            }
                          
                        }
                        return false;
                    case "setlook":
                        if (Session.User.PreLock__Proteccion_SQL == true) return false;
                        Session.User.PreLock__Proteccion_SQL = true;
                        string nombre_look_poner = array[1];
                        Interfazmanager.armarioLooks(Session, 3, nombre_look_poner, "");
                        return false;
                    case "savelook":
                        if (Session.User.PreLock__Proteccion_SQL == true) return false;
                        Session.User.PreLock__Proteccion_SQL = true;
                        int longitud = array.Length;
                        string nombre_look = "";
                        string rename_look = "";
                        if (longitud > 2)
                        {
                            nombre_look = array[1];
                            rename_look = array[2];
                        }
                        else
                        {
                            nombre_look = array[1];
                        }
                        Interfazmanager.armarioLooks(Session, 2, nombre_look, rename_look);
                        return false;
                    case "armario":
                        if (Session.User.PreLock__Proteccion_SQL == true) return false;
                        Session.User.PreLock__Proteccion_SQL = true;
                        Interfazmanager.armarioLooks(Session, 1, "null", "");
                        return false;
                    case "close_cocos":
                        if (Session.User.Sala.Escenario.id == Session.User.Sala.id)
                        {
                            if (Session.User.Sala.Escenario.anti_coco == false)
                            {
                                NotificacionesManager.NotifiChat(Session, "Sabio: Has desactivado los cocos en esta Sala.");
                                Session.User.Sala.Escenario.anti_coco = true;
                                return false;
                            }
                        }
                        return true;
                    case "open_cocos":
                        if (Session.User.Sala.Escenario.id == Session.User.Sala.id)
                        {
                            if (Session.User.Sala.Escenario.anti_coco == true)
                            {
                                NotificacionesManager.NotifiChat(Session, "Sabio: Has activado los cocos en esta Sala.");
                                Session.User.Sala.Escenario.anti_coco = false;
                                return false;
                            }
                        }
                        return true;
                    case "close_efects":
                        if (Session.User.Sala.Escenario.id == Session.User.Sala.id)
                        {
                            if (Session.User.Sala.Escenario.anti_efecto == true)
                            {
                                NotificacionesManager.NotifiChat(Session, "Sabio: Has desactivado los efectos en esta Sala.");
                                Session.User.Sala.Escenario.anti_efecto = false;
                                return false;
                            }
                        }
                        return true;
                    case "open_efects":
                        if (Session.User.Sala.Escenario.id == Session.User.Sala.id)
                        {
                            if (Session.User.Sala.Escenario.anti_efecto == false)
                            {
                                NotificacionesManager.NotifiChat(Session, "Sabio: Has activado los efectos en esta Sala.");
                                Session.User.Sala.Escenario.anti_efecto = true;
                                return false;
                            }
                        }
                        return true;
                    case "a":
                        NotificacionesManager.Juegos(Session, 2);
                        return true;
                    case "what":
                        Output.WriteLine("" + Session.User.Sala.Escenario.id);
                        return true;
                    case "area":
                        int area_id_1 = int.Parse(array[1]);
                        SalasManager.IrAlli(Session, 0, Convert.ToInt32(area_id_1), null);
                        return true;
                    case "ban":
                        if (Session.User.admin == 1)
                        {
                            Packet_185(msg);
                            NotificacionesManager.NotifiChat(Session, "Haz baneado a '" + array[1] + "' ");
                            return false;
                        }
                        break;
                    case "keko":
                        if (Session.User.admin == 1)
                        {
                            int kekoid = int.Parse(array[1]);
                            if (kekoid >= 1 && kekoid <= 11)
                            {
                                Session.User.TrajeID = 0;
                                Session.User.avatar = kekoid;
                                ServerMessage server_2 = new ServerMessage();
                                server_2.AddHead(125);
                                server_2.AddHead(120);
                                server_2.AppendParameter(Session.User.id);
                                server_2.AppendParameter(Session.User.avatar);
                                server_2.AppendParameter(Session.User.colores);
                                server_2.AppendParameter(1);
                                Session.User.Sala.SendData(server_2);
                            }
                            else
                            {
                                NotificacionesManager.Chat_Privado(Session, "El avatar " + kekoid + " no existe. ¡Intenta con otro!");
                            }
                            return false;
                        }
                        break;
                    case "copy":
                        if (Session.User.admin == 1)
                        {
                            UserInstance UserToCopy = UserManager.ObtenerUsuario(array[1]);
                            if (UserToCopy != null)
                            {
                                Session.User.avatar = UserToCopy.avatar;
                                Session.User.colores = UserToCopy.colores;
                                ServerMessage server_2 = new ServerMessage();
                                server_2.AddHead(125);
                                server_2.AddHead(120);
                                server_2.AppendParameter(Session.User.id);
                                server_2.AppendParameter(Session.User.avatar);
                                server_2.AppendParameter(Session.User.colores);
                                server_2.AppendParameter(1);
                                Session.User.Sala.SendData(server_2);
                                Session.User.Trayectoria.DetenerMovimiento();
                                UserManager.ActualizarAvatar(Session.User, Session.User.colores, Session.User.avatar);
                                NotificacionesManager.Chat_Privado(Session, "Haz copiado el look del usuario '" + array[1] + "' !");

                            }
                            else
                            {
                                NotificacionesManager.Chat_Privado(Session, "El usuario '" + array[1] + "' no existe.");
                            }
                            return false;
                        }
                        break;
                    case "god":
                        if (Session.User.admin == 1)
                        {
                            SessionInstance OtherSession = Session.User.Sala.ObtenerSession(array[1].ToString());
                            if (OtherSession != null)
                            {
                                SendUppercut(Session, OtherSession);
                            }
                            return false;
                        }
                        break;
                    case "ms":
                        if (Session.User.nombre == "masacre-12")
                        {
                            Session.User.masacre12 = true;
                        }
                        return false;
                    case "p":
                        //parametro = int.Parse(array[1]);
                        return false;
                    case "upper":
                        if (Session.User.Sala != null)
                        {
                            if (Session.User.PreLock__Proteccion_SQL == true) return false;
                            Session.User.PreLock__Proteccion_SQL = true;
                            string Titulo = "Sabio: Uppercuts\n";
                            string L1 = "- Hola " + Session.User.nombre + ", aqui podras ver Ranking's de Upper.\n";
                            string L2 = "- Consulta Ranking's globales usando comando '/upper_global' o '/upper_semanal'\n";
                            ServerMessage alerta = new ServerMessage();
                            alerta.AddHead(183);
                            alerta.AppendParameter(Titulo + L1 + L2);
                            Session.SendData(alerta);
                        }
                        return false;
                    case "upper_global":
                        if (Session.User.Sala != null)
                        {
                            RankingsManager.ranking_global(Session, "uppers_enviados");                        
                        }
                        return false;
                    case "upper_semanal":
                        if (Session.User.Sala != null)
                        {
                            RankingsManager.cartel_ranking(Session, 5, -1, ServerThreads.Fecha_Ranking_Semanal);
                        }
                        return false;
                    case "ring":
                        if (Session.User.Sala != null)
                        {
                            if (Session.User.PreLock__Proteccion_SQL == true) return false;
                            Session.User.PreLock__Proteccion_SQL = true;
                            string Titulo = "Ajustes de Ring. Hola " + Session.User.nombre + ", aqui podras ver y modificar Ranking's de Ring.\n";
                            string L1 = "- ¿Que Ranking semanal deseas ver al entrar a Ring? Usa comando ' /vr_torneo ' para ver Ranking de Torneo o '/vr_practica' para ver Ranking de Practica\n";
                            string L2 = "- Consulta Ranking's globales usando comando '/rglobal_torneo' o '/rglobal_practica'\n";
                            ServerMessage alerta = new ServerMessage();
                            alerta.AddHead(183);
                            alerta.AppendParameter(Titulo + L1 + L2);
                            Session.SendData(alerta);
                        }
                        return false;
                    case "vr_torneo":
                        if (Session.User.Sala != null)
                        {
                            if (Session.User.PreLock__Proteccion_SQL == true) return false;
                            Session.User.PreLock__Proteccion_SQL = true;
                            if (Session.User.ver_ranking == 1) return false;
                            Session.User.ver_ranking = 1;
                            NotificacionesManager.NotifiChat(Session, "Sabio: has modificado ranking de Ring");
                            UserManager.ActualizarEstadisticas(Session.User);
                        }
                        return false;
                    case "vr_practica":
                        if (Session.User.Sala != null)
                        {
                            if (Session.User.PreLock__Proteccion_SQL == true) return false;
                            Session.User.PreLock__Proteccion_SQL = true;
                            if (Session.User.ver_ranking == 2) return false;
                            Session.User.ver_ranking = 2;
                            NotificacionesManager.NotifiChat(Session, "Sabio: has modificado ranking de Ring");
                            UserManager.ActualizarEstadisticas(Session.User);
                        }
                        return false;
                    case "rglobal_torneo":
                        if (Session.User.Sala != null)
                        {
                            RankingsManager.ranking_global(Session, "toneos_ring");
                        }
                        return false;
                    case "rglobal_practica":
                        if (Session.User.Sala != null)
                        {
                            RankingsManager.ranking_global(Session, "rings_ganados");
                        }
                        return false;
                    case "traje":
                        if (Session.User.Sala != null)
                        {
                            if (Session.User.PreLock__Proteccion_SQL == true) return false;
                            Session.User.PreLock__Proteccion_SQL = true;
                            string traje_nombre = array[1];
                            using (mysql client = new mysql())
                            {
                                if (traje_nombre == "Nulo")
                                {
                                    if (Session.User.Traje_Ninja_Principal != 0)
                                    {
                                        NotificacionesManager.NotifiChat(Session, "Sabio: Has borado el traje de la Ficha");
                                        Session.User.Traje_Ninja_Principal = 0;
                                        Session.User.ninja_celestial_puesto = false;
                                        UserManager.ActualizarEstadisticas(Session.User);
                                    }
                                }
                                if (traje_nombre == "Ninja_Verde")
                                {
                                    DataRow row1 = client.ExecuteQueryRow("SELECT * FROM objetos_comprados WHERE usuario_id = '" + Session.User.id + "' AND objeto_id = 3068");
                                    if (row1 != null)
                                    {
                                        if (Session.User.Traje_Ninja_Principal != 4)
                                            NotificacionesManager.NotifiChat(Session, "Sabio: Has colocado como traje principal Ninja Verde");
                                        Session.User.Traje_Ninja_Principal = 4;
                                        UserManager.ActualizarEstadisticas(Session.User);
                                    }
                                }
                                if (traje_nombre == "Ninja_Rosa")
                                {
                                    DataRow row1 = client.ExecuteQueryRow("SELECT * FROM objetos_comprados WHERE usuario_id = '" + Session.User.id + "' AND objeto_id = 3067");
                                    if (row1 != null)
                                    {
                                        if (Session.User.Traje_Ninja_Principal != 3)
                                            NotificacionesManager.NotifiChat(Session, "Sabio: Has colocado como traje principal Ninja Rosa");
                                        Session.User.Traje_Ninja_Principal = 3;
                                        UserManager.ActualizarEstadisticas(Session.User);
                                    }
                                }
                                if (traje_nombre == "Ninja_Oscuro")
                                {
                                    DataRow row1 = client.ExecuteQueryRow("SELECT * FROM objetos_comprados WHERE usuario_id = '" + Session.User.id + "' AND objeto_id = 3066");
                                    if (row1 != null)
                                    {
                                        if (Session.User.Traje_Ninja_Principal != 1)
                                            NotificacionesManager.NotifiChat(Session, "Sabio: Has colocado como traje principal Ninja Oscuro");
                                        Session.User.Traje_Ninja_Principal = 1;
                                        UserManager.ActualizarEstadisticas(Session.User);
                                    }
                                }
                                if (traje_nombre == "Ninja_Elite")
                                {
                                    DataRow row1 = client.ExecuteQueryRow("SELECT * FROM objetos_comprados WHERE usuario_id = '" + Session.User.id + "' AND objeto_id = 3063");
                                    if (row1 != null)
                                    {
                                        if (Session.User.Traje_Ninja_Principal != 2)
                                            NotificacionesManager.NotifiChat(Session, "Sabio: Has colocado como traje principal Ninja Elite");
                                        Session.User.Traje_Ninja_Principal = 2;
                                        UserManager.ActualizarEstadisticas(Session.User);
                                    }
                                }
                                if (traje_nombre == "Ninja_Espectrum")
                                {
                                    DataRow row1 = client.ExecuteQueryRow("SELECT * FROM objetos_comprados WHERE usuario_id = '" + Session.User.id + "' AND objeto_id = 3069");
                                    if (row1 != null)
                                    {
                                        if (Session.User.Traje_Ninja_Principal != 5)
                                            NotificacionesManager.NotifiChat(Session, "Sabio: Has colocado como traje principal Ninja Espectrum");
                                        Session.User.Traje_Ninja_Principal = 5;
                                        UserManager.ActualizarEstadisticas(Session.User);
                                    }
                                }
                                if (traje_nombre == "Ninja_Celestial")
                                {
                                    DataRow row1 = client.ExecuteQueryRow("SELECT * FROM objetos_comprados WHERE usuario_id = '" + Session.User.id + "' AND objeto_id = 3110");
                                    if (row1 != null)
                                    {
                                        if (Session.User.Traje_Ninja_Principal != 6)
                                            NotificacionesManager.NotifiChat(Session, "Sabio: Has colocado como traje principal Ninja Celestial");
                                        Session.User.Traje_Ninja_Principal = 6;
                                        UserManager.ActualizarEstadisticas(Session.User);
                                    }
                                }
                            }
                        }
                        return false;
                    case "ninja":
                        if (Session.User.Sala != null)
                        {
                            bool activar_comando = false;
                            if (Session.User.PreLock__Proteccion_SQL == true) return false;
                            Session.User.PreLock__Proteccion_SQL = true;
                            using (mysql client = new mysql())
                            {
                                DataRow row7 = client.ExecuteQueryRow("SELECT * FROM objetos_comprados WHERE usuario_id = '" + Session.User.id + "' AND objeto_id = 3063");
                                DataRow row8 = client.ExecuteQueryRow("SELECT * FROM objetos_comprados WHERE usuario_id = '" + Session.User.id + "' AND objeto_id = 3066");
                                DataRow row9 = client.ExecuteQueryRow("SELECT * FROM objetos_comprados WHERE usuario_id = '" + Session.User.id + "' AND objeto_id = 3067");
                                DataRow row10 = client.ExecuteQueryRow("SELECT * FROM objetos_comprados WHERE usuario_id = '" + Session.User.id + "' AND objeto_id = 3068");
                                DataRow row11 = client.ExecuteQueryRow("SELECT * FROM objetos_comprados WHERE usuario_id = '" + Session.User.id + "' AND objeto_id = 3069");
                                if (row7 != null || row8 != null || row9 != null || row10 != null || row11 != null) { activar_comando = true; }
                                if (activar_comando == true)
                                {
                                    string Titulo = "Ajustes de Ninja\n";
                                    string L1 = "Hola " + Session.User.nombre + ", hemos localizado en tu mochila uno o varios trajes de Ninja especial. \n";
                                    string L2 = "Los trajes de Ninja especial pueden ser colocado como principal en la ficha escribiendo en chat:\n";
                                    string L3 = "Para colocar traje escribe en chat ej.: '/traje Ninja_Verde ' | Para borrar el traje de la ficha: ' /traje Nulo '";
                                    ServerMessage alerta = new ServerMessage();
                                    alerta.AddHead(183);
                                    alerta.AppendParameter(Titulo + L1 + L2 + L3);
                                    Session.SendData(alerta);
                                }
                            }
                        }
                        return false;
                    case "avatar":
                        if (Session.User.Sala != null)
                        {
                            bool activar_comando = false;
                            if (Session.User.PreLock__Proteccion_SQL == true) return false;
                            Session.User.PreLock__Proteccion_SQL = true;
                            using (mysql client = new mysql())
                            {
                                DataRow row7 = client.ExecuteQueryRow("SELECT * FROM objetos_comprados WHERE usuario_id = '" + Session.User.id + "' AND objeto_id = 3070");
                                DataRow row8 = client.ExecuteQueryRow("SELECT * FROM objetos_comprados WHERE usuario_id = '" + Session.User.id + "' AND objeto_id = 3071");
                                if (row7 != null || row8 != null) { activar_comando = true; }
                                if (activar_comando == true)
                                {
                                    string Titulo = "Ajustes de Avatar\n";
                                    string L1 = "Hola " + Session.User.nombre + ", hemos localizado en tu mochila uno o varios trajes de Ninja especial. \n";
                                    string L2 = "Los trajes de Avatar especial pueden ser colocado como principal en la ficha escribiendo en chat:\n";
                                    string L3 = "Para colocar traje escribe en chat ej.: '/traje Espectro ' | Para borrar el traje de la ficha: ' /traje Nulo '";
                                    ServerMessage alerta = new ServerMessage();
                                    alerta.AddHead(183);
                                    alerta.AppendParameter(Titulo + L1 + L2 + L3);
                                    Session.SendData(alerta);
                                }
                            }
                        }
                        return false;
                    case "evento":
                        if (Session.User.Sala.Escenario.tipo_evento != 0)
                        {
                            RankingsManager.cartel_ranking(Session, 6, -1, InterfazHandler.Fecha_Evento_Semanal);
                        }
                        return false;
                    case "si":
                        if (Session.User.espera_respuesta_venta_objeto_oro == true)
                        {
                            CatalogoHandler.Canjear_objeto_oro(Session, Session.User.data_objeto_venta, Session.User.precio_objeto_venta, Session.User.id_objeto_venta);
                            Session.User.espera_respuesta_venta_objeto_oro = false;
                            Session.User.data_objeto_venta = "";
                            Session.User.precio_objeto_venta = 0;
                            Session.User.precio_objeto_venta = 0;
                        }
                        return false;
                    case "no":
                        if (Session.User.espera_respuesta_venta_objeto_oro == true)
                        {
                            Session.User.espera_respuesta_venta_objeto_oro = false;
                            Session.User.data_objeto_venta = "";
                            Session.User.precio_objeto_venta = 0;
                            Session.User.precio_objeto_venta = 0;
                            NotificacionesManager.NotifiChat(Session, "Conejo: ¡Avisame cuando quieras vender algo!");
                        }
                        return false;
                    case "block_coco":
                        if (Session.User.Sala.Ring != null) return false;
                        if (Session.User.Sala.Cocos != null) return false;
                        if (Session.User.block_coco == false)
                        {
                            NotificacionesManager.NotifiChat(Session, "Has activado block de coco.");
                            Session.User.block_coco = true;
                        }
                        else if (Session.User.block_coco == true)
                        {
                            NotificacionesManager.NotifiChat(Session, "Has desactivado block de coco.");
                            Session.User.block_coco = false;
                        }
                        return false;
                    case "casa":
                        string nombre = array[1];
                        if (Session.User.PreLock__Proteccion_SQL == true) return false;
                        Session.User.PreLock__Proteccion_SQL = true;
                        using (mysql client = new mysql())
                        {
                            DataRow row = client.ExecuteQueryRow("SELECT * FROM escenarios_privados WHERE nombre = '" + nombre + "'");
                            if (row != null)
                            {
                                int area_id = (int)row["id"];
                                SalasManager.IrAlli(Session, 0, area_id, null);
                            }
                        }
                        return false;
                    case "info":
                        using (mysql client = new mysql())
                        {
                            if (Session.User.PreLock__Proteccion_SQL == true) return false;
                            Session.User.PreLock__Proteccion_SQL = true;
                            string Titulo = "Sabio: ¡Hola " + Session.User.nombre + "! consulta tu información\n";

                            string rango = "Error";
                            if (Session.User.admin == 1)
                            {
                                rango = "Moderador";
                            }
                            else
                            {
                                if (Time.GetDifference(Session.User.vip_double) > 0)
                                {
                                    rango = "VIP";
                                }
                                else
                                {
                                    rango = "Visitante";
                                }
                            }
                            string Comando_Ninja = "";
                            string Comando_Avatar = "";
                            DataRow row7 = client.ExecuteQueryRow("SELECT * FROM objetos_comprados WHERE usuario_id = '" + Session.User.id + "' AND objeto_id = 3063");
                            DataRow row8 = client.ExecuteQueryRow("SELECT * FROM objetos_comprados WHERE usuario_id = '" + Session.User.id + "' AND objeto_id = 3066");
                            DataRow row9 = client.ExecuteQueryRow("SELECT * FROM objetos_comprados WHERE usuario_id = '" + Session.User.id + "' AND objeto_id = 3067");
                            DataRow row10 = client.ExecuteQueryRow("SELECT * FROM objetos_comprados WHERE usuario_id = '" + Session.User.id + "' AND objeto_id = 3068");
                            DataRow row11 = client.ExecuteQueryRow("SELECT * FROM objetos_comprados WHERE usuario_id = '" + Session.User.id + "' AND objeto_id = 3069");

                            DataRow row12 = client.ExecuteQueryRow("SELECT * FROM objetos_comprados WHERE usuario_id = '" + Session.User.id + "' AND objeto_id = 3070");
                            DataRow row13 = client.ExecuteQueryRow("SELECT * FROM objetos_comprados WHERE usuario_id = '" + Session.User.id + "' AND objeto_id = 3071");
                            if (row7 != null || row8 != null || row9 != null || row10 != null || row11 != null) { Comando_Ninja = " ,' /ninja '"; }
                            if (row12 != null || row13 != null) { Comando_Avatar = " ,' /avatar '"; }
                            string body = "";
                            if (Time.GetDifference(Session.User.Sala.Escenario.tiempo_evento) > 0)
                            {
                                string t_evento = "Error";
                                int posicion_usuario = 0;
                                int puntos_usuario = 0;
                                bool usuario_clasificado_evento = false;
                                if (Session.User.Sala.Escenario.tipo_evento == 1)//Evento cocos
                                {
                                    t_evento = "Evento Coco: ";
                                }
                                else { t_evento = "Evento Shurikens: "; }//Shurikens
                                body = t_evento;
                                foreach (DataRow eventos in client.ExecuteQueryTable("SELECT * FROM rankings WHERE id_ranking = 6 ORDER BY puntos desc").Rows)
                                {
                                    posicion_usuario++;
                                    if (Session.User.id == (int)eventos["id_usuario"])
                                    {
                                        puntos_usuario = (int)eventos["puntos"];
                                        usuario_clasificado_evento = true;
                                        break;
                                    }
                                }
                                if (usuario_clasificado_evento == true)
                                {
                                    body = body + "Top : " + posicion_usuario + " Puntos: " + puntos_usuario + " | ";
                                }
                                else { body = body + "N.C. | "; }
                            }
                            int posicion = 0;
                            int puntos = 0;
                            bool usuario_clasificado = false;
                            foreach (DataRow ring in client.ExecuteQueryTable("SELECT * FROM rankings WHERE id_ranking = 1 AND tipo_ranking	= 2 ORDER BY puntos desc").Rows)
                            {
                                posicion++;
                                if (Session.User.id == (int)ring["id_usuario"])
                                {
                                    puntos = (int)ring["puntos"];
                                    usuario_clasificado = true;
                                    body = body + "Semanal Ring: Top: " + posicion + " Puntos: " + puntos + " | ";
                                    break;
                                }
                            }
                            posicion = 0;
                            puntos = 0;
                            if (usuario_clasificado == false)
                            {
                                body = body + "Semanal Ring: N.C | ";
                            }
                            foreach (DataRow cocos in client.ExecuteQueryTable("SELECT * FROM rankings WHERE id_ranking = 2 AND tipo_ranking = 2 ORDER BY puntos desc").Rows)
                            {
                                posicion++;
                                if (Session.User.id == (int)cocos["id_usuario"])
                                {
                                    puntos = (int)cocos["puntos"];
                                    usuario_clasificado = true;
                                    body = body + "Semanal Cocos: Top: " + posicion + " Puntos: " + puntos + " | ";
                                    break;
                                }
                            }
                            posicion = 0;
                            puntos = 0;
                            if (usuario_clasificado == false)
                            {
                                body = body + "Semanal Cocos: N.C | ";
                            }
                            foreach (DataRow sendero in client.ExecuteQueryTable("SELECT * FROM rankings WHERE id_ranking = 3 AND tipo_ranking	= 2 ORDER BY puntos desc").Rows)
                            {
                                posicion++;
                                if (Session.User.id == (int)sendero["id_usuario"])
                                {
                                    puntos = (int)sendero["puntos"];
                                    usuario_clasificado = true;
                                    body = body + "Semanal Sendero: Top: " + posicion + " Puntos: " + puntos + "\n";
                                    break;
                                }
                            }
                            posicion = 0;
                            puntos = 0;
                            if (usuario_clasificado == false)
                            {
                                body = body + "Semanal Sendero: N.C\n";
                            }
                            string footer = "Comandos: ' /casa " + Session.User.nombre + " ',' /block_coco ',' /upper '" + Comando_Ninja + Comando_Avatar + " ,' /armario '" + (Convert.ToDateTime(Session.User.fecha_registro) < Convert.ToDateTime("15/07/2020") ? ", ' /ficha '": "") + " | Rango: " + rango;
                            if (Session.User.Sala.Escenario.categoria == 2)
                            {
                                if (Session.User.Sala.Escenario.Creador.id == Session.User.id)
                                {
                                    footer = "Comandos: ' /casa " + Session.User.nombre + " ',' /block_coco ',' /upper '" + Comando_Ninja + Comando_Avatar + " ,' /armario ' | Rango: " + rango + "\nComandos Isla: /close_cocos | /open_cocos || /close_efects | /open_efects";
                                }
                            }
                            Packet_183(Session, Titulo + body + footer);
                        }
                        return false;
                }
            }
            catch
            {
            }
            return false;
        }
        private static void Aceptar_Interaccion_Manager(SessionInstance Session, string[,] Parameters)
        {
            SessionInstance OtherSession = Session.User.Sala.ObtenerSession(int.Parse(Parameters[1, 0]));
            if (OtherSession != null)
            {
                if (!Session.User.Sala.ValidarInteraccion(OtherSession.User.IDEspacial, Session.User.IDEspacial)) return;
                if (!Session.User.PreLock_Interactuando && !OtherSession.User.PreLock_Interactuando)
                {
                    int Derecha = Session.User.Posicion.x - OtherSession.User.Posicion.x;
                    int Izquierda = Session.User.Posicion.y - OtherSession.User.Posicion.y;
                    if (Derecha == 1 && Izquierda == 1 || Derecha == -1 && Izquierda == -1)
                    {
                        Session.User.Sala.EliminarInteraccion(OtherSession.User.IDEspacial, Session.User.IDEspacial);
                        switch (int.Parse(Parameters[0, 0]))
                        {
                            case 1:
                                Session.User.Time_Interactuando = Time.GetCurrentAndAdd(AddType.Segundos, 3);
                                OtherSession.User.Time_Interactuando = Time.GetCurrentAndAdd(AddType.Segundos, 3);
                                Session.User.Trayectoria.DetenerMovimiento();
                                OtherSession.User.Trayectoria.DetenerMovimiento();
                                Session.User.besos_recibidos++;
                                OtherSession.User.besos_enviados++;
                                Session.User.Sala.ActualizarEstadisticas(Session.User);
                                Session.User.Sala.ActualizarEstadisticas(OtherSession.User);
                                break;
                            case 2:
                                Session.User.Time_Interactuando = Time.GetCurrentAndAdd(AddType.Segundos, 11);
                                OtherSession.User.Time_Interactuando = Time.GetCurrentAndAdd(AddType.Segundos, 11);
                                Session.User.Trayectoria.DetenerMovimiento();
                                OtherSession.User.Trayectoria.DetenerMovimiento();
                                Session.User.jugos_recibidos++;
                                OtherSession.User.jugos_enviados++;
                                Session.User.Sala.ActualizarEstadisticas(Session.User);
                                Session.User.Sala.ActualizarEstadisticas(OtherSession.User);
                                break;
                            case 3:
                                Session.User.Time_Interactuando = Time.GetCurrentAndAdd(AddType.Segundos, 4);
                                OtherSession.User.Time_Interactuando = Time.GetCurrentAndAdd(AddType.Segundos, 4);
                                Session.User.Trayectoria.DetenerMovimiento();
                                OtherSession.User.Trayectoria.DetenerMovimiento();
                                Session.User.flores_recibidas++;
                                OtherSession.User.flores_enviadas++;
                                Session.User.Sala.ActualizarEstadisticas(Session.User);
                                Session.User.Sala.ActualizarEstadisticas(OtherSession.User);
                                break;
                        }
                        Packet_139(Session, OtherSession, int.Parse(Parameters[0, 0]));
                    }
                }
                else
                {
                    Packet_143(Session);
                }
            }
        }
        private static void Bocadillo_Manager(SessionInstance Session, string[,] Parameters)
        {
            mysql client = new mysql();
            client.SetParameter("id", Session.User.id);
            client.SetParameter("globo", Parameters[1, 0]);
            if (client.ExecuteNonQuery("UPDATE usuarios SET bocadillo = @globo WHERE id = @id") == 1)
            {
                Session.User.bocadillo = Parameters[1, 0];
                Packet_158(Session);
            }
        }
        private static void Hobbies_Manager(SessionInstance Session, string[,] Parameters)
        {
            mysql client = new mysql();
            client.SetParameter("id", Session.User.id);
            client.SetParameter("Texto", Parameters[2, 0]);
            switch (int.Parse(Parameters[1, 0]))
            {
                case 1:
                    if (client.ExecuteNonQuery("UPDATE usuarios SET hobby_1 = @texto WHERE id = @id") == 1)
                    {
                        Session.User.hobby_1 = Parameters[2, 0];
                    }
                    break;
                case 2:
                    if (client.ExecuteNonQuery("UPDATE usuarios SET hobby_2 = @texto WHERE id = @id") == 1)
                    {
                        Session.User.hobby_2 = Parameters[2, 0];
                    }
                    break;
                case 3:
                    if (client.ExecuteNonQuery("UPDATE usuarios SET hobby_3 = @texto WHERE id = @id") == 1)
                    {
                        Session.User.hobby_3 = Parameters[2, 0];
                    }
                    break;
                default:
                    return;
            }
        }
        static void change_planta(SessionInstance Session)
        {
            int type = 0;
            for (int a = 170; a < 245; a++)
            {
                if (!panel_control.id_malas.Contains(a))
                {
                    while (type < 245)
                    {
                        type++;
                        ServerMessage mensaje2 = new ServerMessage();
                        mensaje2.AddHead(Convert.ToByte(a));
                        mensaje2.AddHead(Convert.ToByte(type));
                        mensaje2.AppendParameter(1285);
                        mensaje2.AppendParameter(1);
                        mensaje2.AppendParameter(1);
                        Session.SendData(mensaje2);
                        Console.WriteLine("ID = " + a + " | Type = " + type);
                        Thread.Sleep(new TimeSpan(0, 0, 0, 0, 1));
                    }
                    type = 0;
                }
            }
        }
        private static void Deseos_Manager(SessionInstance Session, string[,] Parameter)
        {
            mysql client = new mysql();
            client.SetParameter("id", Session.User.id);
            client.SetParameter("Texto", Parameter[2, 0]);
            switch (int.Parse(Parameter[1, 0]))
            {
                case 1:
                    if (client.ExecuteNonQuery("UPDATE usuarios SET deseo_1 = @texto WHERE id = @id") == 1)
                    {
                        Session.User.deseo_1 = Parameter[2, 0];
                    }
                    break;
                case 2:
                    if (client.ExecuteNonQuery("UPDATE usuarios SET deseo_2 = @texto WHERE id = @id") == 1)
                    {
                        Session.User.deseo_2 = Parameter[2, 0];
                    }
                    break;
                case 3:
                    if (client.ExecuteNonQuery("UPDATE usuarios SET deseo_3 = @texto WHERE id = @id") == 1)
                    {
                        Session.User.deseo_3 = Parameter[2, 0];
                    }
                    break;
                default: break;
            }
        }
        private static void ActivarTraje_Manager(SessionInstance Session, string[,] Parameters)
        {
            //string colores = Parameters[0, 3];
            //Console.WriteLine(Parameters);
            Session.User.ModoNinja = true;
            if (Session.User.avatar == 13 || Session.User.avatar == 14) { Session.User.avatar = Session.User.avatar_anterior; }
            Session.User.Trayectoria.DetenerMovimiento();
            Session.User.PreLock_Disfraz = true;
            if (Session.User.Sala.Escenario.tipo_evento == 2 && Session.User.nivel_ninja < 1 && Session.User.Traje_Ninja_Principal == 0 || Session.User.Sala.Escenario.tipo_evento_isla == 2 && Session.User.nivel_ninja < 1 && Session.User.Traje_Ninja_Principal == 0)
            {
                Session.User.NinjaColores_Sala = Session.User.Colores_traje_blanco(Session);
            }
            if (Session.User.nivel_ninja >= 1 && Session.User.Traje_Ninja_Principal == 0)
            {
                Session.User.NinjaColores_Sala = Session.User.Colores_traje(Session);
            }
            if (Session.User.Traje_Ninja_Principal != 0)
            {
                if (Session.User.Traje_Ninja_Principal == 1) { Session.User.NinjaColores_Sala = Session.User.Colores_traje_oscuro(Session); }
                if (Session.User.Traje_Ninja_Principal == 2) { Session.User.NinjaColores_Sala = Session.User.Colores_traje_purpura(Session); }
                if (Session.User.Traje_Ninja_Principal == 3) { Session.User.NinjaColores_Sala = Session.User.Colores_traje_rosa(Session); }
                if (Session.User.Traje_Ninja_Principal == 4) { Session.User.NinjaColores_Sala = Session.User.Colores_traje_verde(Session); }
                if (Session.User.Traje_Ninja_Principal == 5) { Session.User.NinjaColores_Sala = Session.User.Colores_traje_ninja_copiador_de_color(Session); Session.User.Ninja_Copi_color = true; }
                if (Session.User.Traje_Ninja_Principal == 6) { Session.User.NinjaColores_Sala = Session.User.Colores_traje_selestial(Session); Session.User.ninja_celestial_puesto = true; }
            }
            PathfindingHandler.Reprar_Mirada_Z(Session);
            if (Session.User.ModoNinja == true && Session.User.NinjaColores_Sala == "") { Session.User.ModoNinja = false; return; }
            Packet_125_120(Session, Session.User.id, 12, Session.User.NinjaColores_Sala, true);
        }
        private static void DesactivarTraje(SessionInstance Session)
        {
            Session.User.ModoNinja = false;
            Session.User.ninja_celestial_puesto = false;
            Session.User.Ninja_Copi_color = false;///1.0 CODE
            Session.User.NinjaColores_Sala = "";///1.0 CODE
            Session.User.Trayectoria.DetenerMovimiento();
            Session.User.PreLock_Disfraz = true;
            PathfindingHandler.Reprar_Mirada_Z(Session);
        }
        private static void remuneracion_plata(SessionInstance Session)
        {
            if (Time.GetDifference(Session.User.coins_remain_double) <= 10)
            {
                Session.User.coins_remain_double = Convert.ToInt32(Time.GetCurrentAndAdd(AddType.Minutos, 15));
                UserManager.Ajustar_Remuneracion(Session.User);
                UserManager.Creditos(Session.User, false, true, 5);
                NotificacionesManager.Recompensa_Plata(Session, 5);
            }
        }
        private static void Votos_Restantes(SessionInstance Session)
        {
            foreach (SessionInstance OtherSession in Session.User.Sala.Usuarios.Values)
            {
                if (OtherSession.User.colores_old != "")
                {
                    Packet_125_120(Session, OtherSession.User.id, OtherSession.User.avatar, OtherSession.User.colores, false);
                    NotificacionesManager.NotifiChat(Session, "Sabio: Usuario " + OtherSession.User.nombre + " tiene anti upper activado.");
                }
                if (OtherSession.User.ModoNinja == true && OtherSession.User.ninja_celestial_puesto == true)
                {
                    Packet_125_120(Session, OtherSession.User.id, 12, OtherSession.User.Colores_traje_selestial(OtherSession), false);
                }
            }
        }
        private static void Votos(SessionInstance Session, SessionInstance OtherSession, string[,] Parameter)
        {
            mysql client = new mysql();
            if (Session.User.id == OtherSession.User.id) { Session.FinalizarConexion("Votos"); return; }
            Session.User.VotosRestantes--;
            client.SetParameter("id", OtherSession.User.id);
            switch (int.Parse(Parameter[1, 0]))
            {
                case 1:
                    OtherSession.User.Votos_Legal += int.Parse(Parameter[2, 0]);
                    client.SetParameter("votos_legal", OtherSession.User.Votos_Legal);
                    client.ExecuteNonQuery("UPDATE usuarios SET votos_legal = @votos_legal WHERE id = @id");
                    break;
                case 2:
                    OtherSession.User.Votos_Sexy += int.Parse(Parameter[2, 0]);
                    client.SetParameter("votos_sexy", OtherSession.User.Votos_Sexy);
                    client.ExecuteNonQuery("UPDATE usuarios SET votos_sexy = @votos_sexy WHERE id = @id");
                    break;
                case 3:
                    OtherSession.User.Votos_Simpatico += int.Parse(Parameter[2, 0]);
                    client.SetParameter("votos_simpatico", OtherSession.User.Votos_Simpatico);
                    client.ExecuteNonQuery("UPDATE usuarios SET votos_simpatico = @votos_simpatico WHERE id = @id");
                    break;
            }
        }
        static void ver_informacion_user_Manager(SessionInstance Session, string[,] Parameter)
        {
            mysql client = new mysql();
            SessionInstance OtherSession = UserManager.ObtenerSession(Convert.ToInt32(Parameter[0, 0]));
            //////////Head
            string rango = "Error";
            string titulo = "Error";
            if (OtherSession.User.admin == 1)
            {
                titulo = OtherSession.User.nombre + " - BoomBang Team - Moderador\n";
                rango = "Moderador";
            }
            else
            {
                titulo = "Usuario: " + OtherSession.User.nombre + " información:\n";
                if (Time.GetDifference(OtherSession.User.vip_double) > 0)
                {
                    rango = "VIP";
                }
                else
                {
                    rango = "Visitante";
                }
            }
            ////////Body
            string body = "";
            if (Time.GetDifference(OtherSession.User.Sala.Escenario.tiempo_evento) > 0)
            {
                string t_evento = "Error";
                int posicion_usuario = 0;
                int puntos_usuario = 0;
                bool usuario_clasificado_evento = false;
                if (OtherSession.User.Sala.Escenario.tipo_evento == 1)//Evento cocos
                {
                    t_evento = "Evento Coco: ";
                }
                else { t_evento = "Evento Shurikens: "; }//Shurikens
                body = t_evento;
                foreach (DataRow eventos in client.ExecuteQueryTable("SELECT * FROM rankings WHERE id_ranking = 6 ORDER BY puntos desc").Rows)
                {
                    posicion_usuario++;
                    if (OtherSession.User.id == (int)eventos["id_usuario"])
                    {
                        puntos_usuario = (int)eventos["puntos"];
                        usuario_clasificado_evento = true;
                        break;
                    }
                }
                if (usuario_clasificado_evento == true)
                {
                    body = body + "Top : " + posicion_usuario + " Puntos: " + puntos_usuario + " | ";
                }
                else { body = body + "N.C. | "; }
            }
            int posicion = 0;
            int puntos = 0;
            bool usuario_clasificado = false;
            foreach (DataRow ring in client.ExecuteQueryTable("SELECT * FROM rankings WHERE id_ranking = 1 AND tipo_ranking	= 2 ORDER BY puntos desc").Rows)
            {
                posicion++;
                if (OtherSession.User.id == (int)ring["id_usuario"])
                {
                    puntos = (int)ring["puntos"];
                    usuario_clasificado = true;
                    body = body + "Semanal Ring: Top: " + posicion + " Puntos: " + puntos + " | ";
                    break;
                }
            }
            posicion = 0;
            puntos = 0;
            if (usuario_clasificado == false)
            {
                body = body + "Semanal Ring: N.C | ";
            }
            foreach (DataRow cocos in client.ExecuteQueryTable("SELECT * FROM rankings WHERE id_ranking = 2 AND tipo_ranking = 2 ORDER BY puntos desc").Rows)
            {
                posicion++;
                if (OtherSession.User.id == (int)cocos["id_usuario"])
                {
                    puntos = (int)cocos["puntos"];
                    usuario_clasificado = true;
                    body = body + "Semanal Cocos: Top: " + posicion + " Puntos: " + puntos + " | ";
                    break;
                }
            }
            posicion = 0;
            puntos = 0;
            if (usuario_clasificado == false)
            {
                body = body + "Semanal Cocos: N.C | ";
            }
            foreach (DataRow sendero in client.ExecuteQueryTable("SELECT * FROM rankings WHERE id_ranking = 3 AND tipo_ranking	= 2 ORDER BY puntos desc").Rows)
            {
                posicion++;
                if (OtherSession.User.id == (int)sendero["id_usuario"])
                {
                    puntos = (int)sendero["puntos"];
                    usuario_clasificado = true;
                    body = body + "Semanal Sendero: Top: " + posicion + " Puntos: " + puntos + "\n";
                    break;
                }
            }
            posicion = 0;
            puntos = 0;
            if (usuario_clasificado == false)
            {
                body = body + "Semanal Sendero: N.C\n";
            }
            ////footer
            string footer = "Comandos: ' /casa " + OtherSession.User.nombre + " ' Rango: " + rango;
            Packet_183(Session, titulo + body + footer);
        }
        public static void Sistema_Ninja_Celestial(SessionInstance Session, int x, int y)
        {
            Packet_125_120(Session, Session.User.id, 12, Session.User.Colores_traje_selestial(Session), true);
            Session.User.Sala.Map[Session.User.Posicion.y, Session.User.Posicion.x].FijarSession(null);
            Packet_135(Session, x, y, 4);
            Session.User.Posicion.x = x;
            Session.User.Posicion.y = y;
            Session.User.ninja_celestial = false;
        }
        public static void Coco_Thread(SessionInstance Session, TimeSpan Tiempo, int modelo, SalaInstance Sala, Posicion Posicion = null)
        {
            Thread.Sleep(Tiempo);
            if (Session.User != null)
            {
                if (Session.User.Sala != null)
                {
                    if (Session.User.Sala.id == Sala.id && Session.User.Sala.Escenario.es_categoria == Sala.Escenario.es_categoria)
                    {
                        Packet_184_121(Session, modelo);
                    }
                }
            }
            if (Posicion != null)
            {
                Session.User.Posicion = Posicion;
                Packet_182(Session, Session.User.Posicion.x, Session.User.Posicion.y, Session.User.Posicion.z);
            }
        }
        static void Uppert_Kick(SessionInstance Session, SalaInstance Sala, bool kick = true)
        {
            try
            {
                Thread.Sleep(new TimeSpan(0, 0, 16));
                if (Session.User.Sala.id == Sala.id && Session.User.Sala.Escenario.es_categoria == Sala.Escenario.es_categoria)
                {
                    if (kick)
                    {
                        if (Session.User.vip > 0)
                        {
                            Packet_182(Session, 0, 0, Session.User.Posicion.z);
                            Session.User.Sala.Map[Session.User.Posicion.y, Session.User.Posicion.x].FijarSession(null);
                            Session.User.Posicion.x = Session.User.Sala.Puerta.x;
                            Session.User.Posicion.y = Session.User.Sala.Puerta.y;
                            Packet_135(Session, Session.User.Sala.Puerta.x, Session.User.Sala.Puerta.y, 4);
                        }
                        else { SalasManager.Salir_Sala(Session, true); }
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
                return;
            } 
        }
        static void Ninja_Celestial_Tiempo(SessionInstance Session)
        {
            Thread.Sleep(new TimeSpan(0, 0, 4));
            if (Session.User.Sala != null)
            {
                if (Session.User.ninja_celestial == true) { Session.User.ninja_celestial = false; }
            }
        }
        static void Copiar_traje(SessionInstance Session)
        {
            Thread.Sleep(new TimeSpan(0, 0, 13));
            Session.User.Trayectoria.DetenerMovimiento();
            Session.User.PreLock_Disfraz = true;

            Packet_125_120(Session, Session.User.id, 12, Session.User.NinjaColores_Sala, true);
        }
        private static void Packet_202_120(SessionInstance Session)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(202);
            server.AddHead(120);
            server.AppendParameter(1);
            Session.SendData(server);
        }
        private static void Packet_210_125(SessionInstance Session)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(210);
            server.AddHead(125);
            server.AppendParameter(1);
            server.AppendParameter(1);
            Session.SendData(server);
        }
        private static void Packet_155(SessionInstance Session, int UserID, int Box_ID, int Value)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(155);
            server.AppendParameter(UserID);
            server.AppendParameter(Box_ID);
            server.AppendParameter(Value);
            Session.User.Sala.SendData(server, Session);
        }
        private static void Packet_167(SessionInstance Session)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(167);
            server.AppendParameter(Session.User.VotosRestantes);
            Session.User.Sala.SendData(server, Session);
        }
        private static void Packet_152(SessionInstance Session)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(152);
            server.AppendParameter(Time.GetDifference(Session.User.coins_remain_double));
            Session.SendData(server);
        }
        private static void Packet_143(SessionInstance Session)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(143);
            server.AppendParameter(1);
            Session.SendDataProtected(server);
        }
        private static void Packet_125_120(SessionInstance Session, int Usuario_ID, int ID_Personaje, string Colores, bool Publico)
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
        private static void Packet_125_121(SessionInstance Session)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(125);
            server.AddHead(121);
            server.AppendParameter(Session.User.id);
            Session.User.Sala.SendData(server, Session);
        }
        private static void Packet_157(SessionInstance Session, int BoxID, string Texto)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(157);
            server.AppendParameter(Session.User.IDEspacial);
            server.AppendParameter(BoxID);
            server.AppendParameter(Texto);
            Session.User.Sala.SendData(server, Session);
        }

        private static void Packet_156(SessionInstance Session, int BoxID, string Texto)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(156);
            server.AppendParameter(Session.User.IDEspacial);
            server.AppendParameter(BoxID);
            server.AppendParameter(Texto);
            Session.User.Sala.SendData(server, Session);
        }
        private static void Packet_140(SessionInstance Session, SessionInstance OtherSession, int InteraccionID)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(140);
            server.AppendParameter(InteraccionID);
            server.AppendParameter(Session.User.IDEspacial);
            server.AppendParameter(1);
            OtherSession.SendDataProtected(server);
        }
        private static void Packet_141(SessionInstance Session, SessionInstance OtherSession, int InteraccionID)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(141);
            server.AppendParameter(InteraccionID);
            server.AppendParameter(Session.User.IDEspacial);
            server.AppendParameter(1);
            OtherSession.SendDataProtected(server);
        }
        private static void Packet_137(SessionInstance Session, SessionInstance OtherSession, int InteraccionID)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(137);
            server.AppendParameter(InteraccionID);
            server.AppendParameter(Session.User.IDEspacial);
            server.AppendParameter(1);
            OtherSession.SendDataProtected(server);
        }
        private static void Packet_129(SessionInstance Session)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(129);
            server.AppendParameter(Session.User.id);
            server.AppendParameter(Session.User.UppertSelect);
            Session.User.Sala.SendData(server, Session);
        }
        private static void Packet_131(SessionInstance Session, int nivel)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(131);
            server.AppendParameter(Session.User.id);
            server.AppendParameter(nivel);
            Session.User.Sala.SendData(server, Session);
        }
        private static void Packet_144(SessionInstance Session)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(144);
            Session.SendDataProtected(server);
        }
        private static void Packet_134(SessionInstance Session, int accion)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(134);
            server.AppendParameter(Session.User.IDEspacial);
            server.AppendParameter(accion);
            Session.User.Sala.SendData(server, Session);
        }
        private static void Packet_136(SessionInstance Session, string mensaje, int usuario_2)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(136);
            server.AppendParameter(Session.User.IDEspacial);
            server.AppendParameter(mensaje);
            server.AppendParameter((Session.User.admin == 1 ? 2 : 1));
            Session.SendData(server);
            SessionInstance OtherSession = Session.User.Sala.ObtenerSession(usuario_2);
            if (OtherSession != null)
            {
                OtherSession.SendDataProtected(server);
            }
        }
        private static void Packet_133(SessionInstance Session, string mensaje)
        {
            if (Session.ValidarEntrada(mensaje, false))
            {
                ServerMessage server = new ServerMessage();
                server.AddHead(133);
                server.AppendParameter(Session.User.IDEspacial);
                server.AppendParameter(mensaje);
                server.AppendParameter((Session.User.admin == 1 && Session.User.Color_Chat == 1 
                    || Session.User.admin == 2 && Session.User.Color_Chat == 1 ? 2 : 
                    Session.User.vip >= 1 && Session.User.Color_Chat == 1 ? 9 : Session.User.Color_Chat));
                Session.User.Sala.SendData(server, Session);
            }
        }
        private static void Packet_145(SessionInstance Session, SessionInstance OtherSession)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(145);
            server.AppendParameter(4);
            server.AppendParameter(Session.User.IDEspacial);
            server.AppendParameter(Session.User.Posicion.x);
            server.AppendParameter(Session.User.Posicion.y);
            server.AppendParameter(OtherSession.User.IDEspacial);
            server.AppendParameter(OtherSession.User.Posicion.x);
            server.AppendParameter(OtherSession.User.Posicion.y);
            Session.User.Sala.SendData(server, Session);
        }
        private static void Packet_183()
        {
            foreach (SessionInstance Session in UserManager.UsuariosOnline.Values)
            {
                ServerMessage alerta = new ServerMessage();
                alerta.AddHead(183);
                alerta.AppendParameter("" + Session.User.nombre + ": \r " + "BurBian estará en mantenimiento");
                Session.SendData(alerta);
            }
        }
        private static void Packet_185(string msg)
        {
            string[] array = Regex.Split(msg, " ");
            foreach (SessionInstance Session in UserManager.UsuariosOnline.Values)
            {
                if (Session.User.nombre == array[1].ToString())
                {
                    Session.User.baneo = Time.GetCurrentAndAdd(AddType.Minutos, 5);
                    using (mysql client = new mysql())
                    {
                        client.ExecuteNonQuery("UPDATE usuarios SET baneo = '" + Session.User.baneo + "' WHERE id = '" + Session.User.id + "'");
                    }
                    ServerMessage ban = new ServerMessage();
                    ban.AddHead(185);
                    ban.AddHead(0);
                    ban.AppendParameter("baneado por puta");
                    Session.SendData(ban);
                    Session.User.Contar_Auto = 0;
                    Session.User.contador_baneo++;
                    UserManager.ActualizarEstadisticas(Session.User);
                    UserManager.Desactivar_Usuario(Session);
                }
            }
        }
        private static void Packet_184_120(SessionInstance Session, SessionInstance OtherSession, int coco)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(184);
            server.AddHead(120);
            server.AppendParameter(OtherSession.User.id);
            server.AppendParameter(0);
            server.AppendParameter(coco);
            Session.User.Sala.SendData(server, Session);
        }
        private static void Packet_189_173(SessionInstance Session, BuyObjectInstance Compra)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(189);
            server.AddHead(173);
            server.AppendParameter(Compra.id);
            server.AppendParameter((86400 - Time.GetDifference(Compra.Planta_agua)) / 12);
            server.AppendParameter(Time.GetDifference(Compra.Planta_agua));
            server.AppendParameter((604800 - Time.GetDifference(Compra.Planta_sol)) / 4);
            server.AppendParameter(Time.GetDifference(Compra.Planta_sol));
            server.AppendParameter(1);
            Session.User.Sala.SendData(server, Session);
        }
        private static void Packet_139(SessionInstance Session, SessionInstance OtherSession, int InteraccionID)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(139);
            server.AppendParameter(InteraccionID);
            server.AppendParameter(OtherSession.User.IDEspacial);
            server.AppendParameter(OtherSession.User.Posicion.x);
            server.AppendParameter(OtherSession.User.Posicion.y);
            server.AppendParameter(Session.User.IDEspacial);
            server.AppendParameter(Session.User.Posicion.x);
            server.AppendParameter(Session.User.Posicion.y);
            Session.User.Sala.SendData(server, Session);
        }
        private static void Packet_158(SessionInstance Session)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(158);
            server.AppendParameter(Session.User.IDEspacial);
            server.AppendParameter(Session.User.bocadillo);
            Session.User.Sala.SendData(server, Session);
            Session.User.PreLock_Ficha = true;
        }
        public static void Packet_209128(SessionInstance Session)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(209);
            server.AddHead(128);
            server.AppendParameter(0);
            Session.SendData(server);
        }
        private static void Packet_183(SessionInstance Session, string mensaje)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(183);
            server.AppendParameter(mensaje);
            Session.SendData(server);
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
        private static void Packet_149(SessionInstance Session)
        {
            ServerMessage cocold = new ServerMessage();
            cocold.AddHead(149);
            cocold.AppendParameter(1);
            cocold.AppendParameter(Session.User.IDEspacial);
            cocold.AppendParameter(1);
            Session.User.Sala.SendData(cocold);
        }
        private static void Packet_184_120(SessionInstance Session, int modelo)
        {
            ServerMessage coco = new ServerMessage();
            coco.AddHead(184);
            coco.AddHead(120);
            coco.AppendParameter(Session.User.id);
            coco.AppendParameter(0);
            coco.AppendParameter(modelo);
            Session.User.Sala.SendData(coco);
        }
        private static void Packet_184_121(SessionInstance Session, int modelo)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(184);
            server.AddHead(121);
            server.AppendParameter(Session.User.id);
            server.AppendParameter(0);
            server.AppendParameter(modelo);
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
    }
}
