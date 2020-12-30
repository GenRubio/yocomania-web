using BoomBang.game.instances;
using BoomBang.game.manager;
using BoomBang.game.packets;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace BoomBang.game.handler
{
    class IntercambiosHandler
    {
        public static void Start()
        {
            HandlerManager.RegisterHandler(148130, new ProcessHandler(Cambios));
            HandlerManager.RegisterHandler(199120, new ProcessHandler(PrepararCanjeos));
            HandlerManager.RegisterHandler(199124, new ProcessHandler(CancelarCanjeos));
            HandlerManager.RegisterHandler(199121, new ProcessHandler(PonerObjetos));
            HandlerManager.RegisterHandler(199122, new ProcessHandler(AceptarCambios));
            HandlerManager.RegisterHandler(199123, new ProcessHandler(CambiarObjetos));
        }
        static void CambiarObjetos(SessionInstance Session, string[,] Parameters)
        {
            int id = int.Parse(Parameters[0, 0]);
            int user_1 = int.Parse(Parameters[1, 0]);
            int user_2 = int.Parse(Parameters[2, 0]);
            SessionInstance Session_1 = UserManager.ObtenerSession(user_1);
            SessionInstance Session_2 = UserManager.ObtenerSession(user_2);
            if (Session_1 != null && Session_2 != null)
            {
                if (Session_1.User != null && Session_2.User != null)
                {
                    if (Session_1.User.Intercambio != null && Session_2.User.Intercambio != null)
                    {
                        IntercambioInstance Intercambio = IntercambiosManager.ObtenerIntercambio(id);
                        if (Intercambio != null)
                        {
                            if (IntercambiosManager.ValidarAccion(Intercambio.ID, Session_1, Session_2))
                            {
                                Intercambio.CambiarObjetos(Session);
                            }
                        }
                    }
                }
            }
        }
        static void AceptarCambios(SessionInstance Session, string[,] Parameters)
        {
            int id = int.Parse(Parameters[0, 0]);
            int user_1 = int.Parse(Parameters[1, 0]);
            int user_2 = int.Parse(Parameters[2, 0]);
            SessionInstance Session_1 = UserManager.ObtenerSession(user_1);
            SessionInstance Session_2 = UserManager.ObtenerSession(user_2);
            if (Session_1 != null && Session_2 != null)
            {
                if (Session_1.User != null && Session_2.User != null)
                {
                    if (Session_1.User.Intercambio != null && Session_2.User.Intercambio != null)
                    {
                        IntercambioInstance Intercambio = IntercambiosManager.ObtenerIntercambio(id);
                        if (Intercambio != null)
                        {
                            if (IntercambiosManager.ValidarAccion(Intercambio.ID, Session_1, Session_2))
                            {
                                Intercambio.AceptarCambios(Session);
                            }
                        }
                    }
                }
            }
        }
        static void PonerObjetos(SessionInstance Session, string[,] Parameters)
        {
            int id = int.Parse(Parameters[0, 0]);
            int compra_id = int.Parse(Parameters[1, 0]);
            int objetoID = int.Parse(Parameters[2, 0]);
            IntercambioInstance Intercambio = IntercambiosManager.ObtenerIntercambio(id);
            if (Intercambio != null)
            {
                //if (CatalogoManager.ObtenerCatalogo(objetoID) == null) return;
                // 199121-> ±Ç³y³²1³²-1³²3103³²2³²°   Pocion
                //±Ç³y³²1³²13619³²1885³²1³²° Objeto
                BuyObjectInstance Compra = CatalogoManager.ObtenerCompra(compra_id);
                if (Compra != null)
                {
                    if (Compra.usuario_id != Session.User.id) return;
                    if (Compra.sala_id != 0) return;
                    Intercambio.PonerObjeto(Session, Compra);
                }
            }
        }
        static void CancelarCanjeos(SessionInstance Session, string[,] Parameters)
        {
            int id = int.Parse(Parameters[0, 0]);
            int user_1 = int.Parse(Parameters[1, 0]);
            int user_2 = int.Parse(Parameters[2, 0]);
            SessionInstance Session_1 = UserManager.ObtenerSession(user_1);
            SessionInstance Session_2 = UserManager.ObtenerSession(user_2);
            if (Session_1 != null && Session_2 != null)
            {
                if (Session_1.User != null && Session_2.User != null)
                {
                    if (Session_1.User.Intercambio != null && Session_2.User.Intercambio != null)
                    {
                        IntercambiosManager.TerminarIntercambio(id, Session_1, Session_2);
                    }
                }
            }
        }
        static void PrepararCanjeos(SessionInstance Session, string[,] Parameters)
        {
            int user_1 = int.Parse(Parameters[0, 0]);
            int user_2 = int.Parse(Parameters[1, 0]);
            SessionInstance Session_1 = UserManager.ObtenerSession(user_1);
            SessionInstance Session_2 = UserManager.ObtenerSession(user_2);
            if (Session_1 != null && Session_2 != null)
            {
                if (Session_1.User != null && Session_2.User != null)
                {
                    if (Session_1.User.Intercambio == null && Session_2.User.Intercambio == null && Session_1.User.Cambios == 1 && Session_2.User.Cambios == 1)
                    {
                        IntercambiosManager.IniciarIntercambio(Session_1, Session_2);
                    }
                }
            }
        }
        static void Cambios(SessionInstance Session, string[,] Parameters)
        {
            if (Session.User.Sala != null)
            {
                int Estado = int.Parse(Parameters[0, 0]);
                string Security = Parameters[1, 0];
                if (Estado == 1)
                {
                    if (Session.User.security != Security)
                    {
                        return;
                    }
                }
                Session.User.Cambios = Estado;
                Packet_148_130(Session, Estado);
            }
        }
        private static void Packet_148_130(SessionInstance Session, int Estado)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(148);
            server.AddHead(130);
            server.AppendParameter(Session.User.id);
            server.AppendParameter(Estado);
            Session.User.Sala.SendData(server, Session);
        }
    }
}
