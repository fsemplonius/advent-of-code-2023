<?php

include 'Puzzle_2305.php';
$input = explode("\r\n\r\n", $s1);

$seeds = explode(' ', explode(': ', $input[0])[1]);
$minSeed = 99999999999999;
$maxSeed = 0;
for ($i=0; $i<count($seeds); $i+=2) {
  $seedRange[] = array($seed=$seeds[$i], $seeds[$i]+$seeds[$i+1]);
  $minSeed = min($minSeed, $seed);
  $maxSeed = max($maxSeed, $seed);
}

print_r($seedRange);
echo " $minSeed, $maxSeed x ";
//exit;

$convert = array ();
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
for ($j=0; $j<count($seedRange); $j++) {
  for ($seed1=$seedRange[$j][0]; $seed1<$seedRange[$j][1]; $seed1++) {
    $seed = $seed1;
    for ($i=0; $i<=$n; $i++) {
      foreach ($convert[$i] as $src => $dst) {
        if ($seed >= $src and $seed < $src+$dst[1]) {
echo "\n seed1 $seed1 seed $seed src: $src len: ".$dst[1]." i: $i j: $j room: $room ";
          $seed += $dst[0] - $src;
          break;
        }
      }
    }
echo "$seed1 $seed; ";
    $loc = min($loc, $seed);
  }
}

echo "Result: $loc";

?>
