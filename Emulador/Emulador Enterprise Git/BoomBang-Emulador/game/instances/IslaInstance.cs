using BoomBang.game.manager;
using System;
using System.Collections.Generic;
using System.Data;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace BoomBang.game.instances
{
    public class IslaInstance
    {
        public int id { get; set; }
        public int modelo { get; set; }
        public int uppert { get; set; }
        public string nombre { get; set; }
        public string descripcion { get; set; }
        public UserInstance Creador { get; set; }
        public string noverlo_1 { get; set; }
        public string noverlo_2 { get; set; }
        public string noverlo_3 { get; set; }
        public string noverlo_4 { get; set; }
        public string noverlo_5 { get; set; }
        public string noverlo_6 { get; set; }
        public string noverlo_7 { get; set; }
        public string noverlo_8 { get; set; }
        public string mamigos_1 { get; set; }
        public string mamigos_2 { get; set; }
        public string mamigos_3 { get; set; }
        public string mamigos_4 { get; set; }
        public string mamigos_5 { get; set; }
        public string mamigos_6 { get; set; }
        public string mamigos_7 { get; set; }
        public string mamigos_8 { get; set; }
        public IslaInstance(DataRow row)
        {
            this.id = (int)row["id"];
            this.modelo = (int)row["modelo"];
            this.uppert = (int)row["uppert"];
            this.nombre = (string)row["nombre"];
            this.descripcion = (string)row["descripcion"];
            this.Creador = UserManager.ObtenerUsuario((int)row["CreadorID"]);
            this.noverlo_1 = (string)row["noverlo_1"];
            this.noverlo_2 = (string)row["noverlo_2"];
            this.noverlo_3 = (string)row["noverlo_3"];
            this.noverlo_4 = (string)row["noverlo_4"];
            this.noverlo_5 = (string)row["noverlo_5"];
            this.noverlo_6 = (string)row["noverlo_6"];
            this.noverlo_7 = (string)row["noverlo_7"];
            this.noverlo_8 = (string)row["noverlo_8"];
            this.mamigos_1 = (string)row["mamigos_1"];
            this.mamigos_2 = (string)row["mamigos_2"];
            this.mamigos_3 = (string)row["mamigos_3"];
            this.mamigos_4 = (string)row["mamigos_4"];
            this.mamigos_5 = (string)row["mamigos_5"];
            this.mamigos_6 = (string)row["mamigos_6"];
            this.mamigos_7 = (string)row["mamigos_7"];
            this.mamigos_8 = (string)row["mamigos_8"];
        }
    }
}
