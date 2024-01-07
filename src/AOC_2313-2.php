<?php

include 'Puzzle_2313.php';
$input = explode("\r\n", $s1);

function check($mirror) {
  $vlen = count($mirror);
  $hlen = strlen($mirror[0]);
  $i = 0;
  while ($i < $vlen-1) {
    $found = true;
    $mod = 0;
    $j = $i;
    $k = $i+1;
    while ($j >= 0 and $k < $vlen) {
      for ($l=0; $l<$hlen; $l++) {
        if ($mirror[$j][$l] != $mirror[$k][$l] and ++$mod > 1) {
          $found = false;
          break 2;
        }
      }
      $j--; $k++;
    }
    $i++;
    if ($found and $mod == 1) return $i;
  }
  return 0;
}

$tot = 0;

while (true) {
  $mirror = array ();
  while ($s1=next($input))
    $mirror[] = $s1;
  if (count($mirror) == 0)
    break;
  if (($i=check($mirror)) != 0) {
    $tot += $i * 100;
    continue;
  }
  $mirrorV = array ();
  foreach ($mirror as $s2) {
    $i = 0;
    foreach (str_split($s2) as $s3) {
      $mirrorV[$i++] .= $s3;
    }
  }
  $tot += check($mirrorV);
}

echo "Result: $tot";

?>
