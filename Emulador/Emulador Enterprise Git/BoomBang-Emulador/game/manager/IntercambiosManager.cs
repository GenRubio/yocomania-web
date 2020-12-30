using BoomBang.game.instances;
using System;
using System.Collections.Concurrent;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace BoomBang.game.manager
{
    class IntercambiosManager
    {
        private static int TotalCanjeos = 0;
        public static ConcurrentDictionary<int, IntercambioInstance> IntercambiosEnCurso = new ConcurrentDictionary<int, IntercambioInstance>();
        public static void IniciarIntercambio(SessionInstance Session_1, SessionInstance Session_2)
        {
            TotalCanjeos++;
            IntercambioInstance Inter = new IntercambioInstance(TotalCanjeos, Session_1, Session_2);
            Session_1.User.Intercambio = Inter;
            Session_2.User.Intercambio = Inter;
            IntercambiosEnCurso.TryAdd(TotalCanjeos, Inter);
        }
        public static void TerminarIntercambio(int IntercambioID, SessionInstance Session_1, SessionInstance Session_2)
        {
            if (ValidarAccion(IntercambioID, Session_1, Session_2))
            {
                if (IntercambiosEnCurso.ContainsKey(IntercambioID))
                {
                    IntercambioInstance Intercambo_A_Remover = ObtenerIntercambio(IntercambioID);
                    if (Intercambo_A_Remover.Session_1.User.id == Session_1.User.id && Intercambo_A_Remover.Session_2.User.id == Session_2.User.id || Intercambo_A_Remover.Session_1.User.id == Session_2.User.id && Intercambo_A_Remover.Session_2.User.id == Session_1.User.id)
                    {
                        Intercambo_A_Remover.TerminarCanjeo();
                        IntercambiosEnCurso.TryRemove(Intercambo_A_Remover.ID, out Intercambo_A_Remover);
                    }
                }
            }
        }
        public static IntercambioInstance ObtenerIntercambio(int Key)
        {
            if (IntercambiosEnCurso.ContainsKey(Key))
            {
                return IntercambiosEnCurso[Key];
            }
            return null;
        }
        public static bool ValidarAccion(int IntercambioID, SessionInstance Session_1, SessionInstance Session_2)
        {
            if (IntercambiosEnCurso.ContainsKey(IntercambioID))
            {
                IntercambioInstance Intercambio = IntercambiosEnCurso[IntercambioID];
                if (Intercambio.Session_1.User.id == Session_1.User.id && Intercambio.Session_2.User.id == Session_2.User.id || Intercambio.Session_1.User.id == Session_2.User.id && Intercambio.Session_2.User.id == Session_1.User.id)
                {
                    return true;
                }
            }
            return false;
        }
    }
}
