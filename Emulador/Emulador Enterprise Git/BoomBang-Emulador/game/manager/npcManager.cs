using BoomBang.server;
using System;
using System.Collections.Generic;
using System.Data;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace BoomBang.game.instances.manager
{
    class npcManager
    {
        public static ServerMessage ObtenerNPC(ServerMessage server, int Modelo)
        {
            mysql client = new mysql();
            client.SetParameter("modelo", Modelo);
            server.AppendParameter(client.ExecuteScalar("SELECT COUNT(id) FROM escenarios_npc WHERE EscenarioID = @modelo"));
            client.SetParameter("modelo", Modelo);
            foreach (DataRow row in client.ExecuteQueryTable("SELECT * FROM escenarios_npc WHERE EscenarioID = @modelo").Rows)
            {
                npcInstance NpcData = new npcInstance(row);
                server.AppendParameter(new object[] { NpcData.ID, NpcData.dialogo, NpcData.modelo, NpcData.Nombre, NpcData.Pos.x, 
                    NpcData.Pos.y, NpcData.Pos.z, NpcData.Funcion, NpcData.Funcion_value });
            }
            return server;
        }
    }
}
