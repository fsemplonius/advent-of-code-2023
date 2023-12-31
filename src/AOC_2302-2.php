<?php

include 'Puzzle_2302.php';
$input = explode("\r\n", $s1);
$tot = 0;

while ($line=next($input)) {
  $min = array ('red' => 0, 'green'=> 0, 'blue' => 0);
  list ($game, $sets) = explode(': ', $line);
  foreach (explode('; ', $sets) as $set) {
    foreach (explode(', ', $set) as $cube) {
      list ($num, $color) = explode(' ' , $cube);
      $min[$color] = max($min[$color], $num);
    }
  }
  $tot += $min['red'] * $min['green'] * $min['blue'];
}

echo "Result: $tot";

?>