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
    class NavigatorHandler
    {
        public static void Start()
        {
            HandlerManager.RegisterHandler(15432, new ProcessHandler(CargarEscenarios));
            HandlerManager.RegisterHandler(15433, new ProcessHandler(CargarSalas));
            HandlerManager.RegisterHandler(128120, new ProcessHandler(GoRoom_Subareas));
            HandlerManager.RegisterHandler(128125, new ProcessHandler(GoRoom));
            HandlerManager.RegisterHandler(128121, new ProcessHandler(LoadObjects));
            HandlerManager.RegisterHandler(128124, new ProcessHandler(SalirSala));
            HandlerManager.RegisterHandler(191, new ProcessHandler(Favoritos));
            HandlerManager.RegisterHandler(192, new ProcessHandler(AñadirFavorito));
            HandlerManager.RegisterHandler(193, new ProcessHandler(MisIslas));
            HandlerManager.RegisterHandler(194, new ProcessHandler(IslasPorUsuario));
            HandlerManager.RegisterHandler(195, new ProcessHandler(IslasPorNombre));
            HandlerManager.RegisterHandler(196, new ProcessHandler(EliminarFavorito));
            HandlerManager.RegisterHandler(187, new ProcessHandler(Islas));
        }
        static void EliminarFavorito(SessionInstance Session, string[,] Parameters)
        {
            if (Session.User != null)
            {
                if (Session.User.Sala != null) return;
                if (Session.User.id != int.Parse(Parameters[0, 0])) return;
                mysql client = new mysql();
                if (client.ExecuteQueryRow("SELECT * FROM escenarios_favoritos WHERE user_id = '" + Session.User.id + "' AND sala_id = '" + int.Parse(Parameters[1, 0]) + "'") != null)
                {
                    client.ExecuteNonQuery("DELETE FROM escenarios_favoritos WHERE user_id = '" + Session.User.id + "' AND sala_id = '" + int.Parse(Parameters[1, 0]) + "'");
                }
            }
        }
        static void IslasPorNombre(SessionInstance Session, string[,] Parameters)
        {
            if (Session.User != null)
            {
                if (Session.User.Sala != null) return;
                Packet_195(Session, Parameters[1, 0]);
            }   
        }
        static void IslasPorUsuario(SessionInstance Session, string[,] Parameters)
        {
            if (Session.User != null)
            {
                if (Session.User.Sala != null) return;
                Packet_194(Session, Parameters[1, 0]);
            }
        }
        static void AñadirFavorito(SessionInstance Session, string[,] Parameters)
        {
            if (Session.User != null)
            {
                if (Session.User.Sala != null) return;
                mysql client = new mysql();
                DataRow favoritos = client.ExecuteQueryRow("SELECT * FROM escenarios_favoritos WHERE user_id = '" + Session.User.id + "' AND sala_id = '" + int.Parse(Parameters[1, 0]) + "'");
                if (favoritos != null) return;
                client.ExecuteNonQuery("INSERT INTO escenarios_favoritos (`user_id`, `sala_id`) VALUES ('" + Session.User.id + "', '" + int.Parse(Parameters[1, 0]) + "')");
            }
        }
        static void Favoritos(SessionInstance Session, string[,] Parameters)
        {
            if (Session.User != null)
            {
                if (Session.User.Sala != null) return;
                Packet_191(Session);
            }
        }
        static void Islas(SessionInstance Session, string[,] Parameters)
        {
            if (Session.User != null)
            {
                if (Session.User.Sala != null) return;
                Packet_187(Session);
            }
        }
        static void MisIslas(SessionInstance Session, string[,] Parameters)
        {
            if (Session.User != null)
            {
                if (Session.User.Sala != null) return;
                Packet_193(Session);
            }
        }
        static void SalirSala(SessionInstance Session, string[,] Parameters)
        {
            if (Session.User != null)
            {
                if (Session.User.Sala != null)
                {
                    if (Session.User.block_upper == true)
                    {
                        Session.User.block_upper = false;
                        Session.User.colores = Session.User.colores_old;
                        Session.User.colores_old = "";
                    }
                    if (SalaInstance.UsuariosEnObjetos.ContainsKey(Session.User.id))
                    {
                        SalaInstance.UsuariosEnObjetos.Remove(Session.User.id);
                    }
                    SalasManager.Salir_Sala(Session);
                }
            }   
        }
        static void LoadObjects(SessionInstance Session, string[,] Parameters)
        {
            if (Session.User != null)
            {
                if (Session.User.Sala != null)
                {
                    Session.User.Sala.LoadObjects(Session);
                    Packet_175(Session);
                    if (Session.User.Sala.Escenario.es_categoria == 2)
                    {
                        if (Session.User.Sala.Ring != null) Session.User.Sala.Ring.Cargar_Contador(Session);
                        if (Session.User.Sala.Cocos != null) Session.User.Sala.Cocos.Cargar_Contador(Session);
                        if (Session.User.Sala.Sendero != null) Session.User.Sala.Sendero.Cargar_Contador(Session);
                        if (Session.User.Sala.Camino != null) Session.User.Sala.Camino.Cargar_Contador(Session);
                    }
                    if (Session.User.Sala.Ring != null || Session.User.Sala.Cocos != null || Session.User.Sala.Sendero != null || Session.User.Sala.Camino != null) { return; }
                    TrampasManager.ObtenerTrampas(Session);
                    ConcursosManager.Encontrar_Objetos(Session, Session.User.Sala);
                }
            }     
        }
        static void GoRoom(SessionInstance Session, string[,] Parameters)
        {
            Thread.Sleep(new TimeSpan(0, 0, 0, 0, 500));
            if (Session.User != null)
            {
                if (Session.User.Sala != null) return;
                int id_sala = int.Parse(Parameters[1, 0]);
                if (int.Parse(Parameters[1, 0]) == 30 && int.Parse(Parameters[0, 0]) == 1)//Cementerio Entradas
                {
                    Random rd = new Random();
                    int[] areas = { 50, 46, 26, 30 };
                    id_sala = areas[rd.Next(0, 4)]; //0+1+2+3
                }
                else if (int.Parse(Parameters[1, 0]) == 78 && int.Parse(Parameters[0, 0]) == 1)//Madriguera Entradas
                {
                    Random rd = new Random();
                    int[] areas = { 83, 82, 90, 84 };
                    id_sala = areas[rd.Next(0, 4)]; //0+1+2+3
                }
                else if (int.Parse(Parameters[1, 0]) == 57 && int.Parse(Parameters[0, 0]) == 1)//Bosque Nevado Entradas
                {
                    Random rd = new Random();
                    int[] areas = { 60, 64, 72, 63 };
                    id_sala = areas[rd.Next(0, 4)]; //0+1+2+3
                }
                if (!SalasManager.IrAlli(Session, int.Parse(Parameters[0, 0]), id_sala))
                {
                    Packet_128_120(Session);
                    Session.User.PreLock__Spamm_Areas = true;
                }
            }
        }
        static void GoRoom_Subareas(SessionInstance Session, string[,] Parameters)
        {
            Thread.Sleep(new TimeSpan(0, 0, 0, 0, 500));
            if (Session.User != null)
            {
                int Categoria = int.Parse(Parameters[0, 0]);
                if (Categoria == -1) { Categoria = 1; }
                if (Session.User.PreLock__Spamm_Areas == true) return;
                if (!SalasManager.IrAlli(Session, int.Parse(Parameters[0, 0]), int.Parse(Parameters[1, 0]), null, false))
                {
                    Packet_128_120(Session);
                    Session.User.PreLock__Spamm_Areas = true;
                }
            }
        }
        static void CargarSalas(SessionInstance Session, string[,] Parameters)
        {
            if (Session.User != null)
            {
                if (Session.User.Sala != null) return;
                Packet_154_33(Session, int.Parse(Parameters[1, 0]));
            }
        }
        static void CargarEscenarios(SessionInstance Session, string[,] Parameters)
        {
            if (Session.User != null)
            {
                if (Session.User.Sala != null) return;
                new Thread(() => Packet_154_32(Session)).Start();
                FlowerHandler.Noticia(Session);
            }
        }
        private static void Packet_195(SessionInstance Session, string Nombre)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(195);
            foreach (IslaInstance Isla in IslasManager.ObtenerIslasNombre(Nombre))
            {
                if (Isla.noverlo_1.Contains(Session.User.nombre) || Isla.noverlo_2.Contains(Session.User.nombre) || Isla.noverlo_3.Contains(Session.User.nombre) || Isla.noverlo_4.Contains(Session.User.nombre) || Isla.noverlo_5.Contains(Session.User.nombre) || Isla.noverlo_6.Contains(Session.User.nombre) || Isla.noverlo_7.Contains(Session.User.nombre) || Isla.noverlo_8.Contains(Session.User.nombre)) return;
                server.AppendParameter(0);
                server.AppendParameter(0);
                server.AppendParameter(Isla.id);
                server.AppendParameter(0);
                server.AppendParameter(0);
                server.AppendParameter(0);
                server.AppendParameter(Isla.nombre);
                server.AppendParameter(0);
                server.AppendParameter(IslasManager.Visitantes(Isla));//Visitantes
                server.AppendParameter(0);
            }
            foreach(EscenarioInstance Escenario in CasasManager.ObtenerCasasNombre(Nombre))
            {
                server.AppendParameter(4);
                server.AppendParameter(0);
                server.AppendParameter(Escenario.id);
                server.AppendParameter(0);
                server.AppendParameter(Escenario.id);
                server.AppendParameter(0);
                server.AppendParameter(Escenario.nombre);
                server.AppendParameter(0);
                server.AppendParameter(CasasManager.UsuariosEnSala(Escenario)); //visitantes
                server.AppendParameter(0);
            }
            Session.SendData(server);
        }
        private static void Packet_194(SessionInstance Session, string Nombre)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(194);
            foreach (IslaInstance Isla in IslasManager.ObtenerIslas(Nombre))
            {
                if (Isla.noverlo_1.Contains(Session.User.nombre) || Isla.noverlo_2.Contains(Session.User.nombre) || Isla.noverlo_3.Contains(Session.User.nombre) || Isla.noverlo_4.Contains(Session.User.nombre) || Isla.noverlo_5.Contains(Session.User.nombre) || Isla.noverlo_6.Contains(Session.User.nombre) || Isla.noverlo_7.Contains(Session.User.nombre) || Isla.noverlo_8.Contains(Session.User.nombre)) return;
                server.AppendParameter(0);
                server.AppendParameter(0);
                server.AppendParameter(Isla.id);
                server.AppendParameter(0);
                server.AppendParameter(0);
                server.AppendParameter(0);
                server.AppendParameter(Isla.nombre);
                server.AppendParameter(0);
                server.AppendParameter(IslasManager.Visitantes(Isla));//Visitantes
                server.AppendParameter(0);
            }
            foreach(EscenarioInstance Escenario in CasasManager.ObtenerCasas(Nombre))
            {
                server.AppendParameter(4);
                server.AppendParameter(0);
                server.AppendParameter(Escenario.id);
                server.AppendParameter(0);
                server.AppendParameter(Escenario.id);
                server.AppendParameter(0);
                server.AppendParameter(Escenario.nombre);
                server.AppendParameter(0);
                server.AppendParameter(CasasManager.UsuariosEnSala(Escenario)); //visitantes
                server.AppendParameter(0);
            }
            Session.SendData(server);
        }
        private static void Packet_191(SessionInstance Session)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(191);
            foreach (IslaInstance Isla in IslasManager.ObtenerIslasFavoritos(Session.User.id))
            {
                server.AppendParameter(0);
                server.AppendParameter(0);
                server.AppendParameter(Isla.id);
                server.AppendParameter(0);
                server.AppendParameter(0);
                server.AppendParameter(0);
                server.AppendParameter(Isla.nombre);
                server.AppendParameter(0);
                server.AppendParameter(IslasManager.Visitantes(Isla));//Visitantes
                server.AppendParameter(0);
            }
            foreach (EscenarioInstance Escenario in CasasManager.ObtenerCasasFavoritos(Session.User.id))
            {
                server.AppendParameter(4);
                server.AppendParameter(0);
                server.AppendParameter(Escenario.id);
                server.AppendParameter(0);
                server.AppendParameter(Escenario.id);
                server.AppendParameter(0);
                server.AppendParameter(Escenario.nombre);
                server.AppendParameter(0);
                server.AppendParameter(CasasManager.UsuariosEnSala(Escenario)); //visitantes
                server.AppendParameter(0);
            }
            Session.SendDataProtected(server);
        }
        private static void Packet_187(SessionInstance Session)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(187);
            foreach (SalaInstance Sala in SalasManager.Salas_Privadas.Values)
            {
                if (Sala.Escenario.categoria != 4) continue;
                if (Sala.Escenario.modelo != 25) continue;
                if (CasasManager.UsuariosEnSala(Sala.Escenario) <= 0) continue;
                server.AppendParameter(4);
                server.AppendParameter(0);
                server.AppendParameter(Sala.Escenario.id);
                server.AppendParameter(0);
                server.AppendParameter(Sala.Escenario.id);
                server.AppendParameter(0);
                server.AppendParameter(Sala.Escenario.nombre);
                server.AppendParameter(0);
                server.AppendParameter(CasasManager.UsuariosEnSala(Sala.Escenario)); //visitantes
                server.AppendParameter(0);
            }
            foreach (var IslaID in IslasManager.IslasActivas.Values)
            {
                IslaInstance Isla = IslasManager.ObtenerIsla(IslaID);
                if (Isla != null)
                {
                    if (IslasManager.Visitantes(Isla) > 0)
                    {
                        server.AppendParameter(0);
                        server.AppendParameter(0);
                        server.AppendParameter(Isla.id);
                        server.AppendParameter(0);
                        server.AppendParameter(0);
                        server.AppendParameter(0);
                        server.AppendParameter(Isla.nombre);
                        server.AppendParameter(0);
                        server.AppendParameter(IslasManager.Visitantes(Isla)); //visitantes
                        server.AppendParameter(0);
                    }
                }
            }
            Session.SendDataProtected(server);
        }
        private static void Packet_193(SessionInstance Session)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(193);
            foreach (IslaInstance Isla in IslasManager.ObtenerIslas(Session.User.id))
            {
                server.AppendParameter(0);
                server.AppendParameter(0);
                server.AppendParameter(Isla.id);
                server.AppendParameter(0);
                server.AppendParameter(0);
                server.AppendParameter(0);
                server.AppendParameter(Isla.nombre);
                server.AppendParameter(0);
                server.AppendParameter(IslasManager.Visitantes(Isla));//Visitantes
                server.AppendParameter(0);
            }
            Session.SendDataProtected(server);
        }
        private static void Packet_175(SessionInstance Session)//Coco - Upper Ficha
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(175);
            if (Session.User.Sala.Escenario.es_categoria == 2)
            {
                server.AppendParameter(new object[] { 1, -1, 0 });
                server.AppendParameter(new object[] { 2, -1, 0 });
                server.AppendParameter(new object[] { 3, -1, 0 });
            }
            else
            {
                server.AppendParameter(new object[] { 1, 0, 0 });
                server.AppendParameter(new object[] { 2, 0, 0 });
                server.AppendParameter(new object[] { 3, 0, 0 });
            }
            if (Session.User.Sala.Escenario.categoria == 2)
            {
                IslaInstance Isla = IslasManager.ObtenerIsla(Session.User.Sala.Escenario.IslaID);
                if (Isla != null)
                {
                    server.AppendParameter(new object[] { 4, (Isla.uppert == 0 ? -1 : 0), 1 });///Modificado
                    server.AppendParameter(new object[] { 5, 0, 1 });
                }
            }
            else
            {
                server.AppendParameter(new object[] { 4, Session.User.Sala.Escenario.uppert, 1 });
                server.AppendParameter(new object[] { 5, 0, 1 });
            }
            Session.SendDataProtected(server);
        }
        private static void Packet_128_120(SessionInstance Session)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(128);
            server.AddHead(120);
            server.AppendParameter(-1);
            Session.SendDataProtected(server);
        }
        private static void Packet_154_33(SessionInstance Session, int modelo_id)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(154);
            server.AddHead(33);
            foreach (var sala in SalasManager.Salas_Publicas.Values)
            {
                if (sala.Escenario.id == modelo_id)
                {
                    server.AppendParameter(1);
                    server.AppendParameter(sala.Escenario.es_categoria);
                    server.AppendParameter(0);
                    server.AppendParameter(0);
                    server.AppendParameter(sala.id);
                    server.AppendParameter(modelo_id);
                    server.AppendParameter((sala.Escenario.nombre));
                    server.AppendParameter(sala.Usuarios.Count);
                    server.AppendParameter(sala.Escenario.max_visitantes);
                }
            }
            Session.SendDataProtected(server);
        }
        private static void Packet_154_32(SessionInstance Session)
        {
            mysql client = new mysql();
            Dictionary<int, int> areas = new Dictionary<int, int>();
            ServerMessage server = new ServerMessage();
            server.AddHead(154);
            server.AddHead(32);
            foreach (DataRow row in client.ExecuteQueryTable("SELECT * FROM escenarios_publicos WHERE visible = '1' ORDER BY prioridad ASC").Rows)
            {
                areas.Add((int)row["id"], SalasManager.UsuariosEnSala(new EscenarioInstance(row)));
            }
            foreach (var escenario in areas.OrderByDescending(x => x.Value))
            {
                client.SetParameter("id", escenario.Key);
                DataRow row = client.ExecuteQueryRow("SELECT * FROM escenarios_publicos WHERE id = @id");
                server.AppendParameter(row["categoria"]);
                server.AppendParameter(row["es_categoria"]);
                server.AppendParameter(row["id"]);
                server.AppendParameter(row["nombre"]);
                server.AppendParameter(SalasManager.UsuariosEnSala(new EscenarioInstance(row)));
            }
            Session.SendDataProtected(server);
        }
    }
}
