using BoomBang.game.manager;
using BoomBang.server;
using System;
using System.Collections.Generic;
using System.IO;
using System.Linq;
using System.Net;
using System.Net.Sockets;
using System.Reflection;
using System.Text;
using System.Threading.Tasks;

namespace BoomBang
{
    class Program
    {
        public static string estado = "Premier";//GitHub
        public static string vercion = "v4.0.00";
        private static bool control_panel = false;
        public static bool threads_especiales = true;
        public static bool ver_conexion_usuarios = true;
        public static readonly Encoding Encoding = Encoding.GetEncoding("iso-8859-1");
        public static int puerto_server = 2002;
        static TcpListener server = new TcpListener(IPAddress.Any, puerto_server);
        public static void UpdateTitle()
        {
            Console.Title = $"Emulador Enterprise Edition {estado} | Online: " + UserManager.UsuariosOnline.Count;
        }
        static void Main(string[] args)
        {
            try
            {
                UpdateTitle();
                Output.WriteLine($"Emulador Enterprise Edition {vercion}");
                SessionManager.Initialize(server);
                HandlerManager.Initialize();
                SalasManager.Initialize();
                Output.WriteLine("Visualizar la conexión de usuarios: " + (ver_conexion_usuarios == true ? "true" : "false"));
                Output.WriteLine("Servidor iniciado correctamente!");
                Output.WriteLine("_________________________________________________");
                ServerThreads.Initialize();
                Console.Beep();
                if (control_panel == true)
                {
                    panel_control form = new panel_control();
                    form.ShowDialog();
                }
            }
            catch(Exception ex)
            {
                Output.WriteLine(ex.ToString());Program.EditorialResponse(ex);
                Console.ReadKey();
            }
        }
        public static void EditorialResponse(Exception ex)
        {
            string path = Path.Combine(Path.GetDirectoryName(Assembly.GetExecutingAssembly().Location), @"Errores\RegistroEmulador.txt");
            using (StreamWriter writer = new StreamWriter(path, true))
            {
                writer.WriteLine("-----------------------------------------------------------------------------");
                writer.WriteLine("Date : " + DateTime.Now.ToString());
                writer.WriteLine();

                writer.WriteLine(ex.GetType().FullName);
                writer.WriteLine("Message : " + ex.Message);
                writer.WriteLine("StackTrace : " + ex.StackTrace);
                ex = ex.InnerException;
            }
        }
    }
}
