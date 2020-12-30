using BoomBang.server;
using System;
using System.Collections.Concurrent;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading;
using System.Threading.Tasks;

namespace BoomBang.game.instances
{
    public class IntercambioInstance
    {
        public int ID;
        public ConcurrentDictionary<int, BuyObjectInstance> Session_1_Objetos = new ConcurrentDictionary<int, BuyObjectInstance>();
        public ConcurrentDictionary<int, BuyObjectInstance> Session_2_Objetos = new ConcurrentDictionary<int, BuyObjectInstance>();
        public SessionInstance Session_1;
        public SessionInstance Session_2;
        public bool Cambios_Session_1_Aceptados = false;
        public bool Cambios_Session_2_Aceptados = false;
        public bool Cambios_Session_1_Cambiar = false;
        public bool Cambios_Session_2_Cambiar = false;
        public IntercambioInstance(int CanjeoID, SessionInstance Session_1, SessionInstance Session_2)
        {
            this.ID = CanjeoID;
            this.Session_1 = Session_1;
            this.Session_2 = Session_2;
            this.IniciarCanjeo();
        }
        private void IniciarCanjeo()
        {
            ServerMessage server_1 = new ServerMessage();
            server_1.AddHead(199);
            server_1.AddHead(120);
            server_1.AppendParameter(ID);
            server_1.AppendParameter(Session_1.User.id);
            server_1.AppendParameter(Session_2.User.id);
            this.Session_1.SendData(server_1);

            ServerMessage server_2 = new ServerMessage();
            server_2.AddHead(199);
            server_2.AddHead(120);
            server_2.AppendParameter(ID);
            server_2.AppendParameter(Session_2.User.id);
            server_2.AppendParameter(Session_1.User.id);
            this.Session_2.SendData(server_2);

        }
        public void TerminarCanjeo()
        {
            Cambios_Session_1_Aceptados = false;
            Cambios_Session_2_Aceptados = false;
            Cambios_Session_1_Cambiar = false;
            Cambios_Session_2_Cambiar = false;
            Session_1.User.Intercambio = null;
            Session_2.User.Intercambio = null;

            ServerMessage server_1 = new ServerMessage();
            server_1.AddHead(199);
            server_1.AddHead(124);
            server_1.AppendParameter(ID);
            server_1.AppendParameter(Session_1.User.id);
            server_1.AppendParameter(Session_2.User.id);
            Session_1.SendData(server_1);

            ServerMessage server_2 = new ServerMessage();
            server_2.AddHead(199);
            server_2.AddHead(124);
            server_2.AppendParameter(ID);
            server_2.AppendParameter(Session_2.User.id);
            server_2.AppendParameter(Session_1.User.id);
            Session_2.SendData(server_2);
            
            Session_1_Objetos.Clear();
            Session_2_Objetos.Clear();
        }
        public void PonerObjeto(SessionInstance Session, BuyObjectInstance Compra)
        {
            if (Session_1.User.id == Session.User.id)
            {
                if (!Session_1_Objetos.ContainsKey(Compra.id))
                {
                    Session_1_Objetos.TryAdd(Compra.id, Compra);
                    ServerMessage server_1 = new ServerMessage();
                    server_1.AddHead(199);
                    server_1.AddHead(121);
                    server_1.AppendParameter(Compra.id);
                    server_1.AppendParameter(Compra.objeto_id);
                    server_1.AppendParameter(1);
                    server_1.AppendParameter(1);
                    server_1.AppendParameter(1);
                    server_1.AppendParameter(1);
                    server_1.AppendParameter(1);
                    server_1.AppendParameter(1);
                    server_1.AppendParameter(1);
                    server_1.AppendParameter(1);
                    server_1.AppendParameter(1);
                    server_1.AppendParameter(1);
                    Session_2.SendData(server_1);

                    ServerMessage server_2 = new ServerMessage();
                    server_2.AddHead(199);
                    server_2.AddHead(125);
                    server_2.AppendParameter(1);
                    server_2.AppendParameter(Compra.id);
                    server_2.AppendParameter(Compra.objeto_id);
                    server_2.AppendParameter(1);
                    Session.SendData(server_2);
                }
            }
            if (Session_2.User.id == Session.User.id)
            {
                if (!Session_2_Objetos.ContainsKey(Compra.id))
                {
                    Session_2_Objetos.TryAdd(Compra.id, Compra);

                    ServerMessage server_1 = new ServerMessage();
                    server_1.AddHead(199);
                    server_1.AddHead(121);
                    server_1.AppendParameter(Compra.id);
                    server_1.AppendParameter(Compra.objeto_id);
                    server_1.AppendParameter(1);
                    server_1.AppendParameter(1);
                    server_1.AppendParameter(1);
                    server_1.AppendParameter(1);
                    server_1.AppendParameter(1);
                    server_1.AppendParameter(1);
                    server_1.AppendParameter(1);
                    server_1.AppendParameter(1);
                    server_1.AppendParameter(1);
                    server_1.AppendParameter(1);
                    Session_1.SendData(server_1);

                    ServerMessage server_2 = new ServerMessage();
                    server_2.AddHead(199);
                    server_2.AddHead(125);
                    server_2.AppendParameter(1);
                    server_2.AppendParameter(Compra.id);
                    server_2.AppendParameter(Compra.objeto_id);
                    server_2.AppendParameter(1);
                    Session.SendData(server_2);
                }
            }
        }
        public void CambiarObjetos(SessionInstance Session)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(199);
            server.AddHead(123);
            server.AppendParameter(ID);
            if (Session_1.User.id == Session.User.id)
            {
                if (Cambios_Session_1_Aceptados)
                {
                    Cambios_Session_1_Cambiar = true;
                    server.AppendParameter(Session.User.id);
                }
            }
            if (Session_2.User.id == Session.User.id)
            {
                if (Cambios_Session_2_Aceptados)
                {
                    Cambios_Session_2_Cambiar = true;
                    server.AppendParameter(Session.User.id);
                }
            }
            Thread.Sleep(new TimeSpan(0, 0, 0, 0, 200));
            Session_1.SendData(server);
            Session_2.SendData(server);
            if (Cambios_Session_1_Aceptados == true && Cambios_Session_1_Cambiar == true && Cambios_Session_2_Aceptados == true && Cambios_Session_2_Cambiar == true)
            {
                if (RealizarCanje())
                {
                    Session_1_Objetos.Clear();
                    Session_2_Objetos.Clear();
                    Cambios_Session_1_Aceptados = false;
                    Cambios_Session_2_Aceptados = false;
                    Cambios_Session_1_Cambiar = false;
                    Cambios_Session_2_Cambiar = false;
                    Session_1.User.Intercambio = null;
                    Session_2.User.Intercambio = null;


                    ServerMessage server_1 = new ServerMessage();
                    server_1.AddHead(199);
                    server_1.AddHead(127);
                    server_1.AppendParameter(Session_1.User.id);
                    Session_1.SendData(server_1);

                    ServerMessage server_2 = new ServerMessage();
                    server_2.AddHead(199);
                    server_2.AddHead(127);
                    server_2.AppendParameter(Session_2.User.id);
                    Session_2.SendData(server_2);
                }
            }
        }
        private bool RealizarCanje()
        {
            try
            {
                using (mysql client = new mysql())
                {
                    foreach (BuyObjectInstance Objetos_1 in Session_1_Objetos.Values)
                    {
                        client.SetParameter("id", Objetos_1.id);
                        client.SetParameter("newUser", Session_2.User.id);
                        if (client.ExecuteNonQuery("UPDATE objetos_comprados SET usuario_id = @newUser WHERE id = @id") == 1)
                        {
                            Objetos_1.usuario_id = Session_2.User.id;
                            ServerMessage server = new ServerMessage();
                            server.AddHead(189);
                            server.AddHead(169);
                            server.AppendParameter(Objetos_1.id);
                            server.AppendParameter(Objetos_1.objeto_id);
                            server.AppendParameter(1);
                            Session_1.SendData(server);

                            ServerMessage añadir_mochila = new ServerMessage();
                            añadir_mochila.AddHead(189);
                            añadir_mochila.AddHead(139);
                            añadir_mochila.AppendParameter(Objetos_1.id);
                            añadir_mochila.AppendParameter(Objetos_1.objeto_id);
                            añadir_mochila.AppendParameter(Objetos_1.colores_hex);
                            añadir_mochila.AppendParameter(Objetos_1.colores_rgb);
                            añadir_mochila.AppendParameter(0);
                            añadir_mochila.AppendParameter(0);
                            añadir_mochila.AppendParameter(Objetos_1.tam);
                            añadir_mochila.AppendParameter(Objetos_1.espacio_ocupado);
                            añadir_mochila.AppendParameter(0);
                            añadir_mochila.AppendParameter(0);
                            añadir_mochila.AppendParameter(1);//CantidadObjetos
                            Session_2.SendData(añadir_mochila);
                        }
                    }
                    foreach (BuyObjectInstance Objetos_2 in Session_2_Objetos.Values)
                    {
                        client.SetParameter("id", Objetos_2.id);
                        client.SetParameter("newUser", Session_1.User.id);
                        if (client.ExecuteNonQuery("UPDATE objetos_comprados SET usuario_id = @newUser WHERE id = @id") == 1)
                        {
                            Objetos_2.usuario_id = Session_1.User.id;
                            ServerMessage server = new ServerMessage();
                            server.AddHead(189);
                            server.AddHead(169);
                            server.AppendParameter(Objetos_2.id);
                            server.AppendParameter(Objetos_2.objeto_id);
                            server.AppendParameter(1);
                            Session_2.SendData(server);

                            ServerMessage añadir_mochila = new ServerMessage();
                            añadir_mochila.AddHead(189);
                            añadir_mochila.AddHead(139);
                            añadir_mochila.AppendParameter(Objetos_2.id);
                            añadir_mochila.AppendParameter(Objetos_2.objeto_id);
                            añadir_mochila.AppendParameter(Objetos_2.colores_hex);
                            añadir_mochila.AppendParameter(Objetos_2.colores_rgb);
                            añadir_mochila.AppendParameter(0);
                            añadir_mochila.AppendParameter(0);
                            añadir_mochila.AppendParameter(Objetos_2.tam);
                            añadir_mochila.AppendParameter(Objetos_2.espacio_ocupado);
                            añadir_mochila.AppendParameter(0);
                            añadir_mochila.AppendParameter(0);
                            añadir_mochila.AppendParameter(1);//CantidadObjetos
                            Session_1.SendData(añadir_mochila);
                        }
                    }
                }
                return true;
            }
            catch
            {
                return false;
            }
        }
        public void AceptarCambios(SessionInstance Session)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(199);
            server.AddHead(122);
            server.AppendParameter(ID);
            if (Session_1.User.id == Session.User.id)
            {
                Cambios_Session_1_Aceptados = true;
                server.AppendParameter(Session.User.id);
            }
            if (Session_2.User.id == Session.User.id)
            {
                Cambios_Session_2_Aceptados = true;
                server.AppendParameter(Session.User.id);
            }
            Thread.Sleep(new TimeSpan(0, 0, 0, 0, 200));
            Session_1.SendData(server);
            Session_2.SendData(server);
        }
    }
}
