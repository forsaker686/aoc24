<body style="background: black; color:gray;">
<?php
//NOT YET FINISHED...MADE IT TROUGH FIRST EXAMPLE...
$vnos = fopen("day15_e.txt", "r") or die("Unable to open file!");
$podatki = fread($vnos,filesize("day15_e.txt"));
fclose($vnos);
$podatki = trim($podatki);
//PART 2
$vrstice = preg_split("/\n\s/", $podatki);
$grid = preg_split("/\n/",trim($vrstice[0]));
$navodila = trim($vrstice[1]);

$vrstice2 = array();
$vrstice2[0] = "";
//building map
for($i=1; $i < count($grid)-1; $i++) {
	$nVrstica = "";
	for($j=0;$j<strlen($grid[$i]);$j++) {
		if($grid[$i][$j] == "#") {
			$nVrstica.= "##";
		}
		if($grid[$i][$j] == "O") {
			$nVrstica.="[]";
		}
		if($grid[$i][$j] == ".") {
			$nVrstica.="..";
		}
		if($grid[$i][$j] == "@") {
			$nVrstica.="@.";
		}
	}
	$vrstice2[] = $nVrstica;
}
$vrstice2[count($grid)-1] = "";
$vrstice2[0] = str_repeat("#", strlen($vrstice2[1]));
$vrstice2[count($grid)-1] = str_repeat("#", strlen($vrstice2[1]));
$grid2 = array();
foreach($vrstice2 as $vrstica) {
	$grid2[] = $vrstica;
}
echo '<pre>';
var_dump(implode(PHP_EOL, $vrstice2));
echo '</pre>';
$yI = 0;
$xI =0;
for($i=0; $i < count($grid2); $i++) {
	for($j=0; $j<strlen($grid2[$i]); $j++) {
		if($grid2[$i][$j] == "@") {
			$yI = $i;
			$xI = $j;
			break 2;
		}
	}
}
var_dump($yI.' '.$xI);
function enakih() {
	$stEnakih = 0;
	for($j=$x; $j < strlen($grid2[$y])-1; $j++) {
		var_dump($grid2[$y][$j]);
		if($grid2[$y][$j] == "[") {
			$stEnakih++;
		}
		$j++;
	}
}
function premakni2($grid2, $x, $y, $pot) {
	global $grid2;
		$premikaj = true;
			if($pot == "dol") {
				$iteracije = 0;
				$yT = $y;
				while($grid2[$y][$x] == "[" || $grid2[$y][$x] == "]" && $grid2[$y+1][$x] !== "#") {
					if($grid2[$y+1][$x] == ".") {
						// if($grid2[$y][$x] == "[" && $grid2[$y+1][$x+1] !== "#") {
						// 	$grid2[$y+1][$x] = "[";
						// 	$grid2[$y+1][$x+1] = "]";
						// }else {
						// 	if($grid2[$y][$x] == "]" && $grid2[$y+1][$x-1] !== "#") {
						// 		$grid2[$y+1][$x] = "]";
						// 		$grid2[$y+1][$x-1] = "[";
						// 	}
						// }
						if($grid2[$y][$x] == "[" && $grid2[$y+1][$x+1] !== "#") {
							$grid2[$y+1][$x] = "[";
							$grid2[$y+1][$x+1] = "]";
							// $grid2[$y+1][$x+1] = ".";
							var_dump('sem tle dol');
							var_dump($grid2[$y+1][$x].''.$grid2[$y+1][$x+1]);
							var_dump($grid2[$y][$x].''.$grid2[$y][$x+1]);
							if($grid2[$y][$x+2] == "[" && $grid2[$y+1][$x-1] !== "#") {
								$grid2[$y+1][$x-2] ="[";
								$grid2[$y+1][$x-1] ="]";
								$grid2[$y][$x-2] = ".";
								if($zacetna == "]") {
									$grid2[$y][$x-1] = "[";
									$grid2[$y][$x] = "]";
									$grid2[$y][$x+1] = ".";
								}else {
									$grid2[$y][$x+1] = "]";
									$grid2[$y][$x] = "[";
									$grid2[$y][$x-1] = ".";
								}
								
							}
							if($grid2[$y][$x+2] == "]") {
								$grid2[$y+1][$x+2] ="]";
								$grid2[$y+1][$x+1] ="[";
								$grid2[$y][$x+2] = ".";
								$grid2[$y][$x+1] = ".";
								if($zacetna == "]") {
									$grid2[$y][$x-1] = "[";
									$grid2[$y][$x] = "]";
									$grid2[$y][$x+1] = ".";
								}else {
									$grid2[$y][$x+1] = "]";
									$grid2[$y][$x] = "[";
									$grid2[$y][$x-1] = ".";
								}
							}
						}else {
							var_dump('sem tle dol 2');
							var_dump($grid2[$y+1][$x].''.$grid2[$y+1][$x+1]);
							var_dump($grid2[$y][$x].''.$grid2[$y][$x+1]);
							if($grid2[$y][$x] == "]" && $grid2[$y+1][$x-1] !== "#") {
								$grid2[$y+1][$x] = "]";
								$grid2[$y+1][$x-1] = "[";
								if($grid2[$y][$x-2] == "[") {
									$grid2[$y+1][$x-2] ="[";
									$grid2[$y+1][$x-1] ="]";
									$grid2[$y][$x-2] = ".";
									$grid2[$y][$x-1] = ".";
								}
								if($grid2[$y][$x+2] == "]" && $grid2[$y+1][$x+2] !== "#") {
									$grid2[$y+1][$x+2] ="]";
									$grid2[$y+1][$x+1] ="[";
									$grid2[$y][$x+2] = ".";
									$grid2[$y][$x+1] = ".";
								}
							}
							$grid2[$yT][$x-1] = ".";
						}
						$iteracije++;
						break;
					}
					$y++;
				}
				if($iteracije>0) {
					$grid2[$yT][$x] = ".";
					$grid2[$yT][$x+1] = ".";
					// $grid2[$yT-1][$x] = ".";
					return $iteracije;
				}
				else {
					return $iteracije;
				}

			}else if($pot == "gor") {
				$iteracije = 0;
				$yT = $y;
				$zacetna = $grid2[$y][$x];
				var_dump($zacetna);
				// while($grid2[$y-1][$x] !== "#" && $grid2[$y-1][$x+1] !== "#" && $grid2[$y][$x] == "[" || $grid2[$y][$x] == "]") {
				while($grid2[$y-1][$x] !== "#" && ($grid2[$y][$x] == "[" || $grid2[$y][$x] == "]")) {
					var_dump($y.','.$x);
					if($grid2[$y-1][$x] == ".") {
						if($grid2[$y][$x] == "[" && $grid2[$y-1][$x+1] !== "#") {
							$grid2[$y-1][$x] = "[";
							$grid2[$y-1][$x+1] = "]";
							$grid2[$y+1][$x+1] = ".";
							var_dump('sem tle gor');
							var_dump($grid2[$y-1][$x].''.$grid2[$y-1][$x+1]);
							var_dump($grid2[$y][$x].''.$grid2[$y][$x+1]);

							if($grid2[$y][$x-2] == "[" && $grid2[$y-1][$x-1] !== "#") {
								$grid2[$y-1][$x-2] ="[";
								$grid2[$y-1][$x-1] ="]";
								$grid2[$y][$x-2] = ".";
								var_dump('gor if 2');
								if($zacetna == "]") {
									$grid2[$y][$x-1] = "[";
									$grid2[$y][$x] = "]";
									$grid2[$y][$x+1] = ".";
								}else {
									$grid2[$y][$x+1] = "]";
									$grid2[$y][$x] = "[";
									$grid2[$y][$x-1] = ".";
								}
								
							}
							//tukaj
							if($grid2[$y][$x+2] == "]") {
								var_dump('gor if 4');
								$grid2[$y-1][$x+2] ="]";
								$grid2[$y-1][$x+1] ="[";
								$grid2[$y][$x+2] = ".";
								$grid2[$y][$x+1] = ".";
								if($zacetna == "]") {
									$grid2[$y][$x-1] = "[";
									$grid2[$y][$x] = "]";
									$grid2[$y][$x+1] = ".";
								}else {
									$grid2[$y][$x+1] = "]";
									$grid2[$y][$x] = "[";
									$grid2[$y][$x-1] = ".";
								}
							}
						}else {
							var_dump('sem tle 2 - gor');
							var_dump($grid2[$y-1][$x].''.$grid2[$y-1][$x+1]);
							var_dump($grid2[$y][$x].''.$grid2[$y][$x+1]);
							if($grid2[$y][$x] == "]" && $grid2[$y-1][$x-1] !== "#") {
								$grid2[$y-1][$x] = "]";
								$grid2[$y-1][$x-1] = "[";
								if($grid2[$y][$x-2] == "[") {
									$grid2[$y-1][$x-2] ="[";
									$grid2[$y-1][$x-1] ="]";
									$grid2[$y][$x-2] = ".";
									$grid2[$y][$x-1] = ".";
								}
								// if($grid2[$y][$x+2] == "]" && $grid2[$y-1][$x+2] !== "#") {
								// 	$grid2[$y-1][$x+2] ="]";
								// 	$grid2[$y-1][$x+1] ="[";
								// 	$grid2[$y][$x+2] = ".";
								// 	$grid2[$y][$x+1] = ".";
								// }
							}
							$grid2[$yT][$x-1] = ".";
						}

						// var_dump('pod ifem'.' '.$y.','.$x);
						$iteracije++;
						break;
					}
					
					$y--;
				}
				if($iteracije > 0) {
					$grid2[$yT][$x] = ".";
					// $grid2[$yT][$x+1] = ".";
					// $grid2[$yT][$x-1] = ".";
					return $iteracije;
				}else {
					return $iteracije;
				}

			}else if($pot == "levo") {
				$iteracije = 0;
				$xT = $x;
				while($grid2[$y][$x-1] !== "#" && $grid2[$y][$x-2] !== "#" && $grid2[$y][$x] == "]" || $grid2[$y][$x] == "["){
					var_dump($grid2[$y][$x].' '.$y.','.$x);
					var_dump('levo večkrat');
					if($grid2[$y][$x-1] == ".") {
						var_dump('levo '. $grid2[$y][$x].' '.$y.','.$x);
						$iteracije++;
						$grid2[$y][$x+1] = "[";
						$grid2[$y][$x] = "]";
						$grid2[$y][$x-1] = "[";
						break;
					}
						$x--;
					}
				if($iteracije > 0) {
					$grid2[$y][$xT] = ".";
					$grid2[$y][$xT-1] = "]";
					return $iteracije;
				}else {
					return $iteracije;
				}
			}else {
				$iteracije = 0;
				$xT = $x;
				var_dump('desno');
					//tle si ostal, naredi funkcijo, ki gleda koliko je enakih
					while($grid2[$y][$x+1] !== "#" && $grid2[$y][$x+2] !== "#" && $grid2[$y][$x] == "[" || $grid2[$y][$x] == "]") {
						// $grid[$y][$x+1] = "O";
						if($grid2[$y][$x+1] == ".") {
							var_dump('desno '. $grid2[$y][$x].' '.$y.','.$x);
							$iteracije++;
							$grid2[$y][$x-1] = "]";
							$grid2[$y][$x] = "[";
							$grid2[$y][$x+1] = "]";
							break;
						}
						$x++;
					}
				if($iteracije > 0) {
					$grid2[$y][$xT] = ".";
					$grid2[$y][$xT+1] = "[";
					return $iteracije;
				}else {
					return $iteracije;
				}
			}
		}	
