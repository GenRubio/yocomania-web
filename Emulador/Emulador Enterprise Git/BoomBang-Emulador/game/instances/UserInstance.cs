using BoomBang.game.instances.manager.pathfinding;
using BoomBang.game.manager;
using System;
using System.Collections.Generic;
using System.Data;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace BoomBang.game.instances
{
    public class UserInstance
    {
        public int sendDataUser = 0;
        public bool startAntiScript = false;
        public int avisosScript = 0;
        public int id { get; private set; }
        public string nombre { get; set; }
        public string nombre_halloween { get; set; }
        public string password { get; set; }
        public string security { get; set; }
        public int avatar { get; set; }
        public int avatar_anterior { get; set; }
        public string colores { get; set; }
        public string colores_old = "";
        public string email { get; set; }
        public int edad { get; set; }
        public string ip_registro { get; set; }
        public string ip_actual { get; set; }
        string mfecha_registro;
        public string fecha_registro { get { return mfecha_registro; } }
        public int oro { get; set; }
        public int plata { get; set; }
        public int admin { get; set; }
        public double vip_double { get; set; }
        public string end_vip { get; set; }
        public string bocadillo { get; set; }
        public string hobby_1 { get; set; }
        public string hobby_2 { get; set; }
        public string hobby_3 { get; set; }
        public string deseo_1 { get; set; }
        public string deseo_2 { get; set; }
        public string deseo_3 { get; set; }
        int mVotos_Legal;
        public int Votos_Legal { get { return mVotos_Legal; } set { mVotos_Legal = value; } }
        int mVotos_Sexy;
        public int Votos_Sexy { get { return mVotos_Sexy; } set { mVotos_Sexy = value; } }
        int mVotos_Simpatico;
        public int Votos_Simpatico { get { return mVotos_Simpatico; } set { mVotos_Simpatico = value; } }
        int mVotosRestantes = 5;
        public int VotosRestantes { get { return mVotosRestantes; } set { mVotosRestantes = value; } }
        public int besos_enviados { get; set; }
        public int besos_recibidos { get; set; }
        public int jugos_enviados { get; set; }
        public int jugos_recibidos { get; set; }
        public int flores_enviadas { get; set; }
        public int flores_recibidas { get; set; }
        public int uppers_enviados { get; set; }
        public int uppers_recibidos { get; set; }
        public int cocos_enviados { get; set; }
        public int cocos_recibidos { get; set; }
        public int rings_ganados { get; set; }
        public int senderos_ganados { get; set; }
        public int puntos_cocos { get; set; }
        public int puntos_ninja { get; set; }
        public string ultima_conexion { get; set; }
        public double coins_remain_double { get; set; }
        /* SpaceParams */
        public int IDEspacial { get; set; }
        public SalaInstance Sala { get; set; }
        public Posicion Posicion { get; set; }

        public bool Caminando { get; set; }
        public int UppertSelect { get; set; }
        public int CocoSelect { get; set; }
        /*Pathfinder*/
        public Trayectoria Trayectoria { get; set; }
        public PathFinder PathFinder { get; set; }
        /* Ninja */
        public bool ModoNinja { get; set; }
        /* Traje */
        public bool ModoAvatar { get; set; }
        //Intercambios
        public int Cambios { get; set; }
        public IntercambioInstance Intercambio;
        //MiniGames
        public int mGame12ActualPoints { get; set; }
        public Inscripcion CaminoNinja { get; set; }
        public Inscripcion SenderoOculto { get; set; }
        public Inscripcion CocosLocos { get; set; }
        public GameType Game { get; set; }
        public bool Jugando = false;
        public int CocosRestantes = 0;
        //ObjectManager
        public ObjectEditor ObjectEditor { get; set; }

        public bool Concurso_Evento = false;
        int mTrajeID;
        public int TrajeID { get { return mTrajeID; } set { mTrajeID = value; } }

        int mtutorial_islas;
        public int tutorial_islas { get { return mtutorial_islas; } set { mtutorial_islas = value; } }

        //Regalos
        double mtimespam_regalo_peque;
        public double timespam_regalo_peque { get { return mtimespam_regalo_peque; } set { mtimespam_regalo_peque = value; } }
        //Regalos Grande
        double mtimespam_regalo_grande;
        public double timespam_regalo_grande { get { return mtimespam_regalo_grande; } set { mtimespam_regalo_grande = value; } }
        //Noticias 
        int mnovedades_noticias;
        public int novedades_noticias { get { return mnovedades_noticias; } set { mnovedades_noticias = value; } }
        //Pociones
        public int Efecto;
        public int EfectoAnterior;
        public int TiempoPocion;
        public int KekoAnteriorPocion;
        public int TimpoEspera_Fantasma_Espectro = 0;
        //Cambios
        double mtimespam_desc_cambios;
        public double timespam_desc_cambios { get { return mtimespam_desc_cambios; } set { mtimespam_desc_cambios = value; } }

        //Validar Email
        public int ValidarEmail;

        //Chat Publico
        public int Color_Chat = 1;

        //Tiempo conexion Usuario
        public int AFKManager = 3600;

        public int Clicks_Upper = 0;
        public int Click_Caminar = 0;
        public int Click_Pared = 0;
        public int Ultimo_Intervalo;
        public int Contar_Intervalos;

        public int Contar_Auto = 0;

        public int Clicks_Acciones = 0;
        //BLOCK_ DE COCO
        public  bool block_coco = false;

        public int Sala_Especial = 0;

        public double baneo = 0;
        public int contador_baneo;

        public int cambio_nombre { get; set; }
        public int noticia_registro { get; set; }

        public bool sala_especial = true;

        public int toneos_ring;
        //Vender objeto de oro
        public bool espera_respuesta_venta_objeto_oro = false;
        public int precio_objeto_venta;
        public int id_objeto_venta;
        public string data_objeto_venta;

        public string NinjaColores_Sala = "";
        public bool Ninja_Copi_color = false;

        public int Traje_Ninja_Principal;
        public int torneos_coco;

        public bool block_upper = false;


        public int ver_ranking { get; set; }

        public bool ninja_celestial = false;
        public bool ninja_celestial_puesto = false;

        public bool ver_clicks = false;

        public bool retard_upper = false;

        public int contador_fa = 0;
        public int contar_pasos = 0;
        public int contador_frase = 0;
        public string primera_frase = "";

        public int Clicks_Accion = 0;

        public int Timer_BPad = 0;
        public int Contador_MensajeBPad = 0;

        public bool masacre12 = false;
        public int comprobar_conexion = 10;
        public string levelup = "";
        public UserInstance(DataRow row)
        {
            this.id = (int)row["id"];
            this.nombre = (string)row["nombre"];
            this.password = (string)row["password"];
            this.security = (string)row["security"];
            this.avatar = (int)row["avatar"];
            this.colores = (string)row["colores"];
            this.email = (string)row["email"];
            this.ValidarEmail = (int)row["email_validado"];
            this.edad = (int)row["edad"];
            this.ip_registro = (string)row["ip_registro"];
            this.ip_actual = (string)row["ip_actual"];
            this.oro = (int)row["oro"];
            this.plata = (int)row["plata"];
            this.admin = (int)row["admin"];
            this.vip_double = Convert.ToDouble((int)row["vip"]);
            this.end_vip = (string)row["end_vip"];
            this.bocadillo = (string)row["bocadillo"];
            this.hobby_1 = (string)row["hobby_1"];
            this.hobby_2 = (string)row["hobby_2"];
            this.hobby_3 = (string)row["hobby_3"];
            this.deseo_1 = (string)row["deseo_1"];
            this.deseo_2 = (string)row["deseo_2"];
            this.deseo_3 = (string)row["deseo_3"];
            this.mVotos_Legal = int.Parse(row["votos_legal"].ToString());
            this.mVotos_Sexy = int.Parse(row["votos_sexy"].ToString());
            this.mVotos_Simpatico = int.Parse(row["votos_simpatico"].ToString());
            this.besos_enviados = (int)row["besos_enviados"];
            this.besos_recibidos = (int)row["besos_recibidos"];
            this.jugos_enviados = (int)row["jugos_enviados"];
            this.jugos_recibidos = (int)row["jugos_recibidos"];
            this.flores_enviadas = (int)row["flores_enviadas"];
            this.flores_recibidas = (int)row["flores_recibidas"];
            this.uppers_enviados = (int)row["uppers_enviados"];
            this.uppers_recibidos = (int)row["uppers_recibidos"];
            this.cocos_enviados = (int)row["cocos_enviados"];
            this.cocos_recibidos = (int)row["cocos_recibidos"];
            this.rings_ganados = (int)row["rings_ganados"];
            this.senderos_ganados = (int)row["senderos_ganados"];
            this.puntos_cocos = (int)row["puntos_cocos"];
            this.puntos_ninja = (int)row["puntos_ninja"];
            this.ultima_conexion = (string)row["ultima_conexion"];
            this.mfecha_registro = row["fecha_registro"].ToString();
            this.mtimespam_desc_cambios = double.Parse(row["timespam_desc_cambios"].ToString());
            this.coins_remain_double = Time.GetCurrentAndAdd(AddType.Segundos, (int)row["coins_remain"]);
            this.UppertSelect = UppertLevel();
            this.CocoSelect = nivel_coco;
            this.mtutorial_islas = int.Parse(row["tutorial_islas"].ToString());
            this.mtimespam_regalo_peque = double.Parse(row["timespam_regalo_peque"].ToString());
            this.mtimespam_regalo_grande = double.Parse(row["timespam_regalo_grande"].ToString());
            this.mnovedades_noticias = (int)row["novedades_noticias"];
            this.baneo = (int)row["baneo"];
            this.contador_baneo = (int)row["contador_baneo"];
            this.cambio_nombre = (int)row["cambio_nombre"];
            this.noticia_registro = (int)row["noticia_registro"];
            this.toneos_ring = (int)row["toneos_ring"];
            this.Traje_Ninja_Principal = (int)row["t_n_p"];
            this.torneos_coco = (int)row["torneos_coco"];
            this.ver_ranking = (int)row["ver_ranking"];
        }
        public string Colores_traje(SessionInstance Session)
        {
            string EXTRA_COLORS = "AAAAAAAAAAAAAAAAAA";
            return "000000" + Session.User.colores.Substring(0, 6) + ObtenerCinta(nivel_ninja) + Session.User.colores.Substring(18, 6) + EXTRA_COLORS;
        }
        public string Colores_traje_blanco(SessionInstance Session)
        {
            string EXTRA_COLORS = "AAAAAAAAAAAAAAAAAA";
            return "FFFFFF" + Session.User.colores.Substring(0, 6) + ObtenerCinta(nivel_ninja) + Session.User.colores.Substring(18, 6) + EXTRA_COLORS;
        }
        public string Colores_traje_ninja_copiador_de_color(SessionInstance Session)
        {
            string EXTRA_COLORS = "AAAAAAAAAAAAAAAAAA";
            return "FFFFFF" + "FFFFFF" + "FFFFFF" + "FFFFFF" + EXTRA_COLORS;
        }
        //Trajes especiales XD
        public string Colores_traje_purpura(SessionInstance Session)
        {
            string EXTRA_COLORS = "AAAAAAAAAAAAAAAAAA";
            return "790a3f" + Session.User.colores.Substring(0, 6) + Session.User.colores.Substring(18, 6) + Session.User.colores.Substring(18, 6) + EXTRA_COLORS;///Colores sinta 901615
        }
        public string Colores_traje_oscuro(SessionInstance Session)
        {
            string EXTRA_COLORS = "AAAAAAAAAAAAAAAAAA";
            return "004852" + Session.User.colores.Substring(0, 6) + "f2b100" + Session.User.colores.Substring(18, 6) + EXTRA_COLORS;
        }
        public string Colores_traje_verde(SessionInstance Session)
        {
            string EXTRA_COLORS = "AAAAAAAAAAAAAAAAAA";
            return "5d7835" + Session.User.colores.Substring(0, 6) + "ff9900" + Session.User.colores.Substring(18, 6) + EXTRA_COLORS;
        }
        public string Colores_traje_rosa(SessionInstance Session)
        {
            string EXTRA_COLORS = "AAAAAAAAAAAAAAAAAA";
            return "fec2de" + Session.User.colores.Substring(0, 6) + "b3e1fe" + Session.User.colores.Substring(18, 6) + EXTRA_COLORS;
        }
        public string Colores_traje_selestial(SessionInstance Session)
        {
            return "c0bfbd" + "000000" + "20ecfe" + Session.User.colores.Substring(18, 6) + Session.User.colores.Substring(24, 6) + Session.User.colores.Substring(30, 6) + Session.User.colores.Substring(36, 6); ;///Colores sinta 901615
        }
        //
        private string ObtenerCinta(int NinjaLevel)
        {
            switch (NinjaLevel)
            {
                case 0:
                    return "C9CACF";
                case 1:
                    return "FF0000";
                case 2:
                    return "FF3399";
                case 3:
                    return "FF6600";
                case 4:
                    return "00CC00";
                case 5:
                    return "0066CC";
                case 6:
                    return "FFFFFF";
                case 7:
                    return "660099";
                case 8:
                    return "653232";
                case 9:
                    return "222222";
                case 10:
                    return "f2b100";
                default:
                    return "FFFFFF";
            }
        }
        public int UppertLevel()
        {
            if (uppers_enviados >= 25 && uppers_enviados <= 49) return 1;
            if (uppers_enviados >= 50 && uppers_enviados <= 99) return 2;
            if (uppers_enviados >= 100 && uppers_enviados <= 199) return 3;
            if (uppers_enviados >= 200 && uppers_enviados <= 499) return 4;
            if (uppers_enviados >= 500 && uppers_enviados <= 1499) return 5;
            if (uppers_enviados >= 1500 && uppers_enviados <= 2999) return 6;
            if (uppers_enviados >= 3000 && uppers_enviados <= 5999) return 7;
            if (uppers_enviados >= 6000 && uppers_enviados <= 8999) return 8;
            if (uppers_enviados >= 9000) return 9;
            return 0;
        }
        public int CocoLevel()
        {
            if (puntos_cocos >= 10 && puntos_cocos <= 19) return 1;
            if (puntos_cocos >= 20 && puntos_cocos <= 49) return 2;
            if (puntos_cocos >= 50 && puntos_cocos <= 99) return 3;
            if (puntos_cocos >= 100 && puntos_cocos <= 149) return 4;
            if (puntos_cocos >= 150 && puntos_cocos <= 199) return 5;
            if (puntos_cocos >= 200 && puntos_cocos <= 299) return 6;
            if (puntos_cocos >= 300 && puntos_cocos <= 399) return 7;
            if (puntos_cocos >= 400 && puntos_cocos <= 599) return 8;
            if (puntos_cocos >= 600) return 9;
            return 0;
        }
        public int NinjaLevel()
        {
            if (puntos_ninja >= 400 && puntos_ninja <= 409) return 1;
            if (puntos_ninja >= 410 && puntos_ninja <= 419) return 2;
            if (puntos_ninja >= 420 && puntos_ninja <= 449) return 3;
            if (puntos_ninja >= 450 && puntos_ninja <= 499) return 4;
            if (puntos_ninja >= 500 && puntos_ninja <= 549) return 5;
            if (puntos_ninja >= 550 && puntos_ninja <= 599) return 6;
            if (puntos_ninja >= 600 && puntos_ninja <= 699) return 7;
            if (puntos_ninja >= 700 && puntos_ninja <= 799) return 8;
            if (puntos_ninja >= 800 && puntos_ninja <= 999) return 9;
            if (puntos_ninja >= 1000) return 10;
            return 0;
        }
        //public int UppertLevel()
        //{
        //    if (rings_ganados >= 1 && rings_ganados <= 9) return 1;
        //    if (rings_ganados >= 10 && rings_ganados <= 24) return 2;
        //    if (rings_ganados >= 25 && rings_ganados <= 49) return 3;
        //    if (rings_ganados >= 50 && rings_ganados <= 99) return 4;
        //    if (rings_ganados >= 100 && rings_ganados <= 199) return 5;
        //    if (rings_ganados >= 200 && rings_ganados <= 499) return 6;
        //    if (rings_ganados >= 500 && rings_ganados <= 999) return 7;
        //    if (rings_ganados >= 1000 && rings_ganados <= 1999) return 8;
        //    if (rings_ganados >= 2000) return 9;
        //    return 0;
        //}
        public int nivel_coco
        {
            get
            {
                if (puntos_cocos >= 10 && puntos_cocos <= 19) return 1;
                if (puntos_cocos >= 20 && puntos_cocos <= 49) return 2;
                if (puntos_cocos >= 50 && puntos_cocos <= 99) return 3;
                if (puntos_cocos >= 100 && puntos_cocos <= 149) return 4;
                if (puntos_cocos >= 150 && puntos_cocos <= 199) return 5;
                if (puntos_cocos >= 200 && puntos_cocos <= 299) return 6;
                if (puntos_cocos >= 300 && puntos_cocos <= 399) return 7;
                if (puntos_cocos >= 400 && puntos_cocos <= 599) return 8;
                if (puntos_cocos >= 600) return 9;
                return 0;
            }
        }
        public int puntos_coco_limite
        {
            get
            {
                if (puntos_cocos >= 10 && puntos_cocos <= 19) return 20;
                if (puntos_cocos >= 20 && puntos_cocos <= 49) return 50;
                if (puntos_cocos >= 50 && puntos_cocos <= 99) return 100;
                if (puntos_cocos >= 100 && puntos_cocos <= 149) return 150;
                if (puntos_cocos >= 150 && puntos_cocos <= 199) return 200;
                if (puntos_cocos >= 200 && puntos_cocos <= 299) return 300;
                if (puntos_cocos >= 300 && puntos_cocos <= 399) return 400;
                if (puntos_cocos >= 400 && puntos_cocos <= 599) return 600;
                if (puntos_cocos >= 600) return 600;
                return 10;
            }
        }
        public int nivel_ninja
        {
            get
            {
                if (puntos_ninja >= 400 && puntos_ninja <= 409) return 1;
                if (puntos_ninja >= 410 && puntos_ninja <= 419) return 2;
                if (puntos_ninja >= 420 && puntos_ninja <= 449) return 3;
                if (puntos_ninja >= 450 && puntos_ninja <= 499) return 4;
                if (puntos_ninja >= 500 && puntos_ninja <= 549) return 5;
                if (puntos_ninja >= 550 && puntos_ninja <= 599) return 6;
                if (puntos_ninja >= 600 && puntos_ninja <= 699) return 7;
                if (puntos_ninja >= 700 && puntos_ninja <= 799) return 8;
                if (puntos_ninja >= 800 && puntos_ninja <= 999) return 9;
                if (puntos_ninja >= 1000) return 10;
                return 0;
            }
        }
        public int puntos_ninja_limite
        {
            get
            {
                if (puntos_ninja >= 0 && puntos_ninja <= 399) return 400;
                if (puntos_ninja >= 400 && puntos_ninja <= 409) return 410;
                if (puntos_ninja >= 410 && puntos_ninja <= 419) return 420;
                if (puntos_ninja >= 420 && puntos_ninja <= 449) return 450;
                if (puntos_ninja >= 450 && puntos_ninja <= 499) return 500;
                if (puntos_ninja >= 500 && puntos_ninja <= 549) return 550;
                if (puntos_ninja >= 550 && puntos_ninja <= 599) return 600;
                if (puntos_ninja >= 600 && puntos_ninja <= 699) return 700;
                if (puntos_ninja >= 700 && puntos_ninja <= 799) return 800;
                if (puntos_ninja >= 800 && puntos_ninja <= 999) return 1000;
                if (puntos_ninja >= 1000) return 1000;
                return 400;
            }
        }
        public int vip
        {
            get
            {
                if (Time.TiempoActual() > vip_double)
                {
                    return 0;
                }
                return 1;
            }
        }
        #region Locks
        private double Time_SendUppert = Time.TiempoActual();
        public bool PreLock_EnviandoUppert
        {
            get
            {
                if (Time.TiempoActual() > Time_SendUppert)
                {
                    return false;
                }
                return true;
            }
            set
            {
                Time_SendUppert = Time.GetCurrentAndAdd(AddType.Milisegundos, 175);
            }
            
        }
        private double Time_Notifi = Time.TiempoActual();
        public bool PreLock_Notificacion_IzDer
        {
            get
            {
                if (Time.TiempoActual() > Time_Notifi)
                {
                    return false;
                }
                return true;
            }
        }
        private double Time_Uppert_Click = Time.TiempoActual();
        public bool PreLockUpperClick
        {
            get
            {
                if (Time.TiempoActual() > Time_Uppert_Click)
                {
                    return false;
                }
                return true;
            }
        }
        private double Time_Mirada = Time.TiempoActual();
        public bool PreLock_Mirada
        {
            get
            {
                if (Time.TiempoActual() > Time_Mirada)
                {
                    return false;
                }
                return true;
            }
            set
            {
                Time_Mirada = Time.GetCurrentAndAdd(AddType.Milisegundos, 200);
            }
        }
        private double Time_Acciones = Time.TiempoActual();
        public bool PreLock_Acciones
        {
            get
            {
                if (Time.TiempoActual() > Time_Acciones)
                {
                    return false;
                }
                return true;
            }
            set
            {
                Time_Acciones = Time.GetCurrentAndAdd(AddType.Milisegundos, 100);
            }
        }
        private double Time_Caminando = Time.TiempoActual();
        public bool PreLock_Caminando
        {
            get
            {
                if (Time.TiempoActual() > Time_Caminando)
                {
                    return false;
                }
                return true;
            }
            set
            {
                this.Time_Caminando = Time.GetCurrentAndAdd(AddType.Milisegundos, 680);
            }
        }
        private double Time_Bloqueo_chat = Time.TiempoActual();
        public bool PreLock_BloqueoChat
        {
            get
            {
                if (Time.TiempoActual() > Time_Bloqueo_chat)
                {
                    return false;
                }
                return true;
            }
            set
            {
                Time_Bloqueo_chat = Time.GetCurrentAndAdd(AddType.Segundos, 1);
            }
        }
        public double Time_Interactuando = Time.TiempoActual();
        public bool PreLock_Interactuando
        {
            get
            {
                if (Time.TiempoActual() > Time_Interactuando)
                {
                    return false;
                }
                return true;
            }
        }
        private double Time_Ficha = Time.TiempoActual();
        public bool PreLock_Ficha
        {
            get
            {
                if (Time.TiempoActual() > Time_Ficha)
                {
                    return false;
                }
                return true;
            }
            set
            {
                Time_Ficha = Time.GetCurrentAndAdd(AddType.Segundos, 1);
            }
        }
        public double Time_BlockLatency = Time.TiempoActual();
        public bool Prelock_Latency
        {
            get
            {
                if (Time.TiempoActual() > Time_BlockLatency)
                {
                    return false;
                }
                return true;
            }
        }
        private double Time_Upper_Espera = Time.TiempoActual();
        public bool PreLock_Upper_Espera
        {
            get
            {
                if (Time.TiempoActual() > Time_Upper_Espera)
                {
                    return false;
                }
                return true;
            }
            set
            {
                Time_Upper_Espera = Time.GetCurrentAndAdd(AddType.Milisegundos, 156);
            }
        }
        private double Time_Disfraz = Time.TiempoActual();
        public bool PreLock_Disfraz
        {
            get
            {
                if (Time.TiempoActual() > Time_Disfraz)
                {
                    return false;
                }
                return true;
            }
            set
            {
                Time_Disfraz = Time.GetCurrentAndAdd(AddType.Segundos, 6);
            }
        }
        private double Time_Proteccion_SQL = Time.TiempoActual();
        public bool PreLock__Proteccion_SQL
        {
            get
            {
                if (Time.TiempoActual() > Time_Proteccion_SQL)
                {
                    return false;
                }
                return true;
            }
            set
            {
                Time_Proteccion_SQL = Time.GetCurrentAndAdd(AddType.Segundos, 2);
            }
        }
        public double Time_Acciones_Ficha = Time.TiempoActual();
        public bool PreLock_Acciones_Ficha
        {
            get
            {
                if (Time.TiempoActual() > Time_Acciones_Ficha)
                {
                    return false;
                }
                return true;
            }
        }
        private double Time_Sapmm_Areas = Time.TiempoActual();
        public bool PreLock__Spamm_Areas
        {
            get
            {
                if (Time.TiempoActual() > Time_Sapmm_Areas)
                {
                    return false;
                }
                return true;
            }
            set
            {
                Time_Sapmm_Areas = Time.GetCurrentAndAdd(AddType.Segundos, 2);
            }
        }
        public double Time_Cambio_Colores = Time.TiempoActual();
        public bool PreLock_Cambio_Colores
        {
            get
            {
                if (Time.TiempoActual() > Time_Cambio_Colores)
                {
                    return false;
                }
                return true;
            }
        }
        #endregion
    }
}
