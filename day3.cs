using System;
using System.IO;
using System.Text.RegularExpressions;

namespace day3
{
    internal class Program
    {
        static void Main(string[] args)
        {
            string input = @"day3.txt";
            if (File.Exists(input))
            {
                string readInput = File.ReadAllText(input);
                //regex for mul(number, number)
                string pattern = @"mul\(\d+,\d+\)";
                Regex iskanje = new Regex(pattern);
                var podatki = iskanje.Matches(readInput);
                //regex for numbers
                string stevilke = @"\d+";
                Regex vStevilke = new Regex(stevilke);
                var skupaj = 0;
                foreach(Match v in podatki)
                {
                    var stevilo = vStevilke.Matches(v.Value); //finding numbers
                    skupaj += Int32.Parse(stevilo[0].Value) * Int32.Parse(stevilo[1].Value); //multiplying and adding numbers to total
                }
                Console.WriteLine("part 1:"+ skupaj);
            }
            else
            {
                Console.WriteLine("datoteka ne obstaja!");
            }
        }
    }
}
