using System;
using System.Collections.Generic;
using System.IO;
using System.Linq;
using System.Text.RegularExpressions;

namespace day6
{

    internal class Program
    {
        public static bool Ovire(string[] mapa, int y, int x, int zY, int zX)
        {
            /* zY in zX = # */
            string pot = "gor";
            var vrstica = mapa[zY];
            var nVrstica = "";           
            for(int i = 0; i < vrstica.Length; i++)
            {
                if(i == zX)
                {
                    nVrstica += '#';
                }else
                {
                    nVrstica += vrstica[i];
                }
            }
            mapa[zY] = nVrstica;
            List<string> obiskane = new List<string>();
            bool loop = false;
            while(true)
            {
                //Console.WriteLine($"{y}, {x} - {pot}");
                string koordinate = $"{y},{x},{pot}";
                if(obiskane.Contains(koordinate))
                {
                    mapa[zY] = vrstica;
                    loop = true;
                    break;
                }
                obiskane.Add(koordinate);
                if(x-1 < 0 || x+1 == mapa[y].Trim().Length || y-1 < 0 || y+1 == mapa.Length)
                {
                    mapa[zY] = vrstica;
                    break;
                }
                if(pot == "gor")
                {
                    if (mapa[y - 1][x] != '#')
                    {
                        y--;
                    }else if (mapa[y - 1][x] == '#')
                    {
                        pot = "desno";
                        x++;
                    }
                }
                if(pot == "desno")
                {
                    if ( mapa[y][x+1] != '#')
                    {
                        x++;
                    }else if ( mapa[y][x+1] == '#')
                    {
                        pot = "dol";
                        y++;
                    }
                }
                if(pot == "dol")
                {
                    if (mapa[y + 1][x] != '#')
                    {
                        y++;
                    }else if (mapa[y+1][x] == '#')
                    {
                        pot = "levo";
                        x--;
                    }
                }
                if(pot == "levo")
                {
                    if ( mapa[y][x-1] != '#')
                    {
                        x--;
                    }else if ( mapa[y][x-1] == '#')
                    {
                        pot = "gor";
                        y--;
                    }
                }
            }
            mapa[zY] = vrstica;
            return loop;
        }

        static void Main(string[] args)
        {
            string input = @"day6.txt";
            if (File.Exists(input))
            {
                string readInput = File.ReadAllText(input);
                string[] vrstica = Regex.Split(readInput.Trim(), "\n");
                int y = 0; 
                int zY = 0;
                int x = 0; 
                int zX = 0;
                for (int i = 0; i < vrstica.Length; i++)
                {
                    for (int j = 0; j < vrstica[i].Length; j++)
                    {
                        if (vrstica[i][j] == '^')
                        {
                            y = i;
                            x = j;
                            zY = i;
                            zX = j;
                            break;
                        }
                    }
                }
                List<string> hoja = new List<string>();
                List<string> mapa = new List<string>();
                var pot = "gor";
                bool isci = true;
                while (isci)
                {
                    mapa.Add(y +","+ x +","+ pot);
                    if (pot == "gor")
                    {
                        if (y - 1 >= 0 && vrstica[y-1][x] != '#')
                        {
                            if (!hoja.Contains(y + " " + x))
                            {
                                hoja.Add(y + " " + x);
                            }
                            y--;
                        }else if (y - 1 >= 0 && vrstica[y-1][x] == '#')
                        {
                            pot = "desno";
                            if (!hoja.Contains(y + " " + x))
                            {
                                hoja.Add(y + " " + x);
                            }
                            x++;
                        }else
                        {
                            if (!hoja.Contains(y + " " + x))
                            {
                                hoja.Add(y + " " + x);
                            }
                            isci = false;
                        }

                    }
                    if(pot == "desno")
                    {
                        if (x + 1 < vrstica[y].Length && vrstica[y][x + 1] != '#')
                        {
                            if (!hoja.Contains(y + " " + x))
                            {
                                hoja.Add(y + " " + x);
                            }
                            x++;
                        }else if (x + 1 < vrstica[y].Length && vrstica[y][x+1] == '#')
                        {
                            pot = "dol";
                            if (!hoja.Contains(y + " " + x))
                            {
                                hoja.Add(y + " " + x);
                            }
                            y++;
                        }else
                        {
                            if (!hoja.Contains(y + " " + x))
                            {
                                hoja.Add(y + " " + x);
                            }
                            isci = false;
                        }
                    }
                    if(pot == "dol")
                    {
                        if (y + 1 < vrstica.Length && vrstica[y + 1][x] != '#')
                        {
                            if (!hoja.Contains(y + " " + x))
                            {
                                hoja.Add(y + " " + x);
                            }
                            y++;
                        }else if (y + 1 < vrstica.Length && vrstica[y + 1][x] == '#')
                        {
                            pot = "levo";
                            if (!hoja.Contains(y + " " + x))
                            {
                                hoja.Add(y + " " + x);
                            }
                            x--;
                        }else
                        {
                            if (!hoja.Contains(y + " " + x))
                            {
                                hoja.Add(y + " " + x);
                            }
                            isci = false;
                        }
                    }
                    if(pot == "levo")
                    {
                        if (x - 1 >= 0 && vrstica[y][x - 1] != '#')
                        {
                            if (!hoja.Contains(y + " " + x))
                            {
                                hoja.Add(y + " " + x);
                            }
                            x--;
                        }else if (x - 1 >= 0 && vrstica[y][x-1] == '#')
                        {
                            pot = "gor";
                            if (!hoja.Contains(y + " " + x))
                            {
                                hoja.Add(y + " " + x);
                            }
                            y--;
                        }else
                        {
                            if (!hoja.Contains(y + " " + x))
                            {
                                hoja.Add(y + " " + x);
                            }
                            isci = false;
                        }
                    }
                }
                Console.WriteLine("part 1:" + hoja.Count);
                
                //part 2
                y = zY;
                x = zX;
                int ovire = 0;
                foreach (var m in hoja)
                {
                    //Console.WriteLine(m);
                    var koordinate = m.Split(' ');
                    zY = Int32.Parse(koordinate[0]);
                    zX = Int32.Parse(koordinate[1]);
                    //pot = koordinate[2];
                    if (zX == x && zY == y || vrstica[zY][zX] == '#')
                    {
                        continue;
                    }
                    if (Ovire(vrstica, y, x, zY, zX))
                    {
                        ovire++;
                    }
                }
                Console.WriteLine("part 2:" + ovire);
            }
        }
    }
}
