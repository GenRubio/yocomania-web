using System;
using System.Collections.Generic;
using System.Data;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using BoomBang.server;
using BoomBang.game.manager;

namespace BoomBang.game.instances.manager
{
    class RankingsManager
    {
        private static string nombre_Top1 = "";
        private static string nombre_Top2 = "";
        private static string nombre_Top3 = "";
        public static string fecha_premios_minijuegos = "";
        public static string fecha_premios_eventos = "";
        //id_user = id de usuarios
        //id_ranking = tipo de ranking > 1 ring 2 cocos 3 sendero 4 camino ninja 5 uppers 6 (shurikens,cocos)
        //tipo_ranking = 1 silver 2 golden -1 (uppers, eventos)
        public static void agregar_user_ranking(int id_user, int id_ranking, int tipo_ranking, int puntos)
        {
            mysql client = new mysql();
            client.SetParameter("id_user", id_user);
            client.SetParameter("id_ranking", id_ranking);
            client.SetParameter("tipo_ranking", tipo_ranking);
            DataRow comprobar_usuario = client.ExecuteQueryRow("SELECT * FROM rankings WHERE id_usuario = @id_user AND id_ranking = @id_ranking AND tipo_ranking = @tipo_ranking");
            if (comprobar_usuario != null)
            {
                int puntos_totales = (int)comprobar_usuario["puntos"];
                int actualizar_puntos_totales = puntos_totales + puntos;
                client.SetParameter("id_user", id_user);
                client.SetParameter("id_ranking", id_ranking);
                client.SetParameter("tipo_ranking", tipo_ranking);
                client.SetParameter("puntos", actualizar_puntos_totales);
                client.ExecuteNonQuery("UPDATE rankings SET puntos = @puntos WHERE id_usuario = @id_user AND id_ranking = @id_ranking AND tipo_ranking = @tipo_ranking");
            }
            else
            {
                client.SetParameter("id_user", id_user);
                client.SetParameter("id_ranking", id_ranking);
                client.SetParameter("tipo_ranking", tipo_ranking);
                client.SetParameter("puntos", puntos);
                client.ExecuteNonQuery("INSERT INTO rankings (`id_usuario`, `id_ranking`, `tipo_ranking`, `puntos`) VALUES (@id_user, @id_ranking, @tipo_ranking, @puntos)");
            }
        }
        public static void cartel_ranking(SessionInstance Session, int id_ranking, int tipo_ranking, string fecha_premio)
        {
            mysql client = new mysql();
            int limite_registro = 0;
            int posicion_ranking = 0;
            string ranking = "";
            string mensaje_1 = "No entras en Top 100";
            client.SetParameter("id_ranking", id_ranking);
            client.SetParameter("tipo_ranking", tipo_ranking);
            foreach (DataRow row in client.ExecuteQueryTable("SELECT * FROM rankings WHERE id_ranking = @id_ranking AND tipo_ranking = @tipo_ranking ORDER BY puntos desc").Rows)
            {
                if (limite_registro < 100)
                {
                    posicion_ranking++;
                    if (Session.User.id == (int)row["id_usuario"])
                    {
                        int puntos_usuario = (int)row["puntos"];
                        mensaje_1 = "Top " + posicion_ranking + " - Puntos: " + puntos_usuario + "";
                    }
                    client.SetParameter("id_user", (int)row["id_usuario"]);
                    DataRow usuarios = client.ExecuteQueryRow("SELECT * FROM usuarios WHERE id = @id_user");
                    ranking = ranking + "" + posicion_ranking + ". Usuario: " + (string)usuarios["nombre"] + " - puntos: " + (int)row["puntos"] + "\n";
                    limite_registro++;
                }
            }
            string titulo_ranking = "Error";
            if (id_ranking == 6) { titulo_ranking = "Ranking Evento Semanal"; }
            if (id_ranking == 5) { titulo_ranking = "Ranking Uppers Semanal"; }
            if (id_ranking == 1 && tipo_ranking == 2) { titulo_ranking = "Ranking Semanal Ring"; }
            if (id_ranking == 1 && tipo_ranking == 1) { titulo_ranking = "Ranking Semanal Silver Ring"; }
            if (id_ranking == 2 && tipo_ranking == 2) { titulo_ranking = "Ranking Semanal Cocos"; }
            if (id_ranking == 3 && tipo_ranking == 2) { titulo_ranking = "Ranking Semanal Sendero"; }
            if (id_ranking == 4 && tipo_ranking == 1) { titulo_ranking = "Ranking Semanal Silver Camino"; }
            ServerMessage alerta = new ServerMessage();
            alerta.AddHead(183);
            if (posicion_ranking == 0) { alerta.AppendParameter("¡" + titulo_ranking + "! Entrega de premios: " + fecha_premio + "\nNo hay usuarios clasificados."); }
            else
            {
                alerta.AppendParameter("¡" + titulo_ranking + "! Entrega de premios: " + fecha_premio + "\nTu posicion en Ranking: " + mensaje_1 + "\n" + ranking + "");
            }
            Session.SendData(alerta);
        }
        //atributo_sql = a la tabla por la cual se realiza el rankings
        public static void ranking_global(SessionInstance Session, string atributo_sql)
        {
            mysql client = new mysql();
            int limite_registro = 0;
            int posicion_ranking = 0;
            string ranking = "";
            string mensaje_1 = "No entras en Top 100";
            foreach (DataRow row in client.ExecuteQueryTable("SELECT * FROM usuarios WHERE " + atributo_sql + " > 0 ORDER BY " + atributo_sql + " desc").Rows)
            {
                if (limite_registro < 100)
                {
                    posicion_ranking++;
                    if (Session.User.id == (int)row["id"])
                    {
                        int puntos_usuario = (int)row[atributo_sql];
                        Console.WriteLine(puntos_usuario);
                        mensaje_1 = "Top " + posicion_ranking + " - Puntos: " + puntos_usuario + "";
                    }
                    ranking = ranking + "" + posicion_ranking + ". Usuario: " + (string)row["nombre"] + " - puntos: " + (int)row[atributo_sql] + "\n";
                    limite_registro++;
                }
            }
            string titulo_ranking = "Error";
            if (atributo_sql == "toneos_ring") { titulo_ranking = "Ranking Global Torneos Ring"; }
            if (atributo_sql == "rings_ganados") { titulo_ranking = "Ranking Global Ring"; }
            if (atributo_sql == "uppers_enviados") { titulo_ranking = "Ranking Global Uppers"; }
            ServerMessage alerta = new ServerMessage();
            alerta.AddHead(183);
            alerta.AppendParameter("¡" + titulo_ranking + "!\nTu posicion en Ranking: " + mensaje_1 + "\n" + ranking + "");
            Session.SendData(alerta);
        }
        public static void start_new_event(SalaInstance Sala)
        {
            mysql client = new mysql();
            DataRow look_later_event = client.ExecuteQueryRow("SELECT * FROM escenarios_publicos");
            int evento_type = (int)look_later_event["ultimo_evento"];
            if (evento_type == 1) { Sala.Escenario.tipo_evento = 2; }
            else if (evento_type == 2) { Sala.Escenario.tipo_evento = 1; }
            else
            {
                Sala.Escenario.tipo_evento = 2;
            }
            Sala.Escenario.proximo_evento = Time.GetCurrentAndAdd(AddType.Dias, 7);//7
            Sala.Escenario.tiempo_evento = Time.GetCurrentAndAdd(AddType.Dias, 3);//3
            foreach (var all_areas in SalasManager.Salas_Publicas.Values)
            {
                all_areas.Escenario.tipo_evento = Sala.Escenario.tipo_evento;
            }
            update_escenarios(Sala, false);
            Publicar_Noticia_Evento_Semanal("", "", "");
            Output.WriteLine("[BoomBang Manager] -> Nuevo evento ha sido iniciado.");
        }
        public static void end_event(SalaInstance Sala)
        {
            recompenas_manager(Sala, true);
            foreach(SalaInstance Sala2 in SalasManager.Salas_Publicas.Values)
            {
                Sala2.Escenario.tipo_evento = 0;
                Sala2.Escenario.tiempo_evento = 0;
            }
            update_escenarios(Sala, true);
            Output.WriteLine("[BoomBang Manager] -> Ha terminado el evento semanal.");
        }
        public static void rankings_time_remove(SalaInstance Sala)
        {
            mysql client = new mysql();
            Sala.Escenario.ranking_semanal = Time.GetCurrentAndAdd(AddType.Dias, 7);
            client.ExecuteNonQuery("UPDATE escenarios_publicos SET ranking_semanal = '" + Sala.Escenario.ranking_semanal + "'");
            recompenas_manager(Sala, false);
            Output.WriteLine("[BoomBang Manager] -> Ha terminado semanal de Minijuegos.");
        }
        static void recompenas_manager(SalaInstance Sala, bool tipo)// true > evento | false > juegos_semanales
        {
            mysql client = new mysql();
            int top_ranking_evento = 0;
            int top_ranking_game = 0;
            if (tipo == true)
            {
                if (Sala.Escenario.tipo_evento == 1)//Coco
                {
                    foreach (DataRow row in client.ExecuteQueryTable("SELECT * FROM rankings WHERE id_ranking = 6 ORDER BY puntos desc").Rows)
                    {
                        if (top_ranking_evento < 4) { top_ranking_evento++; }
                        if (top_ranking_evento == 1) { entrega_trofeos((int)row["id_usuario"], 342, top_ranking_evento); }//Trofeo Coco Oro
                        if (top_ranking_evento == 2) { entrega_trofeos((int)row["id_usuario"], 343, top_ranking_evento); }//Trofeo Coco Plata
                        if (top_ranking_evento == 3) { entrega_trofeos((int)row["id_usuario"], 341, top_ranking_evento); }//Trofeo Coco Bronze
                    }
                }
                if (Sala.Escenario.tipo_evento == 2)//Shuriken
                {
                    foreach (DataRow row in client.ExecuteQueryTable("SELECT * FROM rankings WHERE id_ranking = 6 ORDER BY puntos desc").Rows)
                    {
                        if (top_ranking_evento < 4) { top_ranking_evento++; }
                        if (top_ranking_evento == 1) { entrega_trofeos((int)row["id_usuario"], 1145, top_ranking_evento); }//Trofeo Estrella Oro
                        if (top_ranking_evento == 2) { entrega_trofeos((int)row["id_usuario"], 1146, top_ranking_evento); }//Trofeo Estrella Plata
                        if (top_ranking_evento == 3) { entrega_trofeos((int)row["id_usuario"], 1144, top_ranking_evento); }//Trofeo Estrella Bronze
                    }
                }
                top_ranking_evento = 0;
                Publicar_Noticia_Evento_Semanal(nombre_Top1, nombre_Top2, nombre_Top3);
                client.ExecuteNonQuery("DELETE FROM rankings WHERE id_ranking = 6");
                Output.WriteLine("[BoomBang Manager] -> Los premios han sido entregados.");
            }
            if (tipo == false)
            {
                foreach (DataRow row in client.ExecuteQueryTable("SELECT * FROM rankings WHERE id_ranking = 1 AND tipo_ranking = 2 ORDER BY puntos desc").Rows)//Golden Ring
                {
                    if (top_ranking_game < 4) { top_ranking_game++; }
                    if (top_ranking_game == 1) { entrega_trofeos((int)row["id_usuario"], 1071, top_ranking_game); }//Trofeo Upper Oro
                    if (top_ranking_game == 2) { entrega_trofeos((int)row["id_usuario"], 1072, top_ranking_game); }//Trofeo Upper Plata
                    if (top_ranking_game == 3) { entrega_trofeos((int)row["id_usuario"], 1070, top_ranking_game); }//Trofeo Upper Bronze         
                }
                top_ranking_game = 0;
                foreach (DataRow row in client.ExecuteQueryTable("SELECT * FROM rankings WHERE id_ranking = 2 AND tipo_ranking = 2 ORDER BY puntos desc").Rows)//Golden Coco
                {
                    if (top_ranking_game < 4) { top_ranking_game++; }
                    if (top_ranking_game == 1) { entrega_trofeos((int)row["id_usuario"], 342, top_ranking_game); }//Trofeo Coco Oro
                    if (top_ranking_game == 2) { entrega_trofeos((int)row["id_usuario"], 343, top_ranking_game); }//Trofeo Coco Plata
                    if (top_ranking_game == 3) { entrega_trofeos((int)row["id_usuario"], 341, top_ranking_game); }//Trofeo Coco Bronze
                }
                top_ranking_game = 0;
                foreach (DataRow row in client.ExecuteQueryTable("SELECT * FROM rankings WHERE id_ranking = 3 AND tipo_ranking = 2 ORDER BY puntos desc").Rows)//Golden Sendero
                {
                    ///Trofeos lianas de oro
                    if (top_ranking_game < 4) { top_ranking_game++; }
                    if (top_ranking_game == 1) { entrega_trofeos((int)row["id_usuario"], 629, top_ranking_game); }//Trofeo Liana Oro
                    if (top_ranking_game == 2) { entrega_trofeos((int)row["id_usuario"], 630, top_ranking_game); }//Trofeo Liana Plata
                    if (top_ranking_game == 3) { entrega_trofeos((int)row["id_usuario"], 628, top_ranking_game); }//Trofeo Liana Bronze
                }
                top_ranking_game = 0;
                ///Entrega en oro
                foreach (DataRow row in client.ExecuteQueryTable("SELECT * FROM rankings WHERE id_ranking = 1 AND tipo_ranking = 1 ORDER BY puntos desc").Rows)//Silver Ring
                {
                    if (top_ranking_game < 4) { top_ranking_game++; }
                    if (top_ranking_game == 1) { entrega_recompensa_oro((int)row["id_usuario"], 8000); }
                    if (top_ranking_game == 2) { entrega_recompensa_oro((int)row["id_usuario"], 6500); }
                    if (top_ranking_game == 3) { entrega_recompensa_oro((int)row["id_usuario"], 4500); }
                }
                top_ranking_game = 0;
                foreach (DataRow row in client.ExecuteQueryTable("SELECT * FROM rankings WHERE id_ranking = 5 ORDER BY puntos desc").Rows)//Upper
                {
                    if (top_ranking_game < 4) { top_ranking_game++; }
                    if (top_ranking_game == 1) { entrega_recompensa_oro((int)row["id_usuario"], 5000); }
                    if (top_ranking_game == 2) { entrega_recompensa_oro((int)row["id_usuario"], 4000); }
                    if (top_ranking_game == 3) { entrega_recompensa_oro((int)row["id_usuario"], 3000); }
                }
                top_ranking_game = 0;
                Publicar_Noticia_Upper_Semanal(nombre_Top1, nombre_Top2, nombre_Top3);
                client.ExecuteNonQuery("DELETE FROM rankings WHERE id_ranking = 1");
                client.ExecuteNonQuery("DELETE FROM rankings WHERE id_ranking = 2");
                client.ExecuteNonQuery("DELETE FROM rankings WHERE id_ranking = 3");
                client.ExecuteNonQuery("DELETE FROM rankings WHERE id_ranking = 5");
                Output.WriteLine("[BoomBang Manager] -> Los premios de Minijuegos han sido entregados.");
            }
        }
        static void entrega_trofeos(int usuario_id, int id_objeto, int Top)
        {
            mysql client = new mysql();
            client.SetParameter("id", usuario_id);
            DataRow usuario = client.ExecuteQueryRow("SELECT * FROM usuarios WHERE id = @id");
            if (usuario != null)
            {
                if (Top == 1) { nombre_Top1 = (string)usuario["nombre"]; }
                if (Top == 2) { nombre_Top2 = (string)usuario["nombre"]; }
                if (Top == 3) { nombre_Top3 = (string)usuario["nombre"]; }
                client.SetParameter("objeto_id", id_objeto);
                DataRow item_id_objeto = client.ExecuteQueryRow("SELECT * FROM objetos WHERE id = @objeto_id");
                if (item_id_objeto != null)
                {
                    CatalogObjectInstance item = new CatalogObjectInstance(item_id_objeto);
                    client.SetParameter("item_id", id_objeto);
                    client.SetParameter("userid", (int)usuario["id"]);
                    client.SetParameter("hex", "");
                    client.SetParameter("rgb", "");
                    client.SetParameter("tam", "tam_n");
                    client.SetParameter("default_data", 0);
                    client.ExecuteNonQuery("INSERT INTO objetos_comprados (`objeto_id`, `colores_hex`, `colores_rgb`, `usuario_id`, `tam`, `data`) VALUES (@item_id, @hex, @rgb, @userid, @tam, @default_data)");
                    foreach (SessionInstance Session in UserManager.UsuariosOnline.Values)
                    {
                        if (Session.User.id == (int)usuario["id"])
                        {
                            SessionInstance OtherSession = UserManager.ObtenerSession((int)usuario["id"]);
                            client.SetParameter("id", id_objeto);
                            client.SetParameter("UserID", OtherSession.User.id);
                            int compra_id = int.Parse(Convert.ToString(client.ExecuteScalar("SELECT MAX(id) FROM objetos_comprados WHERE objeto_id = @id AND usuario_id = @UserID")));
                            Packet_189_139(OtherSession, item, compra_id, 1, "tam_n");
                        }
                    }
                }
            }
        }
        static void entrega_recompensa_oro(int usuario_id, int Oro)
        {
            mysql client = new mysql();
            client.SetParameter("id", usuario_id);
            DataRow usuario = client.ExecuteQueryRow("SELECT * FROM usuarios WHERE id = @id");
            if (usuario != null)
            {
                bool usuario_online = false;
                foreach (SessionInstance Session in UserManager.UsuariosOnline.Values)
                {
                    if (Session.User.id == (int)usuario["id"])
                    {
                        SessionInstance OtherSession = UserManager.ObtenerSession((int)usuario["id"]);
                        UserManager.Creditos(OtherSession.User, true, true, Oro);
                        usuario_online = true;
                    }
                }
                if (usuario_online == false)
                {
                    client.SetParameter("user_id", (int)usuario["id"]);
                    client.SetParameter("oro", (int)usuario["oro"] + Oro);
                    client.ExecuteNonQuery("UPDATE usuarios SET oro = @oro WHERE id = @user_id");
                }
            }
        }
        static void update_escenarios(SalaInstance Sala, bool final_evento)
        {
            mysql client = new mysql();
            if (final_evento == false)
            {
                client.SetParameter("ultimo_evento", Sala.Escenario.tipo_evento);
            }
            else
            {
                DataRow escenario_publico = client.ExecuteQueryRow("SELECT * FROM escenarios_publicos");
                client.SetParameter("ultimo_evento", (int)escenario_publico["ultimo_evento"]);
            }
            client.SetParameter("proximo_evento", Sala.Escenario.proximo_evento);
            client.SetParameter("tiempo_evento", Sala.Escenario.tiempo_evento);
            client.SetParameter("tipo_evento", Sala.Escenario.tipo_evento);
            client.ExecuteNonQuery("UPDATE escenarios_publicos SET proximo_evento = @proximo_evento, tiempo_evento = @tiempo_evento , " +
                "tipo_evento = @tipo_evento, ultimo_evento = @ultimo_evento");
        }
        static void Publicar_Noticia_Upper_Semanal(string Top1, string Top2, string Top3)
        {
            mysql client = new mysql();
            int count = 1;
            foreach (var Sala in SalasManager.Salas_Publicas.Values)
            {
                if (count > 0)
                {
                    Noticia_Query(client, "¡Resultados Upper Semanal!", "Gracias a todos los usuarios que participaron en el semanal de Uppers." +
                   "\rLos ganadores de la semana fueron\r\r1. " + Top1 + "\r2. " + Top2 + "\r3. " + Top3 + "\r" +
                   "\rUsa comando /upper_semanal para ver el Ranking.");
                    nombre_Top1 = ""; nombre_Top2 = ""; nombre_Top3 = "";
                    Output.WriteLine("[BoomBang Manager] -> La noticia ha sido publicada.");
                    count--;
                }
               
            }
            client.ExecuteNonQuery("UPDATE usuarios SET novedades_noticias = 1");
        }
        static void Publicar_Noticia_Evento_Semanal(string Top1, string Top2, string Top3)
        {
            mysql client = new mysql();
            int count = 1;
            foreach (var Sala in SalasManager.Salas_Publicas.Values)
            {
                if (count > 0)
                {
                    if (Sala.Escenario.tipo_evento == 1 && Time.GetDifference(Sala.Escenario.tiempo_evento) > 0)
                    {
                        Noticia_Query(client, "¡Regresa evento de Cocos!", "Qué está pasando? Aparecen cocos en todas áreas del BoomBang.\r" +
                            "\rAtrapa los cocos que caen en todas las salas durante 3 días\rCada coco atrapado te suma +1 punto en cocosLocos." +
                            "\rAtrapa cocos que caen en areas para desbloquear nuevos cocos!\r\rEvento acaba: " + DateTime.Now.AddDays(3) + "" +
                            "\rEscribe en chat /evento para ver el ranking.");
                    }
                    if (Sala.Escenario.tipo_evento == 2 && Time.GetDifference(Sala.Escenario.tiempo_evento) > 0)
                    {
                        Noticia_Query(client, "¡Regresa evento de Shurikens!", "Qué está pasando? Aparecen shurikens en todas áreas del BoomBang.\r" +
                            "\rAtrapa los shurikens que caen en todas las salas durante 3 días\rCada shuriken atrapado te suma +1 punto en nivelNinja." +
                            "\rAtrapa shurikens que caen en areas para desbloquear el traje Ninja!\r\rEvento acaba: " + DateTime.Now.AddDays(3) + "" +
                            "\rEscribe en chat /evento para ver el ranking.");
                    }
                    if (Time.GetDifference(Sala.Escenario.tiempo_evento) <= 0 && Sala.Escenario.tipo_evento == 2)
                    {
                        Noticia_Query(client, "¡Resultados evento de Shurikens!", "Gracias a todos los usuarios que participaron en el evento de Shurikens." +
                            "\rLos ganadores del evento fueron\r\r1. " + Top1 + "\r2. " + Top2 + "\r3. " + Top3 + "\r" +
                            "\rLos premios se guardan en la mochila automáticamente.");
                    }
                    if (Time.GetDifference(Sala.Escenario.tiempo_evento) <= 0 && Sala.Escenario.tipo_evento == 1)
                    {
                        Noticia_Query(client, "¡Resultados evento de Coco!", "Gracias a todos los usuarios que participaron en el evento de Coco." +
                            "\rLos ganadores del evento fueron\r\r1. " + Top1 + "\r2. " + Top2 + "\r3. " + Top3 + "\r" +
                            "\rLos premios se guardan en la mochila automáticamente.");
                    }
                    client.ExecuteNonQuery("UPDATE usuarios SET novedades_noticias = 1");
                    nombre_Top1 = ""; nombre_Top2 = ""; nombre_Top3 = "";
                    Output.WriteLine("[BoomBang Manager] -> La noticia ha sido publicada.");
                    count--;
                }
            }
        }
        static void Noticia_Query(mysql client, string titulo, string contenido)
        {
            client.SetParameter("titulo", titulo);
            client.SetParameter("contenido", contenido);
            client.SetParameter("tipo_plantilla", 3);
            client.SetParameter("url_1", "");
            client.SetParameter("fecha", DateTime.Now.Year + "-" + DateTime.Now.Month + "-" + DateTime.Now.Day);
            client.ExecuteNonQuery("INSERT INTO noticias (`titulo`, `contenido`, `tipo_plantilla`, `url_1`, `fecha`) " +
                "VALUES (@titulo, @contenido, @tipo_plantilla, @url_1, @fecha)");
        }
        static void Packet_189_139(SessionInstance Session, CatalogObjectInstance item, int compra_id, int Cantidad, string tam)
        {
            ServerMessage server = new ServerMessage();
            server.AddHead(189);
            server.AddHead(139);
            server.AppendParameter(compra_id);
            server.AppendParameter(item.id);
            server.AppendParameter(item.colores_hex);
            server.AppendParameter(item.colores_rgb);
            server.AppendParameter(0);
            server.AppendParameter(0);
            server.AppendParameter(tam);
            server.AppendParameter(item.espacio_ocupado_n);
            server.AppendParameter(0);
            server.AppendParameter(0);
            server.AppendParameter(Cantidad);
            Session.SendData(server);
        }
    }
}
