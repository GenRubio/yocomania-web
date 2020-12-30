using MySql.Data.MySqlClient;
using System;
using System.Collections.Generic;
using System.Data;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace BoomBang.server
{
    public class mysql : IDisposable
    {
        private MySqlConnection Connection;
        private MySqlCommand mCommand;
        public mysql()
        {
            this.Connection = new MySqlConnection(GenerateConnectionString());
            this.mCommand = new MySqlCommand();
            Connection.Open();
            mCommand.Connection = Connection;
        }
        public void Dispose()
        {
            mCommand.Connection.Close();
        }
        public void ClearParameters()
        {
            mCommand.Parameters.Clear();
        }
        public void SetParameter(string Key, object Value)
        {
            mCommand.Parameters.Add(new MySqlParameter(Key, Value));
        }
        public void ResetCommand()
        {
            mCommand.CommandText = null;
            ClearParameters();
        }
        public int ExecuteNonQuery(string CommandText)
        {
            try
            {
                mCommand.CommandText = CommandText;
                int Affected = mCommand.ExecuteNonQuery();
                ResetCommand();
                return Affected;
            }
            catch
            {
                return 0;
            }
        }
        public DataSet ExecuteScalarSet(string CommandText)
        {
            try
            {
                DataSet DataSet = new DataSet();
                mCommand.CommandText = CommandText;
                using (MySqlDataAdapter Adapter = new MySqlDataAdapter(mCommand))
                {
                    Adapter.Fill(DataSet);
                }
                ResetCommand();
                return DataSet;
            }
            catch
            {
                return null;
            }
        }

        public DataTable ExecuteQueryTable(string CommandText)
        {
            try
            {
                DataSet DataSet = ExecuteScalarSet(CommandText);
                return DataSet.Tables.Count > 0 ? DataSet.Tables[0] : null;
            }
            catch
            {
                return null;
            }
        }

        public DataRow ExecuteQueryRow(string CommandText)
        {
            try
            {
                DataTable DataTable = ExecuteQueryTable(CommandText);
                return DataTable.Rows.Count > 0 ? DataTable.Rows[0] : null;
            }
            catch
            {
                return null;
            }
        }

        public object ExecuteScalar(string CommandText)
        {
            try
            {
                mCommand.CommandText = CommandText;
                object ReturnValue = mCommand.ExecuteScalar();
                ResetCommand();
                return ReturnValue;
            }
            catch
            {
                return null;
            }
        }
        public static string GenerateConnectionString()
        {
            MySqlConnectionStringBuilder ConnectionStringBuilder = new MySqlConnectionStringBuilder();
            ConnectionStringBuilder.Server = "localhost";
            ConnectionStringBuilder.Port = 3306;
            ConnectionStringBuilder.UserID = "root";
            ConnectionStringBuilder.Password = "";//xulo500013021998Gen
            ConnectionStringBuilder.Database = "boombang_org";//boombang_old
            ConnectionStringBuilder.ConnectionTimeout = 900000;
            return ConnectionStringBuilder.ToString();
        }
    }
}
