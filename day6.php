<?php
$vnos = fopen("day6.txt", "r") or die("Unable to open file!");
$podatki = fread($vnos,filesize("day6.txt"));
fclose($vnos);
$razbito = preg_split("/\n/", $podatki);
$zacetek = 0;
for($i = 0; $i < count($razbito); $i++) {
	if(str_contains($razbito[$i], "^")) {
		for($k =0; $k < strlen($razbito[$i]); $k++) {
			if($razbito[$i][$k] == "^") {
				$zacetek = $i.' '.$k;
				$razbito[$i][$k] = "X";
				break 2;
			}
		}

	}
}
$zacetek = explode(" ", $zacetek);
$pot = "gor";
$isci = true;
$x = $zacetek[0];
$y = $zacetek[1];
while($isci) {
	if($pot == "gor") {
		if(isset($razbito[$x-1][$y]) && $razbito[$x-1][$y] !== "#") {
			$razbito[$x][$y] = "X";
			$x--;
		}else if(isset($razbito[$x-1][$y]) && $razbito[$x-1][$y] == "#") {
			$pot = "desno";
			$razbito[$x][$y] = "X";
			$y++;
		}else {
			$razbito[$x][$y] = "X";
			$isci = false;
		}
	}
	if($pot == "desno") {
		if(isset($razbito[$x][$y+1]) && $razbito[$x][$y+1] !== "#") {
			$razbito[$x][$y] = "X";
			$y++;
		} else if(isset($razbito[$x][$y+1]) && $razbito[$x][$y+1] == "#") {
			$razbito[$x][$y] = "X";
			$x++;
			$pot = "dol";
		}else {
			$razbito[$x][$y] = "X";
			$isci = false;
		}
	}
	if($pot == "dol") {
		if(isset($razbito[$x+1][$y]) && $razbito[$x+1][$y] !== "#") {
			$razbito[$x][$y] = "X";
			$x++;
		}else if(isset($razbito[$x+1][$y]) && $razbito[$x+1][$y] == "#") {
			$pot = "levo";
			$razbito[$x][$y] = "X";
			$y--;
		}else {
			$razbito[$x][$y] = "X";
			$isci = false;
		}
	}
	if($pot == "levo") {
		if(isset($razbito[$x][$y-1]) && $razbito[$x][$y-1] !== "#") {
			$razbito[$x][$y] = "X";
			$y--;
		} else if(isset($razbito[$x][$y-1]) && $razbito[$x][$y-1] == "#") {
			$razbito[$x][$y] = "X";
			$x--;
			$pot = "gor";
		}else {
			$razbito[$x][$y] = "X";
			$isci = false;
		}
	}
}
//part 1
$mapa = implode("\n", $razbito);
//map drawing
echo '<pre>';
echo $mapa;
echo '</pre>';
preg_match_all("/X/", $mapa, $izpis);
echo 'part1: '.count($izpis[0])-1;

//part 2 - still not optimal - will improve later
function ovire($mapa, $zX, $zY, $x, $y, $pot) {
	$pot = "gor";
	$mapa[$x][$y] = "#";
	$x = $zX;
	$y = $zY;
	$obiskane = array();
	$loop = false;
	while(true) {
		$koordinate = "{$x},{$y},{$pot}";
		if(array_search($koordinate, $obiskane)) {
			$izris = implode("\n", $mapa);
			$loop = true;
			break;
		}
		$obiskane[] = $koordinate;
		if($x -1 < 0 || $x + 1 == count($mapa) || $y - 1 < 0 || $y + 1 == count($mapa)) {
			break;
		}
		if($pot == "gor") {
			if($mapa[$x-1][$y] !== "#") {
				$x-= 1;
			}else if($mapa[$x-1][$y] == "#") {
				$pot = "desno";
				$y+= 1;
			}
		}
		if($pot == "desno") {
			if($mapa[$x][$y+1] !== "#") {
				$y+= 1;
			} else if($mapa[$x][$y+1] == "#") {
				$x+= 1;
				$pot = "dol";
			}
		}
		if($pot == "dol") {
			if($mapa[$x+1][$y] !== "#") {
				$x+=1;
			}else if($mapa[$x+1][$y] == "#") {
				$pot = "levo";
				$y-= 1;
			}
		}
		if($pot == "levo") {
			if($mapa[$x][$y-1] !== "#") {
				$y-= 1;
			} else if($mapa[$x][$y-1] == "#") {
				$x-= 1;
				$pot = "gor";
			}
		}
	}
	return $loop;
}
$ovir = 0;
$x = $zacetek[0];
$y = $zacetek[1];
foreach($path as $posamezna) {
	$cords = explode(",", $posamezna);
	$zX = $cords[0];
	$zY = $cords[1];
	$pot = $cords[2];
	if(ovire($zemljevid, $x, $y, $zX, $zY, $pot)) {
		$ovir++;
	}
}
echo '<br/>';
echo 'part2: '.$ovir-1;

?>
