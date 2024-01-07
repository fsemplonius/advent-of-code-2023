<?php

include 'Puzzle_2314.php';
$input = explode("\r\n", $s1);

$vlen = count($input);
$hlen = strlen($input[0]);

$cache = array ();
$n = 0;
while (true) {
  $n++;
  $save = $vlen;
  $vlen = $hlen;
  $hlen = $save;
  $s1 = str_repeat('.', $hlen);
  $inputNew = array_fill(0, $hlen, $s1);
  $tot = 0;
  for ($h=0; $h<$vlen; $h++) {
    $rockO = $rockHash = 0;
    for ($v=0; $v<$hlen; $v++) {
      if (($rock=$input[$v][$h]) == 'O') {
        $rockO = max($rockHash, ++$rockO);
        $inputNew[$h][$vlen-$rockO] = 'O';
      }
      elseif ($rock == '#') {
        $rockHash = $v+2;
        $inputNew[$h][$vlen-$v-1] = '#';
      }
    }
  }
  if ($n%4 == 0) {
    if (in_array($inputNew, $cache)) break;
    $cache[] = $inputNew;
  }
  $input = $inputNew;
}

$rep = ($lCache=count($cache)) - ($pCache=array_search($inputNew, $cache));
$repCache = (1000000000 - $lCache - 1) % $rep;
$input=$cache[$pCache+$repCache];

$tot = 0;

for ($h=0; $h<$hlen; $h++) {
  for ($v=0; $v<$vlen; $v++) {
    if (($input[$v][$h]) == 'O') {
      $tot += $vlen - $v;
    }
  }
}

echo "Result: $tot";

?>
