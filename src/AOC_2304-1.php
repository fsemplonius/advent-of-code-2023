<?php

include 'Puzzle_2304.php';
$input = explode("\r\n", $s1);

$tot = 0;

while ($s1=next($input)) {
  list ($dum, $cards) = explode(': ', str_replace('  ', ' ', $s1));
  list ($win, $own) = explode (' | ', $cards);
  $n = 0;
  foreach (explode(' ', $win) as $draw) {
    $own1 = explode(' ', $own);
    if (in_array($draw, $own1)) {
      $n *= 2;
      if (!$n) $n = 1;
    }
  }
  $tot += $n;
}

echo "Result: $tot";

?>
