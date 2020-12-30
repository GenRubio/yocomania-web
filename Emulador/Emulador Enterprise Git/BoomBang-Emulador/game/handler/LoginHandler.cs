using BoomBang.game.instances;
using BoomBang.game.manager;
using BoomBang.game.packets;
using BoomBang.server;
using System;
using System.Collections.Generic;
using System.Data;
using System.Linq;
using System.Net.Mail;
using System.Text;
using System.Threading;
using System.Threading.Tasks;

namespace BoomBang.game.handler
{
    class LoginHandler
    {
        public static void Start()
        {
            HandlerManager.RegisterHandler(120145120, Facebook);
            HandlerManager.RegisterHandler(120130, iniciar_sesion);
        }
        private static void iniciar_sesion(SessionInstance Session, string[,] Parameters)
        {
            new Thread(() => stratAntiScriptSession(Session)).Start();
            string userName = Parameters[0, 0];
            string passwordUser = Parameters[1, 0];
            if (userName != "" && passwordUser != "")
            {
                UserManager.IniciarSesion(Session, userName, passwordUser);
            }
            else
            {
                Output.WriteLine("Error al iniciar cliente " + Session.IP);
            }
        }
        private static void stratAntiScriptSession(SessionInstance Session)
        {
            int timer = 10;
            while (timer > 0)
            {
                if (Session.User != null)
                {
                    timer -= 1;
                }    
                Thread.Sleep(1000);
            }
            Session.User.sendDataUser = 0;
            Session.User.startAntiScript = true;
        }
       
        static void Facebook(SessionInstance Session, string[,] Parameters)
        {

        }
    }
}
