<?php
$vnos = fopen("day5_e.txt", "r") or die("Unable to open file!");
$podatki = fread($vnos,filesize("day5_e.txt"));
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
$skupaj = 0;
$skupaj2 = 0;
$popravljene = array();
$st_loopov = 0;
while($st_loopov <=3) { //get trough whole process 3 times to sort everything as it should be
	for($i=0;$i < count($por); $i++) {
		$stevilka1 = substr($por[$i], 0, 2);
		$stevilka2 = substr($por[$i], 3,2);
		for($j = 0; $j < count($pn); $j++) {
			if(str_contains($pn[$j], $stevilka1) && str_contains($pn[$j],$stevilka2)) {
				$posamezna = explode(",", $pn[$j]);
				$poz1 = 0;
				$poz2 = 0;
				for($k = 0; $k < count($posamezna); $k++) {
					//checking every number if it's equal to number 1 and number 2
					if($posamezna[$k] == $stevilka1) {
						$poz1 = $k;
					}
					if($posamezna[$k] == $stevilka2){
						$poz2 = $k;
					}
				}
				//switching numbers if number2 is before number1
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
	$st_loopov++;
}
//part 1
for($i=0;$i < count($pn); $i++) {
	if(!in_array($i, $popravljene)) {
		$posamezna = explode(",", $pn[$i]);
		$sredinska = round(count($posamezna)/2, 0, PHP_ROUND_HALF_DOWN);
		$sredinska = $posamezna[$sredinska];
		$skupaj+=$sredinska;
	}
}
//part 2
$popravljene = array_values(array_unique($popravljene));
for($i=0;$i< count($pn); $i++) {
	if(in_array($i, $popravljene)) {
		$posamezna = explode(",", $pn[$i]);
		$sredinska = round(count($posamezna)/2, 0, PHP_ROUND_HALF_DOWN);
		$sredinska = $posamezna[$sredinska];
		$skupaj2+=$sredinska;		
	}
}

echo 'part 1:'.$skupaj;
echo 'part 2:'.$skupaj2;

?>
