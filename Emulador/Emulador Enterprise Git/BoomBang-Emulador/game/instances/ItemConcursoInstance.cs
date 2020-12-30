using System;
using System.Collections.Generic;
using System.Data;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace BoomBang.game.instances
{
    public class ItemConcursoInstance
    {
        public int id { get; private set; }
        public string nombre { get; set; }
        public int modelo { get; set; }
        public int concurso_id { get; set; }
        public int id_lanzamiento { get; set; }
        public int tipo_salida { get; set; }
        public int tipo_caida { get; set; }
        public int tiempo_aparicion { get; set; }
        public double tiempo_desaparecion = 0;
        public ItemConcursoInstance(DataRow row)
        {
            this.id = (int)row["id"];
            this.nombre = (string)row["nombre"];
            this.modelo = (int)row["modelo"];
            this.concurso_id = (int)row["concurso_id"];
            this.tipo_salida = (int)row["tipo_salida"];
            this.tipo_caida = (int)row["tipo_caida"];
            this.tiempo_aparicion = (int)row["tiempo"];
        }
        public ItemConcursoInstance(int id, string nombre, int modelo, int concurso_id, int tipo_salida, int tipo_caida, int tiempo_aparicion)
        {
            this.id = id;
            this.nombre = nombre;
            this.modelo = modelo;
            this.concurso_id = concurso_id;
            this.tipo_salida = tipo_salida;
            this.tipo_caida = tipo_caida;
            this.tiempo_aparicion = tiempo_aparicion;
        }
    }
}
