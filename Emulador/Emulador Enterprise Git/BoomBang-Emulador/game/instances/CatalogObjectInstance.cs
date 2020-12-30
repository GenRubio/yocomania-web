using System;
using System.Collections.Generic;
using System.Data;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace BoomBang.game.instances
{
    public class CatalogObjectInstance
    {
        public int id;
        public string titulo;
        public string swf;
        public string descripcion;
        public int precio_oro;
        public int precio_plata;
        public string categoria;
        public string colores_hex;
        public string colores_rgb;
        public string parte_1;
        public string parte_2;
        public string parte_3;
        public string parte_4;
        public string tam_n;
        public string espacio_ocupado_n;
        public string tam_g;
        public string tam_p;
        public int vip;
        public int espacio_mapabytes;
        public int visible;
        public int tipo_rare;
        public int intercambiable;
        public string arrastrable;
        public string salas_usables;
        public int rotacion;
        public int tipo_arrastre;
        public string default_data;
        public int something_4;
        public int something_5;
        public int something_6;
        public int limitado;
        public int oro_descuento;
        public CatalogObjectInstance(DataRow row)
        {
            this.id = (int)row["id"];
            this.titulo = (string)row["titulo"];
            this.swf = (string)row["swf"];
            this.descripcion = (string)row["descripcion"];
            this.precio_oro = (int)row["precio_oro"];
            this.precio_plata = (int)row["precio_plata"];
            this.categoria = (string)row["categoria"];
            this.colores_hex = (string)row["colores_hex"];
            this.colores_rgb = (string)row["colores_rgb"];
            this.parte_1 = (string)row["parte_1"];
            this.parte_2 = (string)row["parte_2"];
            this.parte_3 = (string)row["parte_3"];
            this.parte_4 = (string)row["parte_4"];
            this.tam_n = (string)row["tam_n"];
            this.espacio_ocupado_n = (string)row["espacio_2_0"];///espacio_ocupado_n
            this.tam_g = (string)row["tam_g"];
            this.tam_p = (string)row["tam_p"];
            this.vip = (int)row["vip"];
            this.espacio_mapabytes = (int)row["espacio_mapabytes"];
            this.visible = (int)row["visible"];
            this.tipo_rare = (int)row["tipo_rare"];
            this.arrastrable = (string)row["arrastrable"];
            this.intercambiable = (int)row["intercambiable"];
            this.salas_usables = (string)row["salas_usables"];
            this.rotacion = (int)row["rotacion"];
            this.tipo_arrastre = (int)row["tipo_arrastre"];
            this.default_data = (string)row["default_data"];
            this.something_4 = (int)row["something_4"];
            this.something_5 = (int)row["something_5"];
            this.something_6 = (int)row["something_6"];
            this.limitado = (int)row["limitado"];
            this.oro_descuento = (int)row["oro_descuento"];
        }
    }
}
