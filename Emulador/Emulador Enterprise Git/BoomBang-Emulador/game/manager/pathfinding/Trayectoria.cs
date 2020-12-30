using System;
using System.Collections.Generic;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace BoomBang.game.instances.manager.pathfinding
{
    public class Trayectoria
    {
        public List<Posicion> Movimientos = new List<Posicion>();
        private SessionInstance Session;
        public Point EndLocation;
        public Posicion LastPosicion { get; set; }
        public Trayectoria(SessionInstance Session)
        {
            this.Session = Session;
        }
        public void AñadirMovimiento(int x, int y, int z)
        {
            Movimientos.Add(new Posicion(x, y, z));
        }
        public int MovimientosTotales()
        {
            return Movimientos.Count;
        }
        public void DetenerMovimiento()
        {
            Movimientos.Clear();
        }
        public void IsMovementCorrupt(Posicion NextPoint)
        {
            try
            {
                if (NextPoint.x == Session.User.Posicion.x && NextPoint.y == Session.User.Posicion.y)
                {
                    this.Movimientos.Remove(this.Movimientos[0]);
                }
                if (Session.User.Posicion.x == NextPoint.x && Session.User.Posicion.y == NextPoint.y)
                {
                    this.Movimientos.Remove(this.Movimientos[0]);
                }
                Posicion NextStep = NextPoint;
                UserInstance user = Session.User;
                if (Movimientos.Count >= 1)
                {
                    if (Movimientos.Count >= 1)
                    {
                        if (Session.User.Posicion.x + 2 == NextStep.x)
                        {
                            int Resta = NextStep.x - 1;
                            NextStep.x = Resta;

                        }
                        if (Session.User.Posicion.x - 2 == NextStep.x)
                        {
                            int Resta = NextStep.x + 1;
                            NextStep.x = Resta;
                        }
                        if (Session.User.Posicion.y - 2 == NextStep.y)
                        {
                            int Resta = NextStep.y + 1;
                            NextStep.y = Resta;
                        }
                        if (Session.User.Posicion.y + 2 == NextStep.y)
                        {
                            int Resta = NextStep.y - 1;
                            NextStep.y = Resta;
                        }
                    }
                    if (Movimientos.Count >= 2)
                    {
                        if (Session.User.Posicion.x + 3 == NextStep.x)
                        {
                            int Resta = NextStep.x - 2;
                            NextStep.x = Resta;
                        }
                        if (Session.User.Posicion.x - 3 == NextStep.x)
                        {
                            int Resta = NextStep.x + 2;
                            NextStep.x = Resta;
                        }
                        if (Session.User.Posicion.y - 3 == NextStep.y)
                        {
                            int Resta = NextStep.y + 2;
                            NextStep.y = Resta;
                        }
                        if (Session.User.Posicion.y + 3 == NextStep.y)
                        {
                            int Resta = NextStep.y - 2;
                            NextStep.y = Resta;
                        }
                    }
                    if (Movimientos.Count >= 3)
                    {
                        if (Session.User.Posicion.x + 4 == NextStep.x)
                        {
                            int Resta = NextStep.x - 3;
                            NextStep.x = Resta;
                        }
                        if (Session.User.Posicion.x - 4 == NextStep.x)
                        {
                            int Resta = NextStep.x + 3;
                            NextStep.x = Resta;
                        }
                        if (Session.User.Posicion.y - 4 == NextStep.y)
                        {
                            int Resta = NextStep.y + 3;
                            NextStep.y = Resta;
                        }
                        if (Session.User.Posicion.y + 4 == NextStep.y)
                        {
                            int Resta = NextStep.y - 3;
                            NextStep.y = Resta;
                        }
                    }
                    if (Movimientos.Count >= 4)
                    {
                        if (Session.User.Posicion.x + 5 == NextStep.x)
                        {
                            int Resta = NextStep.x - 4;
                            NextStep.x = Resta;
                        }
                        if (Session.User.Posicion.x - 5 == NextStep.x)
                        {
                            int Resta = NextStep.x + 4;
                            NextStep.x = Resta;
                        }
                        if (Session.User.Posicion.y - 5 == NextStep.y)
                        {
                            int Resta = NextStep.y + 4;
                            NextStep.y = Resta;
                        }
                        if (Session.User.Posicion.y + 5 == NextStep.y)
                        {
                            int Resta = NextStep.y - 4;
                            NextStep.y = Resta;
                        }
                    }
                    if (Movimientos.Count >= 5)
                    {
                        if (Session.User.Posicion.x + 6 == NextStep.x)
                        {
                            int Resta = NextStep.x - 5;
                            NextStep.x = Resta;
                        }
                        if (Session.User.Posicion.x - 6 == NextStep.x)
                        {
                            int Resta = NextStep.x + 5;
                            NextStep.x = Resta;
                        }
                        if (Session.User.Posicion.y - 6 == NextStep.y)
                        {
                            int Resta = NextStep.y + 5;
                            NextStep.y = Resta;
                        }
                        if (Session.User.Posicion.y + 6 == NextStep.y)
                        {
                            int Resta = NextStep.y - 5;
                            NextStep.y = Resta;
                        }
                    }
                    if (Movimientos.Count >= 6)
                    {
                        if (Session.User.Posicion.x + 7 == NextStep.x)
                        {
                            int Resta = NextStep.x - 6;
                            NextStep.x = Resta;
                        }
                        if (Session.User.Posicion.x - 7 == NextStep.x)
                        {
                            int Resta = NextStep.x + 6;
                            NextStep.x = Resta;
                        }
                        if (Session.User.Posicion.y - 7 == NextStep.y)
                        {
                            int Resta = NextStep.y + 6;
                            NextStep.y = Resta;
                        }
                        if (Session.User.Posicion.y + 7 == NextStep.y)
                        {
                            int Resta = NextStep.y - 6;
                            NextStep.y = Resta;
                        }
                    }

                }
                if (Session.User.Posicion.x + 1 == NextPoint.x && Session.User.Posicion.y + 1 == NextPoint.y && NextPoint.z != 1)
                {
                    NextPoint.z = 1;
                }
                else if (Session.User.Posicion.x - 1 == NextPoint.x && Session.User.Posicion.y - 1 == NextPoint.y && NextPoint.z != 2)
                {
                    NextPoint.z = 2;
                }
                else if (Session.User.Posicion.x + 1 == NextPoint.x && Session.User.Posicion.y - 1 == NextPoint.y && NextPoint.z != 3)
                {
                    NextPoint.z = 3;
                }
                else if (Session.User.Posicion.x - 1 == NextPoint.x && Session.User.Posicion.y + 1 == NextPoint.y && NextPoint.z != 4)
                {
                    NextPoint.z = 4;
                }
                else if (Session.User.Posicion.x + 1 == NextPoint.x && Session.User.Posicion.y == NextPoint.y && NextPoint.z != 5)
                {
                    NextPoint.z = 5;
                }
                else if (Session.User.Posicion.x == NextPoint.x && Session.User.Posicion.y - 1 == NextPoint.y && NextPoint.z != 6)
                {
                    NextPoint.z = 6;
                }
                else if (Session.User.Posicion.x == NextPoint.x && Session.User.Posicion.y + 1 == NextPoint.y && NextPoint.z != 7)
                {
                    NextPoint.z = 7;
                }
                else if (Session.User.Posicion.x - 1 == NextPoint.x && Session.User.Posicion.y == NextPoint.y && NextPoint.z != 8)
                {
                    NextPoint.z = 8;
                }
            }
            catch
            {

            }
        }
        public void BuscarOtroSendero()
        {
            List<Posicion> Movimientos = PathFinder.FindPath(Session.User.Sala, Session);
            if (Movimientos != null)
            {
                if (Movimientos.Count >= 1)
                {
                    this.Movimientos = Movimientos;
                }
            }
        }
        public Posicion SiguienteMovimiento()
        {
            Posicion NextStep = Movimientos[0];
            this.Movimientos.Remove(this.Movimientos[0]);
            IsMovementCorrupt(NextStep);
            if (!MovementIsVerifield(NextStep))
            {
                DetenerMovimiento();
                BuscarOtroSendero();
                return null;
            }
            return NextStep;
        }
        public void IniciarCaminado(List<Posicion> Movimientos)
        {
            this.Movimientos = Movimientos;
        }
        public bool MovementIsVerifield(Posicion NextStep)
        {
            if (Session.User.Posicion.x == NextStep.x + 1 && Session.User.Posicion.y == NextStep.y + 1) return true;
            if (Session.User.Posicion.x == NextStep.x - 1 && Session.User.Posicion.y == NextStep.y - 1) return true;
            if (Session.User.Posicion.x == NextStep.x + 1 && Session.User.Posicion.y == NextStep.y - 1) return true;
            if (Session.User.Posicion.x == NextStep.x - 1 && Session.User.Posicion.y == NextStep.y + 1) return true;
            if (Session.User.Posicion.x == NextStep.x - 1 && Session.User.Posicion.y == NextStep.y) return true;
            if (Session.User.Posicion.x == NextStep.x + 1 && Session.User.Posicion.y == NextStep.y) return true;
            if (Session.User.Posicion.x == NextStep.x && Session.User.Posicion.y == NextStep.y + 1) return true;
            if (Session.User.Posicion.x == NextStep.x && Session.User.Posicion.y == NextStep.y - 1) return true;
            return false;
        }
    }
}
