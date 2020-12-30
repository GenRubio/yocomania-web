using BoomBang.game.instances;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Net.Sockets;
using System.Text;
using System.Threading.Tasks;

namespace BoomBang.game.manager
{
    public class SessionManager
    {
        public static TcpListener Servidor;
        public static void Initialize(TcpListener Madre)
        {
            SessionManager.Servidor = Madre;
            SessionManager.Servidor.Start();
            SessionManager.EsperarConexiones();
            Output.WriteLine("Se ha establecido la conexión con el puerto " + Madre.Server.LocalEndPoint.ToString().Split(':')[1]);
        }
        public static void EsperarConexiones()
        {
            Servidor.BeginAcceptSocket(ProcesarConexion, null);
        }
        private static void ProcesarConexion(IAsyncResult result)
        {
            new SessionInstance(SessionManager.Servidor.EndAcceptSocket(result));
            SessionManager.EsperarConexiones();
        }
    }
}
