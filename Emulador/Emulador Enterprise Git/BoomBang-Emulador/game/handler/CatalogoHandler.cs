using BoomBang.game.instances;
using BoomBang.game.instances.manager;
using BoomBang.game.manager;
using BoomBang.server;
using System;
using System.Collections.Generic;
using System.Data;
using System.Drawing;
using System.Text.RegularExpressions;
using System.Threading;

namespace BoomBang.game.handler
{
    class CatalogoHandler
    {
        public static string Fecha_Loteria_Final = "";
        public static void Start()
        {
            HandlerManager.RegisterHandler(189133, new ProcessHandler(CargarCatalogo));
            HandlerManager.RegisterHandler(189180, new ProcessHandler(CargarMochila));
            HandlerManager.RegisterHandler(189134, new ProcessHandler(Comprar_Oro));
            HandlerManager.RegisterHandler(189137, new ProcessHandler(Comprar_Plata));
            HandlerManager.RegisterHandler(189181, new ProcessHandler(CargarObjeto));
            HandlerManager.RegisterHandler(189136, new ProcessHandler(PonerObjeto));
            HandlerManager.RegisterHandler(189142, new ProcessHandler(CambiarColores));
            HandlerManager.RegisterHandler(189145, new ProcessHandler(MoverObjeto));
            HandlerManager.RegisterHandler(189163, new ProcessHandler(AbrirObjeto));
            HandlerManager.RegisterHandler(189140, new ProcessHandler(Quitar_Objeto));
            HandlerManager.RegisterHandler(189143, new ProcessHandler(VoltearObjeto));
            HandlerManager.RegisterHandler(189157, new ProcessHandler(MoverObjetoAire));
            HandlerManager.RegisterHandler(189158, new ProcessHandler(Control));
            HandlerManager.RegisterHandler(189156, new ProcessHandler(EditarData));
            HandlerManager.RegisterHandler(189165, new ProcessHandler(Dar_Bebida));
            HandlerManager.RegisterHandler(189164, new ProcessHandler(ClickObject));
            HandlerManager.RegisterHandler(189159, new ProcessHandler(ActivarObjeto));
            HandlerManager.RegisterHandler(189144, new ProcessHandler(CambiarTamañoObjeto));
            HandlerManager.RegisterHandler(189160121, new ProcessHandler(AccionesAnimales));
            //HandlerManager.RegisterHandler(189186, new ProcessHandler(Handler_189_186));
            HandlerManager.RegisterHandler(189166, new ProcessHandler(SubirEnObjeto));
            HandlerManager.RegisterHandler(189167, new ProcessHandler(BajarDeObjeto));
            HandlerManager.RegisterHandler(189168, new ProcessHandler(DesplazarObjeto));
            HandlerManager.RegisterHandler(189161, new ProcessHandler(Sapo));
            HandlerManager.RegisterHandler(189152, new ProcessHandler(AllowAcces));
            HandlerManager.RegisterHandler(189153, new ProcessHandler(AllowAccesInArea));
            HandlerManager.RegisterHandler(189160120, new ProcessHandler(PathfinderAnimals));
            //HandlerManager.RegisterHandler(189171120, new ProcessHandler(Noria));
            HandlerManager.RegisterHandler(189171121, new ProcessHandler(accelerarNoria));
        }
        private static void accelerarNoria(SessionInstance Session, string[,] Parameters)
        {
            int id = int.Parse(Parameters[0, 0]);
            int numero = int.Parse(Parameters[1, 0]);
            ServerMessage server = new ServerMessage();
            server.AddHead(189);
            server.AddHead(171);
            server.AddHead(121);       
            server.AppendParameter(id);
            server.AppendParameter(numero);
            Session.SendData(server);
            Console.WriteLine(id + " " + numero);
        }
        private static void PathfinderAnimals(SessionInstance Session, string[,] Parameters)
        {
            int id = int.Parse(Parameters[0, 0]);
            string patch = Parameters[1, 0];
            try
            {
                List<int> ListPositions = new List<int>();
                while (patch != "")
                {
                    int x = int.Parse(patch.Substring(0, 2));
                    ListPositions.Add(x);
                    int y = int.Parse(patch.Substring(2, 2));
                    ListPositions.Add(y);
                    int z = int.Parse(patch.Substring(4, 1));
                    ListPositions.Add(z);
                    patch = patch.Substring(5);
                }
                BuyObjectInstance Compra = CatalogoManager.ObtenerCompra(id);
                if (ListPositions.Count % 3 != 0) { return; }
                if (Compra.patchfinding != null) { return; }
                Compra.patchfinding = ListPositions;
                new Thread(() => Caminada(Session, Compra)).Start();
            }
            catch
            {
                Output.WriteLine("Error en el patchfinding de animales. --> PathfinderAnimals");
            }
        }
        private static void Caminada(SessionInstance Session, BuyObjectInstance Compra)
        {
            try
            {
                while (Compra.patchfinding.Count > 0)
                {
                    foreach (SessionInstance sessiones in UserManager.UsuariosOnline.Values)
                    {
                        if (sessiones.User.Sala.Escenario.id == Compra.sala_id)
                        {
                            if (Compra.patchfinding.Count > 0)
                            {
                                ServerMessage server = new ServerMessage();
                                server.AddHead(182);
                                server.AppendParameter(2);
                                server.AppendParameter(Compra.id);
                                server.AppendParameter(Compra.patchfinding[0]);
                                Compra.patchfinding.RemoveAt(0);
                                server.AppendParameter(Compra.patchfinding[0]);
                                Compra.patchfinding.RemoveAt(0);
                                server.AppendParameter(Compra.patchfinding[0]);
                                Compra.patchfinding.RemoveAt(0);
                                server.AppendParameter(720);
                                server.AppendParameter(1);
                                Session.User.Sala.SendData(server, Session);
                            }
                        }
                    }
                    Thread.Sleep(new TimeSpan(0, 0, 0, 0, 720));
                }
            }
            catch
            {
                Output.WriteLine("Error en el patchfinding de animales. --> Caminada");
            }
        }

