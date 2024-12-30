using System;
using System.IO;
using System.Text.RegularExpressions;

namespace day2
{
    internal class Program
    {
        static void Main(string[] args)
        {
            string input = @"day2.txt";
            if (File.Exists(input))
            {
                string readInput = File.ReadAllText(input);
                string[] vrstica = Regex.Split(readInput, "\n");
                int varni = 0;
                foreach (var v in vrstica)
                {
                    var razbito = v.Split(' ');
                    var smer = "";
                    var menjava = 0;
                    int ok = 0;
                    for (int i = 0; i < razbito.Length-1; i++)
                    {

                        if (Int32.Parse(razbito[i]) < Int32.Parse(razbito[i+1]))
                        {
                            if(smer != "dol")
                            {
                                smer = "dol";
                                menjava++;
                            }

                        }else
                        {
                            if(smer != "gor")
                            {
                                smer = "gor";
                                menjava++;
                            }
                        }
                        if(menjava == 1)
                        {
                            if (Math.Abs(Int32.Parse(razbito[i]) - Int32.Parse(razbito[i + 1])) == 1 || Math.Abs(Int32.Parse(razbito[i]) - Int32.Parse(razbito[i + 1])) == 2 || Math.Abs(Int32.Parse(razbito[i]) - Int32.Parse(razbito[i + 1])) == 3)
                            {
                                ok++;
                            }
                        }else
                        {
                            break;
                        }
                    }
                    if(ok == razbito.Length-1)
                    {
                        varni++;
                    }
                }
                Console.WriteLine("part 1: " + varni);
            }
            else
            {
                Console.WriteLine("datoteka ne obstaja");
            }
        }
    }
}
