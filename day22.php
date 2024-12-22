<?php
$vnos = fopen("day22.txt", "r") or die("Unable to open file!");
$podatki = fread($vnos,filesize("day22.txt"));
fclose($vnos);
$razbito = preg_split("/\n/", $podatki);
// $zacetna = 123;
/*
    Calculate the result of multiplying the secret number by 64. Then, mix this result into the secret number. Finally, prune the secret number.
    Calculate the result of dividing the secret number by 32. Round the result down to the nearest integer. Then, mix this result into the secret number. Finally, prune the secret number.
    Calculate the result of multiplying the secret number by 2048. Then, mix this result into the secret number. Finally, prune the secret number.
*/
function mix($stevilka, $secret) {
	/* To mix a value into the secret number, calculate the bitwise XOR of the given value and the secret number. Then, the secret number becomes the result of that operation. (If the secret number is 42 and you were to mix 15 into the secret number, the secret number would become 37.)*/
	return $stevilka^$secret;
}
function prune($stevilka) {
	/* To prune the secret number, calculate the value of the secret number modulo 16777216. Then, the secret number becomes the result of that operation. (If the secret number is 100000000 and you were to prune the secret number, the secret number would become 16113920.)*/
	return $stevilka%16777216;
}
function mnozi($stevilka) {
	global $zacetna;
	$stevilka = $stevilka * 64;
	return mix($stevilka, $zacetna);
}
function mnozi2($stevilka) {
	global $zacetna;
	$stevilka = $stevilka * 2048;
	return mix($stevilka, $zacetna);
}
function deli($stevilka) {
	global $zacetna;
	$stevilka = floor($stevilka/32);
	return mix($stevilka, $zacetna);
}

//part 1
$stevilke = array();
foreach($razbito as $kljuc => $zacetna) {
	for($i=0; $i < 2000; $i++) {
		$zacetna = mnozi($zacetna);
		$zacetna = prune($zacetna);
		$zacetna = deli($zacetna);
		$zacetna = prune($zacetna);
		$zacetna = mnozi2($zacetna);
		$zacetna = prune($zacetna);
		$stevilke[$kljuc] = $zacetna;
	}
}

echo 'part 1:'.array_sum($stevilke);