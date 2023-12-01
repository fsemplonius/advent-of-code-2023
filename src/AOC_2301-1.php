<?php

include 'Puzzle_2301.php';
$input = explode("\r\n", $s1);

$tot = 0;
while ($s1=next($input)) {
  $n = -1;
  $dig1 = false;
  while ($s1[++$n]) {
    if (!$dig1 and $s1[$n] >= '0' and $s1[$n] <= '9') $dig1 = $s1[$n];
    if ($s1[$n] >= '0' and $s1[$n] <= '9') $dig2 = $s1[$n];
  }
  $tot += (int) $dig1 * 10 + (int) $dig2;
}

echo "Result: $tot";

?>