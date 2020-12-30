using BoomBang.game.manager;
using BoomBang.server;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace BoomBang.game.instances.manager.pathfinding
{
    class BaneoManager
    {
        public static void Banear_Usuario_Autoclick_Manager(int Usuario_ID, bool Auto)
        {
            string mensaje = "";
            if (Auto == true) { mensaje = "El uso de Autoclick esta prohibido en BoomBang. Podras volver a conectarte en 1 hora. Créditos: -100 de oro"; }
            if (Auto == false) { mensaje = "El uso de Programas esta prohibido en BoomBang. Podras volver a conectarte en 1 hora. Créditos: -100 de oro"; }
            foreach (SessionInstance Session in UserManager.UsuariosOnline.Values)
            {
                SessionInstance OtherSession = UserManager.ObtenerSession(Usuario_ID);
                if (OtherSession.User.Sala != null)
                {
                    OtherSession.User.baneo = Time.GetCurrentAndAdd(AddType.Horas, 1);
                    using (mysql client = new mysql())
                    {
                        client.ExecuteNonQuery("UPDATE usuarios SET baneo = '" + OtherSession.User.baneo + "' WHERE id = '" + OtherSession.User.id + "'");
                    }
                    ServerMessage ban = new ServerMessage();
                    ban.AddHead(185);
                    ban.AddHead(0);
                    ban.AppendParameter(mensaje);
                    OtherSession.SendData(ban);
                    OtherSession.User.Contar_Auto = 0;
                    UserManager.Creditos(OtherSession.User, true, false, 100);
                    OtherSession.User.contador_baneo++;
                    UserManager.ActualizarEstadisticas(OtherSession.User);
                    SalasManager.Salir_Sala(OtherSession);
                    UserManager.Desactivar_Usuario(OtherSession);
                }
            }
        }
    }
}
