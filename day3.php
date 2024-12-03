<?php
$vnos = fopen("day3.txt", "r") or die("Unable to open file!");
$prebrano = fread($vnos,filesize("day3.txt"));
fclose($vnos);
$podatki = array();
preg_match_all("/(mul\(\d+,\d+\))/", trim($prebrano), $ukazi);
$podatki[] = $ukazi[0];

$v_stevilke = array();
foreach($podatki as $podatek) {
	for($i=0;$i < count($podatek); $i++) {
		preg_match_all("/\d+/", $podatek[$i], $stevilke);
		$v_stevilke[] = array_product($stevilke[0]);
	}
}

echo 'part 1: '.array_sum($v_stevilke);

//part 2
$podatki = array();
$stevec = 0;
$zacetek = microtime(true);
	$razdeljeno = preg_split("/don't\(\)/", trim($prebrano));
	if($stevec == 0) {
		preg_match_all("/(mul\(\d+,\d+\))/", trim($razdeljeno[0]), $ukazi2);
		$podatki[] = $ukazi2[0];
		 $stevec++;
	}
	for($i=0; $i < count($razdeljeno); $i++) {
		if(str_contains($razdeljeno[$i], 'do()')) {
			$razdeljenoOK = preg_split("/do\(\)/", trim($razdeljeno[$i]));
			for($j = 1; $j<count($razdeljenoOK); $j++) {
				preg_match_all("/(mul\(\d+,\d+\))/", trim($razdeljenoOK[$j]), $ukazi2);
				$podatki[] = $ukazi2[0];
			}
		}
	}

$v_stevilke = array();
foreach($podatki as $podatek) {
	for($i=0;$i < count($podatek); $i++) {
		preg_match_all("/\d+/", $podatek[$i], $stevilke);
		$v_stevilke[] = array_product($stevilke[0]);
	}
}

echo 'part 2: '.array_sum($v_stevilke);
?>
