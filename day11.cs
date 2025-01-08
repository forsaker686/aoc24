using System;
using System.Collections.Generic;
using System.IO;

namespace day11
{
    internal class Program
    {
        static void Main(string[] args)
        {
            string input = @"day11.txt";
            if (File.Exists(input))
            {
                string readInput = File.ReadAllText(input);
                var kamni = readInput.Split(' ');
                
                for (int i = 0; i < 25; i++)
                {
                    List<String> vKamni = new List<String>();
                    foreach (var s in kamni)
                    {
                        if (long.Parse(s) == 0)
                        {
                            vKamni.Add("1");
                        }
                        else if (s.Length % 2 == 0)
                        {
                            var polovica = (s.Length / 2);
                            var kamen1 = s.Substring(0, polovica);
                            var kamen2 = s.Substring(polovica);
                            vKamni.Add(long.Parse(kamen1).ToString());
                            vKamni.Add(long.Parse(kamen2).ToString());
                        }
                        else
                        {
                            vKamni.Add((long.Parse(s) * 2024).ToString());
                        }
                    }
                    kamni = vKamni.ToArray();
                }
                Console.WriteLine("part 1:" + kamni.Length);
                
            }
        }
    }
}