        private static void AllowAccesInArea(SessionInstance Session, string[,] Parameters)
        {
            mysql client = new mysql();
            DataRow objeto_area = client.ExecuteQueryRow("SELECT * FROM escenarios_privados WHERE id = '" + Session.User.Sala.Escenario.id + "' LIMIT 1");
            if (objeto_area != null)
            {
                BuyObjectInstance Compra = CatalogoManager.ObtenerCompra((int)objeto_area["objeto_id"]);
                if (Compra != null)
                {
                    if (Compra.usuario_id != Session.User.id) return;
                    if (Session.User.Sala.Escenario.Creador.id != Session.User.id) { Session.FinalizarConexion("AllowAccesInArea"); return; }
                    ServerMessage server1 = new ServerMessage();
                    server1.AddHead(189);
                    server1.AddHead(153);
                    server1.AppendParameter(1);
                    server1.AppendParameter(1);
                    server1.AppendParameter(1);
                    server1.AppendParameter(1);
                    server1.AppendParameter(Compra.data);
                    server1.AppendParameter(1);
                    server1.AppendParameter(Compra.open == 0 ? "1" : "");
                    Session.User.Sala.SendData(server1);
                    ServerMessage server = new ServerMessage();
                    server.AddHead(189);
                    server.AddHead(152);
                    server.AppendParameter(1);
                    server.AppendParameter(1);
                    server.AppendParameter(1);
                    server.AppendParameter(1);
                    server.AppendParameter(Compra.data);
                    server.AppendParameter(1);
                    server.AppendParameter(Compra.open == 0 ? "1" : "");
                    Session.User.Sala.SendData(server, Session);

                    Compra.open = abrir_cerar_sala_manager(Compra);

                    if (Compra.open == 1)
                    {
                        client.SetParameter("key", "2358f'9qw");
                        client.SetParameter("id", Compra.id);
                        client.ExecuteNonQuery("UPDATE escenarios_privados SET clave = @key WHERE objeto_id = @id");
                        EscenarioInstance Sala = EscenariosManager.ObtenerEscenario(0, Session.User.Sala.id);
                        Sala.Clave = "2358f'9qw";
                    }
                }
            }
        }
        private static void AllowAcces(SessionInstance Session, string[,] Parameters)
        {
            int Compra_ID = int.Parse(Parameters[0, 0]);
            BuyObjectInstance Compra = CatalogoManager.ObtenerCompra(Compra_ID);
            if (Compra != null)
            {
                if (!listas.Objetos_Area.Contains(Compra.objeto_id)) return;
                if (Compra.usuario_id != Session.User.id) return;
                if (Session.User.Sala.Escenario.Creador.id != Session.User.id) { Session.FinalizarConexion("AllowAcces"); return; }
                ServerMessage server = new ServerMessage();
                server.AddHead(189);
                server.AddHead(152);
                server.AppendParameter(1);
                server.AppendParameter(1);
                server.AppendParameter(1);
                server.AppendParameter(1);
                server.AppendParameter(Compra.data);
                server.AppendParameter(1);
                server.AppendParameter(Compra.open == 0 ? "1": "");
                Session.User.Sala.SendData(server, Session);

                Compra.open = abrir_cerar_sala_manager(Compra);
            }
        }
        private static int abrir_cerar_sala_manager(BuyObjectInstance Compra)
        {
            mysql client = new mysql();
            client.SetParameter("id", Compra.id);
            DataRow escenario = client.ExecuteQueryRow("SELECT * FROM escenarios_privados WHERE objeto_id = @id");
            if (escenario != null)
            {
                client.SetParameter("id", Compra.id);
                DataRow compra = client.ExecuteQueryRow("SELECT * FROM objetos_comprados WHERE id = @id");
                if (compra != null)
                {
                    if (Compra.open == 0)
                    {
                        client.SetParameter("id", Compra.id);
                        client.ExecuteNonQuery("UPDATE objetos_comprados SET open = 1 WHERE id = @id");
                        client.SetParameter("key", "2358f'9qw");
                        client.SetParameter("id", Compra.id);
                        client.ExecuteNonQuery("UPDATE escenarios_privados SET clave = @key WHERE objeto_id = @id");
                        EscenarioInstance Sala = EscenariosManager.ObtenerEscenario(0, (int)escenario["id"]);
                        Sala.Clave = "2358f'9qw";
                        Compra.open = 1;
                    }
                    else
                    {
                        client.SetParameter("id", Compra.id);
                        client.ExecuteNonQuery("UPDATE objetos_comprados SET open = 0 WHERE id = @id");
                        client.SetParameter("key", "");
                        client.SetParameter("id", Compra.id);
                        client.ExecuteNonQuery("UPDATE escenarios_privados SET clave = @key WHERE objeto_id = @id");
                        EscenarioInstance Sala = EscenariosManager.ObtenerEscenario(0, (int)escenario["id"]);
                        Sala.Clave = "";
                        Compra.open = 0;
                    }
                }
            }
            return Compra.open;
        }
        private static void DesplazarObjeto(SessionInstance Session, string[,] Parameters)
        {
            if (Session.User == null) return;
            if (Session.User.Sala == null) return;
            int CompraID = int.Parse(Parameters[0, 0]);
            int x = int.Parse(Parameters[1, 0]);
            int y = int.Parse(Parameters[2, 0]);
            BuyObjectInstance Item = CatalogoManager.ObtenerCompra(CompraID);
            if (Item != null)
            {
                if (Session.User.Sala.DesplazarObjeto(Session, Item, new Point(x, y)))
                {
                    ServerMessage server = new ServerMessage();
                    server.AddHead(189);
                    server.AddHead(168);
                    server.AppendParameter(Item.id);
                    server.AppendParameter(x);
                    server.AppendParameter(y);
                    Session.User.Sala.SendData(server, Session);
                }
            }
        }
        private static void BajarDeObjeto(SessionInstance Session, string[,] Parameters)
        {
            if (Session.User == null) return;
            if (Session.User.Sala == null) return;
            int CompraID = int.Parse(Parameters[0, 0]);
            int user_id = int.Parse(Parameters[1, 0]);
            SessionInstance OtherSession = UserManager.ObtenerSession(user_id);
            BuyObjectInstance Item = CatalogoManager.ObtenerCompra(CompraID);
            if (Item != null && OtherSession != null)
            {
                OtherSession.User.Trayectoria.DetenerMovimiento();
                Session.User.Sala.BajarEnObjeto(OtherSession, false);
            }
        }
        private static void SubirEnObjeto(SessionInstance Session, string[,] Parameters)
        {
            if (Session.User == null) return;
            if (Session.User.Sala == null) return;
            int CompraID = int.Parse(Parameters[0, 0]);
            int user_id = int.Parse(Parameters[1, 0]);
            int Posicion = int.Parse(Parameters[2, 0]);
            SessionInstance OtherSession = UserManager.ObtenerSession(user_id);
            BuyObjectInstance Item = CatalogoManager.ObtenerCompra(CompraID);
            if (Item != null && OtherSession != null)
            {
                if (Item.usuario_id != Session.User.id) return;
                {
                    if (Session.User.Sala.SubirEnObjeto(OtherSession, Item, Posicion))
                    {
                        OtherSession.User.Trayectoria.DetenerMovimiento();
                        ServerMessage server = new ServerMessage();
                        server.AddHead(189);
                        server.AddHead(166);
                        server.AppendParameter(Item.id);
                        server.AppendParameter(OtherSession.User.id);
                        server.AppendParameter(Posicion);
                        Session.User.Sala.SendData(server, Session);
                    }
                }
            }
        }
        //End Codigo
        private static void CargarCatalogo(SessionInstance Session, string[,] Parameters)
        {
            if (Session.User != null)
            {
                Packet_189_133(Session);
            }
        }
        private static void CargarMochila(SessionInstance Session, string[,] Parameters)
        {
            if (Session.User != null)
            {
                mysql client = new mysql();
                Packet_189_180(Session, client);
            }
        }
        private static void Comprar_Oro(SessionInstance Session, string[,] Parameters)
        {
            if (Session.User != null)
            {
                if (Session.User.Sala != null)
                {
                    mysql client = new mysql();
                    Comprar_Oro(Session, client, Parameters);
                }
            }
        }
        private static void Comprar_Plata(SessionInstance Session, string[,] Parameters)
        {
            if (Session.User != null)
            {
                if (Session.User.Sala != null)
                {
                    mysql client = new mysql();
                    Comprar_Plata(Session, client, Parameters);
                }
            }
        }
        private static void CargarObjeto(SessionInstance Session, string[,] Parameters)
        {
            if (Session.User != null)
            {
                if (Session.User.Sala != null)
                {
                    Packet_189_181(Session, Parameters);
                }
            }
        }
        private static void PonerObjeto(SessionInstance Session, string[,] Parameters)
        {
            int compra_id = int.Parse(Parameters[0, 0]);
            int Zona_ID = int.Parse(Parameters[1, 0]);
            int Objeto_id = int.Parse(Parameters[2, 0]);
            int x = int.Parse(Parameters[3, 0]);
            int y = int.Parse(Parameters[4, 0]);
            string tam = Parameters[5, 0];
            int rotation = int.Parse(Parameters[6, 0]);
            string Espacio_Ocupado = Parameters[7, 0];
            string Colores_Hex = Parameters[8, 0];
            string Colores_Rgb = Parameters[9, 0];
            BuyObjectInstance Compra = CatalogoManager.ObtenerCompra(compra_id);
            if (Compra != null)
            {
                if (Compra.usuario_id != Session.User.id) return;
                if (Compra.sala_id != 0) return;
                if (Compra.id != compra_id) return;
                if (Compra.objeto_id != Objeto_id) return;
                if (Session.User.Sala.ObjetosEnSala.ContainsKey(Compra.id)) return;
                if (Session.User.Sala.Escenario.Creador.id != Session.User.id) { Session.FinalizarConexion("PonerObjeto"); return; }
                if (CatalogoManager.portales_magicos.Contains(Compra.objeto_id))
                {
                    string[] Valores = Regex.Split(Espacio_Ocupado, ",");
                    int pos_x = Convert.ToInt32(Valores[Valores.Length - 2]);
                    int pos_y = Convert.ToInt32(Valores[Valores.Length - 1]);
                    if (Compra.objeto_id == 652)//Portal Mágico Chiclets
                    {
                        new Thread(() => sala_privada_portal(Session.User.Sala, Compra, "Portal Chicle", 23)).Start();
                        new Thread(() => colocar_entrada_portal(Session.User.Sala, Compra, pos_x, pos_y)).Start();
                    }
                    else if (Compra.objeto_id == 653)//Portal Mágico Nubes
                    {
                        new Thread(() => sala_privada_portal(Session.User.Sala, Compra, "Portal Cielo", 21)).Start();
                        new Thread(() => colocar_entrada_portal(Session.User.Sala, Compra, pos_x, pos_y)).Start();
                    }
                    else if (Compra.objeto_id == 646)//Portal Mágico 3D
                    {
                        new Thread(() => sala_privada_portal(Session.User.Sala, Compra, "Portal 3D", 24)).Start();
                        new Thread(() => colocar_entrada_portal(Session.User.Sala, Compra, pos_x, pos_y)).Start();
                    }
                    else if (Compra.objeto_id == 480)//Egg Espacial
                    {
                        new Thread(() => colcoar_entrada_teleport(Session.User.Sala, Compra, pos_x, pos_y)).Start();
                    }
                    else if (Compra.objeto_id == 1217)//Arbol valentin
                    {
                        new Thread(() => colcoar_entrada_teleport(Session.User.Sala, Compra, pos_x, pos_y)).Start();
                    }
                    Espacio_Ocupado = calcular_posicion_entrada_portal_magico(Espacio_Ocupado);
                }
                if (CatalogoManager.ColocarObjeto(Session.User.Sala, Compra, compra_id, x, y, tam, rotation, Espacio_Ocupado))
                {
                    if (CatalogoManager.lianas_cocos.Contains(Compra.objeto_id)) 
                    {
                        new Thread(() => CatalogoManager.colocar_objeto_trampa(Session.User.Sala, Compra, Espacio_Ocupado, false, false)).Start();
                    }
                    Packet_189_136(Session, Compra);
                    Packet_189_169(Session, compra_id, Objeto_id);
                    if (listas.Plantas.Contains(Compra.objeto_id))
                    {
                        Compra.Planta_agua = Time.GetCurrentAndAdd(AddType.Dias, 1);
                        Compra.Planta_sol = Time.GetCurrentAndAdd(AddType.Dias, 7);
                        new Thread(() => PlantasManager.planta_sql(Compra)).Start();
                        new Thread(() => planta_regada(Session, Compra)).Start();
                    }
                }
            }
        }
        private static void colcoar_entrada_teleport(SalaInstance Sala, BuyObjectInstance Compra, int x, int y)
        {
            mysql client = new mysql();
            client.SetParameter("id", Compra.id);
            DataRow segundo_objeto_muchila = client.ExecuteQueryRow("SELECT * FROM objetos_comprados WHERE id = @id");
            if (segundo_objeto_muchila != null)
            {
                client.SetParameter("modelo", (int)segundo_objeto_muchila["id_objeto_2"]);
                DataRow segundo_objeto = client.ExecuteQueryRow("SELECT * FROM trampas_privadas WHERE modelo = @modelo");
                if (segundo_objeto != null)
                {
                    client.SetParameter("modelo", Compra.id);
                    client.SetParameter("x", x);
                    client.SetParameter("y", y);
                    client.SetParameter("escenario_id", Sala.Escenario.id);
                    client.SetParameter("go_escenario_x", (int)segundo_objeto["x"] - 1);
                    client.SetParameter("go_escenario_y", (int)segundo_objeto["y"] + 1);
                    client.SetParameter("es_categoria", 0);
                    client.SetParameter("go_es_categoria", 0);
                    client.SetParameter("go_escenario_id", (int)segundo_objeto["escenario_id"]);
                    if (client.ExecuteNonQuery("INSERT INTO trampas_privadas (modelo, x, y, escenario_id, go_es_categoria, go_escenario_x, go_escenario_y,es_categoria, go_escenario_id ) VALUES (@modelo, @x, @y, @escenario_id, @go_es_categoria, @go_escenario_x, @go_escenario_y, @es_categoria, @go_escenario_id)") == 1)
                    {
                        client.SetParameter("modelo", Compra.id);
                        DataRow muchila = client.ExecuteQueryRow("SELECT * FROM objetos_comprados WHERE id = @modelo");
                        if (muchila != null)
                        {
                            client.SetParameter("modelo", Compra.id);
                            DataRow select_creacion = client.ExecuteQueryRow("SELECT * FROM trampas_privadas WHERE modelo = @modelo");
                            if (select_creacion != null)
                            {
                                client.SetParameter("modelo", (int)muchila["id_objeto_2"]);
                                client.SetParameter("go_escenario_x", (int)select_creacion["x"] - 1);
                                client.SetParameter("go_escenario_y", (int)select_creacion["y"] + 1);
                                client.SetParameter("go_escenario_id", (int)select_creacion["escenario_id"]);
                                client.ExecuteNonQuery("UPDATE trampas_privadas SET go_escenario_x = @go_escenario_x, go_escenario_y = @go_escenario_y, go_escenario_id = @go_escenario_id WHERE modelo = @modelo");
                            }

                        }
                    }
                    return;
                }
                client.SetParameter("modelo", Compra.id);
                client.SetParameter("x", x);
                client.SetParameter("y", y);
                client.SetParameter("escenario_id", Sala.Escenario.id);
                client.SetParameter("es_categoria", 0);
                client.SetParameter("go_es_categoria", 0);
                client.ExecuteNonQuery("INSERT INTO trampas_privadas (modelo,x,y,escenario_id, es_categoria,go_es_categoria) VALUES (@modelo, @x, @y, @escenario_id, @es_categoria, @go_es_categoria)");
            }
        }
        private static void colocar_entrada_portal(SalaInstance Sala, BuyObjectInstance Compra, int x, int y)
        {
            mysql client = new mysql();
            client.SetParameter("objeto_id", Compra.id);
            DataRow sala_creada = client.ExecuteQueryRow("SELECT * FROM escenarios_privados WHERE objeto_id = @objeto_id");
            if (sala_creada != null)
            {
                client.SetParameter("id", (int)sala_creada["modelo"]);
                DataRow mapa_sala_creada = client.ExecuteQueryRow("SELECT * FROM mapas_privados WHERE id = @id");
                if (mapa_sala_creada != null)
                {
                    client.SetParameter("modelo", Compra.id);
                    client.SetParameter("x", x);
                    client.SetParameter("y", y);
                    client.SetParameter("escenario_id", Sala.Escenario.id);
                    client.SetParameter("es_categoria", 0);
                    client.SetParameter("go_escenario_id", (int)sala_creada["id"]);
                    client.SetParameter("go_es_categoria", 0);
                    client.SetParameter("go_escenario_x", (int)mapa_sala_creada["posX"]);
                    client.SetParameter("go_escenario_y", (int)mapa_sala_creada["posY"]);
                    client.ExecuteNonQuery("INSERT INTO trampas_privadas (`modelo`, `x`, `y`, `escenario_id`, `es_categoria`, `go_escenario_id`, `go_es_categoria`, `go_escenario_x`, `go_escenario_y`) VALUES (@modelo, @x, @y, @escenario_id, @es_categoria, @go_escenario_id, @go_es_categoria, @go_escenario_x, @go_escenario_y)");
                }
            }
        }
        private static void sala_privada_portal(SalaInstance Sala, BuyObjectInstance Compra, string nombre_sala, int modelo)
        {
            mysql client = new mysql();
            client.SetParameter("id_sala", Sala.Escenario.id);
            DataRow islas = client.ExecuteQueryRow("SELECT * FROM escenarios_privados WHERE id = @id_sala");
            if (islas != null)
            {
                client.SetParameter("nombre", nombre_sala);
                client.SetParameter("modelo", modelo);
                client.SetParameter("CreadorID", Sala.Escenario.Creador.id);
                client.SetParameter("objeto_id", Compra.id);
                client.SetParameter("color_1", "15CCFE35D3FEFEF8D98B59371E5B11");
                client.SetParameter("color_2", "6,86,82,15,84,100,78,63,100,111,53,55,51,16,39");
                client.SetParameter("Ultima_Sala", (int)islas["IslaID"]);
                client.ExecuteNonQuery("INSERT INTO escenarios_privados (`nombre`, `modelo`, `CreadorID`, `objeto_id`, `color_1`, `color_2`, `Ultima_Sala` ) VALUES (@nombre, @modelo, @CreadorID, @objeto_id, @color_1, @color_2, @Ultima_Sala)");
            }
        }
        private static string calcular_posicion_entrada_portal_magico(string array)
        {
            string[] Valores = Regex.Split(array, ",");
            string nuevo_espacio_ocupado = "";
            for (int a = 0; a < Valores.Length - 2; a++)
            {
                if (a != Valores.Length - 3)
                {
                    nuevo_espacio_ocupado = nuevo_espacio_ocupado + Valores[a] + ",";
                }
                else { nuevo_espacio_ocupado = nuevo_espacio_ocupado + Valores[a]; }
            }
            return nuevo_espacio_ocupado;
        }
        private static void CambiarColores(SessionInstance Session, string[,] Parameters)
        {
            int Compra_ID = int.Parse(Parameters[0, 0]);
            string hex = Parameters[1, 0];
            string rgb = Parameters[2, 0];
            BuyObjectInstance Compra = CatalogoManager.ObtenerCompra(Compra_ID);
            if (Compra != null)
            {
                if (Compra.usuario_id != Session.User.id) return;
                if (!Session.User.Sala.ObjetosEnSala.ContainsKey(Compra.id)) return;
                if (Session.User.Sala.Escenario.Creador.id != Session.User.id) { Session.FinalizarConexion("CambiarColores"); return; }


                new Thread(() => cambiarColoresObjectSQL(Compra, hex, rgb)).Start();
                Session.User.Sala.ObjetosEnSala[Compra.id].colores_hex = hex;
                Session.User.Sala.ObjetosEnSala[Compra.id].colores_rgb = rgb;
                Packet_189_142(Session, Compra, Parameters);
            }
        }
        private static void cambiarColoresObjectSQL(BuyObjectInstance Compra, string hex, string rgb)
        {
            mysql client = new mysql();
            client.SetParameter("id", Compra.id);
            client.SetParameter("hex", hex);
            client.SetParameter("dec", rgb);
            client.ExecuteNonQuery("UPDATE objetos_comprados SET colores_hex = @hex, colores_rgb = @dec WHERE id = @id");
        }
        static void MoverObjeto(SessionInstance Session, string[,] Parameters)
        {
            int Compra_ID = int.Parse(Parameters[0, 0]);
            int Objeto_ID = int.Parse(Parameters[1, 0]);
            int x = int.Parse(Parameters[2, 0]);
            int y = int.Parse(Parameters[3, 0]);
            string ocupe = Parameters[4, 0];
            string tam = Parameters[5, 0];
            int rotation = int.Parse(Parameters[6, 0]);
            BuyObjectInstance Compra = CatalogoManager.ObtenerCompra(Compra_ID);
            if (Compra != null)
            {
                if (Compra.usuario_id != Session.User.id) return;
                if (Compra.objeto_id != Objeto_ID) return;
                if (!Session.User.Sala.ObjetosEnSala.ContainsKey(Compra.id)) return;
                if (Session.User.Sala.Escenario.Creador.id != Session.User.id) { Session.FinalizarConexion("MoverObjeto"); return; }
                if (CatalogoManager.portales_magicos.Contains(Compra.objeto_id))
                {
                    mysql client = new mysql();
                    client.SetParameter("modelo", Compra.id);
                    DataRow entrada_portal = client.ExecuteQueryRow("SELECT * FROM trampas_privadas WHERE modelo = @modelo");
                    if (entrada_portal != null)
                    {
                        string[] Valores = Regex.Split(ocupe, ",");
                        int pos_x = Convert.ToInt32(Valores[Valores.Length - 2]);
                        int pos_y = Convert.ToInt32(Valores[Valores.Length - 1]);
                        client.SetParameter("x", pos_x);
                        client.SetParameter("y", pos_y);
                        client.SetParameter("modelo", (int)entrada_portal["modelo"]);
                        client.ExecuteNonQuery("UPDATE trampas_privadas SET x = @x, y = @y WHERE modelo = @modelo");
                        ocupe = calcular_posicion_entrada_portal_magico(ocupe);
                    }
                }
                using (mysql client = new mysql())
                {
                    client.SetParameter("id", Compra.id);
                    client.SetParameter("posX", x);
                    client.SetParameter("posY", y);
                    client.SetParameter("espacio_ocupado", ocupe);
                    if (client.ExecuteNonQuery("UPDATE objetos_comprados SET posX = @posX, posY = @posY, espacio_ocupado = @espacio_ocupado WHERE id = @id") == 1)
                    {
                        Session.User.Sala.EliminarChutas(Session.User.Sala.ObjetosEnSala[Compra.id]);
                        Session.User.Sala.ObjetosEnSala[Compra.id].posX = x;
                        Session.User.Sala.ObjetosEnSala[Compra.id].posY = y;
                        Session.User.Sala.ObjetosEnSala[Compra.id].espacio_ocupado = ocupe;
                        Session.User.Sala.FijarChutas(Session.User.Sala.ObjetosEnSala[Compra.id]);
                        if (CatalogoManager.lianas_cocos.Contains(Compra.objeto_id))
                        {
                            CatalogoManager.colocar_objeto_trampa(Session.User.Sala, Compra, ocupe, true, false);
                        }
                        Packet_189_145(Session, Compra);
                    }
                }
            }
        }
        static void AbrirObjeto(SessionInstance Session, string[,] Parameters)
        {
            int Compra_ID = int.Parse(Parameters[0, 0]);
            BuyObjectInstance Compra = CatalogoManager.ObtenerCompra(Compra_ID);
            using (mysql client = new mysql())
            {
                DataRow nombre_objeto = client.ExecuteQueryRow("SELECT * FROM objetos WHERE id = '" + Compra.objeto_id + "'");
                if (Compra == null) return;
                string nombre = (string)nombre_objeto["titulo"];
                if (Compra != null)
                {
                    if (Compra.usuario_id != Session.User.id) return;
                    if (Session.User.Sala.Escenario.Creador.id != Session.User.id) { Session.FinalizarConexion("AbrirObjeto"); return; }
                    switch (Compra.objeto_id)
                    {
                        case 78:
                            if (CatalogoManager.EliminarObjeto(Session.User.Sala, Compra))
                            {
                                NotificacionesManager.NotifiChat(Session, Session.User.nombre + " ha abierto un " + nombre + ".", Session.User.Sala);
                                Añadir_Objeto_Click(Session, 87, 10, Compra_ID);
                            }
                            break;
                        case 77:
                            if (CatalogoManager.EliminarObjeto(Session.User.Sala, Compra))
                            {
                                NotificacionesManager.NotifiChat(Session, Session.User.nombre + " ha abierto un " + nombre + ".", Session.User.Sala);
                                Añadir_Objeto_Click(Session, 86, 10, Compra_ID);
                            }
                            break;
                        case 76:
                            if (CatalogoManager.EliminarObjeto(Session.User.Sala, Compra))
                            {
                                NotificacionesManager.NotifiChat(Session, Session.User.nombre + " ha abierto un " + nombre + ".", Session.User.Sala);
                                Añadir_Objeto_Click(Session, 85, 10, Compra_ID);
                            }
                            break;
                        case 74:
                            if (CatalogoManager.EliminarObjeto(Session.User.Sala, Compra))
                            {
                                NotificacionesManager.NotifiChat(Session, Session.User.nombre + " ha abierto un " + nombre + ".", Session.User.Sala);
                                Añadir_Objeto_Click(Session, 80, 10, Compra_ID);
                            }
                            break;
                        case 73:
                            if (CatalogoManager.EliminarObjeto(Session.User.Sala, Compra))
                            {
                                NotificacionesManager.NotifiChat(Session, Session.User.nombre + " ha abierto un " + nombre + ".", Session.User.Sala);
                                Añadir_Objeto_Click(Session, 79, 10, Compra_ID);
                            }
                            break;
                        case 71:
                            if (CatalogoManager.EliminarObjeto(Session.User.Sala, Compra))
                            {
                                NotificacionesManager.NotifiChat(Session, Session.User.nombre + " ha abierto un " + nombre + ".", Session.User.Sala);
                                Añadir_Objeto_Click(Session, 371, 50, Compra_ID);
                            }
                            break;
                        case 70:
                            if (CatalogoManager.EliminarObjeto(Session.User.Sala, Compra))
                            {
                                NotificacionesManager.NotifiChat(Session, Session.User.nombre + " ha abierto un " + nombre + ".", Session.User.Sala);
                                Añadir_Objeto_Click(Session, 371, 20, Compra_ID);
                            }
                            break;
                        case 69:
                            if (CatalogoManager.EliminarObjeto(Session.User.Sala, Compra))
                            {
                                NotificacionesManager.NotifiChat(Session, Session.User.nombre + " ha abierto un " + nombre + ".", Session.User.Sala);
                                Añadir_Objeto_Click(Session, 371, 10, Compra_ID);
                            }
                            break;
                        case 68:
                            if (CatalogoManager.EliminarObjeto(Session.User.Sala, Compra))
                            {
                                NotificacionesManager.NotifiChat(Session, Session.User.nombre + " ha abierto un " + nombre + ".", Session.User.Sala);
                                Añadir_Objeto_Click(Session, 371, 5, Compra_ID);
                            }
                            break;
                        case 952:

                            NotificacionesManager.NotifiChat(Session, Session.User.nombre + " ha abierto un " + nombre + ".", Session.User.Sala);
                            Sistema_Obj_Click(Session, 952, Compra_ID);

                            break;
                        case 959:

                            NotificacionesManager.NotifiChat(Session, Session.User.nombre + " ha abierto un " + nombre + ".", Session.User.Sala);
                            Sistema_Obj_Click(Session, 959, Compra_ID);

                            break;
                        case 1112:
                            if (CatalogoManager.EliminarObjeto(Session.User.Sala, Compra))
                            {
                                UserManager.Creditos(Session.User, true, true, 1000);
                                NotificacionesManager.NotifiChat(Session, Session.User.nombre + " ha recibido 1000 créditos de oro", Session.User.Sala);
                            }
                            break;
                        case 1113:
                            if (CatalogoManager.EliminarObjeto(Session.User.Sala, Compra))
                            {
                                UserManager.Creditos(Session.User, false, true, 1000);
                                NotificacionesManager.NotifiChat(Session, Session.User.nombre + " ha recibido 1000 monedas de plata", Session.User.Sala);
                            }
                            break;
                        case 1443:
                            if (CatalogoManager.EliminarObjeto(Session.User.Sala, Compra))
                            {
                                UserManager.Creditos(Session.User, false, true, 10);
                                NotificacionesManager.NotifiChat(Session, Session.User.nombre + " ha recibido 10 monedas de plata", Session.User.Sala);
                            }
                            break;
                        case 1444:
                            if (CatalogoManager.EliminarObjeto(Session.User.Sala, Compra))
                            {
                                UserManager.Creditos(Session.User, false, true, 50);
                                NotificacionesManager.NotifiChat(Session, Session.User.nombre + " ha recibido 50 monedas de plata", Session.User.Sala);
                            }
                            break;
                        case 460:

                            NotificacionesManager.NotifiChat(Session, Session.User.nombre + " ha abierto un " + nombre + ".", Session.User.Sala);
                            Sistema_Obj_Click(Session, 460, Compra_ID);

                            break;
                        case 596:

                            NotificacionesManager.NotifiChat(Session, Session.User.nombre + " ha abierto un " + nombre + ".", Session.User.Sala);
                            Sistema_Obj_Click(Session, 596, Compra_ID);

                            break;
                        case 481:

                            NotificacionesManager.NotifiChat(Session, Session.User.nombre + " ha abierto un " + nombre + ".", Session.User.Sala);
                            Sistema_Obj_Click(Session, 481, Compra_ID);

                            break;
                        case 901:

                            NotificacionesManager.NotifiChat(Session, Session.User.nombre + " ha abierto un " + nombre + ".", Session.User.Sala);
                            Sistema_Obj_Click(Session, 901, Compra_ID);

                            break;

                        default: Output.WriteLine("Apertura de objeto no programada: " + Compra.objeto_id); return;

                    }
                    Packet_189_140(Session, Compra);
                }
            }
        }
        static void Quitar_Objeto(SessionInstance Session, string[,] Parameters)
        {
            int Compra_ID = int.Parse(Parameters[0, 0]);
            mysql client = new mysql();
            BuyObjectInstance Compra = CatalogoManager.ObtenerCompra(Compra_ID);
            if (Compra != null)
            {
                if (Compra.usuario_id != Session.User.id) return;
                if (Session.User.Sala.Escenario.Creador.id != Session.User.id) { Session.FinalizarConexion("Quitar_Objeto"); return; }
                if (CatalogoManager.QuitarObjeto(Session.User.Sala, Compra))
                {
                    DataRow row = client.ExecuteQueryRow("SELECT * FROM objetos WHERE id = '" + Compra.objeto_id + "'");
                    CatalogObjectInstance item = new CatalogObjectInstance(row);
                    if (CatalogoManager.portales_magicos.Contains(Compra.objeto_id))
                    {
                        client.SetParameter("modelo", Compra.id);
                        client.ExecuteNonQuery("DELETE FROM trampas_privadas WHERE modelo = @modelo");
                        if (Compra.objeto_id != 480 && Compra.objeto_id != 1217)//Egg Portal - Arbol del amor
                        {
                            client.SetParameter("objeto_id", Compra.id);
                            client.ExecuteNonQuery("DELETE FROM escenarios_privados WHERE objeto_id = @objeto_id");
                        }
                        else
                        {
                            client.SetParameter("modelo", Compra.id);
                            client.SetParameter("id_user", Session.User.id);
                            DataRow localizar_2_modelo = client.ExecuteQueryRow("SELECT * FROM objetos_comprados WHERE id = @modelo AND usuario_id = @id_user");
                            if (localizar_2_modelo != null)
                            {
                                client.SetParameter("modelo", (int)localizar_2_modelo["id_objeto_2"]);
                                client.ExecuteNonQuery("UPDATE trampas_privadas SET go_escenario_id = -1, go_escenario_x = -1, go_escenario_y = -1 WHERE modelo = @modelo");
                            }
                        }
                    }
                    if (listas.Objetos_Area.Contains(Compra.objeto_id))
                    {
                        borar_sala_creada_objeto(Compra);
                    }
                    if (CatalogoManager.lianas_cocos.Contains(Compra.objeto_id))
                    {
                        CatalogoManager.colocar_objeto_trampa(Session.User.Sala, Compra, "0", false, true);
                    }
                    Packet_189_140(Session, Compra);
                    Packet_189_139(Session, item, Compra.id, 1, Compra.tam);
                    if (listas.Plantas.Contains(Compra.objeto_id))
                    {
                        Compra.Planta_agua = 0;
                        Compra.Planta_sol = 0;
                        PlantasManager.planta_sql(Compra);
                    }
                }
            }
        }
        static void VoltearObjeto(SessionInstance Session, string[,] Parameters)
        {
            if (Session.User.Sala != null)
            {
                using (mysql client = new mysql())
                {
                    int NewRotation = 0;
                    int ID = Convert.ToInt32(Parameters[0, 0]);
                    int ItemID = Convert.ToInt32(Parameters[1, 0]);
                    int x = Convert.ToInt32(Parameters[2, 0]);
                    int y = Convert.ToInt32(Parameters[3, 0]);
                    string coor = Parameters[4, 0];
                    string size_rotation = Parameters[5, 0];
                    string rotation = Parameters[6, 0];
                    if (rotation == string.Empty)
                    {
                        NewRotation = int.Parse(size_rotation);
                    }
                    else
                    {
                        NewRotation = int.Parse(rotation);
                    }
                    BuyObjectInstance Item = CatalogoManager.ObtenerCompra(ID);
                    if (Item != null)
                    {
                        if (!Session.User.Sala.ObjetosEnSala.ContainsKey(Item.id)) return;
                        if (Item.usuario_id == Session.User.id)
                        {
                            client.SetParameter("id", Item.id);
                            client.SetParameter("r", NewRotation);
                            if (client.ExecuteNonQuery("UPDATE objetos_comprados SET rotation = @r WHERE id = @id") == 1)
                            {
                                Session.User.Sala.ObjetosEnSala[Item.id].rotation = NewRotation;
                                Item.rotation = NewRotation;
                                Packet_189_143(Session, ID, NewRotation, coor);
                            }
                        }
                    }
                }
            }
        }
        static void MoverObjetoAire(SessionInstance Session, string[,] Parameters)
        {
            int ID = Convert.ToInt32(Parameters[0, 0]);
            int x = Convert.ToInt32(Parameters[1, 0]);
            int y = Convert.ToInt32(Parameters[2, 0]);
            BuyObjectInstance Item = CatalogoManager.ObtenerCompra(ID);
            if (Item != null)
            {
                if (Item.usuario_id != Session.User.id) return;
                if (!Session.User.Sala.ObjetosEnSala.ContainsKey(Item.id)) return;
                if (Session.User.Sala.Escenario.Creador.id != Session.User.id) { Session.FinalizarConexion("MoverObjetoAire"); return; }
                Session.User.Sala.ObjetosEnSala[Item.id].posX = x;
                Session.User.Sala.ObjetosEnSala[Item.id].posY = y;
                Packet_189_157(Session, Item, ID);
            }
        }
        static void Control(SessionInstance Session, string[,] Parameters)
        {
            int ID = Convert.ToInt32(Parameters[0, 0]);
            int Estado = Convert.ToInt32(Parameters[1, 0]);
            BuyObjectInstance Item = CatalogoManager.ObtenerCompra(ID);
            if (Item != null)
            {
                if (Item.usuario_id != Session.User.id) return;
                if (!Session.User.Sala.ObjetosEnSala.ContainsKey(Item.id)) return;
                if (Session.User.Sala.Escenario.Creador.id != Session.User.id) { Session.FinalizarConexion("Control"); return; }
                Packet_189_158(Session, ID, Estado);
            }
        }
        static void EditarData(SessionInstance Session, string[,] Parameters)
        {
            int ID = Convert.ToInt32(Parameters[0, 0]);
            int apartado = Convert.ToInt32(Parameters[1, 0]);
            string data = Parameters[2, 0];
            BuyObjectInstance Item = CatalogoManager.ObtenerCompra(ID);
            if (Item != null)
            {
                if (Item.usuario_id != Session.User.id) return;
                if (!Session.User.Sala.ObjetosEnSala.ContainsKey(Item.id)) return;
                if (Session.User.Sala.Escenario.Creador.id != Session.User.id) { Session.FinalizarConexion("EditarData"); return; }
                using (mysql client = new mysql())
                {
                    if (Item.objeto_id == 3043)
                    {
                        Vender_Objetos_Oro(Session, data);
                    }
                    else
                    {
                        client.SetParameter("id", ID);
                        client.SetParameter("data", data);
                        if (client.ExecuteNonQuery("UPDATE objetos_comprados SET data = @data WHERE id = @id") == 1)
                        {
                            Session.User.Sala.ObjetosEnSala[Item.id].data = data;
                            Packet_189_156(Session, ID, apartado, data);
                        }
                    }
                }
            }
        }
        static void Dar_Bebida(SessionInstance Session, string[,] Parameters)
        {
            mysql client = new mysql();
            int compra_id = int.Parse(Parameters[0, 0]);
            ServerMessage server = new ServerMessage();
            server.AddHead(189);
            server.AddHead(165);
            server.AppendParameter(compra_id);///Objeto id
            Session.User.Sala.SendData(server, Session);

            BuyObjectInstance Compra = CatalogoManager.ObtenerCompra(compra_id);

            if (Time.GetDifference(Compra.Planta_agua) > 0)
            {
                Compra.Planta_agua = Time.GetCurrentAndAdd(AddType.Dias, 1);
                client.ExecuteNonQuery("UPDATE objetos_comprados SET planta_agua = '" + Compra.Planta_agua + "' WHERE id = '" + Compra.id + "'");
            }
            else
            {
                Compra.Planta_sol = Time.GetCurrentAndAdd(AddType.Dias, 7);
                Compra.Planta_agua = Time.GetCurrentAndAdd(AddType.Dias, 1);
                client.ExecuteNonQuery("UPDATE objetos_comprados SET planta_agua = '" + Compra.Planta_agua + "' WHERE id = '" + Compra.id + "'");
                client.ExecuteNonQuery("UPDATE objetos_comprados SET planta_sol = '" + Compra.Planta_sol + "' WHERE id = '" + Compra.id + "'");
            }
            new Thread(() => planta_regada(Session, Compra)).Start();
        }
        static void planta_regada(SessionInstance Session, BuyObjectInstance Compra)
        {
            Thread.Sleep(new TimeSpan(0, 0, 1));
            ServerMessage planta = new ServerMessage();
            planta.AddHead(189);
            planta.AddHead(173);
            planta.AppendParameter(Compra.id);
            planta.AppendParameter((86400 - Time.GetDifference(Compra.Planta_agua)) / 12);
            planta.AppendParameter(Time.GetDifference(Compra.Planta_agua));
            planta.AppendParameter((604800 - Time.GetDifference(Compra.Planta_sol)) / 4);
            planta.AppendParameter(Time.GetDifference(Compra.Planta_sol));
            planta.AppendParameter(1);
            Session.User.Sala.SendData(planta);
        }
        static void ClickObject(SessionInstance Session, string[,] Parameters)
        {
            Packet_189_164(Session, Parameters);
        }
        static void ActivarObjeto(SessionInstance Session, string[,] Parameters)
        {
            Packet_189_159(Session, Parameters);
        }
        static void CambiarTamañoObjeto(SessionInstance Session, string[,] Parameters)
        {
            if (Session.User.Sala != null)
            {
                using (mysql client = new mysql())
                {
                    int ID = Convert.ToInt32(Parameters[0, 0]);
                    int ItemID = Convert.ToInt32(Parameters[1, 0]);
                    int x = Convert.ToInt32(Parameters[2, 0]);
                    int y = Convert.ToInt32(Parameters[3, 0]);
                    string coor = Parameters[4, 0];
                    string size_rotation = Parameters[5, 0];
                    string rotation = Parameters[6, 0];

                    BuyObjectInstance Item = CatalogoManager.ObtenerCompra(ID);
                    if (Item != null)
                    {
                        if (!Session.User.Sala.ObjetosEnSala.ContainsKey(Item.id)) return;
                        if (Session.User.Sala.Escenario.Creador.id != Session.User.id) { Session.FinalizarConexion("CambiarTamañoObjeto"); return; }
                        if (Item.usuario_id == Session.User.id)
                        {
                            client.SetParameter("id", Item.id);
                            client.SetParameter("r", size_rotation);
                            if (client.ExecuteNonQuery("UPDATE objetos_comprados SET tam = @r WHERE id = @id") == 1)
                            {
                                Session.User.Sala.ObjetosEnSala[Item.id].tam = size_rotation;
                                Item.tam = size_rotation;
                                Packet_189_144(Session, ID, size_rotation, coor);
                            }
                        }
                    }
                }
            }
        }
        static void AccionesAnimales(SessionInstance Session, string[,] Parameters)
        {
            if (Session.User.Sala != null)
            {
                using (mysql client = new mysql())
                {
                    int ID = Convert.ToInt32(Parameters[0, 0]);
                    int accion = Convert.ToInt32(Parameters[1, 0]);
                    BuyObjectInstance Item = CatalogoManager.ObtenerCompra(ID);
                    if (Item != null)
                    {
                        if (!Session.User.Sala.ObjetosEnSala.ContainsKey(Item.id)) return;
                        if (Session.User.Sala.Escenario.Creador.id != Session.User.id) { Session.FinalizarConexion("AccionesAnimales"); return; }
                        if (Item.usuario_id == Session.User.id)
                        {
                            Packet_189_160_121(Session, ID, accion);
                        }
                    }
                }
            }
        }
        static void Packet_Aceptar_Compra(SessionInstance Session, int item, bool Objeto_Normal, int Items_Nesesarios, int Item_id, int loteria, bool Oro, string tam, int cantidad)
        {
            mysql client = new mysql();
            if (Oro == true) { Packet_189_134(Session); }
            if (Oro == false) { Packet_189_137(Session); }
            client.SetParameter("objeto_id", item);
            DataRow objetos = client.ExecuteQueryRow("SELECT * FROM objetos WHERE id = @objeto_id");
            if (objetos != null)
            {
                CatalogObjectInstance objeto = new CatalogObjectInstance(objetos);
                client.SetParameter("id", Session.User.id);
                DataRow usuarios = client.ExecuteQueryRow("SELECT * FROM usuarios WHERE id = @id");
                if (usuarios != null)
                {
                    if ((int)objetos["precio_oro"] > 0)
                    {
                        if ((int)usuarios["oro"] >= (int)objetos["precio_oro"])
                        {
                            UserManager.Creditos(Session.User, true, false, (int)objetos["precio_oro"]);
                            for (int a = 0; a < cantidad; a++)
                            {
                                if (a == 0)
                                {
                                    client.SetParameter("item_id", objeto.id);
                                    client.SetParameter("userid", Session.User.id);
                                    client.SetParameter("hex", objeto.colores_hex);
                                    client.SetParameter("rgb", objeto.colores_rgb);
                                    client.SetParameter("tam", tam);
                                    client.SetParameter("default_data", objeto.default_data);
                                    client.SetParameter("loteria_numero", loteria);
                                    if (client.ExecuteNonQuery("INSERT INTO objetos_comprados (`objeto_id`, `colores_hex`, `colores_rgb`, `usuario_id`, `tam`, `data`, `loteria_numero`) VALUES (@item_id, @hex, @rgb, @userid, @tam, @default_data, @loteria_numero)") == 1)
                                    {
                                        client.SetParameter("id", objeto.id);
                                        client.SetParameter("UserID", Session.User.id);
                                        int compra_id = int.Parse(Convert.ToString(client.ExecuteScalar("SELECT MAX(id) FROM objetos_comprados WHERE objeto_id = @id AND usuario_id = @UserID")));
                                        Packet_189_139(Session, objeto, compra_id, 1, tam);
                                    }
                                }
                                else if (a > 0 && objeto.swf == "Egg_Teleport")
                                {
                                    client.SetParameter("id_objeto", objeto.id);
                                    client.SetParameter("user_id", Session.User.id);
                                    DataRow primer_item_muchila = client.ExecuteQueryRow("SELECT * FROM objetos_comprados WHERE objeto_id = @id_objeto AND usuario_id = @user_id AND id_objeto_2 = -1");
                                    if (primer_item_muchila != null)
                                    {
                                        client.SetParameter("item_id", objeto.id);
                                        client.SetParameter("userid", Session.User.id);
                                        client.SetParameter("hex", objeto.colores_hex);
                                        client.SetParameter("rgb", objeto.colores_rgb);
                                        client.SetParameter("tam", tam);
                                        client.SetParameter("default_data", objeto.default_data);
                                        client.SetParameter("loteria_numero", loteria);
                                        client.SetParameter("id_objeto_2", (int)primer_item_muchila["id"]);
                                        if (client.ExecuteNonQuery("INSERT INTO objetos_comprados (`objeto_id`, `colores_hex`, `colores_rgb`, `usuario_id`, `tam`, `data`, `loteria_numero`, `id_objeto_2`) VALUES (@item_id, @hex, @rgb, @userid, @tam, @default_data, @loteria_numero, @id_objeto_2)") == 1)
                                        {
                                            client.SetParameter("id", objeto.id);
                                            client.SetParameter("UserID", Session.User.id);
                                            int compra_id = int.Parse(Convert.ToString(client.ExecuteScalar("SELECT MAX(id) FROM objetos_comprados WHERE objeto_id = @id AND usuario_id = @UserID")));
                                            Packet_189_139(Session, objeto, compra_id, 1, tam);
                                        }
                                    }
                                    client.SetParameter("id_objeto", objeto.id);
                                    client.SetParameter("user_id", Session.User.id);
                                    DataRow actualizar_primer_objeto = client.ExecuteQueryRow("SELECT * FROM objetos_comprados WHERE objeto_id = @id_objeto AND id_objeto_2 = -1 AND usuario_id = @user_id");
                                    if (actualizar_primer_objeto != null)
                                    {
                                        client.SetParameter("id_objeto", objeto.id);
                                        client.SetParameter("user_id", Session.User.id);
                                        DataRow detectar_ob_2 = client.ExecuteQueryRow("SELECT * FROM objetos_comprados WHERE usuario_id = @user_id AND objeto_id = @id_objeto AND id_objeto_2 != -1 ORDER BY id DESC");
                                        if (detectar_ob_2 != null)
                                        {
                                            client.SetParameter("user_id", Session.User.id);
                                            client.SetParameter("id", (int)actualizar_primer_objeto["id"]);
                                            client.SetParameter("id_objeto_2", (int)detectar_ob_2["id"]);
                                            client.ExecuteNonQuery("UPDATE objetos_comprados SET id_objeto_2 = @id_objeto_2 WHERE usuario_id = @user_id AND id = @id");
                                        }
                                    }
                                }
                            }
                        }
                    }
                    else if ((int)objetos["precio_plata"] > 0)
                    {
                        if ((int)usuarios["plata"] >= (int)objetos["precio_plata"])
                        {
                            UserManager.Creditos(Session.User, false, false, (int)objetos["precio_plata"]);
                            for (int a = 0; a < cantidad; a++)
                            {
                                if (a == 0)
                                {
                                    client.SetParameter("item_id", objeto.id);
                                    client.SetParameter("userid", Session.User.id);
                                    client.SetParameter("hex", objeto.colores_hex);
                                    client.SetParameter("rgb", objeto.colores_rgb);
                                    client.SetParameter("tam", tam);
                                    client.SetParameter("default_data", objeto.default_data);
                                    client.SetParameter("loteria_numero", 0);
                                    if (client.ExecuteNonQuery("INSERT INTO objetos_comprados (`objeto_id`, `colores_hex`, `colores_rgb`, `usuario_id`, `tam`, `data`, `loteria_numero`) VALUES (@item_id, @hex, @rgb, @userid, @tam, @default_data, @loteria_numero)") == 1)
                                    {
                                        client.SetParameter("id", objeto.id);
                                        client.SetParameter("UserID", Session.User.id);
                                        int compra_id = int.Parse(Convert.ToString(client.ExecuteScalar("SELECT MAX(id) FROM objetos_comprados WHERE objeto_id = @id AND usuario_id = @UserID")));
                                        Packet_189_139(Session, objeto, compra_id, 1, tam);
                                    }
                                }
                                if (a > 0 && objeto.swf == "Teleport_Vale")
                                {
                                    client.SetParameter("id_objeto", objeto.id);
                                    client.SetParameter("user_id", Session.User.id);
                                    DataRow primer_item_muchila = client.ExecuteQueryRow("SELECT * FROM objetos_comprados WHERE objeto_id = @id_objeto AND usuario_id = @user_id AND id_objeto_2 = -1");
                                    if (primer_item_muchila != null)
                                    {
                                        client.SetParameter("item_id", objeto.id);
                                        client.SetParameter("userid", Session.User.id);
                                        client.SetParameter("hex", objeto.colores_hex);
                                        client.SetParameter("rgb", objeto.colores_rgb);
                                        client.SetParameter("tam", tam);
                                        client.SetParameter("default_data", objeto.default_data);
                                        client.SetParameter("loteria_numero", 0);
                                        client.SetParameter("id_objeto_2", (int)primer_item_muchila["id"]);
                                        if (client.ExecuteNonQuery("INSERT INTO objetos_comprados (`objeto_id`, `colores_hex`, `colores_rgb`, `usuario_id`, `tam`, `data`, `loteria_numero`, `id_objeto_2`) VALUES (@item_id, @hex, @rgb, @userid, @tam, @default_data, @loteria_numero, @id_objeto_2)") == 1)
                                        {
                                            client.SetParameter("id", objeto.id);
                                            client.SetParameter("UserID", Session.User.id);
                                            int compra_id = int.Parse(Convert.ToString(client.ExecuteScalar("SELECT MAX(id) FROM objetos_comprados WHERE objeto_id = @id AND usuario_id = @UserID")));
                                            Packet_189_139(Session, objeto, compra_id, 1, tam);
                                        }
                                    }
                                    client.SetParameter("id_objeto", objeto.id);
                                    client.SetParameter("user_id", Session.User.id);
                                    DataRow actualizar_primer_objeto = client.ExecuteQueryRow("SELECT * FROM objetos_comprados WHERE objeto_id = @id_objeto AND id_objeto_2 = -1 AND usuario_id = @user_id");
                                    if (actualizar_primer_objeto != null)
                                    {
                                        client.SetParameter("id_objeto", objeto.id);
                                        client.SetParameter("user_id", Session.User.id);
                                        DataRow detectar_ob_2 = client.ExecuteQueryRow("SELECT * FROM objetos_comprados WHERE usuario_id = @user_id AND objeto_id = @id_objeto AND id_objeto_2 != -1 ORDER BY id DESC");
                                        if (detectar_ob_2 != null)
                                        {
                                            client.SetParameter("user_id", Session.User.id);
                                            client.SetParameter("id", (int)actualizar_primer_objeto["id"]);
                                            client.SetParameter("id_objeto_2", (int)detectar_ob_2["id"]);
                                            client.ExecuteNonQuery("UPDATE objetos_comprados SET id_objeto_2 = @id_objeto_2 WHERE usuario_id = @user_id AND id = @id");
                                        }
                                    }
                                }
                            }
                            if (objeto.id == 3043)
                            {
                                client.SetParameter("id", Session.User.id);
                                client.ExecuteNonQuery("UPDATE objetos_comprados SET data = 'Conejo: Compro objetos de oro! A buen precio :v' WHERE usuario_id = @id AND objeto_id = 3043");
                                objeto.default_data = "Conejo: Compro objetos de oro! A buen precio :v";
                            }
                        }
                    }
                }
            }
        }
        private static void Packet_Cancelar_Compra(SessionInstance Session)
        {
            Packet_189_134(Session);
        }
        private static void Packet_Alerta(SessionInstance Session, string Mensaje)
        {
            Packet_183(Session, Mensaje);
        }
        static void Sapo(SessionInstance Session, string[,] Parameters)
        {
            if (Session.User.Sala != null)
            {
                using (mysql client = new mysql())
                {
                    int ID = Convert.ToInt32(Parameters[0, 0]);
                    int accion = Convert.ToInt32(Parameters[1, 0]);
                    BuyObjectInstance Item = CatalogoManager.ObtenerCompra(ID);
                    if (Item != null)
                    {
                        if (!Session.User.Sala.ObjetosEnSala.ContainsKey(Item.id)) return;
                        if (Item.usuario_id == Session.User.id)
                        {
                            Packet_189_161(Session, ID, Item);
                        }
                    }
                }
            }
        }
        public static void Canjear_objeto_oro(SessionInstance Session, string data, int precio_oro, int id_objeto)
        {
            using (mysql client = new mysql())
            {
                DataRow objetos_comprados = client.ExecuteQueryRow("SELECT * FROM objetos_comprados WHERE objeto_id = '" + id_objeto + "' AND usuario_id = '" + Session.User.id + "'");
                if (objetos_comprados != null)
                {
                    NotificacionesManager.NotifiChat(Session, "Conejo: Has recibido " + precio_oro / 2 + " por la venta de " + data + "");
                    UserManager.Creditos(Session.User, true, true, precio_oro / 2);
                    client.ExecuteNonQuery("DELETE FROM objetos_comprados WHERE objeto_id = '" + id_objeto + "' AND usuario_id = '" + Session.User.id + "' LIMIT 1");
                    Packet_189_169(Session, -1, id_objeto);
                }
            }
        }
        static void Vender_Objetos_Oro(SessionInstance Session, string data)
        {
            using (mysql client = new mysql())
            {
                DataRow objetos = client.ExecuteQueryRow("SELECT * FROM objetos WHERE titulo = '" + data + "'");
                if (objetos != null)
                {
                    int id_objeto = (int)objetos["id"];
                    int precio_oro = (int)objetos["precio_oro"];
                    if (precio_oro == -1 || id_objeto == 3065 || id_objeto == 871 || id_objeto == 3067 || id_objeto == 3068 || id_objeto == 3066 || id_objeto == 3063 || id_objeto == 3069)
                    {
                        NotificacionesManager.NotifiChat(Session, "Conejo: Algunos objetos no pueden ser vendidos. Solo acepto objetos de Oro.");
                    }
                    else
                    {
                        DataRow objetos_comprados = client.ExecuteQueryRow("SELECT * FROM objetos_comprados WHERE objeto_id = '" + id_objeto + "' AND usuario_id = '" + Session.User.id + "'");
                        if (objetos_comprados != null)
                        {
                            int sala_id = (int)objetos_comprados["sala_id"];
                            if (sala_id != 0)
                            {
                                NotificacionesManager.NotifiChat(Session, "Conejo: es nesesario tener el objeto en la muchila para poder venderlo.");
                            }
                            else
                            {
                                ServerMessage alerta = new ServerMessage();
                                alerta.AddHead(183);
                                alerta.AppendParameter("Conejo: ¡Consulta la información del objeto aqui!\nNombre de objeto: " + data + " | Precio del objeto en catalago: " + precio_oro + " créditos.\nConejo: Te dare " + precio_oro / 2 + " créditos por el " + data + ".\nEscribe en chat: /si o /no para vender el " + data + "");
                                Session.SendData(alerta);
                                Session.User.espera_respuesta_venta_objeto_oro = true;
                                Session.User.data_objeto_venta = data;
                                Session.User.precio_objeto_venta = precio_oro;
                                Session.User.id_objeto_venta = id_objeto;
                            }
                        }
                        else
                        {
                            NotificacionesManager.NotifiChat(Session, "Conejo: no pudimos encontrar " + data + " en tu muchila.");
                            //No tienes este objeto
                        }
                    }
                }
                else
                {
                    NotificacionesManager.NotifiChat(Session, "Conejo: el objeto " + data + " no figura en nuestro catalago.");
                    // No existe este objeto en catalogo
                }
            }
        }
        private static void Sistema_Obj_Click(SessionInstance Session, int ID_Objeto, int Compra_ID)
        {
            Random random = new Random();
            if (ID_Objeto == 952)
            {
                int Objeto = listas.Objeto_952.Count;
                int Obtener_Objeto = random.Next(Objeto);
                int idRandom = listas.Objeto_952[Obtener_Objeto];
                Añadir_Objeto_Click(Session, idRandom, 1, Compra_ID);
            }
            if (ID_Objeto == 959)
            {
                int Objeto = listas.Objeto_959.Count;
                int Obtener_Objeto = random.Next(Objeto);
                int idRandom = listas.Objeto_959[Obtener_Objeto];
                Añadir_Objeto_Click(Session, idRandom, 1, Compra_ID);
            }
            if (ID_Objeto == 460)
            {
                int Objeto = listas.Objeto_460.Count;
                int Obtener_Objeto = random.Next(Objeto);
                int idRandom = listas.Objeto_460[Obtener_Objeto];
                Añadir_Objeto_Click(Session, idRandom, 1, Compra_ID);
            }
            if (ID_Objeto == 596)
            {
                int Objeto = listas.Objeto_596.Count;
                int Obtener_Objeto = random.Next(Objeto);
                int idRandom = listas.Objeto_596[Obtener_Objeto];
                Añadir_Objeto_Click(Session, idRandom, 1, Compra_ID);
            }
            if (ID_Objeto == 481)
            {
                int Objeto = listas.Objeto_481.Count;
                int Obtener_Objeto = random.Next(Objeto);
                int idRandom = listas.Objeto_481[Obtener_Objeto];
                Añadir_Objeto_Click(Session, idRandom, 1, Compra_ID);
            }
            if (ID_Objeto == 901)
            {
                int Objeto = listas.Objeto_901.Count;
                int Obtener_Objeto = random.Next(Objeto);
                int idRandom = listas.Objeto_901[Obtener_Objeto];
                Añadir_Objeto_Click(Session, idRandom, 1, Compra_ID);
            }
        }
        private static void Añadir_Objeto_Click(SessionInstance Session, int ID_Objeto, int Repetir_accion, int Compra_ID)
        {
            using (mysql client = new mysql())
            {
                client.SetParameter("id", ID_Objeto);
                DataRow row = client.ExecuteQueryRow("SELECT * FROM objetos WHERE id = @id");
                if (row != null)
                {
                    CatalogObjectInstance item = new CatalogObjectInstance(row);

                    if (Repetir_accion == 1)
                    {

                    }
                    else
                    {
                        Packet_189_137(Session);
                        UserManager.Creditos(Session.User, false, false, item.precio_plata);
                        client.SetParameter("id", item.id);
                        client.SetParameter("UserID", Session.User.id);
                        int compra_id = int.Parse(Convert.ToString(client.ExecuteScalar("SELECT MAX(id) FROM objetos_comprados WHERE objeto_id = @id AND usuario_id = @UserID")));
                        Packet_189_139(Session, item, compra_id, Repetir_accion, "tam_n");
                        for (int i = 0; i < Repetir_accion; i++)
                        {
                            client.SetParameter("item_id", item.id);
                            client.SetParameter("userid", Session.User.id);
                            client.SetParameter("hex", item.colores_hex);
                            client.SetParameter("rgb", item.colores_rgb);
                            client.SetParameter("tam", item.tam_n);
                            client.ExecuteNonQuery("INSERT INTO objetos_comprados (`objeto_id`, `colores_hex`, `colores_rgb`, `usuario_id`, `tam`) VALUES (@item_id, @hex, @rgb, @userid, @tam)");
                        }
                    }
                }
            }
        }
        static void Comprar_Plata(SessionInstance Session, mysql client, string[,] Parameters)
        {
            int objeto_id = int.Parse(Parameters[0, 0]);
            client.SetParameter("objeto_id", objeto_id);
            DataRow objetos = client.ExecuteQueryRow("SELECT * FROM objetos WHERE id = @objeto_id");
            if (objetos != null)
            {
                client.SetParameter("user_id", Session.User.id);
                DataRow usuario = client.ExecuteQueryRow("SELECT * FROM usuarios WHERE id = @user_id");
                if (usuario != null)
                {
                    if ((int)usuario["plata"] >= (int)objetos["precio_plata"])
                    {
                        if (listas.Llaves_Casas.Contains(objeto_id))
                        {
                            client.SetParameter("id_user", Session.User.id);
                            client.SetParameter("id_objeto", objeto_id);
                            DataRow muchila = client.ExecuteQueryRow("SELECT * FROM objetos_comprados WHERE usuario_id = @id_user AND objeto_id = @id_objeto");
                            if (muchila != null)
                            {
                                NotificacionesManager.NotifiChat(Session, "Catálogo: Ya tienes este objeto comprado. Algunos objetos solo pueden ser comprados 1 vez.");
                                ServerMessage server = new ServerMessage();
                                server.AddHead(189);
                                server.AddHead(134);
                                server.AppendParameter(1);
                                Session.SendData(server);
                                return;
                            }
                        }
                        if ((int)objetos["vip"] == 1 && Time.GetDifference(Session.User.vip_double) <= 0) { return; }
                        if (listas.Objetos_Catalogo_Plata.Contains(objeto_id))
                        {
                            client.SetParameter("id_user", Session.User.id);
                            client.SetParameter("objeto_id", objeto_id);
                            DataRow muchila = client.ExecuteQueryRow("SELECT * FROM objetos_comprados WHERE usuario_id = @id_user AND objeto_id = @objeto_id");
                            if (muchila != null)
                            {
                                NotificacionesManager.NotifiChat(Session, "Catálogo: Ya tienes este objeto comprado. Algunos objetos solo pueden ser comprados 1 vez.");
                                ServerMessage server = new ServerMessage();
                                server.AddHead(189);
                                server.AddHead(134);
                                server.AppendParameter(1);
                                Session.SendData(server);
                                return;
                            }
                        }
                        int cantidad = 1;
                        if ((string)objetos["swf"] == "Teleport_Vale") { cantidad = 2; }
                        Packet_Aceptar_Compra(Session, objeto_id, false, 0, 0, 0, false, Parameters[1, 0], cantidad);
                    }
                    else
                    {
                        ServerMessage server = new ServerMessage();
                        server.AddHead(189);
                        server.AddHead(134);
                        server.AppendParameter(1);
                        Session.SendData(server);
                    }
                }
            }
        }
        static void Comprar_Oro(SessionInstance Session, mysql client, string[,] Parameters)
        {
            int objeto_id = int.Parse(Parameters[0, 0]);
            client.SetParameter("objeto_id", objeto_id);
            DataRow objetos = client.ExecuteQueryRow("SELECT * FROM  objetos WHERE id = @objeto_id");
            if (objetos != null)
            {
                client.SetParameter("user_id", Session.User.id);
                DataRow usuario = client.ExecuteQueryRow("SELECT * FROM usuarios WHERE id = @user_id");
                if (usuario != null)
                {
                    if ((int)usuario["oro"] >= (int)objetos["precio_oro"])
                    {
                        if (listas.Llaves_Casas.Contains(objeto_id))
                        {
                            client.SetParameter("id_user", Session.User.id);
                            client.SetParameter("id_objeto", objeto_id);
                            DataRow muchila = client.ExecuteQueryRow("SELECT * FROM objetos_comprados WHERE usuario_id = @id_user AND objeto_id = @id_objeto");
                            if (muchila != null)
                            {
                                NotificacionesManager.NotifiChat(Session, "Catálogo: Ya tienes este objeto comprado. Algunos objetos solo pueden ser comprados 1 vez.");
                                ServerMessage server = new ServerMessage();
                                server.AddHead(189);
                                server.AddHead(134);
                                server.AppendParameter(1);
                                Session.SendData(server);
                                return;
                            }
                        }
                        if ((int)objetos["vip"] == 1 && Time.GetDifference(Session.User.vip_double) <= 0) { return; }
                        if (listas.Objetos_Catalogo_Oro.Contains(objeto_id))
                        {
                            client.SetParameter("id_user", Session.User.id);
                            client.SetParameter("objeto_id", objeto_id);
                            DataRow muchila = client.ExecuteQueryRow("SELECT * FROM objetos_comprados WHERE usuario_id = @id_user AND objeto_id = @objeto_id");
                            if (muchila != null)
                            {
                                NotificacionesManager.NotifiChat(Session, "Catálogo: Ya tienes este objeto comprado. Algunos objetos solo pueden ser comprados 1 vez.");
                                ServerMessage server = new ServerMessage();
                                server.AddHead(189);
                                server.AddHead(134);
                                server.AppendParameter(1);
                                Session.SendData(server);
                                return;
                            }
                        }
                        int loteria_numero = 0;
                        if (objeto_id == 871)//Loteria Semanal
                        {
                            DataRow loteria = client.ExecuteQueryRow("SELECT * FROM objetos_comprados WHERE NOT (loteria_numero < (SELECT MAX(loteria_numero) FROM objetos_comprados))");
                            loteria_numero = (int)loteria["loteria_numero"];
                            loteria_numero++;
                        }
                        if (objeto_id == 3065)//Cambio de Nombre
                        {
                            Session.User.cambio_nombre = 1;
                            client.SetParameter("id", Session.User.id);
                            client.ExecuteNonQuery("UPDATE usuarios SET cambio_nombre = '1' WHERE id = @id");
                        }
                        int cantidad = 1;
                        if ((string)objetos["swf"] == "Egg_Teleport") { cantidad = 2; }
                        Packet_Aceptar_Compra(Session, objeto_id, false, 0, 0, loteria_numero, true, Parameters[1, 0], cantidad);

                    }
                    else
                    {
                        ServerMessage server = new ServerMessage();
                        server.AddHead(189);
                        server.AddHead(134);
                        server.AppendParameter(1);
                        Session.SendData(server);
                    }
                }
            }
        }
        private static void Packet_189_133(SessionInstance Session)
        {
            mysql client = new mysql();
            ServerMessage server = new ServerMessage();
            server.AddHead(189);
            server.AddHead(133);
            foreach (CatalogObjectInstance Item in CatalogoManager.ObtenerCatalogo())
            {
                server.AppendParameter(Item.id);
                server.AppendParameter(-1);
                server.AppendParameter(Item.titulo);
                server.AppendParameter(Item.swf);
                if (Item.id == 871)///Loteria Semanal
                {
                    int ultimo_numero_loteria = 0;
                    DataRow loteria = client.ExecuteQueryRow("SELECT * FROM objetos_comprados WHERE NOT (loteria_numero < (SELECT MAX(loteria_numero) FROM objetos_comprados))");
                    if (loteria != null)
                    {
                        ultimo_numero_loteria = (int)loteria["loteria_numero"];
                    }
                    int premio_loteria_total = 250 * ultimo_numero_loteria + 5000;
                    server.AppendParameter(Item.descripcion + " " + premio_loteria_total + " créditos. El premio sera entregado: " + Fecha_Loteria_Final + "");
                }
                else { server.AppendParameter(Item.descripcion); }
                if (Item.limitado == 1) { server.AppendParameter(Item.oro_descuento); }
                else { server.AppendParameter(Item.precio_oro); }
                server.AppendParameter(Item.precio_plata);
                if (Item.tipo_arrastre == 28 || Item.tipo_arrastre == 30) { server.AppendParameter(Item.categoria + "³18"); }//Pociones
                else if (Item.limitado == 1) { server.AppendParameter(Item.categoria + "³17"); }
                else { server.AppendParameter(Item.categoria); }
                server.AppendParameter(Item.colores_hex);
                server.AppendParameter(Item.colores_rgb);
                server.AppendParameter(0);
                server.AppendParameter(0);
                server.AppendParameter(Item.parte_1);
                server.AppendParameter(Item.parte_2);
                server.AppendParameter(Item.parte_3);
                server.AppendParameter(Item.parte_4);
                server.AppendParameter(Item.tam_n);
                server.AppendParameter(Item.tam_g);
                server.AppendParameter(Item.tam_p);
                server.AppendParameter(Item.espacio_ocupado_n);// something_1
                server.AppendParameter(0);//Espacio ocupado 2
                server.AppendParameter(0);//Espacio ocupado 3
                server.AppendParameter(Item.something_4);// something_4
                server.AppendParameter(Item.something_5);// something_5
                server.AppendParameter(Item.something_6);// something_6
                server.AppendParameter(Item.tipo_arrastre); //something 10
                server.AppendParameter(Item.vip);
                server.AppendParameter(Item.espacio_mapabytes);
                server.AppendParameter(Item.id == 1112 && Session.User.admin > 0 ? 1 : Item.visible);
                server.AppendParameter(Item.tipo_rare);// something_12
                server.AppendParameter(Item.arrastrable); //something_13
                server.AppendParameter(Item.intercambiable); // something_14
                server.AppendParameter(Item.salas_usables); //something_15
                server.AppendParameter(Item.rotacion);
            }
            Session.SendDataProtected(server);
        }
        private static void Packet_189_180(SessionInstance Session, mysql client)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(189);
            server.AddHead(180);
            Int64 total_item = 0;
            foreach (DataRow dRow in client.ExecuteQueryTable("SELECT distinct objeto_id from objetos_comprados WHERE usuario_id = '" + Session.User.id + "' AND sala_id = 0").Rows)
            {
                client.SetParameter("KekoID", Session.User.id);
                client.SetParameter("Item", Convert.ToInt32(dRow["objeto_id"]));
                total_item = (Int64)client.ExecuteScalar("SELECT COUNT(id) FROM objetos_comprados WHERE objeto_id = @Item AND sala_id = 0 AND usuario_id = '" + Session.User.id + "'");
                server.AppendParameter(Convert.ToInt32(dRow["objeto_id"]));
                server.AppendParameter(total_item);
            }
            Session.SendData(server);
        }
        private static void Packet_189_181(SessionInstance Session, string[,] Parameters)
        {
            mysql client = new mysql();
            ServerMessage server = new ServerMessage();
            server.AddHead(189);
            server.AddHead(181);
            foreach (DataRow row in client.ExecuteQueryTable("SELECT * FROM objetos_comprados WHERE usuario_id = '" + Session.User.id + "' AND objeto_id = '" + int.Parse(Parameters[0, 0]) + "' AND sala_id = '0'").Rows)
            {
                BuyObjectInstance Item = new BuyObjectInstance(row);
                server.AppendParameter(Item.id);
                server.AppendParameter(Item.objeto_id);
                server.AppendParameter(Item.colores_hex);
                server.AppendParameter(Item.colores_rgb);
                server.AppendParameter(0);
                server.AppendParameter(0);
                server.AppendParameter(Item.tam);
                server.AppendParameter(0);
                server.AppendParameter(0);
                server.AppendParameter(0);
                server.AppendParameter(1);
            }
            Session.SendData(server);
        }
        static void Packet_189_136(SessionInstance Session, BuyObjectInstance Compra)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(189);
            server.AddHead(136);
            server.AppendParameter(Compra.id);
            server.AppendParameter(Compra.objeto_id);
            server.AppendParameter(Session.User.Sala.Escenario.id);
            server.AppendParameter(Session.User.id);
            server.AppendParameter(Compra.posX);
            server.AppendParameter(Compra.posY);
            server.AppendParameter(Compra.rotation);
            server.AppendParameter(Compra.tam);
            server.AppendParameter("");
            server.AppendParameter(Compra.espacio_ocupado);
            server.AppendParameter(Compra.colores_hex);
            server.AppendParameter(Compra.colores_rgb);
            server.AppendParameter("0");
            server.AppendParameter("0");
            if (listas.Objetos_Area.Contains(Compra.objeto_id))
            {
                if (Compra.objeto_id == 602)//ID de Igloo en catalago
                {
                    int id_sala = crear_sala_objeto(Session, Compra, "Igloo", 16);// 16 es el modelo de escenario16.swf = Igloo
                    server.AppendParameter(new object[] { Compra.id, 0, id_sala, Compra.open == 0 ? "" : "1", id_sala, 12, 0 });
                    Compra.data = Convert.ToString(id_sala);
                }
                else if (Compra.objeto_id == 142)//ID de tienda camuflaje en catalago
                {
                    int id_sala = crear_sala_objeto(Session, Compra, "Tienda Camuflaje", 8);// 
                    server.AppendParameter(new object[] { Compra.id, 0, id_sala, Compra.open == 0 ? "" : "1", id_sala, 12, 0 });
                    Compra.data = Convert.ToString(id_sala);
                }
                else if (Compra.objeto_id == 128)//ID de calabazaaargh! en catalago
                {
                    int id_sala = crear_sala_objeto(Session, Compra, "Calabazaaargh!", 15);// 
                    server.AppendParameter(new object[] { Compra.id, 0, id_sala, Compra.open == 0 ? "" : "1", id_sala, 12, 0 });
                    Compra.data = Convert.ToString(id_sala);
                }
                else if (Compra.objeto_id == 613)//ID de tienda voodoo en catalago
                {
                    int id_sala = crear_sala_objeto(Session, Compra, "Tienda Voodoo", 7);// 
                    server.AppendParameter(new object[] { Compra.id, 0, id_sala, Compra.open == 0 ? "" : "1", id_sala, 12, 0 });
                    Compra.data = Convert.ToString(id_sala);
                }
                else if (Compra.objeto_id == 612)//ID de tienda tribal en catalago
                {
                    int id_sala = crear_sala_objeto(Session, Compra, "Tienda Tribal", 7);// 
                    server.AppendParameter(new object[] { Compra.id, 0, id_sala, Compra.open == 0 ? "" : "1", id_sala, 12, 0 });
                    Compra.data = Convert.ToString(id_sala);
                }
                else if (Compra.objeto_id == 611)//ID de tienda fuego en catalago
                {
                    int id_sala = crear_sala_objeto(Session, Compra, "Tienda Fuego", 7);// 
                    server.AppendParameter(new object[] { Compra.id, 0, id_sala, Compra.open == 0 ? "" : "1", id_sala, 12, 0 });
                    Compra.data = Convert.ToString(id_sala);
                }
                else if (Compra.objeto_id == 603)//ID de tienda india en catalago
                {
                    int id_sala = crear_sala_objeto(Session, Compra, "Tienda India", 7);// 
                    server.AppendParameter(new object[] { Compra.id, 0, id_sala, Compra.open == 0 ? "" : "1", id_sala, 12, 0 });
                    Compra.data = Convert.ToString(id_sala);
                }
                else if (Compra.objeto_id == 976)//ID de barco pirata en catalago
                {
                    int id_sala = crear_sala_objeto(Session, Compra, "Barco Pirata", 18);// 
                    server.AppendParameter(new object[] { Compra.id, 0, id_sala, Compra.open == 0 ? "" : "1", id_sala, 12, 0 });
                    Compra.data = Convert.ToString(id_sala);
                }
                else if (Compra.objeto_id == 892)//ID de casa china en catalago
                {
                    int id_sala = crear_sala_objeto(Session, Compra, "Okiya", 20);// 
                    server.AppendParameter(new object[] { Compra.id, 0, id_sala, Compra.open == 0 ? "" : "1", id_sala, 12, 0 });
                    Compra.data = Convert.ToString(id_sala);
                }
                else if (Compra.objeto_id == 888)//ID de casa china dojo en catalago
                {
                    int id_sala = crear_sala_objeto(Session, Compra, "Dojo", 19);// 
                    server.AppendParameter(new object[] { Compra.id, 0, id_sala, Compra.open == 0 ? "" : "1", id_sala, 12, 0 });
                    Compra.data = Convert.ToString(id_sala);
                }
                else if (Compra.objeto_id == 654)//ID de torre mágica en catalago
                {
                    int id_sala = crear_sala_objeto(Session, Compra, "Torre Mágica", 22);// 
                    server.AppendParameter(new object[] { Compra.id, 0, id_sala, Compra.open == 0 ? "" : "1", id_sala, 12, 0 });
                    Compra.data = Convert.ToString(id_sala);
                }
                else if (Compra.objeto_id == 444)//ID de madriguera en catalago
                {
                    int id_sala = crear_sala_objeto(Session, Compra, "Madriguera", 17);// 
                    server.AppendParameter(new object[] { Compra.id, 0, id_sala, Compra.open == 0 ? "" : "1", id_sala, 12, 0 });
                    Compra.data = Convert.ToString(id_sala);
                }
                if (!SalasManager.Salas_Privadas.ContainsKey(Convert.ToInt32(Compra.data)))
                {
                    mysql client = new mysql();
                    DataRow row = client.ExecuteQueryRow("SELECT * FROM escenarios_privados WHERE id = '" + Convert.ToInt32(Compra.data) + "'");
                    if (row != null)
                    {
                        EscenarioInstance Escenario = new EscenarioInstance(row);
                        SalasManager.Salas_Privadas.Add(Convert.ToInt32(Compra.data), new SalaInstance(Convert.ToInt32(Compra.data), Escenario));
                    }
                }
            }
            else
            {
                server.AppendParameter(Compra.data);
            }
            Session.User.Sala.SendData(server, Session);
        }
        private static void borar_sala_creada_objeto(BuyObjectInstance Compra)
        {
            mysql client = new mysql();
            client.SetParameter("id", Compra.id);
            DataRow muchila = client.ExecuteQueryRow("SELECT * FROM objetos_comprados WHERE id = @id");
            if (muchila != null)
            {
                client.SetParameter("area_id", Convert.ToInt32((string)muchila["data"]));
                client.ExecuteNonQuery("DELETE FROM escenarios_privados WHERE id = @area_id");
                client.SetParameter("id_compra", Compra.id);
                client.SetParameter("data", "");
                client.ExecuteNonQuery("UPDATE objetos_comprados SET data = @data WHERE id = @id_compra");

                if (!SalasManager.Salas_Privadas.ContainsKey(Convert.ToInt32((string)muchila["data"])))
                {
                    DataRow row = client.ExecuteQueryRow("SELECT * FROM escenarios_privados WHERE id = '" + Convert.ToInt32((string)muchila["data"]) + "'");
                    if (row != null)
                    {
                        SalasManager.Salas_Privadas.Remove(Convert.ToInt32((string)muchila["data"]));
                    }
                }
            }
        }
        private static int crear_sala_objeto(SessionInstance Session, BuyObjectInstance Compra, string nombre_sala, int modelo)
        {
            mysql client = new mysql();
            int id_area = 0;
            client.SetParameter("id_sala", Session.User.Sala.Escenario.id);
            DataRow islas = client.ExecuteQueryRow("SELECT * FROM escenarios_privados WHERE id = @id_sala");
            if (islas != null)
            {
                client.SetParameter("nombre", nombre_sala);
                client.SetParameter("modelo", modelo);
                client.SetParameter("CreadorID", Session.User.Sala.Escenario.Creador.id);
                client.SetParameter("objeto_id", Compra.id);
                client.SetParameter("color_1", "15CCFE35D3FEFEF8D98B59371E5B11");
                client.SetParameter("color_2", "6,86,82,15,84,100,78,63,100,111,53,55,51,16,39");
                client.SetParameter("Ultima_Sala", (int)islas["IslaID"]);
                client.ExecuteNonQuery("INSERT INTO escenarios_privados (`nombre`, `modelo`, `CreadorID`, `objeto_id`, `color_1`, `color_2`, `Ultima_Sala` ) VALUES (@nombre, @modelo, @CreadorID, @objeto_id, @color_1, @color_2, @Ultima_Sala)");
            }
            client.SetParameter("objeto_id", Compra.id);
            client.SetParameter("modelo", modelo);
            client.SetParameter("CreadorID", Session.User.Sala.Escenario.Creador.id);
            DataRow buscar_id_sala = client.ExecuteQueryRow("SELECT * FROM escenarios_privados WHERE CreadorID  = @CreadorID AND modelo = @modelo AND objeto_id = @objeto_id");
            if (buscar_id_sala != null)
            {
                client.SetParameter("id", Compra.id);
                client.SetParameter("data", (int)buscar_id_sala["id"]);
                client.ExecuteNonQuery("UPDATE objetos_comprados SET data = @data WHERE id = @id");
                id_area = (int)buscar_id_sala["id"];
            }
            return id_area;
        }
        private static void Packet_189_169(SessionInstance Session, int compra_id, int Item)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(189);
            server.AddHead(169);
            server.AppendParameter(compra_id);
            server.AppendParameter(Item);
            server.AppendParameter(1);
            Session.SendData(server);
        }
        private static void Packet_189_142(SessionInstance Session, BuyObjectInstance Compra, string[,] Parameters)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(189);
            server.AddHead(142);
            server.AppendParameter(Session.User.Sala.ObjetosEnSala[Compra.id].id);
            server.AppendParameter(Session.User.Sala.ObjetosEnSala[Compra.id].colores_hex);
            server.AppendParameter(Session.User.Sala.ObjetosEnSala[Compra.id].colores_rgb);
            server.AppendParameter(Parameters[3, 0]);
            server.AppendParameter(Parameters[4, 0]);
            server.AppendParameter(Parameters[5, 0]);
            Session.User.Sala.SendData(server, Session);
        }
        private static void Packet_189_145(SessionInstance Session, BuyObjectInstance Compra)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(189);
            server.AddHead(145);
            server.AppendParameter(Session.User.Sala.ObjetosEnSala[Compra.id].id);
            server.AppendParameter(Session.User.Sala.ObjetosEnSala[Compra.id].posX);
            server.AppendParameter(Session.User.Sala.ObjetosEnSala[Compra.id].posY);
            server.AppendParameter(Session.User.Sala.ObjetosEnSala[Compra.id].espacio_ocupado);
            server.AppendParameter(Session.User.Sala.ObjetosEnSala[Compra.id].tam);
            server.AppendParameter(Session.User.Sala.ObjetosEnSala[Compra.id].rotation);
            Session.User.Sala.SendData(server, Session);
        }
        private static void Packet_189_140(SessionInstance Session, BuyObjectInstance Compra)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(189);
            server.AddHead(140);
            server.AppendParameter(Compra.id);
            Session.User.Sala.SendData(server, Session);
        }
        private static void Packet_189_139(SessionInstance Session, CatalogObjectInstance item, int compra_id, int Cantidad, string tam)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(189);
            server.AddHead(139);
            server.AppendParameter(compra_id);
            server.AppendParameter(item.id);
            server.AppendParameter(item.colores_hex);
            server.AppendParameter(item.colores_rgb);
            server.AppendParameter(0);
            server.AppendParameter(0);
            server.AppendParameter(tam);
            server.AppendParameter(item.espacio_ocupado_n);
            server.AppendParameter(0);
            server.AppendParameter(0);
            server.AppendParameter(Cantidad);
            Session.SendData(server);
        }
        private static void Packet_189_143(SessionInstance Session, int ID, int NewRotation, string coor)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(189);
            server.AddHead(143);
            server.AppendParameter(ID);
            server.AppendParameter(NewRotation);
            server.AppendParameter(coor);
            Session.User.Sala.SendData(server, Session);
        }
        private static void Packet_189_157(SessionInstance Session, BuyObjectInstance Item, int ID)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(189);
            server.AddHead(157);
            server.AppendParameter(ID);
            server.AppendParameter(Session.User.Sala.ObjetosEnSala[Item.id].posX);
            server.AppendParameter(Session.User.Sala.ObjetosEnSala[Item.id].posY);
            Session.User.Sala.SendData(server, Session);
        }
        private static void Packet_189_158(SessionInstance Session, int ID, int Estado)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(189);
            server.AddHead(158);
            server.AppendParameter(ID);
            server.AppendParameter(Estado);
            Session.User.Sala.SendData(server, Session);
        }
        private static void Packet_189_156(SessionInstance Session, int ID, int apartado, string data)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(189);
            server.AddHead(156);
            server.AppendParameter(ID);
            server.AppendParameter(apartado);
            server.AppendParameter(data);
            Session.User.Sala.SendData(server, Session);
        }
        private static void Packet_189_164(SessionInstance Session, string[,] Parameters)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(189);
            server.AddHead(164);
            server.AppendParameter(Parameters[0, 0]);
            server.AppendParameter(Parameters[1, 0]);
            server.AppendParameter(Parameters[2, 0]);
            Session.User.Sala.SendData(server, Session);
        }
        private static void Packet_189_159(SessionInstance Session, string[,] Parameters)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(189);
            server.AddHead(159);
            server.AppendParameter(Parameters[0, 0]);
            server.AppendParameter(Parameters[1, 0]);
            Session.User.Sala.SendData(server, Session);
        }
        private static void Packet_189_144(SessionInstance Session, int ID, string size_rotation, string coor)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(189);
            server.AddHead(144);
            server.AppendParameter(ID);
            server.AppendParameter(size_rotation);
            server.AppendParameter(coor);
            Session.User.Sala.SendData(server, Session);
        }
        private static void Packet_189_160_121(SessionInstance Session, int ID, int accion)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(189);
            server.AddHead(160);
            server.AddHead(121);
            server.AppendParameter(ID);
            server.AppendParameter(accion);
            Session.User.Sala.SendData(server, Session);
        }
        private static void Packet_189_134(SessionInstance Session)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(189);
            server.AddHead(134);
            server.AppendParameter(1);
            Session.SendData(server);
        }
        private static void Packet_189_137(SessionInstance Session)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(189);
            server.AddHead(137);
            server.AppendParameter(1);
            Session.SendData(server);
        }
        
        private static void Packet_183(SessionInstance Session, string mensaje)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(183);
            server.AppendParameter(mensaje);
            Session.SendData(server);
        }
        private static void Packet_189_161(SessionInstance Session, int ID, BuyObjectInstance Item)
        {
            int valor = new Random().Next(0, 11);
            int estado = 1;
            if (valor >= 2 && valor <= 10)
            {
                estado = 2;
                int contador = Convert.ToInt32(Item.data) + 1;
                Item.data = Convert.ToString(contador);
            }
            else
            {
                estado = 1;
                Item.data = "0";
            }
            ServerMessage server = new ServerMessage();
            server.AddHead(189);
            server.AddHead(161);
            server.AppendParameter(ID);
            server.AppendParameter(Convert.ToInt32(Item.data));
            server.AppendParameter(estado);
            Session.User.Sala.SendData(server, Session);

            mysql client = new mysql();
            client.SetParameter("id", Item.id);
            client.SetParameter("data", Item.data);
            client.ExecuteNonQuery("UPDATE objetos_comprados SET data = @data WHERE id = @id");
        }
    }
}
