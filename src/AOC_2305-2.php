<?php

include 'Puzzle_2305.php';
$input = explode("\r\n\r\n", $s1);

$seeds = explode(' ', explode(': ', $input[0])[1]);
for ($i=0; $i<count($seeds); $i+=2)
  $seedRange[] = array($seed=$seeds[$i], $seeds[$i]+$seeds[$i+1]);

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
  $seed1=$seedRange[$j][0];
  while ($seed1 < $seedRange[$j][1]) {
    $room = $seedRange[$j][1]-$seedRange[$j][0];
    $seed = $seed1;
    for ($i=0; $i<=$n; $i++) {
      foreach ($convert[$i] as $src => $dst) {
        if ($seed >= $src and $seed < $src+$dst[1]) {
          $room = min($room, $src+$dst[1]-$seed);
          $seed += $dst[0] - $src;
          break;
        }
      }
    }
    $seed1 += $room;
    $loc = min($loc, $seed);
  }
}

echo "Result: $loc";

?>
