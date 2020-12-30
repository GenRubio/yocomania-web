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
    class CasasManager
    {
        public static Dictionary<int, EscenarioInstance> CasasActivas = new Dictionary<int, EscenarioInstance>();
        public static void Diccionario_AñadirCasa(EscenarioInstance Zona)
        {
            if (Zona.modelo != 25) return;
            if (!CasasActivas.ContainsKey(Zona.id))
            {
                CasasActivas.Add(Zona.id, Zona);
            }
        }
        public static void Diccionario_EliminarCasa(EscenarioInstance Zona)
        {
            if (CasasActivas.ContainsKey(Zona.id))
            {
                CasasActivas.Remove(Zona.id);
            }
        }
        public static int UsuariosEnSala(EscenarioInstance area)
        {
            int num = 0;
            foreach (SalaInstance Sala in SalasManager.Salas_Privadas.Values)
            {
                if (Sala.Escenario.categoria != 4) continue;
                if (Sala.Escenario.Creador.id == area.Creador.id)
                {
                    num += Sala.Usuarios.Count;
                }
            }
            return num;
        }
        public static int GetZoneID(int UserID, int RoomID)
        {
            using (mysql client = new mysql())
            {
                client.SetParameter("User", UserID);
                client.SetParameter("modelo", Get_modelo_ByID(RoomID));
                DataRow row = client.ExecuteQueryRow("SELECT * FROM escenarios_privados WHERE categoria = '4' AND modelo = @modelo AND CreadorID = @User");
                if (row != null)
                {
                    return (int)row["id"];
                }
            }
            return 0;
        }
        static int Get_terreno_something_1_ByID(int id)
        {
            if (id == 1) return 0;
            return 0;
        }
        static int Get_terreno_something_2_ByID(int id)
        {
            if (id == 1) return 0;
            return 0;
        }
        static string Get_terreno_something_3_ByID(int id)
        {
            if (id == 1) return "0,1,2,3,4,5,6,9";
            return "";
        }
        static string Get_terreno_config_ByID(int id)
        {
            if (id == 1) return "6,10,11,12,13,14,25,28";
            return "";
        }
        static string Get_terreno_colores_ByID(int id)
        {
            if (id == 1) return "E6FF99,E0DE8487FF47,E0DE8487FF47,E0DE8487FF47,E0DE8487FF47,E0DE8487FF47,C8FF1B,FFFBE1C1F9C4";
            return "";
        }
        static string Get_terreno_colores_RGB_ByID(int id)
        {
            if (id == 1) return "80,42,100.88,45,100,63,17,100.88,45,100,63,17,100.88,45,100,63,17,100.88,45,100,63,17,100.88,45,100,63,17,100.91,5,100.77,65,100,62,58,98";
            return "";
        }
        static int Get_object_something_1_ByID(int id)
        {
            if (id == 1) return 1;
            return 0;
        }
        static int Get_object_something_2_ByID(int id)
        {
            if (id == 1) return 3;
            return 0;
        }
        static string Get_object_something_3_ByID(int id)
        {
            if (id == 1) return "10,11,12,13,14,15,16,17,18";
            return "";
        }
        static string Get_object_config_ByID(int id)
        {
            if (id == 1) return "40,0,31,0,39,0,0,37,0";
            return "";
        }
        static string Get_object_colores_ByID(int id)
        {
            if (id == 1) return "FCF2FF,000000,000000,000000,FF694AFFE133,000000,000000,FF679A,000000";
            return "";
        }
        static string Get_object_colores_RGB_ByID(int id)
        {
            if (id == 1) return "73,76,100.50,50,50.50,50,50.50,50,50.126,62,100,111,24,100.50,50,50.50,50,50.115,87,100.50,50,50";
            return "";
        }
        static string Get_color_2_ByID(int id)
        {
            if (id == 1) return "63,74,100,91,56,100,91,56,100,91,56,100,71,73,100,71,73,100,80,42,100,71,73,100,80,42,100,80,42,100,63,17,100,88,45,100,63,17,100,88,45,100,63,17,100,88,45,100,63,17,100,88,45,100,63,17,100,88,45,100,62,19,79,100,53,49,62,19,79,100,53,49,62,19,79,100,53,49,62,19,79,100,53,49,62,19,79,100,53,49,68,72,100,103,50,75,68,72,100,103,50,75,68,72,100,103,50,75,68,72,100,103,50,75,68,72,100,103,50,75,91,5,100,86,61,100,66,74,100,62,58,98,77,65,100,73,76,100,70,26,100,120,25,100,90,88,100,70,119,88,77,65,100,89,81,100,77,65,100,77,65,100,115,87,100,105,49,95,77,65,100,126,62,100,111,24,100,99,129,100,77,65,100,125,62,87,135,72,59,127,45,88,82,51,100,109,14,100,64,20,100,103,23,100,77,65,100,90,58,97,91,55,73,91,55,100,91,55,100,77,65,100,72,72,100,143,68,100,137,75,100,77,71,21,130,72,100,143,70,100,72,72,100,72,72,100,143,69,100,72,74,94,116,109,100,111,105,100,30,97,100,96,106,100,101,122,76,73,75,0,129,79,100";
            if (id == 2) return "88,53,87,82,62,98,80,64,91,80,67,91,82,60,93,79,60,98,80,62,100,85,55,97,89,53,90,82,64,96";
            if (id == 3) return "135,46,93,86,44,84,98,55,66,127,34,100,72,72,100,85,63,100,61,76,100,72,72,100,72,72,100";
            if (id == 4) return "114,100,18,85,5,71,93,67,9,99,51,74,93,60,34,138,79,100,138,49,100,72,72,100";
            if (id == 5) return "128,32,100,118,22,100,81,48,65,72,72,100,86,60,97,72,72,100,72,72,100,110,57,70,114,31,100,132,47,93,72,72,100,72,72,100,72,72,100";
            if (id == 6) return "78,58,82,73,72,100,77,63,63,72,72,100,72,72,100,91,56,97";
            if (id == 7) return "";
            if (id == 8) return "72,72,100,62,60,87,74,51,100,74,49,100,72,72,100,72,72,100,75,47,100,73,58,100,82,59,79,72,72,100,72,72,100,72,72,100,72,72,100,68,90,100,72,72,100";
            if (id == 9) return "";
            if (id == 10) return "";
            if (id == 11) return "79,96,25,101,51,40,74,70,91";
            if (id == 12) return "";
            if (id == 13) return "72,100,72,62,60,87,74,51,100,74,49,100,74,49,100";
            if (id == 14) return "72,72,100,62,60,100,74,51,100,74,49,100";
            if (id == 15) return "72,72,100,62,60,87,74,51,100,74,49,100,72,72,100,72,72,100,75,47,100,73,58,100,82,59,79, 72,72,100,72,72,100";
            if (id == 16) return "72,72,100,62,60,87";
            return "";
        }
        static string Get_color_1_ByID(int id)
        {
            if (id == 1) return "E0F8FFFFE5ADFFE5ADFFE5ADFAFBFFFAFBFFE6FF99FAFBFFE6FF99E6FF9987FF47E0DE8487FF47E0DE8487FF47E0DE8487FF47E0DE8487FF47E0DE846ED13FBF9A6B6ED13FBF9A6B6ED13FBF9A6B6ED13FBF9A6B6ED13FBF9A6BF4FFFFBF9963F4FFFFBF9963F4FFFFBF9963F4FFFFBF9963F4FFFFBF9963C8FF1BFFE8C2E9F8FFC1F9C4FFFBE1FCF2FFADFF671347FEFFAFE79657E0056D4EFFBFDCFFFBE1FFFBE1FF679AF2BD72F1FEE9FF694AFFE133F02FFFFFFBE1DD5D42961B1BE07C2DFAFFB3FFF41C8FFF50FFF741FFFBE1F7DDADBAA77CFFE6ABFFE6ABFFFBE1FFFFFFFF0000FF2831353231FF3F3FFF1913FFFFFFFFFFFFFF1B13ECE9EFFF40BFFF55C95CAAFFFF74F2C132C1000000FF4258";
            if (id == 2) return "DDD096F9EECAE8DEC5E8DACAEDE4BDF9F8CDFFF8D5F7EFB2E5D699F4E5CC";
            if (id == 3) return "ED6A1BD3D67EA88964FFA222FFFFFFFFE9CBD9F3FFFFFFFFFFFFFF";
            if (id == 4) return "FFDF1C0C0A0A161210BC9C6956493BFF243BFF6318FFFFFF";
            if (id == 5) return "FFA21CFFD01E9CA56DFFFFFFF7E1BAFFFFFFFFFFFFB27554FFCC3CED6F23FFFFFFFFFFFFFFFFFF";
            if (id == 6) return "CCD1A5FFFBFBA09F8AFFFFFFFFFFFFF7DEA7";
            if (id == 7) return "";
            if (id == 8) return "FFFFFFB1DDB8E3FFBADFFFB1FFFFFFFFFFFFDEFFAAEAFFCFC9C39FFFFFFFFFFFFFFFFFFFFFFFFFD4C3FFFFFFFF";
            if (id == 9) return "";
            if (id == 10) return "";
            if (id == 11) return "BFF45E665237E8E5DE";
            if (id == 12) return "";
            if (id == 13) return "F2FFE4F9FFE2FDFEFAABFFFBDFFFB1";
            if (id == 14) return "FFDE5BAEC8DDFF4E5AFFDCA8";
            if (id == 15) return "FFED33FAF6FFEFCFCF42EAFF9B8078FF3D2E6B4128FFE1C2FFEAD7A4FFF6FFFFFF";
            if (id == 16) return "FCFEE0A0997F";
            return "";
        }
        static int Get_modelo_ByID(int id)
        {
            if (id == 1) return 25;
            if (id == 2) return 26;
            if (id == 3) return 27;
            if (id == 4) return 28;
            if (id == 5) return 29;
            if (id == 6) return 30;
            if (id == 7) return 31;
            if (id == 8) return 32;
            if (id == 9) return 33;
            if (id == 10) return 34;
            if (id == 11) return 35;
            if (id == 12) return 36;
            if (id == 13) return 40;
            if (id == 14) return 41;
            if (id == 15) return 42;
            if (id == 16) return 43;
            return 0;
        }
        public static object[] Get_Key(int modelo)
        {
            if (modelo == 25) return new object[] { 0 };
            if (modelo == 26) return new object[] { 1, 12, 11, 2, 8, 5, 4, 1, 1, 6, 0, 13, 9, 7, 10, 1 };
            if (modelo == 27) return new object[] { 0 };
            if (modelo == 28) return new object[] { 0 };
            if (modelo == 29) return new object[] { 0 };
            if (modelo == 30) return new object[] { 0, 0 };
            if (modelo == 31) return new object[] { 0 };
            if (modelo == 32) return new object[] { 0, 0 };
            if (modelo == 33) return new object[] { 0, 0 };
            if (modelo == 34) return new object[] { 0 };
            if (modelo == 35) return new object[] { 0 };
            if (modelo == 36) return new object[] { 0 };
            if (modelo == 40) return new object[] { 0, 0 };
            if (modelo == 41) return new object[] { 0 };
            if (modelo == 42) return new object[] { 0 };
            if (modelo == 43) return new object[] { 0 };
            return null;
        }
        public static object[] Get_Door_Location_Model(EscenarioInstance area, int UserID)
        {
            if (area.modelo == 25) return new object[] { GetZoneID(UserID, 2) };
            if (area.modelo == 26) return new object[] { (area.Puerta_1 == 1 ? GetZoneID(UserID, 3) : -1), (area.Puerta_2 == 1 ? GetZoneID(UserID, 14) : -1), (area.Puerta_3 == 1 ? GetZoneID(UserID, 15) : -1), (area.Puerta_4 == 1 ? GetZoneID(UserID, 7) : -1), (area.Puerta_5 == 1 ? GetZoneID(UserID, 11) : -1), (area.Puerta_6 == 1 ? GetZoneID(UserID, 8) : -1), (area.Puerta_7 == 1 ? GetZoneID(UserID, 4) : -1), (area.Puerta_8 == 1 ? GetZoneID(UserID, 6) : -1), (area.Puerta_9 == 1 ? GetZoneID(UserID, 5) : -1), (area.Puerta_10 == 1 ? GetZoneID(UserID, 9) : -1), (area.Puerta_11 == 1 ? -1 : -1), (area.Puerta_12 == 1 ? GetZoneID(UserID, 16) : -1), (area.Puerta_13 == 1 ? GetZoneID(UserID, 12) : -1), (area.Puerta_14 == 1 ? GetZoneID(UserID, 10) : -1), (area.Puerta_15 == 1 ? GetZoneID(UserID, 13) : -1), (area.Puerta_16 == 1 ? GetZoneID(UserID, 1) : -1) };
            if (area.modelo == 27) return new object[] { GetZoneID(UserID, 2) };
            if (area.modelo == 28) return new object[] { GetZoneID(UserID, 2) };
            if (area.modelo == 29) return new object[] { GetZoneID(UserID, 2) };
            if (area.modelo == 30) return new object[] { GetZoneID(UserID, 2), 0 };
            if (area.modelo == 31) return new object[] { GetZoneID(UserID, 2) };
            if (area.modelo == 32) return new object[] { GetZoneID(UserID, 2), 0 };
            if (area.modelo == 33) return new object[] { GetZoneID(UserID, 2), 0 };
            if (area.modelo == 34) return new object[] { GetZoneID(UserID, 2) };
            if (area.modelo == 35) return new object[] { GetZoneID(UserID, 2) };
            if (area.modelo == 36) return new object[] { GetZoneID(UserID, 2) };
            if (area.modelo == 40) return new object[] { GetZoneID(UserID, 2), GetZoneID(UserID, 2) };
            if (area.modelo == 41) return new object[] { GetZoneID(UserID, 2), GetZoneID(UserID, 2) };
            if (area.modelo == 42) return new object[] { GetZoneID(UserID, 2) };
            if (area.modelo == 43) return new object[] { GetZoneID(UserID, 2) };
            return null;
        }
        public static void DoorConfiguration(mysql client, int id)
        {
            if (id == 1)
            {
                client.SetParameter("puerta_1", 1);
                client.SetParameter("puerta_2", 0);
                client.SetParameter("puerta_3", 0);
                client.SetParameter("puerta_4", 0);
                client.SetParameter("puerta_5", 0);
                client.SetParameter("puerta_6", 0);
                client.SetParameter("puerta_7", 0);
                client.SetParameter("puerta_8", 0);
                client.SetParameter("puerta_9", 0);
                client.SetParameter("puerta_10", 0);
                client.SetParameter("puerta_11", 0);
                client.SetParameter("puerta_12", 0);
                client.SetParameter("puerta_13", 0);
                client.SetParameter("puerta_14", 0);
                client.SetParameter("puerta_15", 0);
                client.SetParameter("puerta_16", 0);
                return;
            }
            //if (id == 2)
            //{
            //    client.SetParameter("puerta_1", 1);
            //    client.SetParameter("puerta_2", 0);
            //    client.SetParameter("puerta_3", 0);
            //    client.SetParameter("puerta_4", 0);
            //    client.SetParameter("puerta_5", 0);
            //    client.SetParameter("puerta_6", 0);
            //    client.SetParameter("puerta_7", 0);
            //    client.SetParameter("puerta_8", 1);
            //    client.SetParameter("puerta_9", 1);
            //    client.SetParameter("puerta_10", 0);
            //    client.SetParameter("puerta_11", 0);
            //    client.SetParameter("puerta_12", 0);
            //    client.SetParameter("puerta_13", 0);
            //    client.SetParameter("puerta_14", 0);
            //    client.SetParameter("puerta_15", 0);
            //    client.SetParameter("puerta_16", 1);
            //    return;
            //}
            if (id == 2)
            {
                client.SetParameter("puerta_1", 1);
                client.SetParameter("puerta_2", 1);
                client.SetParameter("puerta_3", 1);
                client.SetParameter("puerta_4", 1);
                client.SetParameter("puerta_5", 1);
                client.SetParameter("puerta_6", 1);
                client.SetParameter("puerta_7", 1);
                client.SetParameter("puerta_8", 1);
                client.SetParameter("puerta_9", 1);
                client.SetParameter("puerta_10", 1);
                client.SetParameter("puerta_11", 1);
                client.SetParameter("puerta_12", 1);
                client.SetParameter("puerta_13", 1);
                client.SetParameter("puerta_14", 1);
                client.SetParameter("puerta_15", 1);
                client.SetParameter("puerta_16", 1);
                return;
            }
            if (id == 3)
            {
                client.SetParameter("puerta_1", 1);
                client.SetParameter("puerta_2", 0);
                client.SetParameter("puerta_3", 0);
                client.SetParameter("puerta_4", 0);
                client.SetParameter("puerta_5", 0);
                client.SetParameter("puerta_6", 0);
                client.SetParameter("puerta_7", 0);
                client.SetParameter("puerta_8", 0);
                client.SetParameter("puerta_9", 0);
                client.SetParameter("puerta_10", 0);
                client.SetParameter("puerta_11", 0);
                client.SetParameter("puerta_12", 0);
                client.SetParameter("puerta_13", 0);
                client.SetParameter("puerta_14", 0);
                client.SetParameter("puerta_15", 0);
                client.SetParameter("puerta_16", 0);
                return;
            }
            if (id == 4)
            {
                client.SetParameter("puerta_1", 1);
                client.SetParameter("puerta_2", 0);
                client.SetParameter("puerta_3", 0);
                client.SetParameter("puerta_4", 0);
                client.SetParameter("puerta_5", 0);
                client.SetParameter("puerta_6", 0);
                client.SetParameter("puerta_7", 0);
                client.SetParameter("puerta_8", 0);
                client.SetParameter("puerta_9", 0);
                client.SetParameter("puerta_10", 0);
                client.SetParameter("puerta_11", 0);
                client.SetParameter("puerta_12", 0);
                client.SetParameter("puerta_13", 0);
                client.SetParameter("puerta_14", 0);
                client.SetParameter("puerta_15", 0);
                client.SetParameter("puerta_16", 0);
                return;
            }
            if (id == 5)
            {
                client.SetParameter("puerta_1", 1);
                client.SetParameter("puerta_2", 0);
                client.SetParameter("puerta_3", 0);
                client.SetParameter("puerta_4", 0);
                client.SetParameter("puerta_5", 0);
                client.SetParameter("puerta_6", 0);
                client.SetParameter("puerta_7", 0);
                client.SetParameter("puerta_8", 0);
                client.SetParameter("puerta_9", 0);
                client.SetParameter("puerta_10", 0);
                client.SetParameter("puerta_11", 0);
                client.SetParameter("puerta_12", 0);
                client.SetParameter("puerta_13", 0);
                client.SetParameter("puerta_14", 0);
                client.SetParameter("puerta_15", 0);
                client.SetParameter("puerta_16", 0);
                return;
            }
            client.SetParameter("puerta_1", 0);
            client.SetParameter("puerta_2", 0);
            client.SetParameter("puerta_3", 0);
            client.SetParameter("puerta_4", 0);
            client.SetParameter("puerta_5", 0);
            client.SetParameter("puerta_6", 0);
            client.SetParameter("puerta_7", 0);
            client.SetParameter("puerta_8", 0);
            client.SetParameter("puerta_9", 0);
            client.SetParameter("puerta_10", 0);
            client.SetParameter("puerta_11", 0);
            client.SetParameter("puerta_12", 0);
            client.SetParameter("puerta_13", 0);
            client.SetParameter("puerta_14", 0);
            client.SetParameter("puerta_15", 0);
            client.SetParameter("puerta_16", 0);
        }
        public static void RegistrarCasa(UserInstance User, int numero_habitaciones = 17)
        {
            using (mysql client = new mysql())
            {
                for (int id = 1; id < numero_habitaciones; id++)
                {
                    client.SetParameter("uppert", -1);
                    client.SetParameter("categoria", 4);
                    client.SetParameter("Nombre", User.nombre);
                    client.SetParameter("modelo", Get_modelo_ByID(id));
                    client.SetParameter("color_1", Get_color_1_ByID(id));
                    client.SetParameter("color_2", Get_color_2_ByID(id));
                    client.SetParameter("terreno_something_1", Get_terreno_something_1_ByID(id));
                    client.SetParameter("terreno_something_2", Get_terreno_something_2_ByID(id));
                    client.SetParameter("terreno_something_3", Get_terreno_something_3_ByID(id));
                    client.SetParameter("terreno_config", Get_terreno_config_ByID(id));
                    client.SetParameter("terreno_colores", Get_terreno_colores_ByID(id));
                    client.SetParameter("terreno_rgb", Get_terreno_colores_RGB_ByID(id));
                    client.SetParameter("object_something_1", Get_object_something_1_ByID(id));
                    client.SetParameter("object_something_2", Get_object_something_2_ByID(id));
                    client.SetParameter("object_something_3", Get_object_something_3_ByID(id));
                    client.SetParameter("object_config", Get_object_config_ByID(id));
                    client.SetParameter("object_colores", Get_object_colores_ByID(id));
                    client.SetParameter("object_rgb", Get_object_colores_RGB_ByID(id));
                    client.SetParameter("CreadorID", User.id);
                    DoorConfiguration(client, id);
                    client.ExecuteNonQuery("INSERT INTO escenarios_privados (`uppert`, `categoria`, `nombre`, `modelo`, `color_1`, `color_2`, `terreno_something_1`, `terreno_something_2`, `terreno_something_3`, `terreno_config`, `terreno_colores`, `terreno_rgb`, `object_something_1`, `object_something_2`, `object_something_3`, `object_config`, `object_colores`, `object_rgb`, `CreadorID`, `puerta_1`, `puerta_2`, `puerta_3`, `puerta_4`, `puerta_5`, `puerta_6`, `puerta_7`, `puerta_8`, `puerta_9`, `puerta_10`, `puerta_11`, `puerta_12`, `puerta_13`, `puerta_14`, `puerta_15`, `puerta_16`) VALUES (@uppert, @categoria, @Nombre, @modelo, @color_1, @color_2, @terreno_something_1, @terreno_something_2, @terreno_something_3, @terreno_config, @terreno_colores, @terreno_rgb, @object_something_1, @object_something_2, @object_something_3, @object_config, @object_colores, @object_rgb, @CreadorID, @puerta_1, @puerta_2, @puerta_3, @puerta_4, @puerta_5, @puerta_6, @puerta_7, @puerta_8, @puerta_9, @puerta_10, @puerta_11, @puerta_12, @puerta_13, @puerta_14, @puerta_15, @puerta_16)");
                }
            }
        }
        public static List<EscenarioInstance> ObtenerCasasFavoritos(int id)
        {
            List<EscenarioInstance> Casas = new List<EscenarioInstance>();
            using (mysql client = new mysql())
            {
                client.SetParameter("id", id);
                foreach (DataRow row in client.ExecuteQueryTable("SELECT * FROM escenarios_favoritos WHERE user_id = @id").Rows)
                {
                    client.SetParameter("id", row["sala_id"]);
                    DataRow row2 = client.ExecuteQueryRow("SELECT * FROM escenarios_privados WHERE id = @id");
                    if (row2 != null)
                    {
                        Casas.Add(new EscenarioInstance(row2));
                    }               
                }
            }
            return Casas;
        }
        public static List<EscenarioInstance> ObtenerCasas(string nombre)
        {
            List<EscenarioInstance> Casas = new List<EscenarioInstance>();
            using (mysql client = new mysql())
            {
                UserInstance User = UserManager.ObtenerUsuario(nombre);
                if (User != null)
                {
                    client.SetParameter("id", User.id);
                    client.SetParameter("modelo", 25);
                    foreach (DataRow row in client.ExecuteQueryTable("SELECT * FROM escenarios_privados WHERE CreadorID = @id AND modelo = @modelo").Rows)
                    {
                        Casas.Add(new EscenarioInstance(row));
                    }
                }
            }
            return Casas;
        }
        public static List<EscenarioInstance> ObtenerCasasNombre(string nombre)
        {
            List<EscenarioInstance> Casas = new List<EscenarioInstance>();
            using (mysql client = new mysql())
            {
                EscenarioInstance Casa = ObtenerCasa(nombre);
                if (Casa != null)
                {
                    client.SetParameter("id", Casa.nombre);
                    client.SetParameter("modelo", 25);
                    foreach (DataRow row in client.ExecuteQueryTable("SELECT * FROM escenarios_privados WHERE nombre = @id AND modelo = @modelo").Rows)
                    {
                        Casas.Add(new EscenarioInstance(row));
                    }
                }
            }
            return Casas;
        }
        public static EscenarioInstance ObtenerCasa(string nombre)
        {
            using (mysql client = new mysql())
            {
                client.SetParameter("nombre", nombre);
                client.SetParameter("modelo", 25);
                DataRow row = client.ExecuteQueryRow("SELECT * FROM escenarios_privados WHERE nombre = @nombre AND modelo = @modelo");
                if (row != null)
                {
                    return new EscenarioInstance(row);
                }
            }
            return null;
        }
    }
}
