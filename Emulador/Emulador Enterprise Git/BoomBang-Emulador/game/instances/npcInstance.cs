using System;
using System.Collections.Generic;
using System.Data;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace BoomBang.game.instances
{
    public class npcInstance
    {
        int mID;
        public int ID { get { return mID; } set { mID = value; } }
        int mmodelo;
        public int modelo { get { return mmodelo; } set { mmodelo = value; } }
        int mdialogo;
        public int dialogo { get { return mdialogo; } set { mdialogo = value; } }
        string mNombre;
        public string Nombre { get { return mNombre; } set { mNombre = value; } }
        Posicion mPos;
        public Posicion Pos { get { return mPos; } set { mPos = value; } }
        int mFuncion;
        public int Funcion { get { return mFuncion; } set { mFuncion = value; } }
        int mFuncion_value;
        public int Funcion_value { get { return mFuncion_value; } set { mFuncion_value = value; } }
        int mEscenarioID;
        public int EscenarioID { get { return mEscenarioID; } set { mEscenarioID = value; } }
        public npcInstance(DataRow Row)
        {
            this.mID = (int)Row["id"];
            this.mmodelo = (int)Row["Modelo"];
            this.mdialogo = (int)Row["dialogo"];
            this.mNombre = (string)Row["nombre"];
            this.mPos = new Posicion((int)Row["x"], (int)Row["y"], (int)Row["texto"]);
            this.mFuncion = (int)Row["function"];
            this.mFuncion_value = (int)Row["function_value"];
            this.mEscenarioID = (int)Row["EscenarioID"];
        }
    }
}
