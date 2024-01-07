<?php

include 'Puzzle_2314.php';
$input = explode("\r\n", $s1);

$tot = 0;

$pos = array();
$vlen = count($input);
$hlen = strlen($input[0]);

for ($h=0; $h<$hlen; $h++) {
  $rockO = $rockHash = 0;
  for ($v=0; $v<$vlen; $v++) {
    if (($rock=$input[$v][$h]) == 'O') {
      $rockO = max($rockHash, ++$rockO);
      $tot += $vlen - $rockO + 1;
    }
    elseif ($rock == '#') 
      $rockHash = $v+2;
  }
//echo "rockO $rockO\n";
}

echo "Result: $tot";

?>
