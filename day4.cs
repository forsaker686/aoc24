using System;
using System.IO;
using System.Text.RegularExpressions;

namespace day4
{
    internal class Program
    {
        static void Main(string[] args)
        {
            string input = @"day4.txt";
            if (File.Exists(input))
            {
                string readInput = File.ReadAllText(input);
                string[] vrstica = Regex.Split(readInput, "\n");
                int skupaj = 0;
                for(var i = 0; i < vrstica.Length; i++)
                {
                    for(var j = 0; j < vrstica[i].Length; j++)
                    {
                        if (vrstica[i][j] == 'X')
                        {
                            var prostorDesno = j < (vrstica[i].Length - 3);
                            var prostorLevo = j > 2;
                            var prostorGor = i > 2;
                            var prostorDol = i < (vrstica.Length - 3);
                            //LEVO
                            if(prostorLevo)
                            {
                                if (vrstica[i][j-1] == 'M' && vrstica[i][j-2] == 'A' && vrstica[i][j-3] == 'S')
                                {
                                    skupaj++;
                                }
                                //DIGONALA GOR
                                if(prostorGor)
                                {
                                    if (vrstica[i - 1][j-1] == 'M' && vrstica[i - 2][j-2] == 'A' && vrstica[i-3][j-3] == 'S')
                                    {
                                        skupaj++;
                                    }
                                }
                                //DIAGONALA DOL
                                if(prostorDol)
                                {
                                    if (vrstica[i +1][j-1] == 'M' && vrstica[i+2] [j-2] == 'A' && vrstica[i+3][j-3] == 'S')
                                    {
                                        skupaj++;
                                    }
                                }
                            }
                            //DESNO
                            if(prostorDesno)
                            {
                                if (vrstica[i][j+1] =='M' && vrstica[i][j+2] == 'A' && vrstica[i][j+3] == 'S')
                                {
                                    skupaj++;
                                }
                                //DIAGONALA GOR
                                if (prostorGor)
                                {
                                    if (vrstica[i - 1][j + 1] == 'M' && vrstica[i - 2][j + 2] == 'A' && vrstica[i - 3][j + 3] == 'S')
                                    {
                                        skupaj++;
                                    }
                                }
                                //DIAGONALA DOL
                                if(prostorDol)
                                {
                                    if (vrstica[i + 1][j+1] =='M' && vrstica[i + 2][j+2] =='A' && vrstica[i + 3][j+3] == 'S')
                                    {
                                        skupaj++;
                                    }
                                }
                            }
                            //DOL
                            if(prostorDol)
                            {
                                if (vrstica[i + 1][j] == 'M' && vrstica[i + 2][j] == 'A' && vrstica[i + 3][j] == 'S')
                                {
                                    skupaj++;
                                }
                            }
                            //GOR
                            if(prostorGor)
                            {
                                if (vrstica[i - 1][j] == 'M' && vrstica[i - 2][j] == 'A' && vrstica[i-3][j] == 'S')
                                {
                                    skupaj++;
                                }
                            }
                        }
                    }
                }
                Console.WriteLine("part 1:" + skupaj);
            }
        }
    }
}
