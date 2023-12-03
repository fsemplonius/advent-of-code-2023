<?php

include 'Puzzle_2303.php';
$input = explode("\r\n", $s1);

$condola = array ();
$strt = strlen($input[1]);
$dotLine = str_repeat('.', $strt);
$condola[] = ".$dotLine.";
while ($s1 = next($input))
  $condola[] = ".$s1.";
$condola[] = $condola[0];

function chkval($val) {
  return ($val >= '0' and $val <= '9') ? true : false;
}

$stars = array();

for ($v=1; $v<=$strt; $v++) {
  for ($h=1; $h<=$strt; $h++) {
    if (!chkval($val=$condola[$v][$h])) continue;
    $n = 2;
    while (chkval($val1=$condola[$v][++$h])) {
      $val = $val*10 + $val1;
      $n++;
    }
    for ($i=-1; $i<=1; $i++) {
      for ($j=0; $j<=$n; $j++) {
        if ($condola[$v1=$v+$i][$h1=$h-$j] == '*') {
          if (!isset($stars[$v1][$h1]))
            $stars[$v1][$h1] = array(1, $val);
          else {
            $stars[$v1][$h1][0]++;
            $stars[$v1][$h1][1] *= $val;
          }
        }
      }
    }
  }
}

$tot = 0;

for ($v=1; $v<=$strt; $v++)
  for ($h=1; $h<=$strt; $h++)
    if ($stars[$v][$h][0] == 2)
      $tot += $stars[$v][$h][1];

echo "Result: $tot";

?>
