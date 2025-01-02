using System;
using System.Collections.Generic;
using System.IO;
using System.Text.RegularExpressions;

namespace day5
{
    internal class Program
    {
        //method for checking and ordering
        public static int PreveriUredi(string[] navodila, string stevilke, int part)
        {
           string[] stevila = stevilke.Split(','); //spliting numbers
            List<int> stevil = new List<int>();
            foreach(var s in stevila) //loop trough numbers and adding them to list
            {
                stevil.Add(Int32.Parse(s));
            }
            var stSprememb = 1;
            var spremenjenih = 0;
            while(stSprememb > 0)
            {
                stSprememb = 0;
                foreach (var n in navodila)
                {
                    var navodilo = n.Split('|'); //spliting instructions
                    var x = Int32.Parse(navodilo[0]); //int x
                    var y = Int32.Parse(navodilo[1].Trim()); //int y
                    if (stevil.Contains(x) && stevil.Contains(y)) //checking if list contains both numbers
                    {
                        var indexY = stevil.IndexOf(y); //searching for index of number y
                        int indexX = stevil.IndexOf(x); //seraching for index of number x
                        if(indexY < indexX) //if y is before x, switching positions
                        {
                            stevil[indexY] = x;
                            stevil[indexX] = y;
                            stSprememb++; //incresing that loop will go trough at least one more time
                            spremenjenih++; //for part 1 we need to check if numbers order was changed
                        }
                    }
                }
            }
            if (part == 1)
            {
                if (spremenjenih == 0) //if numbers order was not changed, we return the middle number, otherwise we return 0
                {
                    double sredinska = stevil.Count / 2;
                    sredinska = Math.Floor(sredinska);
                    int iskano = Int32.Parse(sredinska.ToString());
                    return stevil[iskano];
                }
            }else
            {
                if (spremenjenih != 0) //if numbers order was changed, we return the middle number, otherwise we return 0
                {
                    double sredinska = stevil.Count / 2;
                    sredinska = Math.Floor(sredinska);
                    int iskano = Int32.Parse(sredinska.ToString());
                    return stevil[iskano];
                }
            }
            return 0;
        }
        static void Main(string[] args)
        {
            string input = @"day5.txt";
            if (File.Exists(input))
            {
                string readInput = File.ReadAllText(input);
                string[] vrstica = Regex.Split(readInput, @"\n\s"); //spliting instrucions and numbers
                string[] navodila = Regex.Split(vrstica[0], "\n"); //spliting instructions
                string[] stevilke = Regex.Split(vrstica[1].Trim(), "\n"); //spliting numbers
                int skupaj = 0;
                int skupaj2 = 0;
                foreach(var s in stevilke) //loop trough numbers and calling the method
                {
                    skupaj += PreveriUredi(navodila, s, 1); //part 1
                    skupaj2 += PreveriUredi(navodila, s, 2); //part 2
                }
                Console.WriteLine("part 1:" + skupaj);
                Console.WriteLine("part 2:" + skupaj2);
            }else
            {
                Console.WriteLine("datoteka ne obstaja");
            }
        }
    }
}
