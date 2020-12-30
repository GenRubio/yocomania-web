using BoomBang.game.manager;
using BoomBang.server;
using System;
using System.Collections.Generic;
using System.Data;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace BoomBang.game.instances
{
    public class EscenarioInstance
    {
        //Escenario
        public bool anti_coco = false;
        public bool anti_efecto = false;
        public int id { get; private set; }
        public string nombre { get; set; }
        public int modelo { get; set; }
        public int categoria { get; set; }
        public int es_categoria { get; set; }
        public int max_visitantes { get; set; }
        public int uppert { get; set; }
        public int coco { get; set; }
        public int visible { get; set; }
        public int sub_escenarios { get; set; }
        public int IrAlli { get; set; }
        public int segundos_cofre = new Random().Next(60, 120);
        public int segundos_evento_semanal = 300;
        public int segundos_coco_igloo = 360;
        public int segundos_shuriken_igloo = 600;
        public int segundos_items_cmb = new Random().Next(10, 60);
        public double proximo_evento { get; set; }
        public double tiempo_evento { get; set; }
        public int tipo_evento { get; set; }// Esta mal tiene que ir int
        public bool evento_activo = false;
        public bool activar_evento = false;
        public bool ev_coco = false;
        public double evento_anio { get; set; }
        public int item_evento_anio;
        public double loteria_semanal { get; set; }
        public double ranking_semanal { get; set; }
        //Privados
        public string color_1 { get; set; }
        public string color_2 { get; set; }
        public int IslaID { get; set; }
        public UserInstance Creador { get; set; }
        public string Clave = string.Empty;
        //Casas
        public int terreno_something_1 { get; set; }
        public int terreno_something_2 { get; set; }
        public string terreno_something_3 { get; set; }
        public string terreno_config { get; set; }
        public string terreno_colores { get; set; }
        public string terreno_rgb { get; set; }
        public int object_something_1 { get; set; }
        public int object_something_2 { get; set; }
        public string object_something_3 { get; set; }
        public string object_config { get; set; }
        public string object_colores { get; set; }
        public string object_rgb { get; set; }
        public int Puerta_1 { get; set; }
        public int Puerta_2 { get; set; }
        public int Puerta_3 { get; set; }
        public int Puerta_4 { get; set; }
        public int Puerta_5 { get; set; }
        public int Puerta_6 { get; set; }
        public int Puerta_7 { get; set; }
        public int Puerta_8 { get; set; }
        public int Puerta_9 { get; set; }
        public int Puerta_10 { get; set; }
        public int Puerta_11 { get; set; }
        public int Puerta_12 { get; set; }
        public int Puerta_13 { get; set; }
        public int Puerta_14 { get; set; }
        public int Puerta_15 { get; set; }
        public int Puerta_16 { get; set; }
        public int tipo_evento_isla;
        public bool Concurso_Evento = false;
        public int Ultima_Sala;
        public EscenarioInstance(DataRow row)
        {
            this.id = (int)row["id"];
            this.nombre = (string)row["nombre"];
            this.modelo = (int)row["modelo"];
            this.categoria = (int)row["categoria"];
            this.es_categoria = (int)row["es_categoria"];
            this.max_visitantes = (int)row["max_visitantes"];
            this.uppert = (int)row["uppert"];
            this.coco = (int)row["coco"];
            this.visible = (int)row["visible"];
            this.IrAlli = (int)row["IrAlli"];
            if (es_categoria == 1)
            {
                this.proximo_evento = (int)row["proximo_evento"];
                this.tiempo_evento = (int)row["tiempo_evento"];
                this.tipo_evento = (int)row["tipo_evento"];
                //this.evento_anio = (int)row["evento_anio"];
                //this.item_evento_anio = (int)row["item_evento_anio"];
                this.loteria_semanal = (int)row["loteria_semanal"];
                this.ranking_semanal = (int)row["ranking_semanal"];
            } 
            if (es_categoria == 0 || es_categoria == 9)
            {
                if (categoria == 2 || es_categoria == 9)
                {
                    this.IslaID = (int)row["IslaID"];
                    this.color_1 = (string)row["color_1"];
                    this.color_2 = (string)row["color_2"];
                    this.Creador = UserManager.ObtenerUsuario((int)row["CreadorID"]);
                    this.Clave = row["clave"].ToString();
                    this.Ultima_Sala = (int)row["Ultima_Sala"];
                    using (mysql client = new mysql())
                    {
                        DataRow row2 = client.ExecuteQueryRow("SELECT * FROM escenarios_publicos");
                        this.tipo_evento_isla = (int)row2["tipo_evento"];
                    }
                }
                if (categoria == 4)//La parte de casas
                {
                    this.color_1 = (string)row["color_1"];
                    this.color_2 = (string)row["color_2"];
                    this.terreno_something_1 = int.Parse(row["terreno_something_1"].ToString());
                    this.terreno_something_2 = int.Parse(row["terreno_something_2"].ToString());
                    this.terreno_something_3 = row["terreno_something_3"].ToString();
                    this.terreno_config = row["terreno_config"].ToString();
                    this.terreno_colores = row["terreno_colores"].ToString();
                    this.terreno_rgb = row["terreno_rgb"].ToString();
                    this.object_something_1 = int.Parse(row["object_something_1"].ToString());
                    this.object_something_2 = int.Parse(row["object_something_2"].ToString());
                    this.object_something_3 = row["object_something_3"].ToString();
                    this.object_config = row["object_config"].ToString();
                    this.object_colores = row["object_colores"].ToString();
                    this.object_rgb = row["object_rgb"].ToString();
                    this.Puerta_1 = int.Parse(row["puerta_1"].ToString());
                    this.Puerta_2 = int.Parse(row["puerta_2"].ToString());
                    this.Puerta_3 = int.Parse(row["puerta_3"].ToString());
                    this.Puerta_4 = int.Parse(row["puerta_4"].ToString());
                    this.Puerta_5 = int.Parse(row["puerta_5"].ToString());
                    this.Puerta_6 = int.Parse(row["puerta_6"].ToString());
                    this.Puerta_7 = int.Parse(row["puerta_7"].ToString());
                    this.Puerta_8 = int.Parse(row["puerta_8"].ToString());
                    this.Puerta_9 = int.Parse(row["puerta_9"].ToString());
                    this.Puerta_10 = int.Parse(row["puerta_10"].ToString());
                    this.Puerta_11 = int.Parse(row["puerta_11"].ToString());
                    this.Puerta_12 = int.Parse(row["puerta_12"].ToString());
                    this.Puerta_13 = int.Parse(row["puerta_13"].ToString());
                    this.Puerta_14 = int.Parse(row["puerta_14"].ToString());
                    this.Puerta_15 = int.Parse(row["puerta_15"].ToString());
                    this.Puerta_16 = int.Parse(row["puerta_16"].ToString());
                    this.Creador = UserManager.ObtenerUsuario((int)row["CreadorID"]);
                }
            }
        }
    }
}
