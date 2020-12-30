using BoomBang.game.instances;
using BoomBang.server;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Text.RegularExpressions;
using System.Threading.Tasks;

namespace BoomBang.game.manager
{
    public class ObjectEditor
    {
        #region chutasEditor
        public Dictionary<int, Posicion> Posiciones = new Dictionary<int, Posicion>();
        private SessionInstance Session;
        private Posicion Chuta_Central { get; set; }
        public void RegistrarPosicion(Posicion Pos)
        {
            if (Objeto != null)
            {
                if (AñadirChuta(Pos))
                {
                    if (this.Chuta_Central == null)
                    {
                        this.Chuta_Central = Pos;
                        NotificacionesManager.Chat_Privado(Session, "Se ha fijado la chuta central.");

                        return;
                    }
                    Posiciones.Add((Posiciones.Count + 1), Pos);
                    ActualizarChutas();
                    NotificacionesManager.Chat_Privado(Session, "Se ha añadido la chuta correctamente.");
                    return;
                }
                NotificacionesManager.Chat_Privado(Session, "Esta chuta ya ha sido registrada anteriormente.");
                return;
            }
        }
        public bool AñadirChuta(Posicion Pos)
        {
            foreach (var position in Posiciones.Values)
            {
                if (position.x == Pos.x && position.y == Pos.y) return false;
            }
            return true;
        }
        public void Guardar_Chutas()
        {
            string ocupe = "";
            foreach (var Posicion in Posiciones.Values)
            {
                NotificacionesManager.Chat_Privado(Session, (Posicion.x - Chuta_Central.x) + " " + (Posicion.y - Chuta_Central.y));
                ocupe += (Posicion.x - Chuta_Central.x) + "," + (Posicion.y - Chuta_Central.y) + ",";
            }
            ocupe = ocupe.TrimEnd(',');
            using (mysql client = new mysql())
            {
                client.SetParameter("id", Objeto.id);
                client.SetParameter("espacio_2_0", ocupe);
                client.ExecuteNonQuery("UPDATE objetos SET espacio_2_0 = @espacio_2_0 WHERE id = @id");
                client.SetParameter("id", Objeto.id);
                client.ExecuteNonQuery("UPDATE objetos_comprados SET sala_id = '0' WHERE objeto_id = @id");
                NotificacionesManager.Chat_Privado(Session, "¡Se han actualizado los datos del objeto ''" + Objeto.titulo + "'' [" + Objeto.id + "] correctamente!");
                CerrarEditor();
                Posiciones.Clear();
                Chuta_Central = null;
            }
        }
        private void ActualizarChutas()
        {
            foreach (var Pos in Posiciones.Values)
            {
                ServerMessage server = new ServerMessage();
                server.AddHead(124);
                server.AddHead(121);
                server.AppendParameter(Pos.x);
                server.AppendParameter(Pos.y);
                server.AppendParameter(1);
                Session.User.Sala.SendData(server, Session);
            }
            foreach (var Pos in Posiciones.Values)
            {
                ServerMessage server = new ServerMessage();
                server.AddHead(124);
                server.AddHead(120);
                server.AppendParameter(Pos.x);
                server.AppendParameter(Pos.y);
                server.AppendParameter(1);
                Session.User.Sala.SendData(server, Session);
            }
        }
        public void CerrarEditor()
        {
            foreach (var Pos in Posiciones.Values)
            {
                ServerMessage server = new ServerMessage();
                server.AddHead(124);
                server.AddHead(121);
                server.AppendParameter(Pos.x);
                server.AppendParameter(Pos.y);
                server.AppendParameter(1);
                Session.User.Sala.SendData(server, Session);
            }
        }
        #endregion
        public ObjectEditor(SessionInstance Session)
        {
            this.Session = Session;
        }
        public CatalogObjectInstance Objeto;
        public void Commands(SessionInstance Session, string mensaje)
        {
            if (this.Objeto == null) return;
            try
            {
                using (mysql client = new mysql())
                {
                    string[] array = Regex.Split(mensaje, ":");
                    string WordStart = Regex.Split(array[0], "/")[1];
                    switch (WordStart)
                    {
                        case "object.chutas.del":
                            client.SetParameter("id", Objeto.id);
                            client.SetParameter("chutas", "");
                            if (client.ExecuteNonQuery("UPDATE objetos SET espacio_2_0 = @chutas WHERE id = @id") == 1)
                            {
                                NotificacionesManager.Chat_Privado(Session, "Se han eliminado las chutas.");
                            }
                            break;
                        case "object.chutas.restat":
                            Posiciones.Clear();
                            Chuta_Central = null;
                            NotificacionesManager.Chat_Privado(Session, "Se han reestablecido las chutas fijadas.");
                            break;
                        case "object.chutas.set":
                            RegistrarPosicion(Session.User.Posicion);
                            break;
                        case "object.chutas.save":
                            Guardar_Chutas();
                            break;
                        case "object.titulo":
                            string titulo = array[1];
                            client.SetParameter("id", Objeto.id);
                            client.SetParameter("titulo", titulo);
                            if (client.ExecuteNonQuery("UPDATE objetos SET titulo = @titulo WHERE id = @id") == 1)
                            {
                                NotificacionesManager.Chat_Privado(Session, "Título del objeto editado correctamente.");
                            }
                            break;
                        case "object.descripcion":
                            string descripcion = array[1];
                            client.SetParameter("id", Objeto.id);
                            client.SetParameter("descripcion", descripcion);
                            if (client.ExecuteNonQuery("UPDATE objetos SET descripcion = @descripcion WHERE id = @id") == 1)
                            {
                                NotificacionesManager.Chat_Privado(Session, "Descripcion del objeto editado correctamente.");
                            }
                            break;
                        case "object.categoria":
                            string categoria = array[1];
                            client.SetParameter("id", Objeto.id);
                            client.SetParameter("categoria", categoria);
                            if (client.ExecuteNonQuery("UPDATE objetos SET categoria = @categoria WHERE id = @id") == 1)
                            {
                                NotificacionesManager.Chat_Privado(Session, "Descripcion del objeto editado correctamente.");
                            }
                            break;
                        case "object.visible":
                            string visible = array[1];
                            client.SetParameter("id", Objeto.id);
                            client.SetParameter("visible", visible);
                            if (client.ExecuteNonQuery("UPDATE objetos SET visible = @visible WHERE id = @id") == 1)
                            {
                                NotificacionesManager.Chat_Privado(Session, "Visible del objeto editado correctamente.");
                            }
                            break;
                        case "object.precio_oro":
                            string precio_oro = array[1];
                            client.SetParameter("id", Objeto.id);
                            client.SetParameter("precio_oro", precio_oro);
                            if (client.ExecuteNonQuery("UPDATE objetos SET precio_oro = @precio_oro WHERE id = @id") == 1)
                            {
                                NotificacionesManager.Chat_Privado(Session, "precio_oro del objeto editado correctamente.");
                            }
                            break;
                        case "object.precio_plata":
                            string precio_plata = array[1];
                            client.SetParameter("id", Objeto.id);
                            client.SetParameter("precio_plata", precio_plata);
                            if (client.ExecuteNonQuery("UPDATE objetos SET precio_plata = @precio_plata WHERE id = @id") == 1)
                            {
                                NotificacionesManager.Chat_Privado(Session, "precio_plata del objeto editado correctamente.");
                            }
                            break;
                        case "object.vip":
                            string vip = array[1];
                            client.SetParameter("id", Objeto.id);
                            client.SetParameter("vip", vip);
                            if (client.ExecuteNonQuery("UPDATE objetos SET vip = @vip WHERE id = @id") == 1)
                            {
                                NotificacionesManager.Chat_Privado(Session, "vip del objeto editado correctamente.");
                            }
                            break;
                        case "object.espacio_mapabytes":
                            string espacio_mapabytes = array[1];
                            client.SetParameter("id", Objeto.id);
                            client.SetParameter("espacio_mapabytes", espacio_mapabytes);
                            if (client.ExecuteNonQuery("UPDATE objetos SET espacio_mapabytes = @espacio_mapabytes WHERE id = @id") == 1)
                            {
                                NotificacionesManager.Chat_Privado(Session, "espacio_mapabytes del objeto editado correctamente.");
                            }
                            break;
                        case "object.colores_hex":
                            string colores_hex = array[1];
                            client.SetParameter("id", Objeto.id);
                            client.SetParameter("colores_hex", colores_hex);
                            if (client.ExecuteNonQuery("UPDATE objetos SET colores_hex = @colores_hex WHERE id = @id") == 1)
                            {
                                NotificacionesManager.Chat_Privado(Session, "colores_hex del objeto editado correctamente.");
                            }
                            break;
                        case "object.colores_rgb":
                            string colores_rgb = array[1];
                            client.SetParameter("id", Objeto.id);
                            client.SetParameter("colores_rgb", colores_rgb);
                            if (client.ExecuteNonQuery("UPDATE objetos SET colores_rgb = @colores_rgb WHERE id = @id") == 1)
                            {
                                NotificacionesManager.Chat_Privado(Session, "colores_rgb del objeto editado correctamente.");
                            }
                            break;
                        case "object.parte_1":
                            string parte_1 = array[1];
                            client.SetParameter("id", Objeto.id);
                            client.SetParameter("parte_1", parte_1);
                            if (client.ExecuteNonQuery("UPDATE objetos SET parte_1 = @parte_1 WHERE id = @id") == 1)
                            {
                                NotificacionesManager.Chat_Privado(Session, "parte_1 del objeto editado correctamente.");
                            }
                            break;
                        case "object.parte_2":
                            string parte_2 = array[1];
                            client.SetParameter("id", Objeto.id);
                            client.SetParameter("parte_2", parte_2);
                            if (client.ExecuteNonQuery("UPDATE objetos SET parte_2 = @parte_2 WHERE id = @id") == 1)
                            {
                                NotificacionesManager.Chat_Privado(Session, "parte_1 del objeto editado correctamente.");
                            }
                            break;
                        case "object.parte_3":
                            string parte_3 = array[1];
                            client.SetParameter("id", Objeto.id);
                            client.SetParameter("parte_3", parte_3);
                            if (client.ExecuteNonQuery("UPDATE objetos SET parte_3 = @parte_3 WHERE id = @id") == 1)
                            {
                                NotificacionesManager.Chat_Privado(Session, "parte_1 del objeto editado correctamente.");
                            }
                            break;
                        case "object.parte_4":
                            string parte_4 = array[1];
                            client.SetParameter("id", Objeto.id);
                            client.SetParameter("parte_4", parte_4);
                            if (client.ExecuteNonQuery("UPDATE objetos SET parte_4 = @parte_4 WHERE id = @id") == 1)
                            {
                                NotificacionesManager.Chat_Privado(Session, "parte_1 del objeto editado correctamente.");
                            }
                            break;
                        case "object.tam_p":
                            string tam_p = array[1];
                            client.SetParameter("id", Objeto.id);
                            client.SetParameter("tam_p", tam_p);
                            if (client.ExecuteNonQuery("UPDATE objetos SET tam_p = @tam_p WHERE id = @id") == 1)
                            {
                                NotificacionesManager.Chat_Privado(Session, "tam_p del objeto editado correctamente.");
                            }
                            break;
                        case "object.tam_n":
                            string tam_n = array[1];
                            client.SetParameter("id", Objeto.id);
                            client.SetParameter("tam_n", tam_n);
                            if (client.ExecuteNonQuery("UPDATE objetos SET tam_n = @tam_n WHERE id = @id") == 1)
                            {
                                NotificacionesManager.Chat_Privado(Session, "tam_n del objeto editado correctamente.");
                            }
                            break;
                        case "object.tam_g":
                            string tam_g = array[1];
                            client.SetParameter("id", Objeto.id);
                            client.SetParameter("tam_g", tam_g);
                            if (client.ExecuteNonQuery("UPDATE objetos SET tam_g = @tam_g WHERE id = @id") == 1)
                            {
                                NotificacionesManager.Chat_Privado(Session, "tam_g del objeto editado correctamente.");
                            }

                            break;
                        case "object.espacio_ocupado_n":
                            string espacio_ocupado_n = array[1];
                            client.SetParameter("id", Objeto.id);
                            client.SetParameter("espacio_ocupado_n", espacio_ocupado_n);
                            if (client.ExecuteNonQuery("UPDATE objetos SET espacio_ocupado_n = @espacio_ocupado_n WHERE id = @id") == 1)
                            {
                                NotificacionesManager.Chat_Privado(Session, "espacio_ocupado_n del objeto editado correctamente.");
                            }
                            break;
                        case "object.arrastrable":
                            string arrastrable = array[1];
                            client.SetParameter("id", Objeto.id);
                            client.SetParameter("arrastrable", arrastrable);
                            if (client.ExecuteNonQuery("UPDATE objetos SET arrastrable = @arrastrable WHERE id = @id") == 1)
                            {
                                NotificacionesManager.Chat_Privado(Session, "arrastrable del objeto editado correctamente.");
                            }
                            break;
                        case "object.salas_usables":
                            string salas_usables = array[1];
                            client.SetParameter("id", Objeto.id);
                            client.SetParameter("salas_usables", salas_usables);
                            if (client.ExecuteNonQuery("UPDATE objetos SET salas_usables = @salas_usables WHERE id = @id") == 1)
                            {
                                NotificacionesManager.Chat_Privado(Session, "salas_usables del objeto editado correctamente.");
                            }
                            break;
                        case "object.intercambiable":
                            string intercambiable = array[1];
                            client.SetParameter("id", Objeto.id);
                            client.SetParameter("intercambiable", intercambiable);
                            if (client.ExecuteNonQuery("UPDATE objetos SET intercambiable = @intercambiable WHERE id = @id") == 1)
                            {
                                NotificacionesManager.Chat_Privado(Session, "intercambiable del objeto editado correctamente.");
                            }
                            break;
                        case "object.tipo_rare":
                            string tipo_rare = array[1];
                            client.SetParameter("id", Objeto.id);
                            client.SetParameter("tipo_rare", tipo_rare);
                            if (client.ExecuteNonQuery("UPDATE objetos SET tipo_rare = @tipo_rare WHERE id = @id") == 1)
                            {
                                NotificacionesManager.Chat_Privado(Session, "tipo_rare del objeto editado correctamente.");
                            }
                            break;
                        case "object.rotacion":
                            string rotacion = array[1];
                            client.SetParameter("id", Objeto.id);
                            client.SetParameter("rotacion", rotacion);
                            if (client.ExecuteNonQuery("UPDATE objetos SET rotacion = @rotacion WHERE id = @id") == 1)
                            {
                                NotificacionesManager.Chat_Privado(Session, "rotacion del objeto editado correctamente.");
                            }
                            break;
                        case "object.tipo_arrastre":
                            string tipo_arrastre = array[1];
                            client.SetParameter("id", Objeto.id);
                            client.SetParameter("tipo_arrastre", tipo_arrastre);
                            if (client.ExecuteNonQuery("UPDATE objetos SET tipo_arrastre = @tipo_arrastre WHERE id = @id") == 1)
                            {
                                NotificacionesManager.Chat_Privado(Session, "tipo_arrastre del objeto editado correctamente.");
                            }
                            break;
                        case "object.default_data":
                            string default_data = array[1];
                            client.SetParameter("id", Objeto.id);
                            client.SetParameter("default_data", default_data);
                            if (client.ExecuteNonQuery("UPDATE objetos SET default_data = @default_data WHERE id = @id") == 1)
                            {
                                NotificacionesManager.Chat_Privado(Session, "default_data del objeto editado correctamente.");
                            }
                            break;
                    }
                }
            }
            catch
            {

            }
        }

    }
}
