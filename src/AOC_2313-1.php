<?php

include 'Puzzle_2313.php';
$input = explode("\r\n", $s1);

$tot = 0;

$mirror = array ();
while (true) {
  $mirror = array ();
  while ($s1=next($input))
    $mirror[] = $s1;
  if (($vlen=count($mirror)) == 0)
    break;
  $hlen = strlen($mirror[0]);
  $found = false;
  $i = 0;
  while ($i < $vlen-1) {
    if ($mirror[$i] == $mirror[$i+1]) {
      $found = true;
      $j = $i-1;
      $k = $i+2;
      while ($j >= 0 and $k < $vlen) {
        if ($mirror[$j] != $mirror[$k]) {
          $found = false;
          break;
        }
        $j--; $k++;
      }
      if ($found)
        break;
    }
    $i++;
  }
  if ($found) {
    $tot += ++$i*100;
    continue;
  }

  $s1 = $mirror;
  $mirror = array ();
  foreach ($s1 as $s2) {
    $i = 0;
    foreach (str_split($s2) as $s3) {
      $mirror[$i++] .= $s3;
    }
  }
  $vlen = count($mirror);
  $hlen = strlen($mirror[0]);
  $found = false;
  $i = 0;
  while ($i < $vlen-1) {
    if ($mirror[$i] == $mirror[$i+1]) {
      $found = true;
      $j = $i-1;
      $k = $i+2;
      while ($j >= 0 and $k < $vlen) {
        if ($mirror[$j] != $mirror[$k]) {
          $found = false;
          break;
        }
        $j--; $k++;
      }
      if ($found)
        break;
    }
    $i++;
  }
  if ($found)
    $tot += ++$i;
}

echo "Result: $tot";

?>
