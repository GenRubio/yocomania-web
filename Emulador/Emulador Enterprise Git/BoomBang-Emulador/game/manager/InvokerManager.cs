using BoomBang.game.instances;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Text.RegularExpressions;
using System.Threading.Tasks;

namespace BoomBang.game.manager
{
    public class InvokerManager
    {
        public InvokerManager(SessionInstance Session, string Packet)
        {
            try
            {
                int head = 0;
                List<int> Header = new List<int>();
                foreach (string ActualHeader in Regex.Split(Regex.Split(Packet.Substring(1), "³²")[0], "³"))
                {
                    if (ActualHeader.Length == 1)
                    {
                        Header.Add(Convert.ToByte(Convert.ToChar(ActualHeader)));
                    }
                    else
                    {
                        Header.Add(0);
                    }
                }
                int SubParametersLength = 0;
                string[,] Parameters = null;
                for (int Pointer1 = 1; Pointer1 < Packet.Split('²').Length; Pointer1++)
                {
                    for (int Pointer2 = 0; Pointer2 < Packet.Split('²')[Pointer1].Split('³').Length - 1; Pointer2++)
                    {
                        if (Packet.Split('²')[Pointer1].Split('³').Length > SubParametersLength)
                        {
                            SubParametersLength = Packet.Split('²')[Pointer1].Split('³').Length;
                        }
                    }
                }
                Parameters = new string[Packet.Split('²').Length, SubParametersLength];
                for (int Pointer1 = 1; Pointer1 < Packet.Split('²').Length; Pointer1++)
                {
                    for (int Pointer2 = 0; Pointer2 < Packet.Split('²')[Pointer1].Split('³').Length - 1; Pointer2++)
                    {
                        Parameters[Pointer1 - 1, Pointer2] = Packet.Split('²')[Pointer1].Split('³')[Pointer2];
                    }
                }
                string num = "";
                foreach (int ActualHeader in Header)
                {
                    num += ActualHeader;
                }
                head = Convert.ToInt32(num);
                if (HandlerManager.Handlers.ContainsKey(head))
                {
                    HandlerManager.Handlers[head](Session, Parameters);
                    return;
                }
                Output.WriteLine("[InvokerManager][Falta] -> " + head + " -> " + Packet);
            }
            catch (Exception ex)
            {
                Output.WriteLine(ex.ToString());Program.EditorialResponse(ex);
                Session.FinalizarConexion("InvokerManager");
                return;
            }
        }
    }
}
