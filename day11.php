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
?>