for($k=0; $k < strlen($navodila); $k++) {
	var_dump($navodila[$k].' '.$yI.','.$xI);
	if($navodila[$k] == "^") {
		if($yI-1 >= 1 && $grid2[$yI-1][$xI] !== "#") {
			// $grid[$yI][$xI] = "@";
			var_dump('gor v navadnem '.$yI.','.$xI);
			$yI--;
			var_dump('gor v navadnem - '.$yI.','.$xI);
			if($grid2[$yI][$xI] == "[" || $grid2[$yI][$xI] == "]"){
				$it = premakni2($grid2, $xI, $yI, "gor");
				if(!$it > 0) {
					$yI++;
					$grid2[$yI][$xI] = ".";
				}else {
					$grid2[$yI+1][$xI] = ".";
					// $grid2[$yI+2][$xI] = ".";
				}
			}
			$grid2[$yI][$xI] = ".";
		}
	}
	if($navodila[$k] == "<") {
		if($xI-1 >= 1 && $grid2[$yI][$xI-1] !== "#") {
			$xI--;
			if($grid2[$yI][$xI] == "]"){
				$it = premakni2($grid2, $xI, $yI, "levo");
				if(!$it > 0){
					$xI++;
					$grid2[$yI][$xI] = ".";
				}else {
					$grid2[$yI][$xI+1] = ".";
					// $grid2[$yI][$xI+2] = ".";
				}
			}
			$grid2[$yI][$xI] = ".";
		}
	}
	if($navodila[$k] == ">") {
		if($xI+1 <= strlen($grid2[$yI])-2 && $grid2[$yI][$xI+1] !== "#") {
			$xI++;
			if($grid2[$yI][$xI] == "["){
				$it = premakni2($grid2, $xI, $yI, "desno");
				if(!$it > 0) {
					$xI--;
					$grid2[$yI][$xI] = ".";
				}else {
					$grid2[$yI][$xI-1] = ".";
					$grid2[$yI][$xI-2] = ".";
				}
			}
			$grid2[$yI][$xI] = ".";
		}
	}
	if($navodila[$k] == "v") {
		if($yI+1 < count($grid2)-1 && $grid2[$yI+1][$xI] !== "#") {
			$yI++;
			if($grid2[$yI][$xI] == "[" || $grid2[$yI][$xI] == "["){
				$it = premakni2($grid2, $xI, $yI, "dol");
				if(!$it > 0) {
					$yI--;
					$grid2[$yI][$xI] = ".";
				}else {
					$grid2[$yI-1][$xI] = ".";
					// $grid2[$yI-2][$xI] = ".";
				}
			}
			$grid2[$yI][$xI] = ".";
		}
	}
	echo '<pre>';
	for($i=0;$i<count($grid2);$i++) {
		for($j=0;$j<strlen($grid2[$i]);$j++) {
			if($i == $yI && $j == $xI) {
				echo '<span style="color:red;">'.$navodila[$k].'</span>';
			}else {
				echo $grid2[$i][$j];
			}
		}
		echo '<br/>';
	}
	echo '</pre>';
}
echo '<pre>';
var_dump(implode(PHP_EOL, $grid2));
echo '</pre>';
?>
