<?php
$vnos = fopen("day7.txt", "r") or die("Unable to open file!");
$podatki = fread($vnos,filesize("day7.txt"));
fclose($vnos);
$razbito = preg_split("/\n/", $podatki);
$pravilni = array();
function racunaj($rezultat, $stevilke) {
	$variant = pow(count($stevilke)-1, 2); //all possible variations
	for($i = 0; $i < $variant; $i++) {
		$skupaj = intval($stevilke[0]);
		$bit = str_pad( base_convert($i,10,2),(count($stevilke)-1),'0',STR_PAD_LEFT);
		for ($j=0;$j< count($stevilke)-1;$j++) {
			$operacija = substr($bit,$j,1);
			if ($operacija == '0') { $skupaj += intval($stevilke[$j+1]); }
			if ($operacija == '1') { $skupaj *= intval($stevilke[$j+1]); }
			if ($operacija == '2') { $skupaj = $skupaj . $stevilke[$j+1]; }
		}

		if ($skupaj == $rezultat) {
			return true;
		}
	}
	return false;
}
foreach($razbito as $razbit) {
	[$rezultat, $stevila] = explode(':', $razbit);
	$stevilke = explode(" ", trim($stevila));
	if(intval($rezultat) === intval(implode("", $stevilke))) {
		continue;
	}
	if(intval(array_sum($stevilke)) === intval($rezultat) || intval(array_product($stevilke)) === intval($rezultat)) { //če je produkt ali seštevek enak rezultatu
		$pravilni[] = $rezultat;
		continue;
	}
	if(racunaj($rezultat, $stevilke)) {
		$pravilni[] = $rezultat;
		continue;
	}
}
echo 'part 1:'.array_sum($pravilni);
?>
