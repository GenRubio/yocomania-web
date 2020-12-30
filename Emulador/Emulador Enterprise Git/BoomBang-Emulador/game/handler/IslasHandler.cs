using BoomBang.game.instances;
using BoomBang.game.manager;
using BoomBang.game.packets;
using BoomBang.server;
using System;
using System.Collections.Generic;
using System.Data;
using System.Linq;
using System.Text;
using System.Threading;
using System.Threading.Tasks;

namespace BoomBang.game.handler
{
    class IslasHandler
    {
        public static void Start()
        {
            HandlerManager.RegisterHandler(130, new ProcessHandler(Tutorial_Islas));
            HandlerManager.RegisterHandler(189120, new ProcessHandler(CrearIsla));
            HandlerManager.RegisterHandler(189124, new ProcessHandler(MostrarIsla));
            HandlerManager.RegisterHandler(189121, new ProcessHandler(CrearZona));
            HandlerManager.RegisterHandler(189149, new ProcessHandler(EliminarIsla));
            HandlerManager.RegisterHandler(189132, new ProcessHandler(EliminarZona));
            HandlerManager.RegisterHandler(189130, new ProcessHandler(RenombrarZona));
            HandlerManager.RegisterHandler(189129, new ProcessHandler(RenombrarIsla));
            HandlerManager.RegisterHandler(189126, new ProcessHandler(CambiarDescripcion));
            HandlerManager.RegisterHandler(189147, new ProcessHandler(ExpulsarUsuario));
            HandlerManager.RegisterHandler(189146, new ProcessHandler(CambiarColores));
            HandlerManager.RegisterHandler(189125, new ProcessHandler(CambiarUppercut));
            HandlerManager.RegisterHandler(189150, new ProcessHandler(NoVerlo));
            HandlerManager.RegisterHandler(189127, new ProcessHandler(MAmigos));
            HandlerManager.RegisterHandler(189131, new ProcessHandler(Poner_Clave));
            HandlerManager.RegisterHandler(189123, new ProcessHandler(Validar_Clave_Acceso));
        }
        static void Validar_Clave_Acceso(SessionInstance Session, string[,] Parameters)
        {
            if (Session.User != null)
            {
                if (Session.User.PreLock__Proteccion_SQL == true) return;
                if (Session.User.Sala != null) return;
                mysql client = new mysql();
                DataRow row = client.ExecuteQueryRow("SELECT * FROM escenarios_privados WHERE id = '" + int.Parse(Parameters[0, 0]) + "'");
                if (row != null)
                {
                    EscenarioInstance Escenario = new EscenarioInstance(row);
                    if (Escenario.categoria != 2) return;
                    if (!string.IsNullOrEmpty(Escenario.Clave))
                    {
                        if (Escenario.Clave != Parameters[1, 0])
                        {
                            Packet_189_123(Session);
                            return;
                        }
                    }
                    SalasManager.IrAlli(Session, Escenario.es_categoria, Escenario.id, null, true);
                }
                Session.User.PreLock__Proteccion_SQL = true;
            }
        }
        static void Poner_Clave(SessionInstance Session, string[,] Parameters)
        {
            if (Session.User != null)
            {
                if (Session.User.PreLock__Proteccion_SQL == true) return;
                if (Session.User.Sala != null) return;
                mysql client = new mysql();
                DataRow row = client.ExecuteQueryRow("SELECT * FROM escenarios_privados WHERE id = '" + int.Parse(Parameters[1, 0]) + "'");
                if (row != null)
                {
                    EscenarioInstance Escenario = new EscenarioInstance(row);
                    if (Escenario.Creador.id == Session.User.id || Session.User.admin == 1)
                    {
                        if (client.ExecuteNonQuery("UPDATE escenarios_privados SET clave = '" + Parameters[2, 0] + "' WHERE id = '" + Escenario.id + "'") == 1)
                        {
                            if (SalasManager.Salas_Privadas.ContainsKey(int.Parse(Parameters[1, 0])))
                            {
                                SalaInstance Sala = SalasManager.Salas_Privadas[int.Parse(Parameters[1, 0])];
                                Sala.Escenario.Clave = Parameters[2, 0];
                            }
                        }
                    }
                }
                Session.User.PreLock__Proteccion_SQL = true;
            }
        }
        static void MAmigos(SessionInstance Session, string[,] Parameters)
        {
            if (Session.User != null)
            {
                if (Session.User.Sala != null) return;
                IslaInstance Isla = IslasManager.ObtenerIsla(int.Parse(Parameters[0, 0]));
                if (Isla != null)
                {
                    if (IslasManager.ControlDeSeguridad(Session.User, Isla))
                    {
                        if (Parameters[1, 0] == Session.User.nombre) { Parameters[1, 0] = ""; }
                        if (Parameters[2, 0] == Session.User.nombre) { Parameters[2, 0] = ""; }
                        if (Parameters[3, 0] == Session.User.nombre) { Parameters[3, 0] = ""; }
                        if (Parameters[4, 0] == Session.User.nombre) { Parameters[4, 0] = ""; }
                        if (Parameters[5, 0] == Session.User.nombre) { Parameters[5, 0] = ""; }
                        if (Parameters[6, 0] == Session.User.nombre) { Parameters[6, 0] = ""; }
                        if (Parameters[7, 0] == Session.User.nombre) { Parameters[7, 0] = ""; }
                        if (Parameters[8, 0] == Session.User.nombre) { Parameters[8, 0] = ""; }
                        new Thread(() => IslasManager.AñadirMAmigos(Isla, Parameters[1, 0], Parameters[2, 0], Parameters[3, 0], Parameters[4, 0],
                            Parameters[5, 0], Parameters[6, 0], Parameters[7, 0], Parameters[8, 0])).Start();
                    }
                }
            }
        }
        static void NoVerlo(SessionInstance Session, string[,] Parameters)
        {
            if (Session.User != null)
            {
                if (Session.User.Sala != null) return;
                IslaInstance Isla = IslasManager.ObtenerIsla(int.Parse(Parameters[0, 0]));
                if (Isla != null)
                {
                    if (IslasManager.ControlDeSeguridad(Session.User, Isla))
                    {
                        if (Parameters[1, 0] == Session.User.nombre) { Parameters[1, 0] = ""; }
                        if (Parameters[2, 0] == Session.User.nombre) { Parameters[2, 0] = ""; }
                        if (Parameters[3, 0] == Session.User.nombre) { Parameters[3, 0] = ""; }
                        if (Parameters[4, 0] == Session.User.nombre) { Parameters[4, 0] = ""; }
                        if (Parameters[5, 0] == Session.User.nombre) { Parameters[5, 0] = ""; }
                        if (Parameters[6, 0] == Session.User.nombre) { Parameters[6, 0] = ""; }
                        if (Parameters[7, 0] == Session.User.nombre) { Parameters[7, 0] = ""; }
                        if (Parameters[8, 0] == Session.User.nombre) { Parameters[8, 0] = ""; }
                        new Thread(() => IslasManager.AñadirNoVerlo(Isla, Parameters[1, 0], Parameters[2, 0], Parameters[3, 0], 
                            Parameters[4, 0], Parameters[5, 0], Parameters[6, 0], Parameters[7, 0], Parameters[8, 0])).Start();
                        
                    }
                }
            }
        }
        static void Tutorial_Islas(SessionInstance Session, string[,] Parameters)
        {
            if (Session.User != null)
            {
                if (Session.User.Sala != null)
                {
                    if (Session.User.Sala.Escenario.es_categoria != 0) return;
                    Session.User.tutorial_islas = 0;
                    UserManager.Creditos(Session.User, false, true, 10000);
                    Session.User.Sala.ActualizarEstadisticas(Session.User);
                }
            }
        }
        static void CambiarDescripcion(SessionInstance Session, string[,] Parameters)
        {
            if (Session.User != null)
            {
                if (Session.User.PreLock__Proteccion_SQL == true) return;
                if (Session.User.Sala != null) return;
                IslaInstance Isla = IslasManager.ObtenerIsla(int.Parse(Parameters[0, 0]));
                if (Isla != null)
                {
                    if (IslasManager.ControlDeSeguridad(Session.User, Isla))
                    {
                        if (Session.ValidarEntrada(Parameters[1, 0], false))
                        {
                            new Thread(() => IslasManager.CambiarDescripcion(Isla, Parameters[1, 0])).Start();
                        }
                        Session.User.PreLock__Proteccion_SQL = true;
                    }
                }
            }
        }
        static void CambiarUppercut(SessionInstance Session, string[,] Parameters)
        {
            if (Session.User != null)
            {
                if (Session.User.PreLock__Proteccion_SQL == true) return;
                if (Session.User.Sala != null) return;
                IslaInstance Isla = IslasManager.ObtenerIsla(int.Parse(Parameters[0, 0]));
                if (Isla != null)
                {
                    if (IslasManager.ControlDeSeguridad(Session.User, Isla))
                    {
                        new Thread(() => IslasManager.CambiarUppert(Isla, int.Parse(Parameters[1, 0]))).Start();
                        Session.User.PreLock__Proteccion_SQL = true;
                    }
                }
            }
        }
        static void CambiarColores(SessionInstance Session, string[,] Parameters)
        {
            if (Session.User != null)
            {
                if (Session.User.PreLock__Proteccion_SQL == true) return;
                if (Session.User.Sala != null)
                {
                    if (EscenariosManager.ControlDeSeguridad(Session.User, Session.User.Sala.Escenario))
                    {
                        new Thread(() => EscenariosManager.CambiarColores(Session.User.Sala.Escenario, Parameters[0, 0], Parameters[1, 0])).Start();
                        Packet_189_146(Session, Parameters[0, 0], Parameters[1, 0]);
                        Session.User.PreLock__Proteccion_SQL = true;
                    }
                }
            }
        }
        static void ExpulsarUsuario(SessionInstance Session, string[,] Parameters)
        {
            if (Session.User != null)
            {
                if (Session.User.Sala != null)
                {
                    if (EscenariosManager.ControlDeSeguridad(Session.User, Session.User.Sala.Escenario))
                    {
                        SessionInstance SessionToKick = UserManager.ObtenerSession(int.Parse(Parameters[1, 0]));
                        if (SessionToKick != null)
                        {
                            SessionInstance SessionToKick_2 = Session.User.Sala.ObtenerSession(SessionToKick.User.IDEspacial);
                            if (SessionToKick_2 != null)
                            {
                                if (SessionToKick_2.User.id == SessionToKick.User.id)
                                {
                                    SalasManager.Salir_Sala(SessionToKick, true);
                                }
                            }
                        }
                    }
                }
            }
        }
        static void RenombrarIsla(SessionInstance Session, string[,] Parameters)
        {
            if (Session.User != null)
            {
                if (Session.User.PreLock__Proteccion_SQL == true) return;
                if (Session.User.Sala != null) return;
                IslaInstance Isla = IslasManager.ObtenerIsla(int.Parse(Parameters[0, 0]));
                if (Isla != null)
                {
                    if (IslasManager.ControlDeSeguridad(Session.User, Isla))
                    {
                        if (Session.ValidarEntrada(Parameters[1, 0], false))
                        {
                            Packet_189_129(Session, Isla, Parameters[1, 0]);
                        }
                        Session.User.PreLock__Proteccion_SQL = true;
                    }
                }
            }
        }
        static void RenombrarZona(SessionInstance Session, string[,] Parameters)
        {
            if (Session.User != null)
            {
                if (Session.User.PreLock__Proteccion_SQL == true) return;
                if (Session.User.Sala != null) return;
                EscenarioInstance Escenario = EscenariosManager.ObtenerEscenario(0, int.Parse(Parameters[1, 0]));
                if (Escenario != null)
                {
                    if (EscenariosManager.ControlDeSeguridad(Session.User, Escenario))
                    {
                        if (Session.ValidarEntrada(Parameters[2, 0], false))
                        {
                            EscenariosManager.RenombrarEscenario(Escenario, Parameters[2, 0]);
                        }
                        Session.User.PreLock__Proteccion_SQL = true;
                    }
                }
            }
        }
        static void EliminarZona(SessionInstance Session, string[,] Parameters)
        {
            if (Session.User != null)
            {
                if (Session.User.Sala != null) return;
                EscenarioInstance Escenario = EscenariosManager.ObtenerEscenario(0, int.Parse(Parameters[0, 0]));
                if (Escenario != null)
                {
                    if (EscenariosManager.ControlDeSeguridad(Session.User, Escenario))
                    {
                        EscenariosManager.EliminarEscenario(Escenario);
                    }
                }
            }
        }
        static void EliminarIsla(SessionInstance Session, string[,] Parameters)
        {
            if (Session.User != null)
            {
                if (Session.User.Sala != null) return;
                IslaInstance Isla = IslasManager.ObtenerIsla(int.Parse(Parameters[0, 0]));
                if (Isla != null)
                {
                    if (IslasManager.ControlDeSeguridad(Session.User, Isla))
                    {
                        new Thread(() => IslasManager.EliminarIsla(Isla)).Start();
                    }
                }
            }
        }
        static void CrearZona(SessionInstance Session, string[,] Parameters)
        {
            if (Session.User != null)
            {
                if (Session.User.PreLock__Proteccion_SQL == true) return;
                if (Session.User.Sala != null) return;
                IslaInstance Isla = IslasManager.ObtenerIsla(int.Parse(Parameters[0, 0]));
                if (Isla != null)
                {
                    if (IslasManager.ControlDeSeguridad(Session.User, Isla))
                    {
                        if (IslasManager.ZonasIsla(Isla).Count <= 4)
                        {
                            if (Session.ValidarEntrada(Parameters[1, 0], false))
                            {
                                int ZonaID = IslasManager.Crear_Zona(Isla, Session.User, Parameters[1, 0], int.Parse(Parameters[6, 0]), 
                                    Parameters[7, 0], Parameters[8, 0]);
                                if (ZonaID >= 1)
                                {
                                    EscenarioInstance Escenario = EscenariosManager.ObtenerEscenario(0, ZonaID);
                                    if (Escenario != null)
                                    {
                                        Packet_189_121(Session, Escenario);
                                        Session.User.PreLock__Proteccion_SQL = true;
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        static void MostrarIsla(SessionInstance Session, string[,] Parameters)
        {
            if (Session.User != null)
            {
                if (Session.User.Sala != null) return;
                Packet_189_124(Session, int.Parse(Parameters[0, 0]));
            }
        }
        static void CrearIsla(SessionInstance Session, string[,] Parameters)
        {
            if (Session.User != null)
            {
                if (Session.User.PreLock__Proteccion_SQL == true) return;
                if (Session.User.Sala != null) return;
                Packet_189_120(Session, Parameters[0, 0], int.Parse(Parameters[1, 0]));
                Session.User.PreLock__Proteccion_SQL = true;
            }
        }
        private static void Packet_189_123(SessionInstance Session)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(189);
            server.AddHead(123);
            server.AppendParameter(0);
            Session.SendData(server);
        }
        private static void Packet_189_146(SessionInstance Session, string HEX, string Dec)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(189);
            server.AddHead(146);
            server.AppendParameter(Session.User.Sala.Escenario.id);
            server.AppendParameter(HEX);
            server.AppendParameter(Dec);
            Session.User.Sala.SendData(server, Session);
        }
        private static void Packet_189_129(SessionInstance Session, IslaInstance Isla, string Nombre)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(189);
            server.AddHead(129);
            if (IslasManager.ObtenerIsla(Nombre) == null)
            {
                new Thread(() => IslasManager.RenombrarIsla(Isla, Nombre)).Start();
                server.AppendParameter(1);
            }
            else
            {
                server.AppendParameter(0);
            }
            Session.SendData(server);
        }
        private static void Packet_189_121(SessionInstance Session, EscenarioInstance Escenario)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(189);
            server.AddHead(121);
            server.AppendParameter(0);
            server.AppendParameter(Escenario.es_categoria);
            server.AppendParameter(0);
            server.AppendParameter(0);
            server.AppendParameter(Escenario.id);
            Session.SendData(server);
        }
        private static void Packet_189_124(SessionInstance Session, int IslaID)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(189);
            server.AddHead(124);
            IslaInstance Isla = IslasManager.ObtenerIsla(IslaID);
            if (Isla != null)
            {
                IslasManager.Diccionario_AñadirIsla(Isla);
                List<EscenarioInstance> Escenarios = IslasManager.ZonasIsla(Isla);
                server.AppendParameter(Isla.id);
                server.AppendParameter(Isla.nombre);
                server.AppendParameter(Isla.descripcion);
                server.AppendParameter(Isla.modelo);
                server.AppendParameter(Isla.uppert);
                server.AppendParameter(Isla.Creador.id);
                server.AppendParameter(Isla.Creador.nombre);
                server.AppendParameter(Isla.Creador.avatar);
                server.AppendParameter(Isla.Creador.colores);
                server.AppendParameter(Isla.mamigos_1);
                server.AppendParameter(Isla.mamigos_2);
                server.AppendParameter(Isla.mamigos_3);
                server.AppendParameter(Isla.mamigos_4);
                server.AppendParameter(Isla.mamigos_5);
                server.AppendParameter(Isla.mamigos_6);
                server.AppendParameter(Isla.mamigos_7);
                server.AppendParameter(Isla.mamigos_8);
                server.AppendParameter(Isla.noverlo_1);
                server.AppendParameter(Isla.noverlo_2);
                server.AppendParameter(Isla.noverlo_3);
                server.AppendParameter(Isla.noverlo_4);
                server.AppendParameter(Isla.noverlo_5);
                server.AppendParameter(Isla.noverlo_6);
                server.AppendParameter(Isla.noverlo_7);
                server.AppendParameter(Isla.noverlo_8);
                server.AppendParameter(Escenarios.Count);
                foreach (EscenarioInstance Escenario in Escenarios)
                {
                    server.AppendParameter(0);
                    server.AppendParameter(Escenario.es_categoria);
                    server.AppendParameter(Escenario.id);
                    server.AppendParameter(Escenario.id);
                    server.AppendParameter(Escenario.nombre);
                    server.AppendParameter(Escenario.modelo);
                    server.AppendParameter(0);
                    server.AppendParameter(0);
                    server.AppendParameter(0);
                    server.AppendParameter(SalasManager.UsuariosEnSala(Escenario));//Visitantes
                    server.AppendParameter(0);
                    if (Isla.noverlo_1.Contains(Session.User.nombre) || Isla.noverlo_2.Contains(Session.User.nombre) || Isla.noverlo_3.Contains(Session.User.nombre) || Isla.noverlo_4.Contains(Session.User.nombre) || Isla.noverlo_5.Contains(Session.User.nombre) || Isla.noverlo_6.Contains(Session.User.nombre) || Isla.noverlo_7.Contains(Session.User.nombre) || Isla.noverlo_8.Contains(Session.User.nombre))
                    {
                        server.AppendParameter(1);//Usuario no puede acceder a la isla
                        server.AppendParameter(1);
                    }
                    else
                    {
                        if (Isla.mamigos_1.Contains(Session.User.nombre) || Isla.mamigos_2.Contains(Session.User.nombre) || Isla.mamigos_3.Contains(Session.User.nombre) || Isla.mamigos_4.Contains(Session.User.nombre) || Isla.mamigos_5.Contains(Session.User.nombre) || Isla.mamigos_6.Contains(Session.User.nombre) || Isla.mamigos_7.Contains(Session.User.nombre) || Isla.mamigos_8.Contains(Session.User.nombre))
                        {
                            server.AppendParameter(0);
                        }
                        else
                        {
                            server.AppendParameter((string.IsNullOrEmpty(Escenario.Clave) ? 0 : 1));
                        }
                    }
                }

            }
            else
            {
                server.AppendParameter(0);
            }
            Session.SendData(server);
        }
        private static void Packet_189_120(SessionInstance Session, string Nombre, int Modelo)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(189);
            server.AddHead(120);
            if (IslasManager.IslasCreadas(Session.User) < 25)
            {
                if (Nombre == "") { Session.FinalizarConexion("Packet_189_120"); return; }
                if (Session.ValidarEntrada(Nombre, false))
                {
                    if (IslasManager.ObtenerIsla(Nombre) == null)
                    {
                        server.AppendParameter(IslasManager.CrearIsla(Session.User, Nombre, Modelo));
                    }
                    else
                    {
                        server.AppendParameter(0);
                    }
                }
            }
            else
            {
                server.AppendParameter(0);
            }
            Session.SendData(server);
        }
    }
}
