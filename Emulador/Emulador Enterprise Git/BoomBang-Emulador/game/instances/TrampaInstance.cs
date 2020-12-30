using BoomBang.game.manager;
using System;
using System.Collections.Generic;
using System.Data;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace BoomBang.game.instances
{
    public class TrampaInstance
    {
        public int id { get; set; }
        public int modelo { get; set; }
        public Posicion Posicion { get; set; }
        public int es_categoria { get; set; }
        public int escenario_id { get; set; }
        public int go_es_categoria { get; set; }
        public int go_escenario_id { get; set; }
        public Posicion MoverUsuario { get; set; }
        public int expulsar_usuario { get; set; }
        public Posicion go_escenario_posicion { get; set; }
        public TrampaInstance(DataRow row)
        {
            this.id = (int)row["id"];
            this.modelo = (int)row["modelo"];
            this.Posicion = new Posicion(int.Parse(row["x"].ToString()), int.Parse(row["y"].ToString()));
            this.es_categoria = (int)row["es_categoria"];
            this.escenario_id = (int)row["escenario_id"];
            this.go_es_categoria = (int)row["go_es_categoria"];
            this.go_escenario_id = (int)row["go_escenario_id"];
            this.go_escenario_posicion = new Posicion(int.Parse(row["go_escenario_x"].ToString()), int.Parse(row["go_escenario_y"].ToString()));
            this.MoverUsuario = new Posicion(int.Parse(row["mover_x"].ToString()), int.Parse(row["mover_y"].ToString()));
            this.expulsar_usuario = (int)row["expulsar_usuario"];
        }
    }
}
