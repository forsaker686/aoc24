using System;
using System.IO;
using System.Text.RegularExpressions;

namespace day4
{
    internal class Program
    {
        //function for searching x-mas in part 2
        public static int Isci(string[] vrstica, int i, int j)
        {
            int skupaj = 0;
            var prostorDesno = j < (vrstica[i].Length - 1);
            var prostorLevo = j >= 1;
            var prostorGor = i >= 1;
            var prostorDol = i < (vrstica.Length - 1);
            if(prostorDesno && prostorLevo && prostorGor && prostorDol)
            {
                /*M     S
                 *   A
                 *M     S */
                if (vrstica[i - 1][j-1] == 'M' && vrstica[i + 1][j-1] == 'M' && vrstica[i - 1][j+1] == 'S' && vrstica[i+1][j+1] == 'S')
                {
                    skupaj++;
                }
                /*S     M
                 *   A
                 *S     M*/
                if (vrstica[i - 1][j-1] == 'S' && vrstica[i + 1][j-1] == 'S' && vrstica[i + 1][j+1] =='M' && vrstica[i-1][j+1] == 'M')
                {
                    skupaj++;
                }
                /*M     M
                 *   A
                 *S     S*/
                if (vrstica[i - 1][j-1] == 'M' && vrstica[i + 1][j-1] == 'S' && vrstica[i - 1][j+1] == 'M' && vrstica[i + 1][j+1] == 'S')
                {
                    skupaj++;
                }
                /*S     S
                 *   A
                 *M     M*/
                if (vrstica[i - 1][j-1] == 'S' && vrstica[i + 1][j-1] == 'M' && vrstica[i - 1][j+1] == 'S' && vrstica[i + 1][j+1] == 'M')
                {
                    skupaj++;
                }
            }
            return skupaj;
        }
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
                //PART 2
                int skupaj2 = 0;
                for (int i = 0; i < vrstica.Length; i++)
                {
                    for(int j=0; j<vrstica[i].Length; j++)
                    {
                        if (vrstica[i][j] == 'A')
                        {
                            skupaj2 += Isci(vrstica, i, j);
                        }
                    }
                }
                Console.WriteLine("part 2:" + skupaj2);
            }
        }
    }
}
