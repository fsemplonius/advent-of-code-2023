<?php

include 'Puzzle_2311.php';
$input = explode("\r\n", $s1);
//
$mult = 1000000;

$strt = strlen($input[0]);

$vEmpty = array ();
$hEmpty1 = array_fill(0, $strt, true);
for ($v=0; $v<count($input); $v++) {
  $h = -1;
  $vBool = true;
  while ($h < $strt and ($h=strpos($input[$v], '#', $h+1)) !== false) {
    $imagePos[] = array ($v, $h);
    $hEmpty1[$h] = false;
    $vBool = false;
  }
  if ($vBool) $vEmpty[] = $v;
}

$hEmpty = array ();
for ($h=0; $h<$strt; $h++)
  if ($hEmpty1[$h]) $hEmpty[] = $h;

$tot = 0;
$n = count($imagePos);
for ($i=0; $i<$n; $i++) {
  for ($j=$i+1; $j<$n; $j++) {
    $tot += abs(($v1=$imagePos[$i][0]) - ($v2=$imagePos[$j][0])) +
            abs(($h1=$imagePos[$i][1]) - ($h2=$imagePos[$j][1]));

    if ($v1 > $v2) {
      $tmp = $v1;
      $v1 = $v2;
      $v2 = $tmp;
    }
    foreach ($vEmpty as $vE)
      if ($vE > $v1 and $vE < $v2) {
        $tot += $mult - 1;
      }

    if ($h1 > $h2) {
      $tmp = $h1;
      $h1 = $h2;
      $h2 = $tmp;
    }
    foreach ($hEmpty as $hE)
      if ($hE > $h1 and $hE < $h2) {
        $tot += $mult - 1;
      }
  }
}

echo "Result: $tot";

?>
