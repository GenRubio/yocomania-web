using BoomBang.game.instances;
using BoomBang.server;
using System;
using System.Collections.Generic;
using System.Data;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace BoomBang.game.manager
{
    class BuyObjectDAO
    {
        public static int getTotalElements(int salaId)
        {
            int count = 0;
            mysql client = new mysql();
            client.SetParameter("Id", salaId);
            foreach (DataRow row in client.ExecuteQueryTable("SELECT * FROM objetos_comprados WHERE sala_id = @Id").Rows)
            {
                count++;
            }
            return count;
        }
        
    }
}
