<?php

include 'Puzzle_2319.php';
$input = explode("\r\n", $s1);

$work = array ();
while ($s1=next($input)) {
  list ($part, $rules) = explode('{', $s1);
  $i = 0;
  foreach (explode(',',$rules) as $rule) {
    if (strpos($rule, ($gtlt='<')) or strpos($rule, ($gtlt='>'))) {
      list ($val1, $val2) = explode(':', $rule);
      $work[$part][$i++] = array (($sr=$rule[0])=>array(substr($val1,2), $gtlt, $val2));
    }
    else {
      $work[$part][$i-1][$sr][3] = substr($rule, 0, -1);
    }
  }
}

while ($s1=next($input)) {
  $s1 = str_replace(array('{','}'), '', $s1);
  $keyVal = array ();
  $tot1 = 0;
  foreach (explode(',', $s1) as $cond) {
    list ($key, $val) = explode('=', $cond);
    $tot1 += $keyVal[$key] = $val;
  }
  $keyWalk = 'in';
  while (true) {
    foreach ($work[$keyWalk] as $part) {
      $key = key($part);
      $val = $keyVal[$key=key($part)];
      if ($part[$key][1] == '<' && $val < $part[$key][0] or
          $part[$key][1] == '>' && $val > $part[$key][0]) {
        $keyWalk = $part[$key][2];
        break;
      }
      elseif ($part[$key][3]) {
        $keyWalk = $part[$key][3];
        break;
      }
    }
    if ($keyWalk == 'R') break;
    if ($keyWalk == 'A') {
      $tot += $tot1;
      break;
    }
  }
}

echo "Result: " . $tot;

?>
