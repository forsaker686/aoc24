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

$mapa = implode("\n", $razbito);
//map drawing
echo '<pre>';
echo $mapa;
echo '</pre>';
preg_match_all("/X/", $mapa, $izpis);
echo 'part1: '.count($izpis[0])-1;

?>
