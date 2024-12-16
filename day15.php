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
				$iteracije = 0;
				while($grid[$y][$x] == "O" && $grid[$y+1][$x] !== "#") {
					$grid[$y+1][$x] = "O";
					$y++;
					$iteracije++;
				}
				if($iteracije>0) {
					return $iteracije;
				}
				else {
					return $iteracije;
				}

			}else if($pot == "gor") {
				$iteracije = 0;
				while($grid[$y-1][$x] !== "#" && $grid[$y][$x] == "O") {
					$grid[$y-1][$x] = "O";
					$y--;
					$iteracije++;
				}
				if($iteracije > 0) {
					return $iteracije;
				}else {
					return $iteracije;
				}

			}else if($pot == "levo") {
				$iteracije = 0;
				while($grid[$y][$x-1] !== "#" && $grid[$y][$x] == "O"){
						$grid[$y][$x-1] = "O";
						$x--;
						$iteracije++;
					}
				if($iteracije > 0) {
					return $iteracije;
				}else {
					return $iteracije;
				}
			}else {
				$iteracije = 0;
				$xT = $x;
				if($grid[$y][$x+1] == ".") {
					$grid[$y][$x+1] = "O";
					$x++;
				}
					while($grid[$y][$x+1] !== "#" && $grid[$y][$x] == "O") {
						// $grid[$y][$x+1] = "O";
						$x++;
					}
					$grid[$y][$xT] = ".";
					$iteracije = $x-$xT;
				if($iteracije > 0) {
					return $iteracije;
				}else {
					return $iteracije;
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
				$it = premakni($grid, $xI, $yI, "gor");
				if(!$it > 0) {
					$yI++;
				}else {
					$grid[$yI+($it > 2) ? $it : 1][$xI] = ".";
				}
			}
		}
	}
	if($navodila[$k] == "<") {
		if($xI-1 >= 0 && $grid[$yI][$xI-1] !== "#") {
			$xI--;
			if($grid[$yI][$xI] == "O"){
				// $grid[$yI][$xI] = ".";
				$it = premakni($grid, $xI, $yI, "levo");
				if(!$it > 0){
					$xI++;
				}else {
					$grid[$yI][$xI+($it > 2) ? $it : 1] = ".";
				}
			}
		}
	}
	if($navodila[$k] == ">") {
		if($xI+1 <= strlen($grid[$xI]) && $grid[$yI][$xI+1] !== "#") {
			$xI++;
			if($grid[$yI][$xI] == "O"){
				// $grid[$yI][$xI] = ".";
				$it = premakni($grid, $xI, $yI, "desno");
				if(!$it > 0) {
					$xI--;
				}else {
					$grid[$yI][$xI-($it > 2) ? $it : 1] = ".";
				}
			}
		}
	}
	if($navodila[$k] == "v") {
		if($yI+1 < count($grid)-1 && $grid[$yI+1][$xI] !== "#") {
			$yI++;
			if($grid[$yI][$xI] == "O"){
				// $grid[$yI][$xI] = ".";
				$it = premakni($grid, $xI, $yI, "dol");
				if(!$it > 0) {
					$yI--;
				}else {
					$grid[$yI-($it > 2) ? $it : 1][$xI] = ".";
				}
			}
		}
	}
	var_dump($navodila[$k].' '.$yI.','.$xI.':'.$grid[$yI][$xI]);
}
echo '<pre>';
var_dump(implode(PHP_EOL, $grid));
echo '</pre>';
?>
