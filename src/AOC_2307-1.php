<?php

include 'Puzzle_2307.php';
$input = explode("\r\n", $s1);

function cmpCards($card1, $card2) {
  $strength = array ('A', 'K', 'Q', 'J', 'T', '9', '8', '7', '6', '5', '4', '3', '2');
  $cmpCards = array (array($card1[0],$card1[1],$card1[2],$card1[3],$card1[4]),
                     array($card2[0],$card2[1],$card2[2],$card2[3],$card2[4]));
  $n = 0;
  $str = 0;
  foreach ($cmpCards as $cards) {
    $cardsStr = array ();
    foreach ($cards as $card)
      $cardsStr[] = array_search($card, $strength);
    $fCard[$n] = $cardsStr;
    $cntCards = array_count_values(array_count_values($cardsStr));
    if ($cntCards[5] == 1)
      $val[$n] = 0; // Five of a kind
    elseif ($cntCards[4] == 1)
      $val[$n] = 1; // Four of a kind
    elseif ($cntCards[2] == 1 and $cntCards[3] == 1)
      $val[$n] = 2; // Full House
    elseif ($cntCards[3] == 1)
      $val[$n] = 3; // Three of a kind
    elseif ($cntCards[2] == 2)
      $val[$n] = 4; // Two pair
    elseif ($cntCards[2] == 1)
      $val[$n] = 5; // One pair
    else
      $val[$n] = 6; // High card
    $n++;
  }

  if ($val[0] == $val[1]) {
    $n = 0;
    while (true) {
      if ($fCard[0][$n] != $fCard[1][$n]) {
        $ret = ($fCard[0][$n] < $fCard[1][$n]) ? 1 : -1;
        break;
      }
      $n++;
    }
  }
  elseif ($val[0] < $val[1])
    $ret = 1;
  else
    $ret = -1;
  return $ret;
}

$cards = array ();
while ($s1=next($input)) {
  list($card, $bid) = explode(' ', $s1);
  $cards[$bid] = $card;
}
uasort($cards, 'cmpCards');

$tot = 0;
$n = 1;
foreach ($cards as $bid => $card)
  $tot += $n++ * $bid;
echo "Result: $tot";

?>
