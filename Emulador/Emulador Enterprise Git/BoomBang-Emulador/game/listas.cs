using BoomBang.game.handler;
using BoomBang.game.instances;
using BoomBang.server;
using System;
using System.Collections.Generic;
using System.Data;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace BoomBang.game
{
    class listas
    {
        public static List<int> Objetos_Catalogo_Oro = new List<int>() { 3065, 3070, 3071, 3066, 3067, 3068, 3069, 3109, 3110 };
        public static List<int> Objetos_Catalogo_Plata = new List<int>() { 3063, 3043, 3109, 3116, 3117 };
        public static List<int> Catalago_Viernes = new List<int>();
        public static List<int> Objeto_460 = new List<int>() { 461, 462, 463, 464, 465, 466, 467, 468, 469 };
        public static List<int> Objeto_596 = new List<int>() { 597, 598, 599, 600, 601 };
        public static List<int> Objeto_481 = new List<int>() { 482, 483, 484, 485, 486, 487, 488, 489 };
        public static List<int> Objeto_901 = new List<int>() { 902, 903, 904, 905, 906 };
        public static List<int> Objeto_959 = new List<int>() { 967, 968, 969, 975, 977, 978 };
        public static List<int> Objeto_952 = new List<int>() { 953, 954, 955, 956, 957 };
        public static List<int> Plantas = new List<int>() { 1949, 1946, 1944, 1941, 1938, 1935, 1932, 1929, 1926, 1923, 1920, 1917, 1914, 1905, 1906, 1907, 1902, 1899, 1893, 1890, 1887, 1896, 1911 };
        public static List<int> Todos_Objetos_Items = new List<int>() { 3048, 3049, 3050, 3052, 3053, 3064, 285, 397, 444, 117, 115, 116, 119, 274, 275, 276, 293, 286, 586, 3054, 3055, 3056, 3057, 3058, 3059, 3060, 3061, 3084, 3085, 3086, 3087, 3088, 3089, 3090, 3091, 3092, 3093, 3094, 3095, 3096, 3097, 3099, 691, 692, 728, 730, 748, 750, 752, 763, 764, 1310, 1336, 50, 311, 312, 335, 508, 509, 510, 561, 562, 563, 564, 565, 566, 567, 568, 817, 822, 823, 824, 874, 875, 876, 877, 878, 879, 119, 3103, 3109 };
        public static List<int> Chats_Especiales = new List<int>() { 3116, 3117 };
        public static List<int> Pociones_Cajas = new List<int>();
        public static List<int> Lista_Objetos_Unicos = new List<int>();
        public static List<int> Lista_Objetos_CU = new List<int>();
        public static List<int> Lista_Objetos_MR = new List<int>();
        public static List<int> Lista_Objetos_Rare = new List<int>();
        public static List<int> Lista_Todos_Objetos_Oro = new List<int>();
        public static List<int> Lista_Todos_Objetos_Plata = new List<int>();
        public static List<int> Objetos_Area = new List<int> { 602, 142, 128, 613, 612, 611, 603, 976, 892, 888, 654, 444 };
        public static List<int> Areas_Id = new List<int>();
        public static List<int> Llaves_Casas = new List<int> { 578, 631, 149, 210, 319, 445, 1120 };

        public static Dictionary<int, CatalogObjectInstance> Catalago = new Dictionary<int, CatalogObjectInstance>();
        public static List<int> BB_Managers = new List<int>();///Listado de actividades de eventos y rankings del juego

        static void BoomBang_Managers(mysql client)
        {
            DataRow managers = client.ExecuteQueryRow("SELECT proximo_evento, tiempo_evento, tipo_evento, loteria_semanal, ranking_semanal FROM bb_managers ORDER BY id DESC LIMIT 1");
            if (managers != null)
            {
                BB_Managers = new List<int> { (int)managers["proximo_evento"], (int)managers["tiempo_evento"], (int)managers["tipo_evento"], (int)managers["loteria_semanal"], (int)managers["ranking_semanal"] };
            }
        } 
        public static void dictionary_manager()
        {
            mysql client = new mysql();
            foreach (DataRow objetos in client.ExecuteQueryTable("SELECT * FROM objetos").Rows)
            {
                Catalago.Add((int)objetos["id"], new CatalogObjectInstance(objetos));
            }
        }

        public static void automatic_lists_row()
        {
            int Contrador_Goldens = 0;
            for (int x = 0; x < 1000; x++)
            {
                Contrador_Goldens += 10;
                InterfazHandler.Cada_X_Goldens.Add(Contrador_Goldens);
            }
            mysql client = new mysql();
            foreach (DataRow row in client.ExecuteQueryTable("SELECT * FROM objetos WHERE tipo_rare = 4").Rows)
            {
                Lista_Objetos_Rare.Add((int)row["id"]);
                Lista_Todos_Objetos_Oro.Add((int)row["id"]);
            }
            ///Objetos Muy Rare
            foreach (DataRow row in client.ExecuteQueryTable("SELECT * FROM objetos WHERE tipo_rare = 3").Rows)
            {
                Lista_Objetos_MR.Add((int)row["id"]);
                Lista_Todos_Objetos_Oro.Add((int)row["id"]);
            }
            ///Objetos Casi Unico
            foreach (DataRow row in client.ExecuteQueryTable("SELECT * FROM objetos WHERE tipo_rare = 2").Rows)
            {
                Lista_Objetos_CU.Add((int)row["id"]);
                Lista_Todos_Objetos_Oro.Add((int)row["id"]);
            }
            ///Objetos Unico
            foreach (DataRow row in client.ExecuteQueryTable("SELECT * FROM objetos WHERE tipo_rare = 1").Rows)
            {
                Lista_Objetos_Unicos.Add((int)row["id"]);
                Lista_Todos_Objetos_Oro.Add((int)row["id"]);
            }
            foreach (DataRow row in client.ExecuteQueryTable("SELECT * FROM objetos WHERE Especial = 'pocion'").Rows)
            {
                Pociones_Cajas.Add((int)row["id"]);
            }
            foreach (DataRow Row in client.ExecuteQueryTable("SELECT * FROM objetos WHERE limitado = 1").Rows)
            {
                Catalago_Viernes.Add((int)Row["id"]);
            }
            foreach (DataRow Row in client.ExecuteQueryTable("SELECT * FROM objetos WHERE precio_plata > 1 AND visible = 1").Rows)
            {
                Lista_Todos_Objetos_Plata.Add((int)Row["id"]);
            }
            foreach (DataRow Row in client.ExecuteQueryTable("SELECT * FROM escenarios_publicos").Rows)
            {
                Areas_Id.Add((int)Row["id"]);
            }
            BoomBang_Managers(client);
        }
    }
}
