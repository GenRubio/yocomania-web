using System;
using System.Collections.Generic;
using System.Data;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace BoomBang.game.instances
{
    public class BuyObjectInstance
    {
        public static Dictionary<int, BuyObjectInstance> Objetos_Plantas = new Dictionary<int, BuyObjectInstance>();
        public static int Key_OP = 0;
        public int id { get; private set; }
        public int objeto_id { get; set; }
        public int posX { get; set; }
        public int posY { get; set; }
        public string colores_hex { get; set; }
        public string colores_rgb { get; set; }
        public int rotation { get; set; }
        public string tam { get; set; }
        public string espacio_ocupado { get; set; }
        public int sala_id { get; set; }
        public string data { get; set; }
        public int usuario_id { get; set; }
        public double Planta_sol { get; set; }
        public double Planta_agua { get; set; }
        public int open { get; set; }

        public List<int> patchfinding;
        public BuyObjectInstance(DataRow row)
        {
            this.id = (int)row["id"];
            this.objeto_id = (int)row["objeto_id"];
            this.posX = (int)row["posX"];
            this.posY = (int)row["posY"];
            this.colores_hex = (string)row["colores_hex"];
            this.colores_rgb = (string)row["colores_rgb"];
            this.rotation = (int)row["rotation"];
            this.tam = (string)row["tam"];
            this.espacio_ocupado = (string)row["espacio_ocupado"];
            this.sala_id = (int)row["sala_id"];
            this.data = (string)row["data"];
            this.usuario_id = (int)row["usuario_id"];
            this.Planta_sol = (int)row["planta_sol"];
            this.Planta_agua = (int)row["planta_agua"];
            this.open = (int)row["open"];
        }
    }
}
