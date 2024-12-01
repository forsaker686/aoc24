<?php
$vnos = fopen("day1.txt", "r") or die("Unable to open file!");
$podatki = fread($vnos,filesize("day1.txt"));
fclose($vnos);
$razbito = preg_split("/\s\s/", $podatki);
$stevec=0;
$levi = array();
$desni = array();
foreach($razbito as $razbit) {
	if($stevec%2 == 0) {
		$levi[] = $razbit;
	}else {
		$desni[] = $razbit;
	}
	$stevec++;
}
//part 1
sort($levi);
sort($desni);
$razlika = array();
for($i=0;$i<count($levi);$i++) {
	$razlika[] = abs($levi[$i] - $desni[$i]);
}
echo "part 1: ".(array_sum($razlika));

echo'<br/>';
//part 2
$rezultat = array();
for($i=0;$i<count($levi);$i++) {
	$rezultat[] = $levi[$i] * (count(array_keys($desni, $levi[$i])));
}
echo "part 2: ".array_sum($rezultat);
?>