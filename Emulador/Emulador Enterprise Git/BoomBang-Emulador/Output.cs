using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace BoomBang
{
    class Output
    {
        public static void WriteLine(string texto)
        {
            Console.WriteLine(DateTime.Now.ToString("HH:mm:ss") + " -> " + texto);
        }
    }
}
