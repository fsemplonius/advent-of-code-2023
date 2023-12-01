<?php

/*
one
two
three
four
five
six
seven
eight
nine
*/

include 'Puzzle_2301.php';
$input = explode("\r\n", $s1);

$tot = 0;
while ($s1=next($input)) {
  $n = -1;
  $s2 = array ();
  while ($s1[++$n]) {
    if ($s1[$n] == 'o' and $s1[$n+1] == 'n' and $s1[$n+2] == 'e') {
      $s2[] = '1';
      $n++;
    }
    elseif ($s1[$n] == 't') {
      if ($s1[$n+1] == 'w' and $s1[$n+2] == 'o') {
        $s2[] = '2';
        $n++;
      }
      elseif ($s1[$n+1] == 'h' and $s1[$n+2] == 'r' and $s1[$n+3] == 'e' and $s1[$n+4] == 'e') {
        $s2[] = '3';
        $n += 3;
      }
    }
    elseif ($s1[$n] == 'f') {
      if ($s1[$n+1] == 'o' and $s1[$n+2] == 'u' and $s1[$n+3] == 'r') {
        $s2[] = '4';
        $n += 3;
      }
      elseif ($s1[$n+1] == 'i' and $s1[$n+2] == 'v' and $s1[$n+3] == 'e') {
        $s2[] = '5';
        $n += 2;
      }
    }
    elseif ($s1[$n] == 's') {
      if ($s1[$n+1] == 'i' and $s1[$n+2] == 'x') {
        $s2[] = '6';
        $n += 2;
      }
      elseif ($s1[$n+1] == 'e' and $s1[$n+2] == 'v' and $s1[$n+3] == 'e' and $s1[$n+4] == 'n') {
        $s2[] = '7';
        $n += 4;
      }
    }
    elseif ($s1[$n] == 'e' and $s1[$n+1] == 'i' and $s1[$n+2] == 'g' and $s1[$n+3] == 'h' and $s1[$n+4] == 't') {
      $s2[] = '8';
      $n += 3;
    }
    elseif ($s1[$n] == 'n' and $s1[$n+1] == 'i' and $s1[$n+2] == 'n' and $s1[$n+3] == 'e') {
      $s2[] = '9';
      $n += 2;
    }
    else
      $s2[] = $s1[$n];
  }
  $n = -1;
  $dig1 = false;
  while ($s2[++$n]) {
    if (!$dig1 and $s2[$n] >= '0' and $s2[$n] <= '9') $dig1 = $s2[$n];
    if ($s2[$n] >= '0' and $s2[$n] <= '9') $dig2 = $s2[$n];
  }
  $tot += $nn = ((int) $dig1 * 10 + (int) $dig2);
}

echo "Result: $tot";

?>