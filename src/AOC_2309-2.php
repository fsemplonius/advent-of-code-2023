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

  $add = 0;
  for ($j=count($totHist); $j>=0; $j--)
    $add = $totHist[$j][0] - $add;
  $tot += $add;
}

echo "Result: $tot";

?>
