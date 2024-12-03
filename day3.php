<?php
$vnos = fopen("day3.txt", "r") or die("Unable to open file!");
$podatki = fread($vnos,filesize("day3.txt"));
fclose($vnos);
$razbito = preg_split("/\n/", $podatki);
$podatki = array();
foreach($razbito as $razbit) {
	preg_match_all("/(mul\(\d+,\d+\))/", trim($razbit), $ukazi);
	$podatki[] = $ukazi[0];
}
$sestevek = 0;
$v_stevilke = array();
foreach($podatki as $podatek) {
	for($i=0;$i < count($podatek); $i++) {
		preg_match_all("/\d+/", $podatek[$i], $stevilke);
		$v_stevilke[] = array_product($stevilke[0]);
	}
}
echo 'part 1: '.array_sum($v_stevilke);
?>
