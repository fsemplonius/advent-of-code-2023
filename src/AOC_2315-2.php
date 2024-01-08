<?php

include 'Puzzle_2315.php';
//
$boxes = array();

foreach (explode(',', $s1) as $seq) {
  $n = 0;
  foreach (str_split($seq) as $char) {
    if ($char == '-') {
      unset($boxes[$n][substr($seq,0,-1)]);
    }
    elseif ($char == '=') {
      $boxes[$n][substr($seq,0,-2)] = substr($seq,-1);
      break;
    }
    else {
      $n = ($n+ord($char)) * 17 % 256;
    }
  }
}

foreach ($boxes as $n => $lenses) {
  $i = 1;
  foreach ($lenses as $lens)
    $tot += ($n+1) * $i++ * $lens;
}

echo "Result: $tot";

?>
