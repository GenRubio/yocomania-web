using BoomBang.game.instances;
using BoomBang.game.packets;
using BoomBang.server;
using System;
using System.Collections.Generic;
using System.Data;
using System.Linq;
using System.Text;
using System.Text.RegularExpressions;
using System.Threading.Tasks;

namespace BoomBang.game.manager
{
    class CatalogoManager
    {
        public static bool EliminarObjeto(SalaInstance Sala, BuyObjectInstance Compra)
        {
            if (Sala.ObjetosEnSala.ContainsKey(Compra.id))
            {
                using (mysql client = new mysql())
                {
                    client.SetParameter("id", Compra.id);
                    if (client.ExecuteNonQuery("DELETE FROM objetos_comprados WHERE id = @id") == 1)
                    {
                        Sala.EliminarChutas(Compra);
                        Sala.ObjetosEnSala.Remove(Compra.id);
                        return true;
                    }
                }
            }
            return false;
        }
        public static bool QuitarObjeto(SalaInstance Sala, BuyObjectInstance Compra)
        {
            if (Sala.ObjetosEnSala.ContainsKey(Compra.id))
            {
                using (mysql client = new mysql())
                {
                    client.SetParameter("id", Compra.id);
                    if (client.ExecuteNonQuery("UPDATE objetos_comprados SET sala_id = '0' WHERE id = @id") == 1)
                    {
                        Sala.EliminarChutas(Compra);
                        Sala.ObjetosEnSala.Remove(Compra.id);
                        return true;
                    }
                }
            }
            return false;
        }
        public static bool ColocarObjeto_Especial(SalaInstance Sala, BuyObjectInstance Compra, int id, int x, int y, string tam, int rotation, string espacio_ocupado)
        {
            using (mysql client = new mysql())
            {
                client.SetParameter("id", id);
                client.SetParameter("posX", x);
                client.SetParameter("posY", y);
                client.SetParameter("tam", tam);
                client.SetParameter("rotation", rotation);
                client.SetParameter("sala_id", Sala.Escenario.id);
                client.SetParameter("espacio_ocupado", espacio_ocupado);
                if (client.ExecuteNonQuery("UPDATE objetos_comprados SET posX = @posX, posY = @posY, tam = @tam, rotation = @rotation, espacio_ocupado = @espacio_ocupado, sala_id = @sala_id WHERE id = @id") == 1)
                {
                    Compra.posX = x;
                    Compra.posY = y;
                    Compra.sala_id = Sala.id;
                    Compra.espacio_ocupado = espacio_ocupado;
                    Compra.tam = tam;
                    Sala.ObjetosEnSala.Remove(Compra.id);
                    Sala.ObjetosEnSala.Add(Compra.id, Compra);
                    if (Sala.ObjetosEnSala.ContainsKey(Compra.id))
                    {
                        Sala.FijarChutas(Compra);
                    }
                    return true;
                }
            }
            return false;
        }
        public static void colocar_objeto_trampa(SalaInstance Sala, BuyObjectInstance Compra, string espacio_ocupado, bool update, bool deleat)
        {
            mysql client = new mysql();
            string[] Valores = Regex.Split(espacio_ocupado, ",");
            if (update == false && deleat == false)
            {
                client.SetParameter("modelo", Compra.id);
                client.SetParameter("x", Valores[0]);
                client.SetParameter("y", Valores[1]);
                client.SetParameter("mover_x", Sala.Puerta.x);
                client.SetParameter("mover_y", Sala.Puerta.y);
                client.SetParameter("escenario_id", Sala.Escenario.id);
                if (Compra.objeto_id == 1230) { client.SetParameter("expulsar_usuario", 1); }
                else
                {
                    client.SetParameter("expulsar_usuario", 0);
                }
                client.ExecuteNonQuery("INSERT INTO trampas_privadas (`modelo`, `x`, `y`, `mover_x`, `mover_y`, `escenario_id`, `es_categoria`, `expulsar_usuario`) VALUES (@modelo, @x, @y, @mover_x, @mover_y, @escenario_id, '0', @expulsar_usuario)");
            }
            else if (update == true && deleat == false)
            {
                client.SetParameter("modelo", Compra.id);
                client.SetParameter("x", Valores[0]);
                client.SetParameter("y", Valores[1]);
                client.SetParameter("escenario_id", Sala.Escenario.id);
                client.ExecuteNonQuery("UPDATE trampas_privadas SET x = @x, y = @y WHERE modelo = @modelo AND escenario_id = @escenario_id");
            }
            if (deleat == true)
            {
                client.SetParameter("modelo", Compra.id);
                client.ExecuteNonQuery("DELETE FROM trampas_privadas WHERE modelo = @modelo");
            }
        }
        public static List<int> lianas_cocos = new List<int> { 1230, 1229 };
        public static List<int> portales_magicos = new List<int> { 652, 653, 646, 480, 1217 };
        public static bool ColocarObjeto(SalaInstance Sala, BuyObjectInstance Compra, int id, int x, int y, string tam, int rotation, string espacio_ocupado)
        {
            using (mysql client = new mysql())
            {
                client.SetParameter("id", id);
                client.SetParameter("posX", x);
                client.SetParameter("posY", y);
                client.SetParameter("tam", tam);
                client.SetParameter("rotation", rotation);
                client.SetParameter("sala_id", Sala.Escenario.id);
                client.SetParameter("espacio_ocupado", espacio_ocupado);
                if (client.ExecuteNonQuery("UPDATE objetos_comprados SET posX = @posX, posY = @posY, tam = @tam, rotation = @rotation, espacio_ocupado = @espacio_ocupado, sala_id = @sala_id WHERE id = @id") == 1)
                {
                    Compra.posX = x;
                    Compra.posY = y;
                    Compra.sala_id = Sala.id;
                    if (!lianas_cocos.Contains(Compra.objeto_id))
                    {
                        Compra.espacio_ocupado = espacio_ocupado;
                    }
                    Compra.tam = tam;
                    Sala.ObjetosEnSala.Add(Compra.id, Compra);
                    if (Sala.ObjetosEnSala.ContainsKey(Compra.id))
                    {
                        Sala.FijarChutas(Compra);
                        /*
                         * 0,0 > Posicion central
0,1 > Trajectoria derecha - abajo
1,0 > Trajectoria derecha - arriba
-1,0 > Trajectoria esquerda - abajo
0, -1 > Trajectoria esquerda - arriba
1,1 > Derecha
*/
                    }
                    return true;
                }
            }
            return false;
        }
        public static BuyObjectInstance ObtenerCompra(int id)
        {
            using (mysql client = new mysql())
            {
                client.SetParameter("id", id);
                DataRow row = client.ExecuteQueryRow("SELECT * FROM objetos_comprados WHERE id = @id");
                if (row != null)
                {
                    return new BuyObjectInstance(row);
                }
            }
            return null;
        }
        public static List<CatalogObjectInstance> ObtenerCatalogo()
        {
            List<CatalogObjectInstance> Objetos = new List<CatalogObjectInstance>();
            using (mysql client = new mysql())
            {
                foreach (DataRow row in client.ExecuteQueryTable("SELECT * FROM objetos").Rows)
                {
                    Objetos.Add(new CatalogObjectInstance(row));
                }
            }
            return Objetos;
        }
    }
}
