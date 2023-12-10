<?php

include 'Puzzle_2309.php';
$input = explode("\r\n", $s1);

$tot = 0;

while ($s1=next($input)) {
  $totHist = array (0 => $hist = explode(' ', $s1));
  $nHist = array ();
  array ();
  while (true) {
    $val = $hist[0];
    unset($hist[0]);
    foreach ($hist as $nVal) {
      $nHist[] = $nVal - $val;
      $val = $nVal;
    }
    $found = true;
    foreach ($nHist as $s2) {
      if ($s2 != 0) {
        $found = false;
        break;
      }
    }
    if ($found) break;
    $totHist[] = $hist = $nHist;
    $nHist = array ();
  }
  $lenVert = count($totHist[$lenHor=count($totHist)-1])-1;
  for ($j=$lenHor; $j>=0; $j--)
    $tot += $totHist[$j][$lenVert++];
}

echo "Result: $tot";

?>
