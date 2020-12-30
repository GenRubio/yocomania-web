using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;

namespace BoomBang
{
    public class Posicion
    {
        public int x, y, z;
        public Posicion(int x, int y, int z = 4)
        {
            this.x = x;
            this.y = y;
            this.z = z;
        }
    }
}
