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
				if($grid[$yI-1][$xI] !== "#" && $grid[$yI-1][$xI] !== "O") {
					$grid[$yI-1][$xI] = "O";
					$grid[$yI][$xI] = ".";
				}else if($grid[$yI-1][$xI] == "O" && $grid[$yI-2][$xI] !== "#") {
					$grid[$yI-2][$xI] = "O";
					$grid[$yI][$xI] = ".";
				}
			}
		}else {
			continue;
		}
	}
	if($navodila[$k] == "<") {
		if($xI-1 >= 0 && $grid[$yI][$xI-1]) {
			$xI--;
			if($grid[$yI][$xI] == "O"){
				if($grid[$yI][$xI-1] !== "#" && $grid[$yI][$xI-1] !== "O") {
					$grid[$yI][$xI-1] = "O";
					$grid[$yI][$xI] = ".";
				}else if($grid[$yI][$xI-1] == "O" && $grid[$yI][$xI-2] !== "#") {
					$grid[$yI][$xI-2] = "O";
					$grid[$yI][$xI] = ".";
				}
			}
		}else {
			continue;
		}
	}
	if($navodila[$k] == ">") {
		if($xI+1 <= strlen($grid[$xI]) && $grid[$yI][$xI+1] !== "#") {
			$xI++;
			if($grid[$yI][$xI] == "O"){
				if($grid[$yI][$xI+1] !== "#" && $grid[$yI][$xI+1] !== "O") {
					$grid[$yI][$xI+1] = "O";
					$grid[$yI][$xI] = ".";
				}else if($grid[$yI][$xI+1] == "O" && $grid[$yI][$xI+2] !== "#") {
					$grid[$yI][$xI+2] = "O";
					$grid[$yI][$xI] = ".";
				}
			}
		}else {
			continue;
		}
	}
	if($navodila[$k] == "v") {
		if($yI+1 <= count($grid) && $grid[$yI+1][$xI] !== "#") {
			$yI++;
			if($grid[$yI][$xI] == "O"){
				if($grid[$yI+1][$xI] !== "#" && $grid[$yI+1][$xI] !== "O") {
					$grid[$yI+1][$xI] = "O";
					$grid[$yI][$xI] = ".";
				}else if($grid[$yI+1][$xI] == "O" && $grid[$yI+2][$xI] !== "#") {
					$grid[$yI+2][$xI] = "O";
					$grid[$yI][$xI] = ".";
				}
			}
		}else {
			continue;
		}
	}
}
var_dump(implode(PHP_EOL, $grid));
