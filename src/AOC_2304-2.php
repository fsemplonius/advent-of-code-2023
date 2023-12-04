<?php

include 'Puzzle_2304.php';
$input = explode("\r\n", $s1);
unset($input[0]);

$tot = 0;

$nCards = array ();
for ($i=0; $i<count($input)-1; $i++)
  $nCards[] = 1;

$i = -1;
foreach ($input as $s1) {
  $i1 = ++$i + 1;
  list ($dum, $cards) = explode(': ', str_replace('  ', ' ', $s1));
  list ($win, $own) = explode (' | ', $cards);
  foreach (explode(' ', $win) as $draw) {
    $own1 = explode(' ', $own);
    if (in_array($draw, $own1)) $nCards[$i1++] += $nCards[$i];
  }
  $tot += $nCards[$i];
}

echo "Result: $tot";

?>
