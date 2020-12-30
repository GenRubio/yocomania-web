using BoomBang.game.instances;
using BoomBang.game.manager;
using BoomBang.server;
using System;
using System.Collections.Generic;
using System.Data;
using System.IO;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace BoomBang.game
{
    class diccionarios
    {
        public static Dictionary<int, int[]> loteriaSemanal = new Dictionary<int, int[]>();
        public static Dictionary<int, BPamigosInstance> bpadAmigos = new Dictionary<int, BPamigosInstance>();
        public static void Iniciar()
        {
            mysql client = new mysql();
            cargar_diccionarios(client);
        }
        static void cargar_diccionarios(mysql client)
        {
            int key = 0;
            foreach (DataRow row in client.ExecuteQueryTable("SELECT * FROM objetos_comprados WHERE objeto_id = 871").Rows)//Diccionario Loteria
            {
                key++;
                int id_user = (int)row["usuario_id"];
                int numero_loteria = (int)row["loteria_numero"];
                loteriaSemanal.Add(key, new int[] { id_user, numero_loteria });
            }
            foreach (DataRow row in client.ExecuteQueryTable("SELECT * FROM bpad_amigos").Rows)//Diccionario bpadAmigos
            {
                bpadAmigos.Add((int)row["id"], new BPamigosInstance(row));
            }
        }
    }
}
