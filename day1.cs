using System;
using System.Collections.Generic;
using System.IO;
using System.Text.RegularExpressions;

namespace day1
{
    internal class Program
    {
        static void Main(string[] args)
        {
            string input = @"day1.txt";
            if (File.Exists(input))
            {
                string readInput = File.ReadAllText(input);
                string[] vrstica = Regex.Split(readInput, "\n");
                List<int> stolpec1 = new List<int>();
                List<int> stolpec2 = new List<int>();
                foreach (string v in vrstica)
                {
                    var razbito = Regex.Split(v, "   ");
                    stolpec1.Add(Int32.Parse(razbito[0].Trim()));
                    if (razbito.Length > 1)
                    {
                        stolpec2.Add(Int32.Parse(razbito[1].Trim()));
                    }
                }
                stolpec1.Sort();
                stolpec2.Sort();
                //part 1
                var sestevek = 0;
                for (int i = 0; i < stolpec1.Count; i++)
                {
                    sestevek += Math.Abs(stolpec1[i] - stolpec2[i]);
                }
                Console.WriteLine("part 1:" + sestevek);

                //part 2
                var sestevek2 = 0;
                for(int i=0; i< stolpec1.Count; i++)
                {
                    int skupaj = 0;
                    for(int j = 0; j < stolpec2.Count; j++)
                    {
                        if (stolpec1[i] == stolpec2[j])
                        {
                            skupaj++;
                        }
                    }
                    sestevek2 += (skupaj * stolpec1[i]);
                }
                Console.WriteLine("part 2:" + sestevek2);
            }
            else
            {
                Console.WriteLine("datoteka ne obstaja");
            }
        }
    }
}
