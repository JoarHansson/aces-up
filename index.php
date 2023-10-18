<?php

declare(strict_types=1);

require __DIR__ . "/header.php";
require __DIR__ . "/functions.php";


$suits = ["Spades", "Hearts", "Diamonds", "Clubs"];
$values = ["A", "2", "3", "4", "5", "6", "7", "8", "9", "10", "J", "Q", "K"];
$deck = [];

// construct deck of cards, add unicodes to each card and shuffle the deck:
foreach ($suits as $suit) {

  foreach ($values as $key => $value) {
    $deck[] = [
      "suit" => $suit,
      "value" => $value,
      "unicode" =>
      "U+1F0" . chr(65 + array_search($suit, $suits)) .
        base_convert(strval(array_keys($values)[$key] + 1), 10, 16)
    ];

    /*
    Value for key ($deck[x]["unicode"] explained:
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

dealCards($deck, $handOfCards);

echo "<pre>";
var_dump($handOfCards);
var_dump($deck);
?>

</body>

</html>