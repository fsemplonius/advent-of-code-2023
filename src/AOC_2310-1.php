<?php

include 'Puzzle_2310.php';
$input = explode("\r\n", $s1);

$pipes = array ();
while ($s1=next($input))
  $pipes[] = $s1;

// N W S E
$pipeDir = array('|' => (array(array(-1,0,2), array(0,0,0),  array(1,0,0),  array(0,0,0))),
                 '-' => (array(array(0,0,0),  array(0,1,1),  array(0,0,0),  array(0,-1,3))),
                 'L' => (array(array(0,0,0),  array(0,0,0),  array(0,1,1),  array(-1,0,0))),
                 'J' => (array(array(0,0,0) , array(-1,0,0), array(0,-1,3), array(0,0,0))),
                 '7' => (array(array(0,-1,3), array(1,0,2),  array(0,0,0),  array(0,0,0))),
                 'F' => (array(array(0,1,1),  array(0,0,0),  array(0,0,0),  array(1,0,2))),
                 '.' => (array(array(0,0,0),  array(0,0,0),  array(0,0,0),  array(0,0,0))),
                 '|' => (array(array(-1,0,0), array(0,0,0),  array(1,0,2),  array(0,0,0))));

$tot = 1;
for ($vs=0; $vs<count($pipes); $vs++) {
  if (($hs=strpos($pipes[$vs], 'S')) !== false) {
    foreach (array(array(-1,0),array(0,1),array(1,0),array(0,-1)) as $dir=>$dd) {
      list ($vd, $hd, $dum) = $pipeDir[$pipes[$v=$vs+$dd[0]][$h=$hs+$dd[1]]][$dir];
      if ($vd != 0 or $hd != 0) break;
    }
  }
}

while ($pipes[$v][$h] != 'S') {
  list ($vd, $hd, $dir) = $pipeDir[$pipes[$v][$h]][$dir];
  $v += $vd; $h += $hd;
  if ($vd == 0 and $hd == 0) exit; // to prevent infinite loops
  $tot++;
}

echo "Result: " . $tot/2;

?>
