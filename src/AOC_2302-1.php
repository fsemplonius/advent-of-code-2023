<?php

include 'Puzzle_2302.php';
$input = explode("\r\n", $s1);
$max = array ('red' => 12, 'green'=> 13, 'blue' => 14);
$tot = 0;

while ($line=next($input)) {
  $possible = true;
  list ($game, $sets) = explode(': ', $line);
  $cubes = explode('; ', $sets);
//echo 'here';
  foreach ($cubes as $set) {
    $cubes = explode(', ', $set);
    foreach ($cubes as $cube) {
      list ($num, $color) = explode(' ' , $cube);
      if ($max[$color] < $num) {
        $possible = false;
        break 2;
      }
    }
  }
  if ($possible) {
    list ($dum, $gameNum) = explode(' ', $game);
    $tot += $gameNum;
  }
}

echo "Result: $tot";

?>