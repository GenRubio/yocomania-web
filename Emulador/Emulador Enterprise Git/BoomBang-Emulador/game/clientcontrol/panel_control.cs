using BoomBang.game.instances;
using BoomBang.game.manager;
using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace BoomBang.server
{
    public partial class panel_control : Form
    {
        public panel_control()
        {
            InitializeComponent();
        }
        private void panel_control_Load(object sender, EventArgs e)
        {
            Text = "Control Panel " + Program.vercion;
        }
        SessionInstance Session;
        private static string console_packets = "";
        private void button5_Click(object sender, EventArgs e)
        {
            mysql client = new mysql();
            DataRow usuario = client.ExecuteQueryRow("SELECT * FROM usuarios WHERE nombre = '" + textBox5.Text + "'");
            if (usuario != null)
            {
                Session = UserManager.ObtenerSession((int)usuario["id"]);
                console_packets = console_packets + "[Session] > Session encontrada id = " + Session.User.id + Environment.NewLine;
                richTextBox2.Text = console_packets;
                groupBox2.Enabled = true;
                return;
            }
            console_packets = console_packets + "[Session] > Error: Session no encontrada." + Environment.NewLine;
            richTextBox2.Text = console_packets;
        }

        private void button2_Click(object sender, EventArgs e)
        {
            string texto = "";
            label23.Text = textBox6.Text;
            label25.Text = textBox7.Text;
            label27.Text = textBox8.Text;
            if (Convert.ToInt32(textBox6.Text) == 0) { texto = "Error: ID no puede ser nula"; }
            else
            {
                if (Convert.ToInt32(textBox8.Text) < 0 && Convert.ToInt32(textBox7.Text) < 0)
                {
                    ServerMessage server = new ServerMessage();
                    server.AddHead(Convert.ToByte(textBox6.Text));
                    if (textBox9.Text.Contains(",")) { textBox9.Text = textBox9.Text.Replace(",", "³²"); }
                    if (textBox9.Text.Contains(".")) { textBox9.Text = textBox9.Text.Replace(".", "³"); }
                    server.AppendParameter(textBox9.Text);
                    Session.SendData(server);
                    texto = "[" + textBox6.Text + "] > " + textBox9.Text;
                }
                else if (Convert.ToInt32(textBox7.Text) > 0 && Convert.ToInt32(textBox8.Text) < 0)
                {
                    ServerMessage server = new ServerMessage();
                    server.AddHead(Convert.ToByte(textBox6.Text));
                    server.AddHead(Convert.ToByte(textBox7.Text));
                    if (textBox9.Text.Contains(",")) { textBox9.Text = textBox9.Text.Replace(",", "³²"); }
                    if (textBox9.Text.Contains(".")) { textBox9.Text = textBox9.Text.Replace(".", "³"); }
                    server.AppendParameter(textBox9.Text);
                    Session.SendData(server);
                    texto = "[" + textBox6.Text + "/" + textBox7.Text + "] > " + textBox9.Text;
                }
                else
                {
                    ServerMessage server = new ServerMessage();
                    server.AddHead(Convert.ToByte(textBox6.Text));
                    server.AddHead(Convert.ToByte(textBox7.Text));
                    server.AddHead(Convert.ToByte(textBox8.Text));
                    if (textBox9.Text.Contains(",")) { textBox9.Text = textBox9.Text.Replace(",", "³²"); }
                    if (textBox9.Text.Contains(".")) { textBox9.Text = textBox9.Text.Replace(".", "³"); }
                    server.AppendParameter(textBox9.Text);
                    Session.SendData(server);
                    texto = "[" + textBox6.Text + "/" + textBox7.Text + "/"+ textBox8.Text +"] > " + textBox9.Text;
                }
            }
            console_packets = console_packets + texto + Environment.NewLine;
            richTextBox2.Text = console_packets;
        }
        private static List<int> ID = new List<int>();
        private static List<int> TYPE = new List<int>();

        private void button6_Click(object sender, EventArgs e)
        {
            console_packets = "";
            console_packets = console_packets + "[Packet_Manager] > Clear console" + Environment.NewLine;
            richTextBox2.Text = console_packets;
        }

        private void button7_Click(object sender, EventArgs e)
        {
            richTextBox2.Enabled = true;
        }

        private void button3_Click(object sender, EventArgs e)
        {
            if (Convert.ToInt32(textBox10.Text) > 0)
            {
                ID.Add(Convert.ToInt32(textBox10.Text));
                console_packets = console_packets + "[Packet_Manager] > ID añadida " + Convert.ToInt32(textBox10.Text) + Environment.NewLine;
                richTextBox2.Text = console_packets;
            }
            else
            {
                TYPE.Add(Convert.ToInt32(textBox11.Text));
                console_packets = console_packets + "[Packet_Manager] > TYPE añadida " + Convert.ToInt32(textBox11.Text) + Environment.NewLine;
                richTextBox2.Text = console_packets;
            }
        }
        private static bool timer = false;
        public static List<int> id_malas = new List<int>() { 150,153,163,173,174,185, 170, 183 };
        private void button4_Click(object sender, EventArgs e)
        {
            timer1.Interval = Convert.ToInt32(numericUpDown1.Value);
            if (timer == false) { timer = true; timer1.Start(); button4.Text = "Stop"; }
            else { timer = false; timer1.Stop(); button4.Text = "Start"; }
        }

        private void timer1_Tick(object sender, EventArgs e)
        {
            if (Convert.ToInt32(textBox7.Text) < 0 && Convert.ToInt32(textBox8.Text) < 0)
            {
                if (!ID.Contains(Convert.ToInt32(label23.Text)) && !id_malas.Contains(Convert.ToInt32(label23.Text)))
                {
                    ServerMessage server = new ServerMessage();
                    server.AddHead(Convert.ToByte(label23.Text));
                    if (textBox9.Text.Contains(",")) { textBox9.Text = textBox9.Text.Replace(",", "³²"); }
                    if (textBox9.Text.Contains(".")) { textBox9.Text = textBox9.Text.Replace(".", "³"); }
                    server.AppendParameter(textBox9.Text);
                    Session.SendData(server);                
                }
                int numero_lab = Convert.ToInt32(label23.Text);
                numero_lab++;
                label23.Text = Convert.ToString(numero_lab);
                if (numero_lab == 245) { textBox7.Text = "1"; label25.Text = "1"; label23.Text = "1"; }
            }
            else if (Convert.ToInt32(textBox7.Text) > 0 && Convert.ToInt32(textBox8.Text) < 0)
            {
                if (!ID.Contains(Convert.ToInt32(label23.Text)) && !TYPE.Contains(Convert.ToInt32(label25.Text)) && !id_malas.Contains(Convert.ToInt32(label23.Text)))
                {
                    ServerMessage server = new ServerMessage();
                    server.AddHead(Convert.ToByte(label23.Text));
                    server.AddHead(Convert.ToByte(label25.Text));
                    if (textBox9.Text.Contains(",")) { textBox9.Text = textBox9.Text.Replace(",", "³²"); }
                    if (textBox9.Text.Contains(".")) { textBox9.Text = textBox9.Text.Replace(".", "³"); }
                    server.AppendParameter(textBox9.Text);
                    Session.SendData(server);
                }
                if (Convert.ToInt32(label23.Text) < 245)
                {
                    int numero_lab = Convert.ToInt32(label23.Text) + 1;
                    label23.Text = Convert.ToString(numero_lab);
                }
                else
                {
                    label23.Text = "1";
                    int numero_lab = Convert.ToInt32(label25.Text) + 1;
                    label25.Text = Convert.ToString(label25);
                }
            }
        }
    }
}
