using System;
using System.Collections.Generic;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace BoomBang.game.instances
{
    public class UsuarioEnObjeto
    {
        public BuyObjectInstance Item;
        public SessionInstance Session;
        public int Posicion;
        public Point Desplazable;
        public UsuarioEnObjeto(BuyObjectInstance Item, SessionInstance Session, int Pos)
        {
            this.Item = Item;
            this.Session = Session;
            this.Posicion = Pos;
            this.Desplazable = new Point(Item.posX, Item.posY);
        }
    }
}
