<?php

include 'Puzzle_2308.php';
$input = explode("\r\n", $s1);

$RL = next($input);
$RL = $RL.'0';

next($input);
$nodes = array ();
while ($s1=next($input)) {
  $node = substr($s1, 0, 3);
  $nodeL = substr($s1, 7, 3);
  $nodeR = substr($s1, 12, 3);
  $nodes[$node] = array('L'=>$nodeL, "R"=>$nodeR);
}

$node = 'AAA';
$steps = $ip = 0;
while ($node != 'ZZZ') {
  if (($LorR=$RL[$ip++]) == '0') {
    $LorR = $RL[0];
    $ip = 1;
  }
  $node = $nodes[$node][$LorR];
  $steps++;
}

echo "Result: $steps";

?>
