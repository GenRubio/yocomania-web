using BoomBang.game.instances;
using BoomBang.server;
using System;
using System.Collections.Generic;
using System.Data;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace BoomBang.game.manager
{
    class Interfazmanager
    {
        public static void armarioLooks(SessionInstance Session, int opcion, string nombre, string rename_look)
        {
            mysql client = new mysql();
            string titulo = "Hola " + Session.User.nombre + " bienvenido a tu armario de looks :)\r";
            string l1 = "";
            string l2 = "Para crear nuevo look usa comando /savelook # El(#) indica el nombre que quieres poner a tu look.\r";
            string l3 = "Para carga tu look del armario usa comando /setlook # El(#) indica el nombre de look que desas cargar.\r";
            if (opcion == 1)
            {
                int count = 0;
                foreach (DataRow armario in client.ExecuteQueryTable("SELECT * FROM user_armario WHERE user_id = " + Session.User.id + "").Rows)
                {
                    count++;
                    l1 = l1 + "Look " + count + " > '" + (string)armario["nombre"] + "'  ";
                }
                if (l1 == "")
                {
                    l1 = "Ups! Tu armario esta vacio. No tienes look's registrados.";
                }
                l1 = l1 + "\r";
                packetAlerta(Session, (titulo + l1 + l2 + l3));
            }
            else if (opcion == 2)
            {
                int key = 0;
                if (rename_look != "")
                {
                    client.SetParameter("nombre", nombre);
                    client.SetParameter("user_id", Session.User.id);
                    DataRow comprobar_nombre = client.ExecuteQueryRow("SELECT * FROM user_armario WHERE nombre = @nombre AND user_id = @user_id");
                    if (comprobar_nombre != null)
                    {
                        client.SetParameter("nombre", rename_look);
                        client.SetParameter("avatar", Session.User.avatar);
                        client.SetParameter("colores", Session.User.colores);
                        client.SetParameter("id", (int)comprobar_nombre["id"]);
                        client.ExecuteNonQuery("UPDATE user_armario SET nombre = @nombre, avatar_id = @avatar, colores = @colores WHERE id = @id");
                        NotificacionesManager.NotifiChat(Session, "Sabio: has cambiado look "+ nombre+ " por " + rename_look +".");
                        return;
                    }
                    NotificacionesManager.NotifiChat(Session, "Sabio: no tienes este look en armario.");
                    return;
                }
                else
                {
                    foreach (DataRow armario in client.ExecuteQueryTable("SELECT * FROM user_armario WHERE user_id = " + Session.User.id + "").Rows)
                    {
                        key++;
                    }
                    client.SetParameter("nombre", nombre);
                    client.SetParameter("user_id", Session.User.id);
                    DataRow comprobar_nombre = client.ExecuteQueryRow("SELECT * FROM user_armario WHERE nombre = @nombre AND user_id = @user_id");
                    if (comprobar_nombre != null)
                    {
                        NotificacionesManager.NotifiChat(Session, "Sabio: ya tienes un look registrador con el mismo nombre.");
                        return;
                    }
                    if (key < 3)
                    {
                        client.SetParameter("id", Session.User.id);
                        client.SetParameter("avatar", Session.User.avatar);
                        client.SetParameter("colores", Session.User.colores);
                        client.SetParameter("nombre", nombre);
                        client.ExecuteNonQuery("INSERT INTO user_armario (user_id,nombre,colores,avatar_id) VALUES (@id, @nombre, @colores, @avatar)");

                        NotificacionesManager.NotifiChat(Session, "Sabio: has añadido nuevo look al armario.");
                    }
                    else
                    {
                        NotificacionesManager.NotifiChat(Session, "Sabio: tu armario esta llendo.");
                    }
                }
            }
            else if (opcion == 3)
            {
                client.SetParameter("nombre", nombre);
                client.SetParameter("user_id", Session.User.id);
                DataRow ver_armario = client.ExecuteQueryRow("SELECT * FROM user_armario WHERE nombre = @nombre AND user_id = @user_id");
                if (ver_armario != null)
                {
                    int id_avatar = (int)ver_armario["avatar_id"];
                    string colores = (string)ver_armario["colores"];
                    if (Session.User.avatar == id_avatar && Session.User.colores == colores)
                    {
                        NotificacionesManager.NotifiChat(Session, "Sabio: ya tienes este look puesto !");
                        return;
                    }
                    Session.User.avatar = id_avatar;
                    Session.User.colores = colores;
                    Packet_125_120(Session, Session.User.id, Session.User.avatar, Session.User.colores, true);
                    client.SetParameter("id", Session.User.id);
                    client.SetParameter("avatar", Session.User.avatar);
                    client.SetParameter("colores", Session.User.colores);
                    client.ExecuteNonQuery("UPDATE usuarios SET avatar = @avatar, colores = @colores WHERE id = @id");
                    return;
                }
                NotificacionesManager.NotifiChat(Session, "Sabio: no tienes este look en armario.");
            }
        }
        static void packetAlerta(SessionInstance Session, string mensaje)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(183);
            server.AppendParameter(mensaje);
            Session.SendData(server);
        }
        static void Packet_125_120(SessionInstance Session, int Usuario_ID, int ID_Personaje, string Colores, bool Publico)
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
    }
}
