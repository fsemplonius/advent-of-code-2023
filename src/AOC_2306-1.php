<?php

//$timeDist = array (7=>9, 15=>40, 30=>200);
$timeDist = array (60=>601, 80=>1163, 86=>1559, 76=>1300);

$result = 1;
foreach ($timeDist as $time => $dist) {
  $notFnd = true;
  $st = 0;
  while ((($time-++$st) * $st) <= $dist) {}
  $en = $time;
  while ((($time-(--$en) * $en)) <= $dist) {}
  $result *= $en - $st + 1;
}

echo "Result: $result";

?>
