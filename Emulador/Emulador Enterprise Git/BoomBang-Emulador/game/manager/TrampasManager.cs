using BoomBang.game.instances;
using BoomBang.server;
using System;
using System.Collections.Generic;
using System.Data;
using System.Linq;
using System.Text;
using System.Threading;
using System.Threading.Tasks;

namespace BoomBang.game.manager
{
    public class TrampasManager
    {
        private static List<TrampaInstance> trampasPublicas = new List<TrampaInstance>();
        private static List<TrampaInstance> trampasPrivadas = new List<TrampaInstance>();
        public static void saveTrampasSala()
        {
            mysql client = new mysql();
            foreach(DataRow trampa in client.ExecuteQueryTable("SELECT * FROM trampas_publicas").Rows)
            {
                trampasPublicas.Add(new TrampaInstance(trampa));
            }
            foreach (DataRow trampa in client.ExecuteQueryTable("SELECT * FROM trampas_privadas").Rows)
            {
                trampasPrivadas.Add(new TrampaInstance(trampa));
            }
        }
        private static void buscarFlechas(int es_categoria, int escenario_id, SessionInstance Session)
        {
            foreach(TrampaInstance trampa in trampasPublicas.ToList())
            {
                if (trampa.es_categoria == es_categoria && trampa.escenario_id == escenario_id)
                {
                    ServerMessage server = new ServerMessage();
                    server.AddHead(124);
                    server.AddHead(120);
                    server.AppendParameter(trampa.Posicion.x);
                    server.AppendParameter(trampa.Posicion.y);
                    server.AppendParameter(trampa.modelo);
                    Session.SendData(server);
                }
            }
        }
        public static void ObtenerTrampas(SessionInstance Session)
        {
            if (Session.User != null)
            {
                if (Session.User.Sala != null)
                {
                    buscarFlechas(Session.User.Sala.Escenario.es_categoria, Session.User.Sala.Escenario.modelo, Session);
                }
            }
        }
        private static TrampaInstance detectUserInCroz(int es_categoria, int escenario_id, int x, int y, bool publicArea)
        {
            if (publicArea)
            {
                foreach (TrampaInstance trampa in trampasPublicas.ToList())
                {
                    if (trampa.es_categoria == es_categoria && trampa.escenario_id == escenario_id && trampa.Posicion.x == x && trampa.Posicion.y == y)
                    {
                        return trampa;
                    }
                }
            }
            else
            {
                foreach (TrampaInstance trampa in trampasPrivadas.ToList())
                {
                    if (trampa.es_categoria == es_categoria && trampa.escenario_id == escenario_id && trampa.Posicion.x == x && trampa.Posicion.y == y)
                    {
                        return trampa;
                    }
                }
            }
            return null;
        }
        public static void BuscarTrampa(SessionInstance Session)
        {
            if (Session.User.Sala != null)
            {
                if (Session.User.Sala.Escenario.es_categoria == 1)//Salas publicas
                {
                    TrampaInstance trampa = detectUserInCroz(Session.User.Sala.Escenario.es_categoria, Session.User.Sala.Escenario.id,
                        Session.User.Posicion.x, Session.User.Posicion.y, true);
                    if (trampa != null)
                    {
                        new Thread(() => EjecutarTrampa(Session, trampa, true)).Start();
                    }
                }
                else if (Session.User.Sala.Escenario.es_categoria == 0)//Salas privadas
                {
                    TrampaInstance trampa = detectUserInCroz(Session.User.Sala.Escenario.es_categoria, Session.User.Sala.Escenario.id,
                       Session.User.Posicion.x, Session.User.Posicion.y, false);
                    if (trampa != null)
                    {
                        new Thread(() => EjecutarTrampa(Session, trampa, false)).Start();
                    }
                }  
            }
        }
        public static void EjecutarTrampa(SessionInstance Session, TrampaInstance Trampa, bool publica)
        {
            if (Session.User != null)
            {
                if (Session.User.Sala != null)
                {
                    if (publica == false)
                    {
                        mysql client = new mysql();
                        client.SetParameter("modelo", Trampa.modelo);
                        DataRow muchila = client.ExecuteQueryRow("SELECT * FROM objetos_comprados WHERE id = @modelo");
                        if (muchila != null)
                        {
                            int objeto_id = (int)muchila["objeto_id"];
                            if (objeto_id == 1230)//Liana
                            {
                                Session.User.Time_Interactuando = Time.GetCurrentAndAdd(AddType.Segundos, 10);
                                Session.User.Trayectoria.DetenerMovimiento();
                                ServerMessage liana = new ServerMessage();
                                liana.AddHead(147);
                                liana.AppendParameter(Session.User.IDEspacial);
                                Session.User.Sala.SendData(liana);
                                Thread.Sleep(new TimeSpan(0, 0, 10));
                                SalasManager.Salir_Sala(Session, true);
                            }
                            else if (objeto_id == 1229)//Coco
                            {
                                Session.User.Time_Interactuando = Time.GetCurrentAndAdd(AddType.Segundos, 6);
                                Session.User.Trayectoria.DetenerMovimiento();
                                Session.User.Sala.Map[Session.User.Posicion.y, Session.User.Posicion.x].FijarSession(null);
                                ServerMessage coco = new ServerMessage();
                                coco.AddHead(184);
                                coco.AddHead(120);
                                coco.AppendParameter(Session.User.id);
                                coco.AppendParameter(0);
                                coco.AppendParameter(35);
                                Session.User.Sala.SendData(coco);
                                Thread.Sleep(new TimeSpan(0, 0, 6));
                                Session.User.Posicion = Trampa.MoverUsuario;
                                ServerMessage server = new ServerMessage();
                                server.AddHead(135);
                                server.AppendParameter(Session.User.IDEspacial);
                                server.AppendParameter(Session.User.Posicion.x);
                                server.AppendParameter(Session.User.Posicion.y);
                                server.AppendParameter(Session.User.Posicion.z);
                                Session.User.Sala.SendData(server, Session);
                            }
                            else //Portales Magicos
                            {
                                if (Trampa.go_es_categoria >= 0)
                                {
                                    if (Trampa.go_escenario_id >= 1)
                                    {
                                        Session.User.Time_Interactuando = Time.GetCurrentAndAdd(AddType.Segundos, 1);
                                        Session.User.Trayectoria.DetenerMovimiento();
                                        Thread.Sleep(new TimeSpan(0, 0, 1));
                                        if (Trampa.go_escenario_posicion.x != -1 && Trampa.go_escenario_posicion.y != -1)
                                        {
                                            SalasManager.IrAlli(Session, Trampa.go_es_categoria, Trampa.go_escenario_id, Trampa.go_escenario_posicion);
                                            return;
                                        }
                                        SalasManager.IrAlli(Session, Trampa.go_es_categoria, Trampa.go_escenario_id);
                                        return;
                                    }
                                }
                            }
                        }
                    }
                    else if (publica == true)
                    {
                        if (Trampa.go_es_categoria >= 0)
                        {
                            if (Trampa.go_escenario_id >= 1)
                            {
                                Session.User.Time_Interactuando = Time.GetCurrentAndAdd(AddType.Segundos, 1);
                                Session.User.Trayectoria.DetenerMovimiento();
                                Thread.Sleep(new TimeSpan(0, 0, 1));
                                if (Trampa.go_escenario_posicion.x != -1 && Trampa.go_escenario_posicion.y != -1)
                                {
                                    SalasManager.IrAlli(Session, Trampa.go_es_categoria, Trampa.go_escenario_id, Trampa.go_escenario_posicion);
                                    return;
                                }
                                SalasManager.IrAlli(Session, Trampa.go_es_categoria, Trampa.go_escenario_id);
                                return;
                            }
                        }
                    }
                }
            }
        }
    }
}
