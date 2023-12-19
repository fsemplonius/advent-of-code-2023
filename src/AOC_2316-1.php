<?php

include 'Puzzle_2316.php';
$input = explode("\r\n", $s1);
//
// please note that php does not handle backslashes correctly (I think)
// so in the input you need to substitude \\ by \\\\
//
// Build floor and empty floorCopy
//
$floor = $floorCopy = $stack = $allLoc = array ();
$strt = strlen($input[1]);
//echo "strt $strt";
$eLine = str_repeat('e', $strt);
$eLineC = 'e'.str_repeat('.', $strt).'e';
$floor[] = "e$eLine".'e';
$floorCopy[] = $floor[0];
while ($s1 = next($input)) {
  $floor[] = 'e'.$s1.'e';
  $floorCopy[] = $eLineC;
}
$floor[] = $floor[0];
$floorCopy[] = $floorCopy[0];

$floorDir = array('.' => (array(array(-1,0,0,9), array(0,1,1,9),  array(1,0,2,9),  array(0,-1,3,9))),
                  '/' => (array(array(0,1,1,9),  array(-1,0,0,9), array(0,-1,3,9), array(1,0,2,9))),
                  "\\"=> (array(array(0,-1,3,9), array(1,0,2,9),  array(0,1,1,9),  array(-1,0,0,9))),
                  '-' => (array(array(0,-1,3,0,1,1) , array(0,1,1,9), array(0,-1,3,0,1,1), array(0,-1,3,9))),
                  '|' => (array(array(-1,0,0,9), array(-1,0,0,1,0,2), array(1,0,2,9), array(-1,0,0,1,0,2))));

$sp = -1;
$stack[++$sp] = array (1, 1, 1);	// $v $h $dir

while ($sp >= 0) {
  list ($v, $h, $dir) = $stack[$sp--];
  while ($floor[$v][$h] != 'e') {
    list ($vd, $hd, $dir, $vd1, $hd1, $dir1) = $floorDir[$floor[$v][$h]][$dir];
    if ($vd1 != 9 and $floor[$vd2=$v+$vd1][$hd2=$h+$hd1] != 'e') {
      if (in_array($s1=array($v,$h), $allLoc)) break;
      $stack[++$sp] = array ($vd2, $hd2, $dir1);
      $allLoc[] = $s1;
    }
    $floorCopy[$v][$h] = '#';
    $v += $vd; $h += $hd;
  }
}

$tot = 0;

foreach ($floorCopy as $tiles) {
  $h = 1;
  while (($tile=$tiles[$h++]) != 'e')
    if ($tile == '#') $tot++;
}

echo "Result: " . $tot;

?>
