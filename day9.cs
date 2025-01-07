using System;
using System.Collections.Generic;
using System.IO;
using System.Linq;

namespace day9
{
    internal class Program
    {
        public static List<string> Menjaj(List<string> zapis)
        {
            int stevilka = zapis.Count;
            for (int i = 0; i < stevilka; i++)
            {
                for (int j = zapis.Count - 1; j >= 0; j--)
                {
                    if (zapis[j] == "." && j > i)
                    {
                        continue;
                    }
                    else if (zapis[i] == ".")
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
            for (int i = 0; i < zapis.Count; i++)
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
                List<string> zapis = new List<string>();
                List<string> zapis2 = new List<string>();
                Dictionary<int, int> stMest = new Dictionary<int, int>();
                for (int i = 0; i < readInput.Length; i++)
                {
                    if (i % 2 == 1)
                    {
                        for (int j = 0; j < Int32.Parse(readInput[i].ToString()); j++)
                        {
                            zapis.Add(".");
                            zapis2.Add(".");
                        }
                    }
                    else
                    {
                        for (int j = 0; j < Int32.Parse(readInput[i].ToString()); j++)
                        {
                            zapis.Add(stevec.ToString());
                            zapis2.Add(stevec.ToString());
                        }
                        stMest[stevec] = Int32.Parse(readInput[i].ToString());
                        stevec++;
                    }
                }
                zapis = Menjaj(zapis);
                Console.WriteLine("part 1:" + Sestej(zapis));

                //part 2 - sloooow code, need to improve it
                foreach (var s in stMest.OrderByDescending(vnos => vnos.Key))
                {
                    stMest.Remove(s.Key);
                    for(int i = 0; i < zapis2.Count; i++)
                    {
                        if (zapis2[i] == ".")
                        {
                            bool menjaj = false;
                            for(int j = 0; j < s.Value; j++)
                            {
                                if (i + j < zapis2.Count && zapis2[i+j] == ".")
                                {
                                    menjaj = true;
                                    continue;
                                }else
                                {
                                    menjaj = false;
                                    break;
                                }
                            }
                            if(menjaj)
                            {
                                for(int j = 0; j < s.Value; j++)
                                {
                                    zapis2[i+j] = s.Key.ToString();
                                }
                                for(int j= zapis2.Count - 1; j >= 0; j--)
                                {
                                    if (zapis2[j] == s.Key.ToString())
                                    {
                                        for(int k = 0; k < s.Value; k++)
                                        {
                                            zapis2[j - k] = ".";
                                        }
                                        break;
                                    }
                                }
                            }
                        }
                    }
                }
                foreach(var s in zapis2)
                {
                    Console.Write(s);
                }
                Console.WriteLine("part 2:" + Sestej(zapis2));
            }
        }
    }
}
