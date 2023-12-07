<?php

$result = 1;

$time = 60808676;
$dist = 601116315591300;
$st = 0;
while ((($time-++$st) * $st) <= $dist) {}
$en = $time;
while ((($time-(--$en) * $en) <= $dist) {}
$result *= $en - $st + 1;

echo "Result: $result";

?>
