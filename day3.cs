using System;
using System.IO;
using System.Text.RegularExpressions;

namespace day3
{
    internal class Program
    {
        //function for searching and calculating passed string
        public static int Iskanje(string input)
        {
            //regex for mul(number, number)
            string pattern = @"mul\(\d+,\d+\)";
            Regex iskanje = new Regex(pattern);
            var podatki = iskanje.Matches(input);
            //regex for numbers
            string stevilke = @"\d+";
            Regex vStevilke = new Regex(stevilke);
            var skupaj = 0;
            foreach (Match v in podatki)
            {
                var stevilo = vStevilke.Matches(v.Value); //finding numbers
                skupaj += Int32.Parse(stevilo[0].Value) * Int32.Parse(stevilo[1].Value); //multiplying and adding numbers to total
            }
            return skupaj;
        }
        static void Main(string[] args)
        {
            string input = @"day3.txt";
            if (File.Exists(input))
            {
                string readInput = File.ReadAllText(input);
                //part 1
                var skupaj = 0;
                skupaj += Iskanje(readInput);
                Console.WriteLine("part 1:"+ skupaj);
                //part 2
                int skupaj2 = 0;
                //pattern for spliting don't()
                string vzorec = @"don't\(\)";
                var podatki2 = Regex.Split(readInput, vzorec);
                //adding values until first don't() to total
                skupaj2 += Iskanje(podatki2[0]);
                for(var i=1; i < podatki2.Length; i++) 
                {
                    //searching if splited string contains do()
                    if (podatki2[i].Contains("do()"))
                    {
                        //spliting do()
                        var podatki3 = Regex.Split(podatki2[i], @"do\(\)");
                        //looping trough splited values starting with 1, because 1'st value - 0 is still under don't()
                        for(var j = 1; j < podatki3.Length; j++)
                        {
                            //searching and adding numbers with function
                            skupaj2 += Iskanje(podatki3[j]);
                        }
                    }
                }
                Console.WriteLine("part 2:" + skupaj2);
            }
            else
            {
                Console.WriteLine("datoteka ne obstaja!");
            }
        }
    }
}
