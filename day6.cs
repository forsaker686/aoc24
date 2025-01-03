using System;
using System.Collections.Generic;
using System.IO;
using System.Text.RegularExpressions;

namespace day6
{

    internal class Program
    {

        static void Main(string[] args)
        {
            string input = @"day6.txt";
            if (File.Exists(input))
            {
                string readInput = File.ReadAllText(input);
                string[] vrstica = Regex.Split(readInput, "\n");
                int y = 0;
                int x = 0;
                for (int i = 0; i < vrstica.Length; i++)
                {
                    for (int j = 0; j < vrstica[i].Length; j++)
                    {
                        if (vrstica[i][j] == '^')
                        {
                            y = i;
                            x = j;
                            break;
                        }
                    }
                }
                List<string> hoja = new List<string>();
                var pot = "gor";
                bool isci = true;
                while (isci)
                {
                    Console.WriteLine($"{y} {x} - {pot}");
                    if (pot == "gor")
                    {
                        if (y - 1 >= 0 && vrstica[y-1][x] != '#')
                        {
                            if (!hoja.Contains(y + "" + x))
                            {
                                hoja.Add(y + "" + x);
                            }
                            y--;
                        }else if (y - 1 >= 0 && vrstica[y-1][x] == '#')
                        {
                            pot = "desno";
                            if (!hoja.Contains(y + "" + x))
                            {
                                hoja.Add(y + "" + x);
                            }
                            x++;
                        }else
                        {
                            if (!hoja.Contains(y + "" + x))
                            {
                                hoja.Add(y + "" + x);
                            }
                            isci = false;
                        }

                    }
                    if(pot == "desno")
                    {
                        if (x + 1 < vrstica[y].Length && vrstica[y][x + 1] != '#')
                        {
                            if (!hoja.Contains(y + "" + x))
                            {
                                hoja.Add(y + "" + x);
                            }
                            x++;
                        }else if (x + 1 < vrstica[y].Length && vrstica[y][x+1] == '#')
                        {
                            pot = "dol";
                            if (!hoja.Contains(y + "" + x))
                            {
                                hoja.Add(y + "" + x);
                            }
                            y++;
                        }else
                        {
                            if (!hoja.Contains(y + "" + x))
                            {
                                hoja.Add(y + "" + x);
                            }
                            isci = false;
                        }
                    }
                    if(pot == "dol")
                    {
                        if (y + 1 < vrstica.Length && vrstica[y + 1][x] != '#')
                        {
                            if (!hoja.Contains(y + "" + x))
                            {
                                hoja.Add(y + "" + x);
                            }
                            y++;
                        }else if (y + 1 < vrstica.Length && vrstica[y + 1][x] == '#')
                        {
                            pot = "levo";
                            if (!hoja.Contains(y + "" + x))
                            {
                                hoja.Add(y + "" + x);
                            }
                            x--;
                        }else
                        {
                            if (!hoja.Contains(y + "" + x))
                            {
                                hoja.Add(y + "" + x);
                            }
                            isci = false;
                        }
                    }
                    if(pot == "levo")
                    {
                        if (x - 1 >= 0 && vrstica[y][x - 1] != '#')
                        {
                            if (!hoja.Contains(y + "" + x))
                            {
                                hoja.Add(y + "" + x);
                            }
                            x--;
                        }else if (x - 1 >= 0 && vrstica[y][x-1] == '#')
                        {
                            pot = "gor";
                            if (!hoja.Contains(y + "" + x))
                            {
                                hoja.Add(y + "" + x);
                            }
                            y--;
                        }else
                        {
                            if (!hoja.Contains(y + "" + x))
                            {
                                hoja.Add(y + "" + x);
                            }
                            isci = false;
                        }
                    }
                }
                Console.WriteLine("part 1:" + hoja.Count);
            }
        }
    }
}
