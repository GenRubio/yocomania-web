using BoomBang.game.instances;
using System;
using System.Collections.Generic;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace BoomBang.game.manager.pathfinding
{
    public class SearchParameters
    {
        public Point StartLocation { get; set; }
        public Point EndLocation { get; set; }
        public bool[,] Map { get; set; }
        public SessionInstance Session;
        public SalaInstance Sala;
        public SearchParameters(Point endLocation, SessionInstance Session)
        {
            this.Sala = Session.User.Sala;
            this.StartLocation = new Point(Session.User.Posicion.x, Session.User.Posicion.y);
            this.EndLocation = endLocation;
            //this.Map = Sala.Map.;
        }
    }
}