using BoomBang.game.manager;
using BoomBang.server;
using System;
using System.Collections.Generic;
using System.Data;
using System.Linq;
using System.Text;
using System.Threading;
using System.Threading.Tasks;

namespace BoomBang.game.instances.manager
{
    public class PlantasManager
    {
        public static void cargar_planta(SessionInstance Session, BuyObjectInstance objeto)
        {
            mysql client = new mysql();
            client.SetParameter("id", objeto.id);
            DataRow objetos_comprado = client.ExecuteQueryRow("SELECT * FROM objetos_comprados WHERE id = @id");
            BuyObjectInstance Compra = CatalogoManager.ObtenerCompra((int)objetos_comprado["id"]);
            if (Compra.Planta_agua - Compra.Planta_sol < 0 && Time.GetDifference(Compra.Planta_sol) <= 0)//planta murio
            {
                Compra.Planta_agua = 0;
                Compra.Planta_sol = 0;
                planta_sql(Compra);
                return;
            }
            if (Time.GetDifference(Compra.Planta_sol) <= 0 && Time.GetDifference(Compra.Planta_agua) > 0 && Compra.Planta_sol != 0)//Planta ha crecido
            {
                Compra.Planta_agua = 0;
                Compra.Planta_sol = 0;
                planta_sql(Compra);
                actualizar_planta(Compra.id, Compra, Session);
                return;
            }
            if (Time.GetDifference(Compra.Planta_agua) <= 0)//Planta ha muerto
            {
                Compra.Planta_agua = 0;
                Compra.Planta_sol = 0;
                planta_sql(Compra);
                return;
            }
            new Thread(() => Packet_189_173(Session, Compra)).Start();
        }
        public static void planta_sql(BuyObjectInstance Compra)
        {
            mysql client = new mysql();
            client.SetParameter("id_compra", Compra.id);
            client.SetParameter("planta_agua", Compra.Planta_agua);
            client.SetParameter("planta_sol", Compra.Planta_sol);
            client.ExecuteNonQuery("UPDATE objetos_comprados SET planta_agua = @planta_agua ,planta_sol = @planta_sol  WHERE id = @id_compra");
        }
        public static void actualizar_planta(int id_compra, BuyObjectInstance Compra, SessionInstance Session)///Actualizar la planta
        {
            mysql client = new mysql();
            Random rd = new Random();
            int numero_random = rd.Next(1, 50);
            client.SetParameter("id", id_compra);
            DataRow parametros_compra = client.ExecuteQueryRow("SELECT * FROM objetos_comprados WHERE id = @id");
            BuyObjectInstance compromiso = CatalogoManager.ObtenerCompra(id_compra);
            int compra_objeto_id = (int)parametros_compra["objeto_id"];
            switch (compra_objeto_id)
            {
                case 1896:
                    if (numero_random == 10) { Compra.objeto_id = 1898; }
                    else { Compra.objeto_id = 1897; }
                    break;
                case 1911:
                    if (numero_random == 10) { Compra.objeto_id = 1913; }
                    else { Compra.objeto_id = 1912; }
                    break;
                case 1949:
                    Compra.objeto_id = 1950;
                    break;
                case 1946:
                    if (numero_random == 10) { Compra.objeto_id = 1948; }
                    else { Compra.objeto_id = 1947; }
                    break;
                case 1944:
                    Compra.objeto_id = 1945;
                    break;
                case 1941:
                    if (numero_random == 10) { Compra.objeto_id = 1943; }
                    else { Compra.objeto_id = 1942; }
                    break;
                case 1938:
                    if (numero_random == 10) { Compra.objeto_id = 1940; }
                    else { Compra.objeto_id = 1939; }
                    break;
                case 1935:
                    if (numero_random == 10) { Compra.objeto_id = 1937; }
                    else { Compra.objeto_id = 1936; }
                    break;
                case 1932:
                    if (numero_random == 10) { Compra.objeto_id = 1934; }
                    else { Compra.objeto_id = 1933; }
                    break;
                case 1929:
                    if (numero_random == 10) { Compra.objeto_id = 1931; }
                    else { Compra.objeto_id = 1930; }
                    break;
                case 1926:
                    if (numero_random == 10) { Compra.objeto_id = 1928; }
                    else { Compra.objeto_id = 1927; }
                    break;
                case 1923:
                    if (numero_random == 10) { Compra.objeto_id = 1925; }
                    else { Compra.objeto_id = 1924; }
                    break;
                case 1920:
                    if (numero_random == 10) { Compra.objeto_id = 1922; }
                    else { Compra.objeto_id = 1921; }
                    break;
                case 1917:
                    if (numero_random == 10) { Compra.objeto_id = 1919; }
                    else { Compra.objeto_id = 1918; }
                    break;
                case 1914:
                    if (numero_random == 10) { Compra.objeto_id = 1916; }
                    else { Compra.objeto_id = 1915; }
                    break;
                case 1905:
                    Compra.objeto_id = 1908;
                    break;
                case 1906:
                    Compra.objeto_id = 1909;
                    break;
                case 1907:
                    Compra.objeto_id = 1910;
                    break;
                case 1902:
                    if (numero_random == 10) { Compra.objeto_id = 1904; }
                    else { Compra.objeto_id = 1903; }
                    break;
                case 1899:
                    if (numero_random == 10) { Compra.objeto_id = 1901; }
                    else { Compra.objeto_id = 1900; }
                    break;
                case 1893:
                    if (numero_random == 10) { Compra.objeto_id = 1895; }
                    else { Compra.objeto_id = 1894; }
                    break;
                case 1890:
                    if (numero_random == 10) { Compra.objeto_id = 1892; }
                    else { Compra.objeto_id = 1891; }
                    break;
                case 1887:
                    if (numero_random == 10) { Compra.objeto_id = 1889; }
                    else { Compra.objeto_id = 1888; }
                    break;
            }
            client.SetParameter("objetos_id", Compra.objeto_id);
            DataRow catalago = client.ExecuteQueryRow("SELECT * FROM objetos WHERE id = @objetos_id");

            client.SetParameter("id", Compra.id);
            client.SetParameter("id_objeto", Compra.objeto_id);
            client.SetParameter("hex", (string)catalago["colores_hex"]);
            client.SetParameter("rgb", (string)catalago["colores_rgb"]);
            Compra.colores_hex = (string)catalago["colores_hex"];
            Compra.colores_rgb = (string)catalago["colores_rgb"];
            client.ExecuteNonQuery("UPDATE objetos_comprados SET objeto_id = @id_objeto, colores_hex = @hex, colores_rgb = @rgb WHERE id = @id");
            new Thread(() => change_planta(Session, Compra)).Start();
        }
        static void objetos_manager_change(SessionInstance Session, int compra_id)
        {
            BuyObjectInstance borar_objeto = CatalogoManager.ObtenerCompra(compra_id);
            if (borar_objeto != null)
            {
                if (CatalogoManager.QuitarObjeto(Session.User.Sala, borar_objeto))
                {
                    Packet_189_140(Session, borar_objeto);
                }      
            }
            BuyObjectInstance poner_objeto = CatalogoManager.ObtenerCompra(compra_id);
            if (poner_objeto != null)
            {
                if (CatalogoManager.ColocarObjeto(Session.User.Sala, poner_objeto, compra_id, poner_objeto.posX, poner_objeto.posY, poner_objeto.tam, poner_objeto.rotation, poner_objeto.espacio_ocupado))
                {
                    Packet_189_136(Session, poner_objeto.id);
                }
            }
        }
        static void change_planta(SessionInstance Session, BuyObjectInstance Compra)
        {
            Thread.Sleep(new TimeSpan(0, 0, 1));
            objetos_manager_change(Session, Compra.id);
        }
        static void Packet_189_173(SessionInstance Session, BuyObjectInstance Compra)
        {
            double tiempo = Time.GetCurrentAndAdd(AddType.Segundos, 20);
            while (Time.GetDifference(tiempo) > 0)
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
                Session.SendData(server);
                Thread.Sleep(new TimeSpan(0, 0, 1));//Por alguna razon el packet se esta duplicando
            }
        }
        static void Packet_189_136(SessionInstance Session, int id_compra)
        {
            BuyObjectInstance Compra = CatalogoManager.ObtenerCompra(id_compra);
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
            server.AppendParameter("Gen");
            server.AppendParameter(Compra.espacio_ocupado);
            server.AppendParameter(Compra.colores_hex);
            server.AppendParameter(Compra.colores_rgb);
            server.AppendParameter("0");
            server.AppendParameter("0");
            server.AppendParameter(Compra.data);
            Session.User.Sala.SendData(server, Session);
        }
        static void Packet_189_140(SessionInstance Session, BuyObjectInstance Compra)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(189);
            server.AddHead(140);
            server.AppendParameter(Compra.id);
            Session.User.Sala.SendData(server, Session);
        }
    }
}
