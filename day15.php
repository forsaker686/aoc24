<?php
//NOT YET FINISHED...NOT EVEN SURE IF IT'S THE RIGHT APROACH.
$vnos = fopen("day15_e.txt", "r") or die("Unable to open file!");
$podatki = fread($vnos,filesize("day15_e.txt"));
fclose($vnos);
$podatki = trim($podatki);
$vrstice = preg_split("/\n\s/", $podatki);
$grid = preg_split("/\n/",trim($vrstice[0]));
$navodila = trim($vrstice[1]);
$yI = 0;
$xI =0;
function premakni($grid, $x, $y, $pot) {
	global $grid;
		$premikaj = true;
			if($pot == "dol") {
				for($i = $y; $i < count($grid) -1; $i++) {
					if($grid[$i+1][$x] !== "#" && $grid[$i+1][$x] == ".") {
						$grid[$i][$x] = ".";
						$grid[$i+1][$x] = "O";
					}
				}
			}else if($pot == "gor") {
				for($i = $y; $i < count($grid) -1; $i--) {
					if($grid[$i-1][$x] !== "#" && $grid[$i-1][$x] == ".") {
						$grid[$i][$x] = ".";
						$grid[$i-1][$x] = "O";
					}
				}

			}else if($pot == "levo") {
				for($i = $x ; $i > 0 ; $i--) {
					if($grid[$y][$i-1] !== "#" && $grid[$y][$i-1] == ".") {
						$grid[$y][$i] = ".";
						$grid[$y][$i-1] = "O";
					}
				}
			}else {
				for($i = $x; $i < strlen($grid[$y])-1; $i++) {
					if($grid[$y][$i+1] !== "#" && $grid[$y][$i+1] == ".") {
						$grid[$y][$i] = ".";
						$grid[$y][$i+1] = "O";
					}
				}
			}
		}			
for($i=0; $i < count($grid); $i++) {
	for($j=0; $j<strlen($grid[$i]); $j++) {
		if($grid[$i][$j] == "@") {
			$yI = $i;
			$xI = $j;
			break 2;
		}
	}
}
for($k=0; $k < strlen($navodila); $k++) {
	if($navodila[$k] == "^") {
		if($yI-1 >= 0 && $grid[$yI-1][$xI] !== "#") {
			$yI--;
			if($grid[$yI][$xI] == "O"){
				premakni($grid, $xI, $yI, "gor");
			}
		}else {
			continue;
		}
	}
	if($navodila[$k] == "<") {
		if($xI-1 >= 0 && $grid[$yI][$xI-1] !== "#") {
			$xI--;
			if($grid[$yI][$xI] == "O"){
				premakni($grid, $xI, $yI, "levo");
			}
		}else {
			continue;
		}
	}
	if($navodila[$k] == ">") {
		if($xI+1 <= strlen($grid[$xI]) && $grid[$yI][$xI+1] !== "#") {

			$xI++;
			if($grid[$yI][$xI] == "O"){
				premakni($grid, $xI, $yI, "desno");
				continue;
			}
		}else {
			continue;
		}
	}
	if($navodila[$k] == "v") {
		if($yI+1 < count($grid)-1 && $grid[$yI+1][$xI] !== "#") {
			$yI++;
			if($grid[$yI][$xI] == "O"){
				premakni($grid, $xI, $yI, "dol");
				continue;
			}else {
				continue;
			}
		}else {
			continue;
		}
	}
}
echo '<pre>';
var_dump(implode(PHP_EOL, $grid));
echo '</pre>';
?>
