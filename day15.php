<?php
//ONLY PART 1
$vnos = fopen("day15.txt", "r") or die("Unable to open file!");
$podatki = fread($vnos,filesize("day15.txt"));
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
				$yT = $y;
				while($grid[$y][$x] == "O" && $grid[$y+1][$x] !== "#") {
					if($grid[$y+1][$x] == ".") {
						$grid[$y+1][$x] = "O";
						$iteracije++;
						break;
					}
					$y++;
				}
				if($iteracije>0) {
					$grid[$yT][$x] = ".";
					return $iteracije;
				}
				else {
					return $iteracije;
				}

			}else if($pot == "gor") {
				$iteracije = 0;
				$yT = $y;
				while($grid[$y-1][$x] !== "#" && $grid[$y][$x] == "O") {
					if($grid[$y-1][$x] == ".") {
						$grid[$y-1][$x] = "O";
						$iteracije++;
						break;
					}
					
					$y--;
				}
				if($iteracije > 0) {
					$grid[$yT][$x] = ".";
					return $iteracije;
				}else {
					return $iteracije;
				}

			}else if($pot == "levo") {
				$iteracije = 0;
				$xT = $x;
				while($grid[$y][$x-1] !== "#" && $grid[$y][$x] == "O"){
					if($grid[$y][$x-1] == ".") {
						$iteracije++;
						$grid[$y][$x-1] = "O";
						break;
					}
						$x--;
					}
				if($iteracije > 0) {
					$grid[$y][$xT] = ".";
					return $iteracije;
				}else {
					return $iteracije;
				}
			}else {
				$iteracije = 0;
				$xT = $x;
					while($grid[$y][$x+1] !== "#" && $grid[$y][$x] == "O") {
						// $grid[$y][$x+1] = "O";
						if($grid[$y][$x+1] == ".") {
							$iteracije++;
							$grid[$y][$x+1] = "O";
							break;
						}
						$x++;
					}
				if($iteracije > 0) {
					$grid[$y][$xT] = ".";
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
			// $grid[$yI][$xI] = "@";
			$yI--;
			if($grid[$yI][$xI] == "O"){
				$it = premakni($grid, $xI, $yI, "gor");
				if(!$it > 0) {
					$yI++;
					$grid[$yI][$xI] = ".";
				}else {
					$grid[$yI+1][$xI] = ".";
				}
			}
			$grid[$yI][$xI] = ".";
		}
	}
	if($navodila[$k] == "<") {
		if($xI-1 >= 0 && $grid[$yI][$xI-1] !== "#") {
			$xI--;
			if($grid[$yI][$xI] == "O"){
				$it = premakni($grid, $xI, $yI, "levo");
				if(!$it > 0){
					$xI++;
					$grid[$yI][$xI] = ".";
				}else {
					$grid[$yI][$xI+1] = ".";
				}
			}
			$grid[$yI][$xI] = ".";
		}
	}
	if($navodila[$k] == ">") {
		if($xI+1 <= strlen($grid[$xI]) && $grid[$yI][$xI+1] !== "#") {
			$xI++;
			if($grid[$yI][$xI] == "O"){
				$it = premakni($grid, $xI, $yI, "desno");
				if(!$it > 0) {
					$xI--;
					$grid[$yI][$xI] = ".";
				}else {
					$grid[$yI][$xI-1] = ".";
				}
			}
			$grid[$yI][$xI] = ".";
		}
	}
	if($navodila[$k] == "v") {
		if($yI+1 < count($grid)-1 && $grid[$yI+1][$xI] !== "#") {
			$yI++;
			if($grid[$yI][$xI] == "O"){
				$it = premakni($grid, $xI, $yI, "dol");
				if(!$it > 0) {
					$yI--;
					$grid[$yI][$xI] = ".";
				}else {
					$grid[$yI-1][$xI] = ".";
				}
			}
			$grid[$yI][$xI] = ".";
		}
	}
}
$sestevki = array();
for($i=0;$i< count($grid);$i++) {
	for($j=0;$j<strlen($grid[$i]); $j++) {
		if($grid[$i][$j] == "O") {
			$sestevki[] = 100 * $i+$j;
		}
	}
}

echo 'part 1: '.array_sum($sestevki);
echo '<pre>';
var_dump(implode("", $grid));
echo '</pre>';
?>
