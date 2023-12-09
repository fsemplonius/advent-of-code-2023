<?php

//https://www.geeksforgeeks.org/introduction-to-chinese-remainder-theorem/

include 'Puzzle_2308.php';
$input = explode("\r\n", $s1);

$RL = next($input);
$RL = $RL.'0';

next($input);
$nodes = $cnode = array ();
while ($s1=next($input)) {
  $node = substr($s1, 0, 3);
  if ($node[2] == 'A') $cnode[] = $node;
  $nodeL = substr($s1, 7, 3);
  $nodeR = substr($s1, 12, 3);
  $nodes[$node] = array('L'=>$nodeL, "R"=>$nodeR);
}

$tot = 1;

$ipRL = 0;
foreach ($cnode as $node) {
  $steps =  0;
  while (true) {
    if (($LorR=$RL[$ipRL++]) == '0') {
      $LorR = $RL[0];
      $ipRL = 1;
    }
    $node = $nodes[$node][$LorR];
    $steps++;
    if ($node[2] == 'Z') {
      $x = $tot; $y = $steps;
      while ($x != $y) {
        if ($x > $y)
          $x -= $y;
        else
          $y -= $x;
      }
      $tot = floor($tot * $steps / $x);
      break;
    }
  }
}

echo "Result: $tot";

?>
