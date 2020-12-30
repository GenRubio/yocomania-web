using System;
using System.Collections.Generic;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace BoomBang.game.instances.manager.pathfinding
{
    public class PathFinder
    {
        public static List<Posicion> FindPath(SalaInstance Sala, SessionInstance Session)
        {
            List<Posicion> path = new List<Posicion>();
            int width = Sala.Map.GetLength(0);
            int height = Sala.Map.GetLength(1);
            Node[,] nodes = new Node[width, height];
            for (int y = 0; y < height; y++)
            {
                for (int x = 0; x < width; x++)
                {
                    nodes[x, y] = new Node(x, y, new Point(Session.User.Trayectoria.EndLocation.X, Session.User.Trayectoria.EndLocation.Y));
                }
            }
            Node startNode = nodes[Session.User.Posicion.x, Session.User.Posicion.y];
            Node endNode = nodes[Session.User.Trayectoria.EndLocation.X, Session.User.Trayectoria.EndLocation.Y];
            bool success = Search(startNode, endNode, width, height, nodes, Sala);
            if (success)
            {
                Node CurrentNode = endNode;
                while (CurrentNode.ParentNode != null)
                {
                    path.Add(new Posicion(CurrentNode.Location.X, CurrentNode.Location.Y));
                    CurrentNode = CurrentNode.ParentNode;
                }
                path.Reverse();
            }
            return path;
        }
        private static bool Search(Node currentNode, Node endNode, int width, int height, Node[,] nodes, SalaInstance Sala)
        {
            currentNode.State = NodeState.Closed;
            List<Node> nextNodes = GetAdjacentWalkableNodes(currentNode, width, height, nodes, Sala);
            nextNodes.Sort((node1, node2) => node1.F.CompareTo(node2.F));
            foreach (var nextNode in nextNodes)
            {
                if (nextNode.Location == endNode.Location)
                {
                    return true;
                }
                else
                {
                    if (Search(nextNode, endNode, width, height, nodes, Sala))
                        return true;
                }
            }
            return false;
        }
        private static List<Node> GetAdjacentWalkableNodes(Node fromNode, int width, int height, Node[,] nodes, SalaInstance Sala)
        {
            List<Node> walkableNodes = new List<Node>();
            IEnumerable<Point> nextLocations = GetAdjacentLocations(fromNode.Location);
            foreach (var location in nextLocations)
            {
                int x = location.X;
                int y = location.Y;

                if (x < 0 || x >= width || y < 0 || y >= height)
                    continue;

                Node node = nodes[x, y];

                if (!Sala.Caminable(new Posicion(node.Location.X, node.Location.Y)))
                    continue;

                if (node.State == NodeState.Closed)
                    continue;

                if (node.State == NodeState.Open)
                {
                    float traversalCost = Node.GetTraversalCost(node.Location, node.ParentNode.Location);
                    float gTemp = fromNode.G + traversalCost;
                    if (gTemp < node.G)
                    {
                        node.ParentNode = fromNode;
                        walkableNodes.Add(node);
                    }
                }
                else
                {
                    node.ParentNode = fromNode;
                    node.State = NodeState.Open;
                    walkableNodes.Add(node);
                }
            }
            return walkableNodes;
        }
        private static IEnumerable<Point> GetAdjacentLocations(Point fromLocation)
        {
            return new Point[]
            {
                new Point(fromLocation.X+1, fromLocation.Y+1),
                new Point(fromLocation.X-1, fromLocation.Y-1),
                new Point(fromLocation.X+1, fromLocation.Y),
                new Point(fromLocation.X, fromLocation.Y+1),
                new Point(fromLocation.X-1, fromLocation.Y),
                new Point(fromLocation.X, fromLocation.Y-1),
                new Point(fromLocation.X+1, fromLocation.Y-1),
                new Point(fromLocation.X-1, fromLocation.Y+1)
            };
        }
    }
    public enum NodeState
    {
        Untested, Open, Closed
    }
    public class Node
    {
        private Node parentNode;
        public Point Location { get; private set; }
        public float G { get; private set; }
        public float H { get; private set; }
        public NodeState State { get; set; }
        public float F
        {
            get { return this.G + this.H; }
        }
        public Node ParentNode
        {
            get { return this.parentNode; }
            set
            {
                this.parentNode = value;
                this.G = this.parentNode.G + GetTraversalCost(this.Location, this.parentNode.Location);
            }
        }

        public Node(int x, int y, Point endLocation)
        {
            this.Location = new Point(x, y);
            this.State = NodeState.Untested;
            this.H = GetTraversalCost(this.Location, endLocation);
            this.G = 0;
        }

        public override string ToString()
        {
            return string.Format("{0}, {1}: {2}", this.Location.X, this.Location.Y, this.State);
        }

        internal static float GetTraversalCost(Point newNode, Point end)
        {
            float mHEstimate;
            float deltaX = end.X - newNode.X;
            float deltaY = end.Y - newNode.Y;
            mHEstimate = (float)Math.Sqrt(deltaX * deltaX + deltaY * deltaY);
            return Default(newNode, end, mHEstimate);
        }

        static float Default(Point newNode, Point end, float mHEstimate)
        {
            Point dxy = new Point(Math.Abs(end.X - newNode.X), Math.Abs(end.Y - newNode.Y));
            int Orthogonal = Math.Abs(dxy.X - dxy.Y);
            int Diagonal = Math.Abs(((dxy.X + dxy.Y) - Orthogonal) / 2);
            return (float)mHEstimate * (Diagonal + Orthogonal + dxy.X + dxy.Y);
        }
    }
}
