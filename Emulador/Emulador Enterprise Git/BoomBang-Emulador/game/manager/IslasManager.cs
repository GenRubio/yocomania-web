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
    class IslasManager
    {
        public static Dictionary<int, int> IslasActivas = new Dictionary<int, int>();
        public static void AñadirNoVerlo(IslaInstance Isla, string nombre1, string nombre2, string nombre3, string nombre4, string nombre5, string nombre6, string nombre7, string nombre8)
        {
            using (mysql client = new mysql())
            {
                client.SetParameter("id", Isla.id);
                client.SetParameter("noverlo_1", nombre1);
                client.SetParameter("noverlo_2", nombre2);
                client.SetParameter("noverlo_3", nombre3);
                client.SetParameter("noverlo_4", nombre4);
                client.SetParameter("noverlo_5", nombre5);
                client.SetParameter("noverlo_6", nombre6);
                client.SetParameter("noverlo_7", nombre7);
                client.SetParameter("noverlo_8", nombre8);
                client.ExecuteNonQuery("UPDATE islas SET noverlo_1 = @noverlo_1, noverlo_2 = @noverlo_2, noverlo_3 = @noverlo_3, noverlo_4 = @noverlo_4, noverlo_5 = @noverlo_5, noverlo_6 = @noverlo_6, noverlo_7 = @noverlo_7, noverlo_8 = @noverlo_8 WHERE id = @id");
            }
        }
        public static void AñadirMAmigos(IslaInstance Isla, string nombre1, string nombre2, string nombre3, string nombre4, string nombre5, string nombre6, string nombre7, string nombre8)
        {
            using (mysql client = new mysql())
            {
                client.SetParameter("id", Isla.id);
                client.SetParameter("mamigos_1", nombre1);
                client.SetParameter("mamigos_2", nombre2);
                client.SetParameter("mamigos_3", nombre3);
                client.SetParameter("mamigos_4", nombre4);
                client.SetParameter("mamigos_5", nombre5);
                client.SetParameter("mamigos_6", nombre6);
                client.SetParameter("mamigos_7", nombre7);
                client.SetParameter("mamigos_8", nombre8);
                client.ExecuteNonQuery("UPDATE islas SET mamigos_1 = @mamigos_1, mamigos_2 = @mamigos_2, mamigos_3 = @mamigos_3, mamigos_4 = @mamigos_4, mamigos_5 = @mamigos_5, mamigos_6 = @mamigos_6, mamigos_7 = @mamigos_7, mamigos_8 = @mamigos_8 WHERE id = @id");
            }
        }
        public static void CambiarDescripcion(IslaInstance Isla, string texto)
        {
            using (mysql client = new mysql())
            {
                client.SetParameter("id", Isla.id);
                client.SetParameter("texto", texto);
                client.ExecuteNonQuery("UPDATE islas SET descripcion = @texto WHERE id = @id");
            }
        }
        public static void CambiarUppert(IslaInstance Isla, int Estado)
        {
            if (Estado == 1 || Estado == 0)
            {
                using (mysql client = new mysql())
                {
                    client.SetParameter("id", Isla.id);
                    client.SetParameter("Estado", Estado);
                    if (client.ExecuteNonQuery("UPDATE islas SET uppert = @Estado WHERE id = @id") == 1)
                    {
                        List<SalaInstance> Salas = new List<SalaInstance>();
                        try
                        {
                            foreach (var Sala in SalasManager.Salas_Privadas.Values)
                            {
                                if (Sala.Escenario.IslaID == Isla.id)
                                {
                                    Salas.Add(Sala);
                                }
                            }
                        }
                        catch
                        {
                        }
                        foreach (var Sala in Salas)
                        {
                            if (Sala.Escenario.IslaID == Isla.id)
                            {
                                ServerMessage server = new ServerMessage();
                                server.AddHead(175);
                                server.AppendParameter(new object[] { 4, (Isla.uppert == 1 ? -1 : 0), 1 });
                                Sala.SendData(server);
                            }
                        }
                    }
                }
            }
        }
        public static bool RenombrarIsla(IslaInstance Isla, string nombre)
        {
            using (mysql client = new mysql())
            {
                client.SetParameter("id", Isla.id);
                client.SetParameter("nombre", nombre);
                if (client.ExecuteNonQuery("UPDATE islas SET nombre = @nombre WHERE id = @id") == 1)
                {
                    return true;
                }
            }
            return false;
        }
        public static void EliminarIsla(IslaInstance Isla)
        {
            using (mysql client = new mysql())
            {
                client.SetParameter("id", Isla.id);
                client.ExecuteNonQuery("DELETE FROM Islas WHERE id = @id");
                DataRow ver_islas_favoritas = client.ExecuteQueryRow("SELECT * FROM escenarios_favoritos WHERE sala_id = '" + Isla.id + "'");
                if (ver_islas_favoritas != null)
                {
                    client.ExecuteNonQuery("DELETE FROM escenarios_favoritos WHERE sala_id = '" + Isla.id + "'");
                }
            }
            foreach (EscenarioInstance Zona in ZonasIsla(Isla))
            {
                EscenariosManager.EliminarEscenario(Zona);
            }
            Diccionario_EliminarIsla(Isla);
        }
        public static int Visitantes(IslaInstance Isla)
        {
            int num = 0;
            foreach (EscenarioInstance Zona in ZonasIsla(Isla))
            {
                num += SalasManager.UsuariosEnSala(Zona);
            }
            return num;
        }
        public static void Diccionario_AñadirIsla(IslaInstance Isla)
        {
            if (!IslasActivas.ContainsKey(Isla.id))
            {
                IslasActivas.Add(Isla.id, Isla.id);
            }
        }
        public static void Diccionario_EliminarIsla(IslaInstance Isla)
        {
            if (IslasActivas.ContainsKey(Isla.id))
            {
                IslasActivas.Remove(Isla.id);
            }
        }
        public static List<EscenarioInstance> ZonasIsla(IslaInstance Isla)
        {
            List<EscenarioInstance> Escenarios = new List<EscenarioInstance>();
            using (mysql client = new mysql())
            {
                client.SetParameter("id", Isla.id);
                foreach (DataRow row in client.ExecuteQueryTable("SELECT * FROM escenarios_privados WHERE IslaID = @id").Rows)
                {
                    Escenarios.Add(new EscenarioInstance(row));
                }
            }
            return Escenarios;
        }
        public static List<IslaInstance> ObtenerIslas(int id)
        {
            List<IslaInstance> Islas = new List<IslaInstance>();
            using (mysql client = new mysql())
            {
                client.SetParameter("id", id);
                foreach (DataRow row in client.ExecuteQueryTable("SELECT * FROM islas WHERE CreadorID = @id").Rows)
                {
                    Islas.Add(new IslaInstance(row));
                }
            }
            return Islas;
        }
        public static List<IslaInstance> ObtenerIslasFavoritos(int id)
        {
            List<IslaInstance> Islas = new List<IslaInstance>();
            using (mysql client = new mysql())
            {
                client.SetParameter("id", id);
                foreach (DataRow row in client.ExecuteQueryTable("SELECT * FROM escenarios_favoritos WHERE user_id = @id").Rows)
                {
                    client.SetParameter("id", row["sala_id"]);
                    DataRow row2 = client.ExecuteQueryRow("SELECT * FROM islas WHERE id = @id");
                    if (row2 != null)
                    {
                        Islas.Add(new IslaInstance(row2));
                    }
                    
                }
            }
            return Islas;
        }
        public static List<IslaInstance> ObtenerIslasNombre(string nombre)
        {
            List<IslaInstance> Islas = new List<IslaInstance>();
            using (mysql client = new mysql())
            {
                IslaInstance Isla = IslasManager.ObtenerIsla(nombre);
                if (Isla != null)
                {
                    client.SetParameter("id", Isla.nombre);
                    foreach (DataRow row in client.ExecuteQueryTable("SELECT * FROM islas WHERE nombre = @id").Rows)
                    {
                        Islas.Add(new IslaInstance(row));
                    }
                }
            }
            return Islas;
        }
        public static List<IslaInstance> ObtenerIslas(string nombre)
        {
            List<IslaInstance> Islas = new List<IslaInstance>();
            using (mysql client = new mysql())
            {
                UserInstance User = UserManager.ObtenerUsuario(nombre);
                if (User != null)
                {
                    client.SetParameter("id", User.id);
                    foreach (DataRow row in client.ExecuteQueryTable("SELECT * FROM islas WHERE CreadorID = @id").Rows)
                    {
                        Islas.Add(new IslaInstance(row));
                    }
                }
            }
            return Islas;
        }
        public static int Crear_Zona(IslaInstance Isla, UserInstance User, string nombre, int modelo, string color_1, string color_2)
        {
            using (mysql client = new mysql())
            {
                client.SetParameter("IslaID", Isla.id);
                client.SetParameter("CreadorID", User.id);
                client.SetParameter("nombre", nombre);
                client.SetParameter("modelo", modelo);
                client.SetParameter("color_1", color_1);
                client.SetParameter("color_2", color_2);
                if (client.ExecuteNonQuery("INSERT INTO escenarios_privados (`IslaID`, `nombre`, `modelo`, `color_1`, `color_2`, `CreadorID`) VALUES (@IslaID, @nombre, @modelo, @color_1, @color_2, @CreadorID)") == 1)
                {
                    client.SetParameter("IslaID", Isla.id);
                    return (Convert.ToInt32(client.ExecuteScalar("SELECT MAX(id) FROM escenarios_privados WHERE IslaID = @IslaID")));
                }
            }
            return 0;
        }
        public static bool ControlDeSeguridad(UserInstance User, IslaInstance Isla)
        {
            if (Isla.Creador.id == User.id)
            {
                return true;
            }
            return false;
        }
        public static int CrearIsla(UserInstance User, string nombre, int modelo)
        {
            using (mysql client = new mysql())
            {
                client.SetParameter("UserID", User.id);
                client.SetParameter("Nombre", nombre);
                client.SetParameter("Modelo", modelo);
                if (client.ExecuteNonQuery("INSERT INTO islas (`Nombre`, `Modelo`, `CreadorID`) VALUES (@Nombre, @Modelo, @UserID)") == 1)
                {
                    client.SetParameter("UserID", User.id);
                    return (Convert.ToInt32(client.ExecuteScalar("SELECT MAX(id) FROM islas WHERE CreadorID = @UserID")));
                }
            }
            return 0;
        }
        public static int IslasCreadas(UserInstance User)
        {
            using (mysql client = new mysql())
            {
                client.SetParameter("id", User.id);
                return Convert.ToInt32(client.ExecuteScalar("SELECT COUNT(id) FROM islas WHERE CreadorID = @id"));
            }
        }
        public static IslaInstance ObtenerIsla(int id)
        {
            using (mysql client = new mysql())
            {
                client.SetParameter("id", id);
                DataRow row = client.ExecuteQueryRow("SELECT * FROM islas WHERE id = @id");
                if (row != null)
                {
                    return new IslaInstance(row);
                }
            }
            return null;
        }
        public static IslaInstance ObtenerIsla(string nombre)
        {
            using (mysql client = new mysql())
            {
                client.SetParameter("nombre", nombre);
                DataRow row = client.ExecuteQueryRow("SELECT * FROM islas WHERE nombre = @nombre");
                if (row != null)
                {
                    return new IslaInstance(row);
                }
            }
            return null;
        }
    }
}
