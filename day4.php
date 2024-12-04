<?php
$vnos = fopen("day4.txt", "r") or die("Unable to open file!");
$podatki = fread($vnos,filesize("day4.txt"));
fclose($vnos);
$razbito = preg_split("/\n/", $podatki);
$skupaj = 0;
for($i = 0; $i < count($razbito); $i++) {
	for($j=0;$j < strlen($razbito[$i]); $j++) {
			if($razbito[$i][$j] == "X") {
				$prostorLevo = $j > 2;
				$prostorDesno = $j < strlen($razbito[$i]) -3;
				$prostorGor = $i > 2;
				$prostorDol = $i < count($razbito) -3;
				if($prostorLevo) {
					if($razbito[$i][$j-1] == "M" && $razbito[$i][$j-2] == "A" && $razbito[$i][$j-3] == "S"){
						$skupaj++;
					}

					//diagonala gor
					if($prostorGor) {
						if($razbito[$i-1][$j-1] == "M" && $razbito[$i-2][$j-2] == "A" && $razbito[$i-3][$j-3] == "S"){
							$skupaj++;
						}
					}
					//diagonala dol
					if($prostorDol) {
						if($razbito[$i+1][$j-1] == "M" && $razbito[$i+2][$j-2] == "A" && $razbito[$i+3][$j-3] == "S"){
							$skupaj++;
						}
					}
				}
				//desno
				if($prostorDesno) {
					if($razbito[$i][$j+1] == "M" && $razbito[$i][$j+2] == "A" && $razbito[$i][$j+3] == "S"){
						$skupaj++;
					}
					//diagonala gor
					if($prostorGor) {
						if($razbito[$i-1][$j+1] == "M" && $razbito[$i-2][$j+2] == "A" && $razbito[$i-3][$j+3] == "S"){
							$skupaj++;
						}
					}
					//diagonala dol
					if($prostorDol) {
						if($razbito[$i+1][$j+1] == "M" && $razbito[$i+2][$j+2] == "A" && $razbito[$i+3][$j+3] == "S"){
							$skupaj++;
						}
					}
				}

				if($prostorDol) {
					if($razbito[$i+1][$j] == "M" && $razbito[$i+2][$j] == "A" && $razbito[$i+3][$j] == "S"){
						$skupaj++;
					}
				}
				if($prostorGor) {
					if($razbito[$i-1][$j] == "M" && $razbito[$i-2][$j] == "A" && $razbito[$i-3][$j] == "S"){
						$skupaj++;
					}
				}
			}
	}
}
echo 'part 1: '.$skupaj;
