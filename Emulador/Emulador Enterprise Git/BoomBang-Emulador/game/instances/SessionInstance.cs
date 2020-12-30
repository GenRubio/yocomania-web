using BoomBang.game.instances.manager.pathfinding;
using BoomBang.game.manager;
using BoomBang.server;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Net.Sockets;
using System.Text;
using System.Threading;
using System.Threading.Tasks;

namespace BoomBang.game.instances
{
    public class SessionInstance
    {
        public bool verificandoCuenta = true;
        public bool ping;
        public double LastPingTime = 0;
        public Socket Client { get; set; }
        private byte[] buffer = new byte[2048];
        public string IP { get { return Client.RemoteEndPoint.ToString().Split(':')[0]; } }
        private bool Policy = false;
        public UserInstance User;
        public SessionInstance(Socket Client)
        {
            this.Client = Client;
            this.ping = false;
            this.EsperarDatos();
        }
        
        private void EsperarDatos()
        {
            try
            {
                if (this.Client.Connected)
                {
                    Client.BeginReceive(buffer, 0, buffer.Length, SocketFlags.None, ProcesarDatos, null);
                }
            }
            catch (Exception)
            {
                this.FinalizarConexion("Datos");
            }
        }
        private void ProcesarDatos(IAsyncResult Result)
        {
            try
            {
                int Length = this.Client.EndReceive(Result);
                if (Length == 0 && Length > buffer.Length)
                {
                    this.FinalizarConexion("ProcesarDatos");
                    return;
                }
                char[] chars = new char[Length];
                Program.Encoding.GetChars(buffer, 0, Length, chars, 0);
                string Information = new String(chars);
                if (Information.StartsWith("<policy-file-request/>"))
                {
                    if (this.Policy)
                    {
                        this.FinalizarConexion("ProcesarDatos");
                        return;
                    }
                    this.Policy = true;
                    Client.Send(Program.Encoding.GetBytes("<?xml version=\"1.0\"?>\r\n<!DOCTYPE cross-domain-policy SYSTEM \"/xml/dtds/cross-domain-policy.dtd\">\r\n<cross-domain-policy>\r\n<allow-access-from domain=\"*\" to-ports=\"" + Program.puerto_server + "\" />\r\n</cross-domain-policy>\0"));
                }
                else
                {
                    if (Information[0] != Convert.ToChar(177)) 
                    { 
                        this.FinalizarConexion("ProcesarDatos");
                        return;
                    }
                    string[] Datas = Information.Split(Convert.ToChar(177));
                    for (int i = 1; i < Datas.Length; i++)
                    {
                        new InvokerManager(this, Convert.ToChar(177) + Datas[i]);
                    }
                }
                this.EsperarDatos();
            }
            catch
            {
                this.FinalizarConexion("ProcesarDatos");
            }
        }
        private byte[] Encriptar(byte[] buffer)
        {
            return buffer;
        }
        private byte[] Desencriptar(byte[] buffer)
        {
            return buffer;
        }
        public void SendDataProtected(ServerMessage server)
        {
            try
            {
                if (this.Client.Connected)
                {
                    this.Client.Send(server.GetMessage());
                }
            }
            catch
            {
                this.FinalizarConexion("SendData");
            }
        }
        public void SendData(ServerMessage server)
        {
            try
            {
                if (this.Client.Connected)
                {
                    this.User.sendDataUser++;
                    this.Client.Send(server.GetMessage());  
                }
            }
            catch
            {
                this.FinalizarConexion("SendData");
            }
        }
        public void FinalizarConexion(string error)
        {
            if (this.Client.Connected)
            {
                this.Client.Shutdown(SocketShutdown.Both);
                this.Client.Disconnect(true);
            }
            if (this.User != null)
            {
                updateOnlineUser(this.User);
                UserManager.CerrarSesion(this, error);
            }
        }
        private  void updateOnlineUser(UserInstance User)
        {
            mysql client = new mysql();
            client.SetParameter("user", User.nombre);
            client.ExecuteNonQuery("UPDATE usuarios SET Online = 0 WHERE nombre = @user");
        }
        public bool ValidarEntrada(string texto, bool Register)
        {
            if (Register)
            {
                string[] Permitidos = { "q", "w", "e", "r", "t", "y", "u", "i", "o", "p", "a", "s", "d", "f", "g", "h", "j", "k", "l", "ñ", "z", "x", "c", "v", "b", "n", "m", ",", ".", "-", "Q", "W", "E", "R", "T", "Y", "U", "I", "O", "P", "A", "S", "D", "F", "G", "H", "J", "K", "L", "Z", "X", "C", "V", "B", "N", "M", "@", "!", "=", ":", ".", ",", "0", "1", "2", "3", "4", "5", "6", "7", "8", "9" };
                string[] Letras = { "q", "w", "e", "r", "t", "y", "u", "i", "o", "p", "a", "s", "d", "f", "g", "h", "j", "k", "l", "ñ", "z", "x", "c", "v", "b", "n", "m", "Q", "W", "E", "R", "T", "Y", "U", "I", "O", "P", "A", "S", "D", "F", "G", "H", "J", "K", "L", "Z", "X", "C", "V", "B", "N", "M" };
                string[] Numeros = { "0", "1", "2", "3", "4", "5", "6", "7", "8", "9" };
                string[] Caracteres = { "@", "!", "=", ":", ".", "," };
                int TotalCount = texto.Length;
                int Letras_Totales = 0;
                for (int id = 0; id < texto.Length; id++)
                {
                    if (Letras.Contains(texto[id].ToString()))
                    {
                        Letras_Totales++;
                        if (Letras_Totales > 11) { return false; }
                    }
                    if (!Permitidos.Contains(texto[id].ToString()))
                    {
                        return false;
                    }
                }
            }
            else
            {
                string[] Permitidos = { "q", "w", "e", "r", "t", "y", "u", "i", "o", "p", "a", "s", "d", "f", "g", "h", "j", "k", "l", "ñ", "z", "x", "c", "v", "b", "n", "m", ",", ".", "-", "_", "á", "é", "í", "ó", "ú", "Á", "É", "Í", "Ó", "Ú", "Q", "W", "E", "R", "T", "Y", "U", "I", "O", "P", "A", "S", "D", "F", "G", "H", "J", "K", "L", "Ñ", "Z", "X", "C", "V", "B", "N", "M", "{", "}", "[", "]", "@", "/", "-", "+", " ", "*", "'", "!", "#", "$", "%", "&", "(", ")", "=", "?", "¿", "¡", ":", ";", "<", ">", "0", "1", "2", "3", "4", "5", "6", "7", "8", "9" };
                int TotalCount = texto.Length;
                for (int id = 0; id < texto.Length; id++)
                {
                    if (!Permitidos.Contains(texto[id].ToString()))
                    {
                        return false;
                    }
                }
            }
            return true;
        }
    }
    public class ServerMessage
    {
        private readonly Encoding Encoding = Encoding.GetEncoding("iso-8859-1");
        private List<byte> Head;
        private List<object[]> Parameters;
        public ServerMessage()
        {
            this.Head = new List<byte>();
            this.Parameters = new List<object[]>();
        }
        public void AddHead(byte data)
        {
            Head.Add(data);
        }
        public void AddHead(byte[] data)
        {
            foreach (byte buffer in data)
            {
                Head.Add(buffer);
            }
        }
        public void AppendParameter(object Parameter)
        {
            Parameters.Add(new object[] { Parameter });
        }
        public void AppendParameter(object[] ParameterGroup)
        {
            Parameters.Add(ParameterGroup);
        }
        public byte[] GetMessage()
        {
            List<byte> Message = new List<byte>();
            Message.Add(0xb1);
            foreach (byte ActualHeader in Head)
            {
                Message.Add(ActualHeader);
                Message.Add(0xb3);
            }
            Message.Add(0xb2);
            foreach (object[] ParameterGroup in Parameters)
            {
                if (ParameterGroup != null)
                {
                    foreach (object Parameter in ParameterGroup)
                    {
                        if (Parameter != null && Convert.ToString(Parameter) != "")
                        {
                            foreach (byte ParameterByte in Encoding.GetBytes(Parameter.ToString()))
                            {
                                Message.Add(ParameterByte);
                            }
                        }
                        Message.Add(0xb3);
                    }
                }
                else
                {
                    Message.Add(0xb3);
                }
                Message.Add(0xb2);
            }
            Message.Add(0xb0);
            return Message.ToArray(); ;
        }
    }
}
