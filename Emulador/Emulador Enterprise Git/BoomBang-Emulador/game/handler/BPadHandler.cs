using BoomBang.game.instances;
using BoomBang.game.manager;
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
    class BPadHandler
    {
        public static void Start()
        {
            HandlerManager.RegisterHandler(132120, new ProcessHandler(Method_132_120));
            HandlerManager.RegisterHandler(132121, new ProcessHandler(Method_132_121));
            HandlerManager.RegisterHandler(132122, new ProcessHandler(Method_132_122));
            HandlerManager.RegisterHandler(132124, new ProcessHandler(Method_132_124));
            HandlerManager.RegisterHandler(132125, new ProcessHandler(Method_132_125));
            HandlerManager.RegisterHandler(132126, new ProcessHandler(Method_132_126));
            HandlerManager.RegisterHandler(132128, new ProcessHandler(Method_132_128));
            HandlerManager.RegisterHandler(132129, new ProcessHandler(Method_132_129));
            HandlerManager.RegisterHandler(132130, new ProcessHandler(Method_132_130));
            HandlerManager.RegisterHandler(132123, new ProcessHandler(AñadirAmigo));
            HandlerManager.RegisterHandler(132127, new ProcessHandler(EnviarMensaje));
            HandlerManager.RegisterHandler(209127, new ProcessHandler(compartir));//Compartir game
        }
        private static void compartir(SessionInstance Session, string[,] Parameters)
        {
            try
            {
                mysql client = new mysql();
                foreach (DataRow row in client.ExecuteQueryTable("SELECT * FROM bpad_amigos WHERE ID_1 = '" + Session.User.id + "'").Rows)
                {
                    UserInstance amigo = UserManager.ObtenerUsuario((int)row["ID_2"]);
                    SessionInstance SessionFriend = UserManager.ObtenerSession(amigo.id);
                    string Fecha = Convert.ToString(DateTime.Now).Substring(0, 16);
                    client.SetParameter("Emisor", Session.User.id);
                    client.SetParameter("Receptor", amigo.id);
                    client.SetParameter("Mensaje", Session.User.levelup);
                    client.SetParameter("Fecha", Fecha);
                    client.SetParameter("Tipo", 3);
                    client.ExecuteNonQuery("INSERT INTO bpad_mensajes (`Emisor`, `Mensaje`, `Receptor`, `Tipo`, `Fecha`) VALUES (@Emisor, @Mensaje, @Receptor, @Tipo, @Fecha)");
                    client.SetParameter("UserID", Session.User.id);
                    int GetMessageID = Convert.ToInt32(client.ExecuteScalar("SELECT MAX(id) FROM bpad_mensajes WHERE Emisor = @UserID"));
                    ServerMessage server = new ServerMessage();
                    server.AddHead(132);
                    server.AddHead(127);
                    server.AppendParameter(GetMessageID);
                    server.AppendParameter(Session.User.id);
                    server.AppendParameter(Fecha);
                    server.AppendParameter(Session.User.levelup);
                    server.AppendParameter(3);
                    SessionFriend.SendData(server);
                }
                Session.User.levelup = "";
            }
            catch (Exception e)
            {
               Console.WriteLine(e);Program.EditorialResponse(e);
            }
        }
        private static void Method_132_120(SessionInstance Session, string[,] Parameters)
        {
            Session.SendData(Cargar_Bpad(Session));
        }
        private static void Method_132_121(SessionInstance Session, string[,] Parameters)
        {
            Session.SendData(Cargar_Mensajes(Session));
        }
        private static void Method_132_122(SessionInstance Session, string[,] Parameters)
        {
            Thread.Sleep(100);
            Cargar_Bpad(Session);
            ServerMessage server = new ServerMessage();
            server.AddHead(132);
            server.AddHead(122);
            using (mysql client = new mysql())
            {
                client.SetParameter("UserID", Session.User.id);
                foreach (DataRow row in client.ExecuteQueryTable("SELECT * FROM bpad_amigos WHERE ID_1 = @UserID AND Solicitud = '0'").Rows)
                {
                    UserInstance FriendUser = UserManager.ObtenerUsuario((int)row["ID_2"]);
                    if (FriendUser != null)
                    {
                        server.AppendParameter(FriendUser.id);
                        if (UserManager.UsuariosOnline.ContainsKey(FriendUser.id))
                        {
                            SessionInstance SessionAmigo = UserManager.ObtenerSession(FriendUser.id);
                            if (SessionAmigo != null)
                            {
                                if (SessionAmigo.User.Sala != null)
                                {
                                    if (SessionAmigo.User.Sala.Escenario.id == 70)//Las areas del bosque nevada
                                    {
                                        server.AppendParameter(1);
                                        server.AppendParameter(-1);
                                        server.AppendParameter(0);
                                        server.AppendParameter(0);
                                        server.AppendParameter(0);
                                        server.AppendParameter(-1);
                                        server.AppendParameter(-1);
                                        server.AppendParameter(Session.User.Sala.Escenario.id);
                                    }
                                    else if (SessionAmigo.User.Sala.Escenario.id == 2 && SessionAmigo.User.Sala.Escenario.es_categoria == 2 && SessionAmigo.User.Sala.Escenario.categoria == 5)
                                    {
                                        server.AppendParameter(1);
                                        server.AppendParameter(-1);
                                        server.AppendParameter(SessionAmigo.User.Sala.Escenario.es_categoria);//ES_CATEGORIA
                                        server.AppendParameter(0);
                                        server.AppendParameter(0);
                                        server.AppendParameter(SessionAmigo.User.Sala.id);
                                        server.AppendParameter(0);
                                        server.AppendParameter(SessionAmigo.User.Sala.Escenario.nombre);
                                    }
                                    else
                                    {
                                        server.AppendParameter(1);
                                        server.AppendParameter(-1);
                                        server.AppendParameter(SessionAmigo.User.Sala.Escenario.es_categoria);//ES_CATEGORIA
                                        server.AppendParameter(0);
                                        server.AppendParameter(0);
                                        if (Session.User.Sala != null)
                                        {
                                            if (Session.User.Sala.Escenario.IrAlli == 0)
                                            {
                                                Thread.Sleep(new TimeSpan(0, 0, 0, 0, 500));
                                                server.AppendParameter(-1);
                                            }
                                            else
                                            {
                                                if (Session.User.Sala.Escenario.es_categoria == SessionAmigo.User.Sala.Escenario.es_categoria && Session.User.Sala.id == SessionAmigo.User.Sala.id || SessionAmigo.User.Sala.Escenario.es_categoria == 2)
                                                {
                                                    server.AppendParameter(-1);
                                                }
                                                else
                                                {
                                                    server.AppendParameter(SessionAmigo.User.Sala.id);
                                                }
                                            }
                                        }
                                        else
                                        {
                                            server.AppendParameter(SessionAmigo.User.Sala.id);
                                        }
                                        server.AppendParameter(0);
                                        server.AppendParameter(SessionAmigo.User.Sala.Escenario.nombre);
                                    }
                                }
                                else
                                {
                                    server.AppendParameter(1);
                                    server.AppendParameter(-1);
                                    server.AppendParameter(0);
                                    server.AppendParameter(0);
                                    server.AppendParameter(0);
                                    server.AppendParameter(-1);
                                    server.AppendParameter(-1);
                                    server.AppendParameter("Flower Power");
                                }
                            }
                        }
                        else
                        {
                            server.AppendParameter(0);
                            server.AppendParameter(0);
                            server.AppendParameter(0);
                            server.AppendParameter(0);
                            server.AppendParameter(0);
                            server.AppendParameter(0);
                            server.AppendParameter(-1);
                            server.AppendParameter(FriendUser.ultima_conexion);
                        }
                    }
                }
            }
            Session.SendData(server);
        }
        private static void Method_132_129(SessionInstance Session, string[,] Parameters)
        {
            string Usuario = Parameters[0, 0].ToString();
            ServerMessage server = new ServerMessage();
            server.AddHead(132);
            server.AddHead(129);
            UserInstance UserRegister = UserManager.ObtenerUsuario(Usuario);
            if (UserRegister != null)
            {
                UserInstance OtherUser = UserManager.ObtenerUsuario(Usuario);
                if (OtherUser != null)
                {
                    server.AppendParameter(1);
                    server.AppendParameter(OtherUser.id);
                    server.AppendParameter(OtherUser.nombre);
                    server.AppendParameter(OtherUser.avatar);
                    server.AppendParameter(OtherUser.colores);
                    if (UserManager.UsuariosOnline.ContainsKey(OtherUser.id))
                    {
                        SessionInstance OtherSession = UserManager.ObtenerSession(OtherUser.id);
                        if (OtherSession != null)
                        {
                            if (OtherSession.User.Sala != null)
                            {
                                server.AppendParameter(1);
                                server.AppendParameter(-1);
                                server.AppendParameter(OtherSession.User.Sala.Escenario.es_categoria);//ES_CATEGORIA
                                server.AppendParameter(OtherSession.User.Sala.id);
                                server.AppendParameter(OtherSession.User.Sala.id);
                                server.AppendParameter(OtherSession.User.Sala.id);
                                server.AppendParameter(OtherSession.User.Sala.Escenario.nombre);
                            }
                            else
                            {
                                server.AppendParameter(2);
                                server.AppendParameter(2);
                                server.AppendParameter(0);
                                server.AppendParameter(0);
                                server.AppendParameter(0);
                                server.AppendParameter(2);
                                server.AppendParameter("Flower Power");
                            }
                        }
                    }
                    else
                    {
                        server.AppendParameter(-2);
                        server.AppendParameter(-2);
                        server.AppendParameter(-2);
                        server.AppendParameter(-2);
                        server.AppendParameter(-2);
                        server.AppendParameter(-2);
                        server.AppendParameter(OtherUser.ultima_conexion);
                    }
                    server.AppendParameter(OtherUser.edad);
                    server.AppendParameter("BoomBang");
                }
            }
            else
            {
                server.AppendParameter(0);
            }
            Session.SendData(server);
        }
        private static void AñadirAmigo(SessionInstance Session, string[,] Parameters)
        {
            int OtherUserID = int.Parse(Parameters[0, 0]);
            if (OtherUserID != Session.User.id)
            {
                UserInstance OtherUser = UserManager.ObtenerUsuario(OtherUserID);
                if (OtherUser != null)
                {
                    if (MandarSolicitud(Session, OtherUser))
                    {
                        if (UserManager.UsuariosOnline.ContainsKey(OtherUser.id))
                        {
                            SessionInstance SessionFriend = UserManager.ObtenerSession(OtherUser.id);
                            if (SessionFriend != null)
                            {
                                ServerMessage server = new ServerMessage();
                                server.AddHead(132);
                                server.AddHead(123);
                                server.AppendParameter(Session.User.id);
                                server.AppendParameter(Session.User.nombre);
                                server.AppendParameter(Session.User.bocadillo);
                                server.AppendParameter(Session.User.avatar);
                                server.AppendParameter(Session.User.colores);
                                server.AppendParameter(Session.User.edad);
                                server.AppendParameter("BoomBang");
                                server.AppendParameter(null);
                                server.AppendParameter(1);
                                server.AppendParameter(1);
                                SessionFriend.SendData(server);
                            }
                        }
                    }
                }
            }
        }
        private static void Method_132_126(SessionInstance Session, string[,] Parameters)
        {
            int FriendID = int.Parse(Parameters[0, 0].ToString());
            string Nota = Parameters[1, 0].ToString();
            int Marquilla = int.Parse(Parameters[2, 0].ToString());
            using (mysql client = new mysql())
            {
                client.SetParameter("MyID", Session.User.id);
                client.SetParameter("FriendID", FriendID);
                client.SetParameter("Nota", Nota);
                client.SetParameter("Marquilla", Marquilla);
                client.ExecuteNonQuery("UPDATE bpad_amigos SET Nota = @Nota, Marquilla = @Marquilla WHERE (ID_1 = @MyID AND ID_2 = @FriendID)");
            }
        }
        private static void Method_132_128(SessionInstance Session, string[,] Parameters)
        {
            using (mysql client = new mysql())
            {
                int MensajeID = int.Parse(Parameters[0, 0]);
                client.SetParameter("MensajeID", MensajeID);
                client.ExecuteNonQuery("UPDATE bpad_mensajes SET Leido = 1 WHERE id = @MensajeID");
            }
        }
        private static bool EsAmigo(int Emisor, int Receptor)
        {
            using (mysql client = new mysql())
            {
                client.SetParameter("MyID", Emisor);
                client.SetParameter("OtherID", Receptor);
                DataRow row = client.ExecuteQueryRow("SELECT * FROM bpad_amigos WHERE ID_1 = @MyID AND ID_2 = @OtherID AND Solicitud = 0");
                if (row != null)
                {
                    return true;
                }
            }
            return false;
        }
        private static int CountMensajes(int Emisor, int Receptor)
        {
            using (mysql client = new mysql())
            {
                client.SetParameter("MyID", Emisor);
                client.SetParameter("OtherID", Receptor);
                return Convert.ToInt32(client.ExecuteScalar("SELECT COUNT(id) FROM bpad_mensajes WHERE Emisor = @MyID AND Receptor = @OtherID AND Leido = 0"));
            }
        }
        private static void EnviarMensaje(SessionInstance Session, string[,] Parameters)
        {
            using (mysql client = new mysql())
            {
                object[] users = getUsersToMultiAction(Parameters);
                string Mensaje = Parameters[1, 0];
                string Fecha = Convert.ToString(DateTime.Now).Substring(0, 16);
                int Tipo = Session.User.admin == 0 ? 0 : 1;

                for (int i = 0; i < users.Length; i++)
                {
                    int FriendID = Convert.ToInt32(users[i]);
                    UserInstance UserFriend = UserManager.ObtenerUsuario(FriendID);
                    if (UserFriend != null)
                    {
                        if (EsAmigo(Session.User.id, UserFriend.id))
                        {
                            if (CountMensajes(Session.User.id, UserFriend.id) >= 25) return;
                            client.SetParameter("Emisor", Session.User.id);
                            client.SetParameter("Receptor", FriendID);
                            client.SetParameter("Mensaje", Mensaje);
                            client.SetParameter("Fecha", Fecha);
                            client.SetParameter("Tipo", Tipo);
                            client.ExecuteNonQuery("INSERT INTO bpad_mensajes (`Emisor`, `Mensaje`, `Receptor`, `Tipo`, `Fecha`) VALUES (@Emisor, @Mensaje, @Receptor, @Tipo, @Fecha)");
                            if (UserManager.UsuariosOnline.ContainsKey(UserFriend.id))
                            {
                                SessionInstance SessionFriend = UserManager.ObtenerSession(UserFriend.id);
                                client.SetParameter("UserID", Session.User.id);
                                int GetMessageID = Convert.ToInt32(client.ExecuteScalar("SELECT MAX(id) FROM bpad_mensajes WHERE Emisor = @UserID"));
                                if (SessionFriend != null)
                                {
                                    ServerMessage server = new ServerMessage();
                                    server.AddHead(132);
                                    server.AddHead(127);
                                    server.AppendParameter(GetMessageID);
                                    server.AppendParameter(Session.User.id);
                                    server.AppendParameter(Fecha);
                                    server.AppendParameter(Mensaje);
                                    server.AppendParameter(Tipo);
                                    SessionFriend.SendData(server);
                                }
                            }
                        }
                    }
                }
            }
        }
        private static void Method_132_130(SessionInstance Session, string[,] Parameters)
        {
            int OtherUser = int.Parse(Parameters[0, 0].ToString());
            UserInstance UserFriend = UserManager.ObtenerUsuario(OtherUser);
            if (UserFriend != null)
            {
                if (RechazarSolicitud(Session, UserFriend))
                {
                    ServerMessage server_1 = new ServerMessage();
                    server_1.AddHead(132);
                    server_1.AddHead(130);
                    server_1.AppendParameter(UserFriend.id);
                    Session.SendData(server_1);

                    ServerMessage server_2 = new ServerMessage();
                    server_2.AddHead(132);
                    server_2.AddHead(125);
                    server_2.AppendParameter(Session.User.id);
                    Session.SendData(server_2);
                }
            }
        }
        private static void Method_132_124(SessionInstance Session, string[,] Parameters)
        {
            int OtherUser = int.Parse(Parameters[0, 0]);
            UserInstance UserFriend = UserManager.ObtenerUsuario(OtherUser);
            if (UserFriend != null)
            {
                if (AceptarSolicitud(Session, UserFriend))
                {
                    ServerMessage server_1 = new ServerMessage();
                    server_1.AddHead(132);
                    server_1.AddHead(124);
                    server_1.AppendParameter(OtherUser);
                    Session.SendData(server_1);

                    ServerMessage server_2 = new ServerMessage();
                    server_2.AddHead(132);
                    server_2.AddHead(131);
                    server_2.AppendParameter(1);
                    server_2.AppendParameter(OtherUser);
                    Session.SendData(server_2);

                    if (UserManager.UsuariosOnline.ContainsKey(UserFriend.id))
                    {
                        SessionInstance SessionFriend = UserManager.ObtenerSession(UserFriend.id);
                        if (SessionFriend != null)
                        {
                            SessionFriend.SendData(Cargar_Bpad(SessionFriend));
                            Session.SendData(Cargar_Bpad(Session));
                        }
                    }
                }
            }
        }
        static void Method_132_125(SessionInstance Session, string[,] Parameters)
        {
            int FriendID = int.Parse(Parameters[0, 0]);
            UserInstance FriendUser = UserManager.ObtenerUsuario(FriendID);
            if (FriendUser != null)
            {
                if (EliminarAmigo(Session, FriendUser))
                {
                    if (UserManager.UsuariosOnline.ContainsKey(FriendUser.id))
                    {
                        SessionInstance SessionFriend = UserManager.ObtenerSession(FriendUser.id);
                        if (SessionFriend != null)
                        {
                            ServerMessage server_1 = new ServerMessage();
                            server_1.AddHead(132);
                            server_1.AddHead(125);
                            server_1.AppendParameter(Session.User.id);
                            SessionFriend.SendData(server_1);
                        }
                    }
                    ServerMessage server_2 = new ServerMessage();
                    server_2.AddHead(132);
                    server_2.AddHead(125);
                    server_2.AppendParameter(FriendUser.id);
                    Session.SendData(server_2);
                }
            }
        }
        private static bool EliminarAmigo(SessionInstance Session, UserInstance FriendUser)
        {
            try
            {
                using (mysql client = new mysql())
                {
                    client.SetParameter("MyID", Session.User.id);
                    client.SetParameter("FriendID", FriendUser.id);
                    client.ExecuteNonQuery("DELETE FROM bpad_amigos WHERE (ID_1 = @MyID AND ID_2 = @FriendID)");
                    client.SetParameter("MyID", Session.User.id);
                    client.SetParameter("FriendID", FriendUser.id);
                    client.ExecuteNonQuery("DELETE FROM bpad_amigos WHERE (ID_1 = @FriendID AND ID_2 = @MyID)");
                }
                return true;
            }
            catch
            {
                return false;
            }
        }
        static bool RechazarSolicitud(SessionInstance Session, UserInstance UserFriend)
        {
            using (mysql client = new mysql())
            {
                client.SetParameter("MyID", Session.User.id);
                client.SetParameter("FriendID", UserFriend.id);
                client.ExecuteNonQuery("DELETE FROM bpad_amigos WHERE (ID_1 = @MyID AND ID_2 = @FriendID)");
            }
            return true;
        }
        static bool AceptarSolicitud(SessionInstance Session, UserInstance User)
        {
            using (mysql client = new mysql())
            {
                DataRow comprobar = client.ExecuteQueryRow("SELECT * FROM usuarios WHERE id = '" + User.id + "'");
                if (comprobar != null)
                {
                    client.SetParameter("MyID", Session.User.id);
                    client.SetParameter("FriendID", User.id);
                    client.ExecuteNonQuery("INSERT INTO bpad_amigos (`ID_1`, `ID_2`, `Solicitud`) VALUES (@FriendID, @MyID, 0)");
                    client.SetParameter("MyID", Session.User.id);
                    client.SetParameter("FriendID", User.id);
                    client.ExecuteNonQuery("UPDATE bpad_amigos SET Solicitud = '0' WHERE ID_1 = @MyID AND ID_2 = @FriendID");
                }
            }
            return true;
        }
        static bool MandarSolicitud(SessionInstance Session, UserInstance User)
        {
            using (mysql client = new mysql())
            {
                client.SetParameter("MyID", Session.User.id);
                client.SetParameter("OtherID", User.id);
                DataRow row = client.ExecuteQueryRow("SELECT * FROM bpad_amigos WHERE (ID_1 = @OtherID AND ID_2 = @MyID)");
                if (row == null)
                {
                    DataRow comprobar = client.ExecuteQueryRow("SELECT * FROM usuarios WHERE id = '" + User.id + "'");
                    if (comprobar != null)
                    {
                        client.SetParameter("MyID", Session.User.id);
                        client.SetParameter("OtherID", User.id);
                        client.ExecuteNonQuery("INSERT INTO bpad_amigos (`ID_1`, `ID_2`) VALUES (@OtherID, @MyID)");
                    }
                    return true;
                }
            }
            return false;
        }
        static ServerMessage Cargar_Mensajes(SessionInstance Session)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(132);
            server.AddHead(121);
            using (mysql client = new mysql())
            {
                client.SetParameter("UserID", Session.User.id);
                int NumeroMensajes = Convert.ToInt32(client.ExecuteScalar("SELECT COUNT(*) FROM bpad_mensajes WHERE (Receptor = @UserID AND Leido = 0)"));
                server.AppendParameter(NumeroMensajes);
                client.SetParameter("UserID", Session.User.id);
                foreach (DataRow row in client.ExecuteQueryTable("SELECT * FROM bpad_mensajes WHERE (Receptor = @UserID AND Leido = 0)").Rows)
                {
                    server.AppendParameter((int)row["id"]);
                    server.AppendParameter((int)row["Emisor"]);
                    server.AppendParameter((string)row["Fecha"]);
                    server.AppendParameter((string)row["Mensaje"]);
                    server.AppendParameter((int)row["Tipo"]);
                }
            }
            return server;
        }
        static ServerMessage Cargar_Bpad(SessionInstance Session)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(132);
            server.AddHead(120);
            using (mysql client = new mysql())
            {
                int NumeroAmigos = Convert.ToInt32(client.ExecuteScalar("SELECT COUNT(*) FROM bpad_amigos WHERE (ID_1 = '" + Session.User.id + "')"));
                server.AppendParameter(NumeroAmigos);
                List<int> ID_amigos = new List<int>();
                foreach (DataRow row in client.ExecuteQueryTable("SELECT * FROM bpad_amigos WHERE ID_1 = '" + Session.User.id + "'").Rows)
                {
                    //if (!ID_amigos.Contains((int)row[""]))
                    UserInstance UserFriend = UserManager.ObtenerUsuario((int)row["ID_2"]);
                    if (UserFriend != null)
                    {
                        server.AppendParameter(UserFriend.id);
                        server.AppendParameter(UserFriend.nombre);
                        server.AppendParameter(UserFriend.bocadillo);
                        server.AppendParameter(UserFriend.avatar);
                        server.AppendParameter(UserFriend.colores);
                        server.AppendParameter(UserFriend.edad);
                        server.AppendParameter("BurBian");
                        server.AppendParameter((string)row["Nota"]);
                        server.AppendParameter((int)row["Marquilla"]);
                        server.AppendParameter((int)row["Solicitud"]);
                    }
                }
            }
            return server;
        }
        static object[] getUsersToMultiAction(object[,] parameters)
        {
            int a = 0;
            string c = "";
            foreach (string s in parameters)
            {
                if (int.TryParse(s, out a))
                    c += s + ",";
            }
            return c.TrimEnd(',').Split(',');
        }
    }
}
