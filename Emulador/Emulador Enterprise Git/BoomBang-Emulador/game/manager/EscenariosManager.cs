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
    public class EscenariosManager
    {
        public static bool CambiarColores(EscenarioInstance Escenario, string HEX, string DEC)
        {
            using (mysql client = new mysql())
            {
                client.SetParameter("id", Escenario.id);
                client.SetParameter("color_1", HEX);
                client.SetParameter("color_2", DEC);
                if (client.ExecuteNonQuery("UPDATE escenarios_privados SET color_1 = @color_1, color_2 = @color_2 WHERE id = @id") == 1)
                {
                    Escenario.color_1 = HEX;
                    Escenario.color_2 = DEC;
                    return true;
                }
            }
            return false;
        }
        public static void RenombrarEscenario(EscenarioInstance Escenario, string nombre)
        {
            using (mysql client = new mysql())
            {
                client.SetParameter("id", Escenario.id);
                client.SetParameter("nombre", nombre);
                if (Escenario.es_categoria == 0)
                {
                    client.ExecuteNonQuery("UPDATE escenarios_privados SET nombre = @nombre WHERE id = @id");
                }
            }
            SalaInstance Sala = SalasManager.ObtenerSala(Escenario);
            if (Sala != null)
            {
                Sala.Escenario.nombre = nombre;
            }
        }
        public static bool ControlDeSeguridad(UserInstance User, EscenarioInstance Escenario)
        {
            if (Escenario.Creador.id == User.id)
            {
                return true;
            }
            return false;
        }
        public static void EliminarEscenario(EscenarioInstance Escenario)
        {
            using (mysql client = new mysql())
            {
                client.SetParameter("id", Escenario.id);
                if (Escenario.es_categoria == 0)
                {
                    client.ExecuteNonQuery("DELETE FROM escenarios_privados WHERE id = @id");
                    client.SetParameter("id", Escenario.id);
                    foreach (DataRow row in client.ExecuteQueryTable("SELECT * FROM objetos_comprados WHERE sala_id = @id").Rows)
                    {
                        BuyObjectInstance Compra = new BuyObjectInstance(row);
                        SessionInstance Session = UserManager.ObtenerSession(Compra.usuario_id);
                        if (Session != null)
                        {
                            ServerMessage añadir_mochila = new ServerMessage();
                            añadir_mochila.AddHead(189);
                            añadir_mochila.AddHead(139);
                            añadir_mochila.AppendParameter(Compra.id);
                            añadir_mochila.AppendParameter(Compra.objeto_id);
                            añadir_mochila.AppendParameter(Compra.colores_hex);
                            añadir_mochila.AppendParameter(Compra.colores_rgb);
                            añadir_mochila.AppendParameter(0);
                            añadir_mochila.AppendParameter(0);
                            añadir_mochila.AppendParameter(Compra.tam);
                            añadir_mochila.AppendParameter(0);
                            añadir_mochila.AppendParameter(0);
                            añadir_mochila.AppendParameter(0);
                            añadir_mochila.AppendParameter(1);//CantidadObjetos
                            Session.SendData(añadir_mochila);
                        }
                        else
                        {
                            break;
                        }
                    }
                    client.SetParameter("id", Escenario.id);
                    client.ExecuteNonQuery("UPDATE objetos_comprados SET sala_id = '0' WHERE sala_id = @id");
                }
                if (Escenario.es_categoria == 1)
                {
                    client.ExecuteNonQuery("DELETE FROM escenarios_publicos WHERE id = @id");
                }
            }
            SalaInstance Sala = SalasManager.ObtenerSala(Escenario);
            if (Sala != null)
            {
                SalasManager.EliminarSala(Sala);
            }
        }
        public static EscenarioInstance ObtenerEscenario(int es_categoria, int id)
        {
            if (es_categoria == 1) // publico
            {
                return Obtener_Publico(id);
            }
            if (es_categoria == 0) // Privado
            {
                return Obtener_Privado(id);
            }
            return null;
        }
        private static EscenarioInstance Obtener_Publico(int id)
        {
            using (mysql client = new mysql())
            {
                client.SetParameter("id", id);
                DataRow row = client.ExecuteQueryRow("SELECT * FROM escenarios_publicos WHERE id = @id");
                if (row != null)
                {
                    return new EscenarioInstance(row);
                }
            }
            return null;
        }
        private static EscenarioInstance Obtener_Privado(int id)
        {
            using (mysql client = new mysql())
            {
                client.SetParameter("id", id);
                DataRow row = client.ExecuteQueryRow("SELECT * FROM escenarios_privados WHERE id = @id");
                if (row != null)
                {
                    return new EscenarioInstance(row);
                }
            }
            return null;
        }
    }
}
