<?php

declare(strict_types=1);

echo "<pre>";

$suits = ["Spades", "Hearts", "Diamonds", "Clubs"];
$values = ["A", "2", "3", "4", "5", "6", "7", "8", "9", "10", "J", "Q", "K"];
$deck = [];

// construct the deck of cards and shuffle it:
foreach ($suits as $suit) {

  foreach ($values as $key => $value) {
    $deck[] = [
      "suit" => $suit,
      "value" => $value,
      "unicodes" =>
      "U+1F0" . chr(65 + array_search($suit, $suits)) .
        base_convert(strval(array_keys($values)[$key] + 1), 10, 16)
    ];

    /*
    Value for key ($deck[x]["unicodes"] explained:
    chr(65 + array_search($suit, $suits)) == A,B,C or D.
    array_keys($values)[$key] == a number, 0 to 12.
      1 is then added because the unicode indexes start at 1, not 0.
    base_convert($int, 10, 16) converts to hexadecimal (again, because of unicode indexes)

    See this chart for more clarity:
    https://en.wikipedia.org/wiki/Playing_Cards_(Unicode_block)
    */
  }
}
shuffle($deck);

// print unicode card:
$unicodeCard = base_convert("U+1F0A2", 16, 10);
print_r(mb_chr(intval($unicodeCard), 'UTF-8') . "\n");


// deal a hand of 4 cards:
$handOfCards = [];

function dealCards(array &$deck, array &$handOfCards)
{
  $handOfCards = array_splice($deck, 0, 4);
}
print_r($deck);
print_r($handOfCards);
