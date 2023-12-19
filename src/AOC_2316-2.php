<?php

include 'Puzzle_2316.php';
$input = explode("\r\n", $s1);
//
// Please note that php does not handle backslashes correctly (I think)
// so in the input you need to substitude \\ by \\\\
//
// Build floor and empty floorCopySt
//
$floor = $floorCopySt = $stack = array ();
$strt = strlen($input[1]);
$eLine = str_repeat('e', $strt);
$eLineC = 'e'.str_repeat('.', $strt).'e';
$floor[] = "e$eLine".'e';
$floorCopySt[] = $floor[0];
while ($s1 = next($input)) {
  $floor[] = "e$s1".'e';
  $floorCopySt[] = $eLineC;
}
$floor[] = $floor[0];
$floorCopySt[] = $floorCopySt[0];

$floorDir = array('.' => (array(array(-1,0,0,9), array(0,1,1,9),  array(1,0,2,9),  array(0,-1,3,9))),
                  '/' => (array(array(0,1,1,9),  array(-1,0,0,9), array(0,-1,3,9), array(1,0,2,9))),
                  "\\"=> (array(array(0,-1,3,9), array(1,0,2,9),  array(0,1,1,9),  array(-1,0,0,9))),
                  '-' => (array(array(0,-1,3,0,1,1) , array(0,1,1,9), array(0,-1,3,0,1,1), array(0,-1,3,9))),
                  '|' => (array(array(-1,0,0,9), array(-1,0,0,1,0,2), array(1,0,2,9), array(-1,0,0,1,0,2))));

$dirInd = array (0, array(0,1), array(1,0), array(0,-1), array(-1, 0));

$vt = $ht = $dirt = 1;
$vdt = $hdt = 0;
while ($vht=next($dirInd)) {
  $vt -= $vdt; $ht -= $hdt;
  list ($vdt, $hdt) = $vht;
  $dirt = ($dirt+1) % 4;
  while ($floor[$vt][$ht] != 'e') {
    $floorCopy = $floorCopySt;
    $allLoc = array ();
    $sp = -1;
    $stack[++$sp] = array ($vt, $ht, $dirt);
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
    $totInd = 0;
    foreach ($floorCopy as $tiles) {
      $h = 1;
      while (($tile=$tiles[$h++]) != 'e')
        if ($tile == '#') $totInd++;
    }
    $tot = max($tot, $totInd);
    $vt += $vdt; $ht += $hdt;
  }
}

echo "Result: $tot";

?>
