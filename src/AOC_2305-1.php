<?php

include 'Puzzle_2305.php';
$input = explode("\r\n\r\n", $s1);

$convert = array ();
$seeds = explode(' ', explode(': ', $input[0])[1]);
$n = -1;
while ($s1=next($input)) {
  $line = explode("\r\n", $s1);
  $n++;
  while ($s2=next($line)) {
    $s3 = explode(' ', $s2);
    $convert[$n][$s3[1]] = array ($s3[0], $s3[2]);
  }
  ksort($convert[$n], SORT_NUMERIC);
}

$loc = 99999999999999;
foreach ($seeds as $seed) {
  for ($i=0; $i<=$n; $i++) {
    foreach ($convert[$i] as $src => $dst) {
      if ($seed >= $src and $seed < $src+$dst[1]) {
        $seed += $dst[0] - $src;
        break;
      }
    }
  }
  $loc = min($loc, $seed);
}

echo "Result: $loc";

?>
