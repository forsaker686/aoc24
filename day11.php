<?php
$vnos = fopen("day11.txt", "r") or die("Unable to open file!");
$podatki = fread($vnos,filesize("day11.txt"));
fclose($vnos);
$podatki = trim($podatki);
$kamni = explode(" ", $podatki);
$stevec = 0;
$kamni2 = array();
while($stevec < 25) {
	$novi = array();
	foreach($kamni as $i => $kamen) {
		if($kamen == 0) {
			$nov = 1;
			$novi[] = 1;
		}else if(strlen($kamen) % 2 == 0) {
			$polovica = strlen($kamen)/2;
			$prvi = substr($kamen, 0, $polovica);
			$drugi = substr($kamen, $polovica);
			$novi[] = $prvi;
			$novi[] = intval($drugi);
		}else {
			$nov = $kamen*2024;
			$novi[] = $nov;
		}
	}
	$kamni = $novi;
	$stevec++;
}

echo 'part 1:'.count($kamni);

//part2

function nastavi_array($podatki) {
	$kamni = array();
	$pKamni = explode(" ", $podatki);
	foreach($pKamni as $kamen) {
		if(isset($kamni[$kamen]) == FALSE) {
			$kamni[$kamen]=0;
		}
		$kamni[$kamen]++;
	}
	return $kamni;
}

function utripaj($rocks) {
	$novi = array();
	foreach($rocks as $vrednost => $kamen) {
		$dolzina = strlen($vrednost);
		$pol = intdiv($dolzina,2);
		if($vrednost == 0) {
			// $nov = 1;
			// $novi[] = 1;
			if(isset($novi['1']) == FALSE) {
				$novi['1'] =0;
			}
			$novi['1'] +=$kamen;
		}else{ 
			if($dolzina==(pol*2)) {
				$polovica = strlen($kamen)/2;
				$prvi = substr($vrednost, 0, $pol);
				$drugi = substr($vrednost, $pol, $pol);
				$drugi = ltrim($drugi,'0');
				if ($drugi=='') $drugi='0';
				if(isset($novi[$prvi]) == FALSE) {
					$novi[$prvi] = 0;
				}
				if(isset($novi[$drugi]) == FALSE) {
					$novi[$drugi] = 0;
				}
				$novi[$prvi]+=$kamen;
				$novi[$drugi]+=$kamen;
			}else {
				$nov = $kamen*2024;
				$nov = bcmul($vrednost, '2024');
				if(isset($novi[$nov]) == FALSE) {
					$novi[$nov] = 0;
				}
				// $novi[] = $nov;
				$novi[$nov] += $kamen;
			}
		}
	}
	return $novi;
}

$kamni = nastavi_array($podatki);

for($i=0; $i < 75; $i++) {
	$kamni = utripaj($kamni);
	$skupaj = 0;
	foreach($kamni as $j => $kamen) {
		$skupaj = bcadd($skupaj, $kamen);
	}
	if($i==74) {
		echo 'part 2:'.$skupaj;
	}
}
?>
