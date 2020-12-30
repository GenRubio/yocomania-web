using BoomBang.game.handler;
using BoomBang.game.instances;
using BoomBang.game.instances.manager.pathfinding;
using BoomBang.game.instances.MiniGames;
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

namespace BoomBang.game.manager
{
    public class SalasManager
    {
        public static Dictionary<int, SalaInstance> Salas_Publicas = new Dictionary<int, SalaInstance>();
        public static Dictionary<int, SalaInstance> Salas_Privadas = new Dictionary<int, SalaInstance>();
        #region SalasAdmin V2
        public static void Initialize()
        {
            using (mysql client = new mysql())
            {
                foreach (DataRow row in client.ExecuteQueryTable("SELECT * FROM escenarios_publicos").Rows)
                {
                    CrearSala(new EscenarioInstance(row));
                }
            }
            Output.WriteLine("Se han registrado " + Salas_Publicas.Count + " salas públicas.");
        }
        #endregion
        #region SalasAdmin V1
        public static bool CrearSala(EscenarioInstance Escenario)
        {
            if (Escenario != null)
            {
                if (Escenario.es_categoria == 1 && Escenario.categoria == 1) //publico
                {
                    if (!Salas_Publicas.ContainsKey(Escenario.id))
                    {
                        Salas_Publicas.Add(Escenario.id, new SalaInstance(Escenario.id, Escenario));
                        return true;
                    }
                }
                if (Escenario.es_categoria == 0 && Escenario.categoria ==  4 || Escenario.es_categoria == 0 && Escenario.categoria == 2) //privada
                {
                    if (!Salas_Privadas.ContainsKey(Escenario.id))
                    {
                        Salas_Privadas.Add(Escenario.id, new SalaInstance(Escenario.id, Escenario));
                        return true;
                    }
                }
            }
            return false;
        }
        public static void EliminarSala(SalaInstance Sala)
        {
            if (Sala != null)
            {
                if (Sala.Escenario.es_categoria == 0)
                {
                    if (Salas_Privadas.ContainsKey(Sala.id))
                    {
                        Salas_Privadas.Remove(Sala.id);
                        Sala.ExpusarUsuarios();
                    }
                }
                if (Sala.Escenario.es_categoria == 1)
                {
                    if (Salas_Publicas.ContainsKey(Sala.id))
                    {
                        Salas_Publicas.Remove(Sala.id);
                        Sala.ExpusarUsuarios();
                    }
                }
            }
        }
        public static int UsuariosEnSala(EscenarioInstance Escenario)
        {
            int num = 0;
            if (Escenario != null)
            {
                if (Escenario.es_categoria == 1)
                {
                    if (Escenario.id == 30)//Cementerio contador global
                    {
                        foreach (var sala in Salas_Publicas.Values)
                        {
                            if (sala.Escenario.id >= 26 && sala.Escenario.id <= 55)
                            {
                                num += Salas_Publicas[sala.id].Visitantes;
                            }
                        }
                    }
                    else if (Escenario.id == 57)//Bosque nevado contador global
                    {
                        foreach (var sala in Salas_Publicas.Values)
                        {
                            if (sala.Escenario.id >= 57 && sala.Escenario.id <= 74)
                            {
                                num += Salas_Publicas[sala.id].Visitantes;
                            }
                        }
                    }
                    else if (Escenario.id == 78) //Madriguera contador global
                    {
                        foreach (var sala in Salas_Publicas.Values)
                        {
                            if (sala.Escenario.id >= 78 && sala.Escenario.id <= 96)
                            {
                                num += Salas_Publicas[sala.id].Visitantes;
                            }
                        }
                    }
                    else if (Escenario.id == 214) //Isla Perdida
                    {
                        foreach (var sala in Salas_Publicas.Values)
                        {
                            if (sala.Escenario.id >= 214 && sala.Escenario.id <= 238)
                            {
                                num += Salas_Publicas[sala.id].Visitantes;
                            }
                        }
                    }
                    else
                    {
                        if (Salas_Publicas.ContainsKey(Escenario.id))
                        {
                            num += Salas_Publicas[Escenario.id].Visitantes;
                        }
                    }
                }
                if (Escenario.es_categoria == 0)
                {
                    if (Salas_Privadas.ContainsKey(Escenario.id))
                    {
                        num += Salas_Privadas[Escenario.id].Visitantes;
                        SalaInstance sala = Salas_Privadas[Escenario.id];
                        foreach (BuyObjectInstance Item in sala.ObjetosEnSala.Values)
                        {
                            if (listas.Objetos_Area.Contains(Item.objeto_id) && Salas_Privadas.ContainsKey(Convert.ToInt32(Item.data)))
                            {
                                num += Salas_Privadas[Convert.ToInt32(Item.data)].Visitantes;
                            }
                        }
                    }
                }
                if (Escenario.es_categoria == 2) return RingInstance.Jugadores;
                if (Escenario.es_categoria == 8) return CocosInstance.Jugadores;
                if (Escenario.es_categoria == 6) return SenderoInstance.Jugadores;
                if (Escenario.es_categoria == 12) return CaminoInstance.Jugadores;
            }
            return num;
        }
        public static bool IrAlli(SessionInstance Session, int es_categoria, int id, Posicion DoorPosition = null, bool Autorizado = false)
        {
            if (es_categoria == 1) //publicos
            {
                if (Salas_Publicas.ContainsKey(id))
                {
                    SalaInstance Sala = Salas_Publicas[id];
                    if (Sala.Escenario.id == 9 && Session.User.vip <= 0 && Session.User.admin <= 0)
                    {
                        Packets.Packet_183(Session, "Igloo [VIP]\rSabio: La area Igloo es exclusiva para los usuarios VIP. Puedes comprar VIP en FlowerPower.\rOso Polar: En mi area encontrarás Shurikens y Coco que caen de vez en cuando.");
                        return false;
                    }
                    if (Entrar_Sala(Session, Salas_Publicas[id], DoorPosition))
                    {
                        Salas_Publicas[id].CargarEscenario(Session);
                        return true;
                    }
                }
                else
                {
                    SalaInstance Sala = Salas_Publicas[id];
                    if (Sala.Escenario.id == 9 && Session.User.vip <= 0 && Session.User.admin <= 0)
                    {
                        Packets.Packet_183(Session, "Igloo [VIP]\rSabio: La area Igloo es exclusiva para los usuarios VIP. Puedes comprar VIP en FlowerPower.\rOso Polar: En mi area encontrarás Shurikens y Coco que caen de vez en cuando.");
                        return false;
                    }
                    if (CrearSala(EscenariosManager.ObtenerEscenario(es_categoria, id)))
                    {
                        if (Salas_Publicas.ContainsKey(id))
                        {
                            if (Entrar_Sala(Session, Salas_Publicas[id], DoorPosition))
                            {
                                Salas_Publicas[id].CargarEscenario(Session);
                                return true;
                            }
                        }
                    }
                }
            }
            if (es_categoria == 0) //Privados
            {
                if (Salas_Privadas.ContainsKey(id))
                {
                    SalaInstance Sala = Salas_Privadas[id];
                    if (Sala.Escenario.Ultima_Sala != 0) { Sala.Escenario.IslaID = Sala.Escenario.Ultima_Sala; }
                    if (Sala.Escenario.Creador.id != Session.User.id)
                    {
                        if (Session.User.admin != 1)
                        {
                            if (!string.IsNullOrEmpty(Sala.Escenario.Clave))
                            {
                                if (!Autorizado) return false;
                            }
                        }
                    }
                    if (Entrar_Sala(Session, Salas_Privadas[id], DoorPosition))
                    {        
                        Salas_Privadas[id].CargarEscenario(Session);
                        return true;
                    }
                }
                else
                {
                    if (CrearSala(EscenariosManager.ObtenerEscenario(es_categoria, id)))
                    {
                        if (Salas_Privadas.ContainsKey(id))
                        {
                            SalaInstance Sala = Salas_Privadas[id];
                            if (Sala.Escenario.Ultima_Sala != 0) { Sala.Escenario.IslaID = Sala.Escenario.Ultima_Sala; }
                            if (Sala.Escenario.Creador.id != Session.User.id)
                            {
                                if (Session.User.admin != 1)
                                {
                                    if (!string.IsNullOrEmpty(Sala.Escenario.Clave))
                                    {
                                        if (!Autorizado) return false;
                                    }
                                }
                            }
                            if (Entrar_Sala(Session, Salas_Privadas[id], DoorPosition))
                            {
                                Salas_Privadas[id].CargarEscenario(Session);
                                return true;
                            }
                        }
                    }
                }
            }
            return false;
        }
        public static SalaInstance ObtenerSala(EscenarioInstance Escenario)
        {
            if (Escenario.es_categoria == 0)
            {
                if (Salas_Privadas.ContainsKey(Escenario.id))
                {
                    return Salas_Privadas[Escenario.id];
                }
            }
            if (Escenario.es_categoria == 1)
            {
                if (Salas_Publicas.ContainsKey(Escenario.id))
                {
                    return Salas_Publicas[Escenario.id];
                }
            }
            return null;
        }
        public static bool Entrar_Sala(SessionInstance Session, SalaInstance Sala, Posicion DoorPosicion)
        {
            int key = 1;
            if (Sala.Visitantes < Sala.Escenario.max_visitantes)
            {

                if (Session.User.Sala != null)
                {
                    if (Session.User.Sala.Escenario.es_categoria == Sala.Escenario.es_categoria && Session.User.Sala.id == Sala.id)
                    {
                        return false;
                    }
                    Salir_Sala(Session);
                }
                while (Sala.Usuarios.ContainsKey(key))
                {
                    key++;
                }
                Sala.Usuarios.Add(key, Session);
                if (Sala.Usuarios.ContainsKey(key))
                {
                    if (Sala.Escenario.es_categoria == 2)
                    {
                        Session.User.Posicion = MiniGamesManager.ObtenerPuerta(Sala.Escenario, key);
                        if (Sala.Ring != null)
                        {
                            Sala.Ring.Participantes.Add(key, Session);
                            Session.User.CocosRestantes = 3;
                        }
                        if (Sala.Cocos != null)
                        {
                            Sala.Cocos.Participantes.Add(key, Session);
                            Session.User.CocosRestantes = 3;
                        }
                        if (Sala.Sendero != null)
                        {
                            Sala.Sendero.Participantes.Add(key, Session);
                            Session.User.CocosRestantes = 3;
                        }
                        if (Sala.Camino != null)
                        {
                            Sala.Camino.Participantes.Add(key, Session);
                            Session.User.CocosRestantes = 3;
                        }
                    }
                    else
                    {
                        if (DoorPosicion != null)
                            Session.User.Posicion = DoorPosicion;
                        else
                            Session.User.Posicion = new Posicion(Sala.Puerta.x, Sala.Puerta.y);
                    }
                    Session.User.Sala = Sala;
                    Session.User.IDEspacial = key;
                    Session.User.Trayectoria = new Trayectoria(Session);
                    Session.User.Sala.Map[Session.User.Posicion.y, Session.User.Posicion.x].FijarSession(Session);
                    if (Session.User.colores_old != "")
                    {
                        Session.User.colores = Session.User.colores_old;
                        Session.User.colores_old = "";
                        Session.User.block_upper = false;
                    }
                    Session.User.Sala.EnviarRegistro(Session);
                    return true;
                }
            }
            return false;
        }
        public static void Salir_Sala(SessionInstance Session, bool ByKick = false)
        {
            if (Session.User.Sala != null)
            {
                if (Session.User.Sala.Usuarios.ContainsKey(Session.User.IDEspacial))
                {
                    if (Session.User.Sala.Usuarios.Remove(Session.User.IDEspacial))
                    {
                        
                        Session.User.Sala.Map[Session.User.Posicion.y, Session.User.Posicion.x].FijarSession(null);
                        if (Session.Client.Connected)
                        {
                            ServerMessage cargar_flower_power = new ServerMessage();
                            cargar_flower_power.AddHead(128);
                            cargar_flower_power.AddHead(124);
                            Session.SendDataProtected(cargar_flower_power);
                            if (ByKick)
                            {
                                ServerMessage expulsar_usuario = new ServerMessage();
                                expulsar_usuario.AddHead(153);
                                Session.SendDataProtected(expulsar_usuario);
                            }
                        }
                        ServerMessage eliminar_usuario = new ServerMessage();
                        eliminar_usuario.AddHead(128);
                        eliminar_usuario.AddHead(123);
                        eliminar_usuario.AppendParameter(Session.User.IDEspacial);
                        Session.User.Sala.SendData(eliminar_usuario);
                        Session.User.Sala.EliminarInteraccionesDeUsuario(Session.User.IDEspacial);
                        MiniGamesManager.DescalificarParticipante(Session);
                        if (Session.User.Intercambio != null)
                        {
                            Session.User.Intercambio.TerminarCanjeo();
                        }
                        Session.User.Sala = null;
                    }
                }
            }
        }
        public static List<SalaInstance> Obtener_Salas_Privadas_Isla(IslaInstance Isla)
        {
            List<SalaInstance> Salas = new List<SalaInstance>();
            foreach (var Sala in Salas_Privadas.Values)
            {
                if (Sala.Escenario.IslaID == Isla.id)
                {
                    Salas.Add(Sala);
                }
            }
            return Salas;
        }
        #endregion
        #region oso_bosque
        public static void bosque_oso(SessionInstance Session)
        {
            if (Session.User.Sala.Escenario.id == 69 && Session.User.Posicion.x == 10 && Session.User.Posicion.y == 14 && Session.User.Efecto != 7)
            {
                Session.User.Trayectoria.DetenerMovimiento();
                packet_oso(Session);
                packet_upper(Session);
                Session.User.Time_Interactuando = Time.GetCurrentAndAdd(AddType.Segundos, 5);
                new Thread(() => Uppert_Kick(Session, Session.User.Sala)).Start();
            }
        }
        static void Uppert_Kick(SessionInstance Session, SalaInstance Sala)
        {
            Thread.Sleep(new TimeSpan(0, 0, 5));
            if (Session.User.Sala.id == Sala.id && Session.User.Sala.Escenario.es_categoria == Sala.Escenario.es_categoria)
            {
                SalasManager.Salir_Sala(Session, true);
            }
        }
        static void packet_upper(SessionInstance Session)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(165);
            server.AppendParameter(1);
            Session.User.Sala.SendData(server, Session);
        }
        static void packet_oso(SessionInstance Session)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(165);
            server.AppendParameter("³²1³²");
            Session.User.Sala.SendData(server, Session);
        }
    }
    #endregion
}
