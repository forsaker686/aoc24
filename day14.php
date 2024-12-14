<?php
$vnos = fopen("day14.txt", "r") or die("Unable to open file!");
$podatki = fread($vnos,filesize("day14.txt"));
fclose($vnos);
$podatki = trim($podatki);
$vrstice = preg_split("/\n/", $podatki);
$robotki = array();
foreach($vrstice as $kljuc => $vrstica) {
		if($vrstica !== "") {
			preg_match_all("/-?\d+/", $vrstica, $stevilke);
			$robotki[$kljuc]['zx'] = $stevilke[0][0];
			$robotki[$kljuc]['zy'] = $stevilke[0][1];
			$robotki[$kljuc]['vx'] = $stevilke[0][2];
			$robotki[$kljuc]['vy'] = $stevilke[0][3];
		}
	}
$koncne = array();
foreach($robotki as $kljuc => $robotek) {
	$x = $robotek['zx'];
	$y = $robotek['zy'];
	$px = $robotek['vx'];
	$py = $robotek['vy'];
	for($i=1;$i <= 100; $i++) {
		if(($x+$px) < 101 && ($x+$px) >=0) {
			$x += $px;
		}else {
			if(($x+$px) > 100) {
				$x = ($x+$px) - 101;
			}
			if(($x+$px) < 0) {
				$x = ($x+$px) + 101;
			}
			
		}
		if(($y+$py) < 103 && ($y+$py) >=0) {
			$y += $py;
		}else {
			if(($y+$py) > 102) {
				$y = ($y+$py)-103;
			}
			if(($y+$py) < 0) {
				$y = ($y+$py)+103;
			}
		}
	}
	if($x !== 50 && $y !== 51) {
		if($x < 50 && $y < 51) {
			if(isset($koncne[0][$x.','.$y])) {
				$koncne[0][$x.','.$y]++;
			}else {
				$koncne[0][$x.','.$y] = 1;
			}				
		}else if($x > 50 && $y < 51) {
			if(isset($koncne[1][$x.','.$y])) {
				$koncne[1][$x.','.$y]++;
			}else {
				$koncne[1][$x.','.$y] = 1;
			}				
		}else if($x < 50 && $y > 51) {
			if(isset($koncne[2][$x.','.$y])) {
				$koncne[2][$x.','.$y]++;
			}else {
				$koncne[2][$x.','.$y] = 1;
			}	
		}else {
			if(isset($koncne[3][$x.','.$y])) {
				$koncne[3][$x.','.$y]++;
			}else {
				$koncne[3][$x.','.$y] = 1;
			}	
		}

	}

}
function rezultat($podatki) {
	$skupaj = 0;
	foreach($podatki as $podatek) {
		$skupaj += $podatek;
	}
	return $skupaj;
}

$k1 = rezultat($koncne[0]);
$k2 = rezultat($koncne[1]);
$k3 = rezultat($koncne[2]);
$k4 = rezultat($koncne[3]);
echo 'part 1: '.($k1*$k2*$k3*$k4);

?>
