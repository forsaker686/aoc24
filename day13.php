<?php
$vnos = fopen("day13.txt", "r") or die("Unable to open file!");
$podatki = fread($vnos,filesize("day13.txt"));
fclose($vnos);
$podatki = trim($podatki);
$vrstice = preg_split("/\n\s/", $podatki);
$igra = array();
foreach($vrstice as $kljuc => $vrstica) {
	$posamezno = preg_split("/\n/", trim($vrstica));
	foreach($posamezno as $vrstica => $posamezen) {
		if($posamezen !== "") {
			$kontrole = explode(":", $posamezen);
			if(isset($kontrole[1])) {
				$vrednosti = explode(",", $kontrole[1]);
				if($vrstica == 0) {
					preg_match_all("/\d+/", $vrednosti[0], $x);
					preg_match_all("/\d+/", $vrednosti[1], $y);
					$igra[$kljuc]['A'] = [$x[0][0], $y[0][0]];
				}
				if($vrstica == 1) {
					preg_match_all("/\d+/", $vrednosti[0], $x);
					preg_match_all("/\d+/", $vrednosti[1], $y);
					$igra[$kljuc]['B'] = [$x[0][0], $y[0][0]];
				}
				if($vrstica == 2) {
					preg_match_all("/\d+/", $vrednosti[0], $x);
					preg_match_all("/\d+/", $vrednosti[1], $y);
					$igra[$kljuc]['P'] = [$x[0][0], $y[0][0]];
				}
			}
		}
	}
}
function igraj($igra, $dodatek = 0) {
	$skupaj = 0;
	foreach($igra as $play) {
		$rX = $dodatek + $play['P'][0];
		$rY = $dodatek + $play['P'][1];
		$aX = $play['A'][0];
		$aY = $play['A'][1];
		$bX = $play['B'][0];
		$bY = $play['B'][1];
		$A = ($rX*$bY - $rY * $bX) / ($aX * $bY - $aY * $bX);
		$B = ($rY*$aX - $rX * $aY) / ($aX * $bY - $aY * $bX);
	    if (is_int($A) && is_int($B)) {
	        $skupaj += $A * 3 + $B;
	    }
	}
	return $skupaj;
}
//part 1
echo 'part 1:'.igraj($igra).'<br/>';
//part 2
echo 'part 2:'.igraj($igra, 10000000000000);

?>
