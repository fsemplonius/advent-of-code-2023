<?php

include 'Puzzle_2311.php';
$input = explode("\r\n", $s1);
//
$strt = strlen($input[0]);
$image0 = array ();
$hEmpty = array_fill(0, $strt, true);

for ($v=0; $v<count($input); $v++) {
  $image0[] = $input[$v];
  $vEmpty = true;
  $h = -1;
  while ($h < $strt and ($h=strpos($input[$v], '#', $h+1)) !== false) {
    $vEmpty = false;
    $hEmpty[$h] = false;
  }
  if ($vEmpty) $image0[] = $input[$v];
}

$strt = strlen($image0[0]);
$image = array ();
for ($v=0; $v<count($image0); $v++) {
  $s1 = '';
  for ($h=0; $h<$strt; $h++) {
    $s1 .= $s2 = $image0[$v][$h];
    if ($hEmpty[$h]) $s1 .= $s2;
  }
  $image[] = $s1;
}

$imagePos = array ();
for ($v=0; $v<count($image); $v++) {
  $h = -1;
  while ($h < $strt and ($h=strpos($image[$v], '#', $h+1)) !== false) {
    $imagePos[] = array ($v, $h);
  }
}

$tot = 0;
$n = count($imagePos);
for ($i=0; $i<$n; $i++) {
  for ($j=$i+1; $j<$n; $j++) {
    $tot += $tt = abs(($v1=$imagePos[$i][0]) - ($v2=$imagePos[$j][0])) +
            abs(($h1=$imagePos[$i][1]) - ($h2=$imagePos[$j][1]));
  }
}

echo "Result: $tot";

?>
