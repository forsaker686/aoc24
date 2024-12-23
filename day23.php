<!-- EYES FRIENDLY -->
<body style="background: black; color:gray;"> 
<?php

$vnos = fopen("day23.txt", "r") or die("Unable to open file!");
$podatki = fread($vnos,filesize("day23.txt"));
fclose($vnos);
$podatki = trim($podatki);
$vrstice = preg_split("/\n/", $podatki);
$racunalniki = array();
//adding computers to the list
foreach($vrstice as $vrstica) {
	[$a, $b] = explode("-", trim($vrstica));
	if(!in_array($a, $racunalniki)) {
		$racunalniki[] = $a;
	}
	if(!in_array($b, $racunalniki)) {
		$racunalniki[] = $b;
	}
}

//grouping computers together
$grupe = array();
foreach($racunalniki as $racunalnik) {
	$rac = array();
	foreach($vrstice as $vrstica) {
		[$a, $b] = explode("-", trim($vrstica));
		if($a == $racunalnik || $b == $racunalnik) {
			$racB = ($a == $racunalnik) ? $b : $a;
			$rac[$racB] = 0;
		}
	}
	$grupe[$racunalnik] = $rac;
}
//checking groups with the same computers and at the same time only including computers, that have "t" for the first char
$posamezne = array();
foreach($grupe as $kljuc => $grupa) {
	if($kljuc[0] == "t") {
		foreach(array_keys($grupa) as $bGrupa) {
			foreach(array_keys($grupe[$bGrupa]) as $cGrupa) {
				if(isset($grupe[$cGrupa][$kljuc])) {
					$grupica = [$kljuc, $bGrupa, $cGrupa];
					sort($grupica);
					$posamezne[implode(",", $grupica)] = 0; 
				}
			}
		}
	}
}

echo 'part 1:'.count($posamezne);
//dumping the list of all groups
//echo '<pre>';
//var_dump($posamezne);
//echo '</pre>';

//part2
echo '<br/>';
//https://en.wikipedia.org/wiki/Bron%E2%80%93Kerbosch_algorithm
function BronKerbosch($P, $R=[], $X=[], &$posamezne=[]) {
	global $grupe;
    if (empty($P) && empty($X)) {
        // Report R as a maximal clique
        if(count($R) > count($posamezne)) {
        	$posamezne = $R;
        }
        
    }
    foreach ($P as $v) {
        $neighbors = isset($grupe[$v]) ? array_keys($grupe[$v]) : []; // Get neighbors of vertex v
        // Recursive call with updated sets
        BronKerbosch(
        	array_intersect($P, $neighbors), // P ∩ N(v)
            array_merge($R, [$v]), // R ∪ {v}
            array_intersect($X, $neighbors), // X ∩ N(v)
            $posamezne
        );

        // Update P and X
        $P = array_diff($P, [$v]); // P \ {v}
        $X = array_merge($X, [$v]); // X ∪ {v}
    }
    return $posamezne;
}

$P = array_keys($grupe);
$posamezne = BronKerbosch($P);
sort($posamezne);
echo 'part 2: '.implode(",", $posamezne);
