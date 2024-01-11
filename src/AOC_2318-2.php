<?php

include 'Puzzle_2318.php';
$input = explode("\r\n", $s1);

$dirs = array(0 => 'R', 1 => 'D', 2 => 'L', 3 => 'U');
$tot = 2;
$path = array ();
$v = $h = 0;
while ($s1=next($input)) {
  list ($dum, $hex) = explode('(#', $s1);
  $steps = hexdec(substr($hex, 0, 5));
  $dir = $dirs[$hex[5]];
  switch ($dir) {
  case 'U':
    $v += $steps;
    break;
  case 'R':
    $h += $steps;
    break;
  case 'D':
    $v -= $steps;
    break;
  case 'L':
    $h -= $steps;
  }
  $c3 = $v;
  $c4 = $h;
  $tot += $steps + $c1 * $c4 - $c2 * $c3;
  $first = false;
  $c1 = $c3;
  $c2 = $c4;
}

echo "Result: " . $tot/2;

?>
