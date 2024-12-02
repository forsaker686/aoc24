<?php
$vnos = fopen("day2.txt", "r") or die("Unable to open file!");
$podatki = fread($vnos,filesize("day2.txt"));
fclose($vnos);
$razbito = preg_split("/\n/", $podatki);
$varne = array();
foreach($razbito as $razbit) {
	$vrstica = explode(" ", $razbit);
	$vrsticaOK = false;
	$prebrane = "";
	$pot = "";
	for($i = 0; $i < count($vrstica)-1; $i++) {
		if($vrstica[$i] < $vrstica[$i+1]) {
			if($pot == "" || $pot == "gor") {
				$pot = "gor";
				if(($vrstica[$i+1] - $vrstica[$i]) == 1 || ($vrstica[$i+1] - $vrstica[$i]) == 2 ||  ($vrstica[$i+1] - $vrstica[$i]) ==3) {
					$vrsticaOK = true;
					$prebrane = $prebrane.' '.$vrstica[$i];
				}
			}
		} else {
			if($pot == "" || $pot == "dol") {
				$pot = "dol";
				if(($vrstica[$i] - $vrstica[$i+1]) == 1 || ($vrstica[$i] - $vrstica[$i+1]) == 2 || ($vrstica[$i] - $vrstica[$i+1]) == 3) {
					$vrsticaOK = true;
					$prebrane = $prebrane.' '.$vrstica[$i];
				}
			}
		}
		if($vrstica[$i+1] == $vrstica[count($vrstica)-1]) {
			if($vrstica[$i] < $vrstica[$i+1]) {
				if($pot == "gor") {
					if(($vrstica[$i+1] - $vrstica[$i]) == 1 || ($vrstica[$i+1] - $vrstica[$i]) == 2 ||  ($vrstica[$i+1] - $vrstica[$i]) ==3) {
						$vrsticaOK = true;
						$prebrane = $prebrane.' '.$vrstica[$i+1];
					}
				}
			} else {
				if($pot == "dol") {
					if(($vrstica[$i] - $vrstica[$i+1]) == 1 || ($vrstica[$i] - $vrstica[$i+1]) == 2 || ($vrstica[$i] - $vrstica[$i+1]) == 3) {
						$vrsticaOK = true;
						$prebrane = $prebrane.' '.$vrstica[$i+1];
					}
				}
			}			
		}
	}
	if(trim($prebrane) == trim($razbit) && $vrsticaOK) {
		$varne[] = trim($razbit);	
	} 
}
$safe = array();
//iskanje duplikatov
foreach($varne as $varna) {
	$posamezna = explode(" ", $varna);
	$results = array_keys(array_filter(array_count_values($posamezna),static function($count) { return $count > 1; }));
	if(!count($results) > 0) {
		$safe[] = $varna;
	}
}

echo 'part 1: '.count($safe);
?>
