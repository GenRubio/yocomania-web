using BoomBang.game.manager;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace BoomBang.game.instances
{
    public class ObjetoLanzadoInstance
    {
        public int key { get; set; }
        public ItemConcursoInstance Item { get; set; }
        public Posicion Pos { get; set; }
        public SalaInstance Sala { get; set; }
        public double tiempo;
        public double tiempo_desaparicion = Time.GetCurrentAndAdd(AddType.Segundos, 15);
        public ObjetoLanzadoInstance(int key, ItemConcursoInstance Item, Posicion Pos, SalaInstance Sala)
        {
            this.key = key;
            this.Item = Item;
            this.Pos = Pos;
            this.Sala = Sala;
            this.LanzarObjeto();
        }
        public static List<int> Objetos_Pisando = new List<int>()
        {
            5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21
        };
        public static List<int> Objetos_Cementerio = new List<int>()
        {
            7,8,9,10,11,12,13,14,15,16,17,18,19,20,21
        };
        public static List<int> Objetos_BosqueNevada = new List<int>()
        {
            22,23
        };
        public static List<int> Objetos_Madriguera = new List<int>()
        {
            24
        };
        private void LanzarObjeto()
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(200);
            server.AddHead(120);
            server.AppendParameter(this.key);
            server.AppendParameter(this.Item.id);
            server.AppendParameter(this.Pos.x);
            server.AppendParameter(this.Pos.y);
            server.AppendParameter(this.Item.modelo);
            server.AppendParameter(this.Item.tipo_caida);
            server.AppendParameter(this.Item.tipo_salida);//TipoApertura
            server.AppendParameter(this.Item.tiempo_aparicion);//TiempoAparicion
            this.Sala.SendData(server);
        }
    }
}
