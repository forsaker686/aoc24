<?php
$vnos = fopen("day9.txt", "r") or die("Unable to open file!");
$podatki = fread($vnos,filesize("day9.txt"));
fclose($vnos);
$podatki = trim($podatki);
$stevilka = 0;
$aString = array();
//getting blocks
for($i=0; $i < strlen($podatki); $i++) {
	if($i % 2 == 1) {
		for($j = 0; $j< intval($podatki[$i]); $j++) {
			$string.=".";
			$aString[] =".";
		}
	}else {
		for($j=0; $j < intval($podatki[$i]); $j++) {
			$string.=$stevilka;
			$aString[] =$stevilka;
		}
		$stevilka++;
	}
}
$stevec = count($aString);
for($i = 0; $i < $stevec; $i++) {
	if($aString[$i] == ".") {
		for($j = count($aString)-1; $j >= 0; $j--) {
			if($aString[$j] == "." && $j > $i){
				continue;
			}
			else {
				$zacasna = $aString[$j];
				$aString[$i] = $zacasna;
				$aString[$j] = ".";
				$stevec--;
				break;
			}
		}
	}
}
$rezultati = array();
for($i = 0; $i < count($aString); $i++) {
	if($aString[$i] !== ".") {
		$rezultati[] = $i*intval($aString[$i]);
	}
}

//part 2 - not yet finished
krsort($stMest);

for($i=0; $i < $stevec; $i++) {
	if($aString2[$i] == ".") {
		foreach($stMest as $key => $value) {
			$menjaj = false;
			for($k=0; $k < $value; $k++) {
				if($aString2[$i+$k] == ".") {
					$menjaj = true;
					continue;
				}else {
					$menjaj = false;
					break;
				}
			}
			if($menjaj) {
				for($k=0; $k < $value; $k++) {
					$aString2[$i+$k] = $key;
				}
				for($j = count($aString2)-1; $j >= 0; $j--) {
						if($aString2[$j] == $key) {
							// for($l = $value; $l >=0; $l--) {
							for($l = 0; $l < $value; $l++) {
								$aString2[$j-$l] = ".";
								continue;
							}
							break;
						}
						// unset($stMest[$key]);
						
						
				}
			}
			unset($stMest[$key]);
			
		}
	}
}
var_dump(implode("", $aString2));
echo 'part 1: '.array_sum($rezultati);
