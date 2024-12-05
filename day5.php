<?php
$vnos = fopen("day5.txt", "r") or die("Unable to open file!");
$podatki = fread($vnos,filesize("day5.txt"));
fclose($vnos);
$razbito = preg_split("/\n/", $podatki);
$varne = array();
$loceno = false;
$por = array();
$pn = array();
foreach($razbito as $razbit) {
	if(!$loceno) {
		if(strlen($razbit) == 1) {
			$loceno = true;
			continue;
		}
		$por[] = $razbit;
	}else {
		$pn[] = $razbit;
	}
}
//part 1
$skupaj = 0;
$popravljene = array();
for($i=0;$i < count($por); $i++) {
	$stevilka1 = substr($por[$i], 0, 2);
	$stevilka2 = substr($por[$i], 3,2);
	for($j = 0; $j < count($pn); $j++) {
		if(str_contains($pn[$j], $stevilka1) && str_contains($pn[$j],$stevilka2)) {
			$posamezna = explode(",", $pn[$j]);
			$poz1 = 0;
			$poz2 = 0;
			for($k = 0; $k < count($posamezna); $k++) {
				if($posamezna[$k] == $stevilka1) {
					$poz1 = $k;
				}else if($posamezna[$k] == $stevilka2){
					$poz2 = $k;
				}
			}
			if($poz2 < $poz1) {
				$zacasna = $posamezna[$poz2];
				$posamezna[$poz2] = $posamezna[$poz1];
				$posamezna[$poz1] = $zacasna;
				$pn[$j] = implode(",", $posamezna);
				$popravljene[] = $j;
			}
		}
	}
}
for($i=0;$i < count($pn); $i++) {
	if(!in_array($i, $popravljene)) {
		$posamezna = explode(",", $pn[$i]);
		$sredinska = round(count($posamezna)/2, 0, PHP_ROUND_HALF_DOWN);
		$sredinska = $posamezna[$sredinska];
		$skupaj+=$sredinska;
	}
}
echo 'part 1:'.$skupaj;


?>
