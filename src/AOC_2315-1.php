<?php

include 'Puzzle_2315.php';
//
$tot = 0;

foreach (explode(',', $s1) as $seq) {
  $n = 0;
  foreach (str_split($seq) as $char) {
    $n = ($n+ord($char)) * 17 % 256;
  }
  $tot += $n;
}

echo "Result: $tot";

?>
