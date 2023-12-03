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
  if ($val >= '0' and $val <= '9')
    return true;
  elseif ($val == '.')
    return false;
  return 2;
}

$tot = 0;

for ($v=1; $v<=$strt; $v++) {
  for ($h=1; $h<=$strt; $h++) {
    if (chkval($val=$condola[$v][$h]) !== true) continue;
    $n = 2;
    while (chkval($val1=$condola[$v][++$h]) === true) {
      $val = $val*10 + $val1;
      $n++;
    }
    $found = true;
    if (chkval($condola[$v][$h-$n]) != 2 and chkval($condola[$v][$h]) != 2) {
      $found = false;
      for ($i=-1; $i<=1; $i+=2) {
        for ($j=0; $j<=$n; $j++) {
          if (chkval($condola[$v+$i][$h-$j]) == 2) {
            $found = true;
            break 2;
          }
        }
      }
    }
    if ($found) {
      $tot += (int) $val;
    }
  }
}

echo "Result: $tot";

?>
