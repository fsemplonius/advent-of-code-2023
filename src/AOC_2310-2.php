<?php

include 'Puzzle_2310.php';
$input = explode("\r\n", $s1);
//
// Build pipes map and empty pipesCopy
//
$pipes = $pipesCopy = $path = array ();
$strt = strlen($input[1]);
$dotLine = str_repeat('.', $strt);
$pipes[] = ".$dotLine.";
$dotLineC = str_repeat('O', $strt);
$pipesCopy[] = "O$dotLineC".'E';
while ($s1 = next($input)) {
  $pipes[] = ".$s1.";
  $pipesCopy[] = "O$dotLine".'E';
}
$pipes[] = $pipes[0];
$pipesCopy[] = $pipesCopy[0];
//
// Reference tables
// N W S E   v h dir side
//
$pipeDir = array('|' => (array(array(-1,0,2,0), array(0,0,0,0),  array(1,0,0,0),  array(0,0,0,0))),
                 '-' => (array(array(0,0,0,0),  array(0,1,1,0),  array(0,0,0,0),  array(0,-1,3,0))),
                 'L' => (array(array(0,0,0,0),  array(0,0,0,0),  array(0,1,1,3),  array(-1,0,0,1))),
                 'J' => (array(array(0,0,0,0) , array(-1,0,0,3), array(0,-1,3,1), array(0,0,0,0))),
                 '7' => (array(array(0,-1,3,3), array(1,0,2,1),  array(0,0,0,0),  array(0,0,0,0))),
                 'F' => (array(array(0,1,1,1),  array(0,0,0,0),  array(0,0,0,0),  array(1,0,2,3))),
                 '.' => (array(array(0,0,0,0),  array(0,0,0,0),  array(0,0,0,0),  array(0,0,0,0))),
                 '|' => (array(array(-1,0,0,0), array(0,0,0,0),  array(1,0,2,0),  array(0,0,0,0))));
$dirInd = array(array(-1,0),array(0,1),array(1,0),array(0,-1));

$tot = 0;

//
// Find start $vs,$vh and second pos. $v,$h
//
for ($vs=0; $vs<count($pipes); $vs++) {
  if (($hs=strpos($pipes[$vs], 'S')) !== false) {
    $pipesCopy[$vs][$hs] = 'S';
    $path[] = array ($vs, $hs, $side=($dir+1)%4);	// when side is wrong change to $dir+1 or $dir+3
    foreach ($dirInd as $dir=>$dd) {
      list ($vd, $hd, $dum) = $pipeDir[$pipes[$v=$vs+$dd[0]][$h=$hs+$dd[1]]][$dir];
      if ($vd != 0 or $hd != 0) break;
    }
  }
}
$pipesCopy[$v][$h] = $pipes[$v][$h];
$side = ($dir+1) % 4;
$path[] = array ($v, $h, $side);
//
// Run the path and mark in $pipesCopy and store in $path
//
while ($pipes[$v][$h] != 'S') {
  list ($vd, $hd, $dir, $sided) = $pipeDir[$pipes[$v][$h]][$dir];
  $v += $vd; $h += $hd;
  $side = ($side+$sided) % 4;
  if ($vd == 0 and $hd == 0) exit;
  $pipesCopy[$v][$h] = $pipes[$v][$h];
  $path[] = array ($v, $h, $side);
}
//
// Fill from 4 sides with O
//
for ($v=1; $v<count($pipesCopy)-1; $v++) {
  $h = 0;
  while (($v1=$pipesCopy[$v][++$h]) != 'E') {
    if ($v1 == '.' and $pipesCopy[$v][$h-1] == 'O' || $pipesCopy[$v-1][$h] == 'O')
      $pipesCopy[$v][$h] = 'O';
  }
  $h = $strt+1;
  while (--$h > 1) {
    if ($pipesCopy[$v][$h] == '.' and 
        ($v1=$pipesCopy[$v][$h+1]) == 'E' || $v1 == 'O' || $pipesCopy[$v-1][$h] == 'O')
      $pipesCopy[$v][$h] = 'O';
  }
}
for ($h=1; $h<=$strt; $h++) {
  $v = count($pipesCopy)-1;
  while (--$v > 1) {
    if ($pipesCopy[$v][$h] == '.' and $pipesCopy[$v][$h+1] == 'O')
        $pipesCopy[$v][$h] = 'O';
  }
}
//
// Find enclosed tiles
//
foreach ($path as $val) {
  list ($v, $h, $side) = $val;
  if (($s1=$pipesCopy[$v1=$v+$dirInd[$side][0]][$h1=$h+$dirInd[$side][1]]) == 'O') {
    echo "O => v $v h $h side $side\n";
    echo "Error wrong side at start";	// change program
    exit;
  }
  if ($s1 == '.') {
    $pipesCopy[$v1][$h1] = 'I';
  }
}
//
// Fill remaining I for enclosed tiles and count
//
$v = 0;
foreach ($pipesCopy as $val) {
  $hs = $h = 0;
  while ($val[$h] != 'E') {
    while (!in_array($s1=$val[++$h], array('I','E'))) {}
    if ($s1 == 'E') break;
    $tot++;
    $hs = $h;
    while ($pipesCopy[$v][--$h] == '.') {
      $pipesCopy[$v][$h] = 'I';
      $tot++;
    }
    while ($val[++$hs] == '.') {
      $pipesCopy[$v][$hs] = 'I';
      $tot++;
    }
    $h = $hs - 1;
  }
  $v++;
}

echo "Result: " . $tot;

?>
