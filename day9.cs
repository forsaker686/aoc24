using System;
using System.Collections.Generic;
using System.IO;

namespace day9_1
{
    internal class Program
    {
        public static List<string> Menjaj(List<string> zapis)
        {
            int stevilka = zapis.Count;
            for (int i = 0; i < stevilka; i++)
            {
                for (int j = zapis.Count-1; j >= 0; j--)
                {
                    if (zapis[j] == "." && j > i)
                    {
                        continue;
                    }
                    else if(zapis[i] == ".")
                    {
                        var zacasna = zapis[i];
                        zapis[i] = zapis[j];
                        zapis[j] = zacasna;
                        stevilka--;
                        break;
                    }
                }
            }
            return zapis;
        }
        public static long Sestej(List<string> zapis)
        {
            long skupaj = 0;
            for(int i = 0; i < zapis.Count; i++)
            {
                if (zapis[i] != ".")
                {
                    skupaj += (i * Int32.Parse(zapis[i]));
                }
            }
            return skupaj;
        }
        static void Main(string[] args)
        {
            string input = @"day9.txt";
            if (File.Exists(input))
            {
                string readInput = File.ReadAllText(input);
                int stevec = 0;
                List <string> zapis = new List<string>();
                for (int i = 0; i < readInput.Length; i++) 
                {
                    if(i % 2 == 1)
                    {
                        for(int j = 0; j < Int32.Parse(readInput[i].ToString()); j++)
                        {
                            zapis.Add(".");
                        }
                    }else
                    {
                        for (int j = 0; j < Int32.Parse(readInput[i].ToString()); j++)
                        {
                            zapis.Add(stevec.ToString());
                        }
                        stevec++;
                    }
                }
                zapis = Menjaj(zapis);
                Console.WriteLine("part 1:" + Sestej(zapis));
            }
        }
    }
}
