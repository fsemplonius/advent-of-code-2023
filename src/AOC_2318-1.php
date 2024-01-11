<?php

include 'Puzzle_2318.php';
$input = explode("\r\n", $s1);
//
// Find limits of the map
//
$v = $h = $vmin = $vmax = $hmin = $hmax = 0;
while ($s1=next($input)) {
  list ($dir, $steps) = explode(' ', $s1);
  switch ($dir) {
  case 'U':
    $v -= $steps;
    break;
  case 'R':
    $h += $steps;
    break;
  case 'D':
    $v += $steps;
    break;
  case 'L':
    $h -= $steps;
  }
  $vmin = min($vmin, $v);
  $vmax = max($vmax, $v);
  $hmin = min($hmin, $h);
  $hmax = max($hmax, $h);
}
//
// Build empty map
//
$v = -$vmin;
$h = -$hmin;
$vlen = $vmax - $vmin + 1;
$hlen = $hmax - $hmin + 1;

$dotLine = str_repeat('.', $hlen) . 'E';
$interior = array_fill(0, $vlen, $dotLine);
//
// U R D L   side
//
$intDir = array('U' => (array(1, 9, 3, 9)),
                'R' => (array(9, 1, 9, 3)),
                'D' => (array(3, 9, 1, 9)),
                'L' => (array(9, 3, 9, 1)));
$dirInd = array(array(-1,0),array(0,1),array(1,0),array(0,-1));
$dirInit = array('U' => 1, 'R' => 2, 'D' => 3, 'L' => 0);
//
// Put the path in the map
//
$path = array ();
$side = -1;
reset($input);
while ($s1=next($input)) {
  list ($dir, $steps) = explode(' ', $s1);
  if ($side == -1) 
    $side = $dirInit[$dir];
  else
    $side = ($side + $intDir[$dir][$side]) % 4;
  switch ($dir) {
  case 'U':
    for ($i=$v-$steps; $i<$v; $i++) {
      $interior[$i][$h] = '#';
      $path[] = array ($i, $h, $side);
    }
    $v -= $steps;
    break;
  case 'R':
    for ($i=$h; $i<=$h+$steps; $i++) {
      $interior[$v][$i] = '#';
      $path[] = array ($v, $i, $side);
    }
    $h += $steps;
    break;
  case 'D':
    for ($i=$v; $i<$v+$steps; $i++) {
      $interior[$i][$h] = '#';
      $path[] = array ($i, $h, $side);
    }
    $v += $steps;
    break;
  case 'L':
    for ($i=$h-$steps; $i<=$h; $i++) {
      $interior[$v][$i] = '#';
      $path[] = array ($v, $i, $side);
    }
    $h -= $steps;
  }
}
//
// Find enclosed trenches
//
foreach ($path as $val) {
  list ($v, $h, $side) = $val;
  if ($interior[$v1=$v+$dirInd[$side][0]][$h1=$h+$dirInd[$side][1]] == '.') {
    $interior[$v1][$h1] = 'I';
  }
}
//
// Fill remaining I for enclosed trenches
//
for ($v=0; $v<$vlen; $v++) {
  $hs = $h = 0;
  while ($interior[$v][$h] != 'E') {
    while (!in_array($s1=$interior[$v][++$h], array('I','E'))) {}
    if ($s1 == 'E') break;
    if ($interior[$v+1][$h] == '.') {
      $interior[$v+1][$h] = 'I';
    }
    $hs = $h;
    while ($interior[$v][--$h] == '.') {
      $interior[$v][$h] = 'I';
    }
    while ($interior[$v][++$hs] == '.') {
      $interior[$v][$hs] = 'I';
      if ($interior[$v+1][$hs] == '.') {
        $interior[$v+1][$hs] = 'I';
      }
    }
    $h = $hs - 1;
  }
}
//
// count trenches
//
$tot = 0;
for ($v=0; $v<$vlen; $v++) {
  $h = -1;
  while ($interior[$v][++$h] != 'E') {
    if (in_array($s1=$interior[$v][$h], array('#','I'))) {
      $tot++;
    }
  }
}

echo "Result: " . $tot;

?>
