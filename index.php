<?php

declare(strict_types=1);

require __DIR__ . "/header.php";
require __DIR__ . "/functions.php";


$suits = ["Spades", "Hearts", "Diamonds", "Clubs"];
$values = ["A", "2", "3", "4", "5", "6", "7", "8", "9", "10", "J", "Q", "K"];
$deck = [];

// The output of these nested foreach loops is the a populated array $deck. 
// It contains suit and value as well as the unicode for each card.
foreach ($suits as $suit) {
  foreach ($values as $key => $value) {

    $lastUnicodeChar; // (1,2,3,4,5,6,7,8,9,a,b,d,e)

    switch (base_convert(strval(array_keys($values)[$key] + 1), 10, 16)) {
      case "a":
        $lastUnicodeChar = "a";
        break;
      case "b":
        $lastUnicodeChar = "b";
        break;
      case "c":
        $lastUnicodeChar = "d";
        break;
      case "d":
        $lastUnicodeChar = "e";
        break;
      default:
        $lastUnicodeChar = base_convert(strval(array_keys($values)[$key] + 1), 10, 16);
    }

    $deck[] = [
      "suit" => $suit,
      "value" => $value,
      "unicode" =>
      "U+1F0" . chr(65 + array_search($suit, $suits)) . $lastUnicodeChar,
    ];

    /*
    Value for key ($deck[x]["unicode"] explained:

      * "U+1F0" - all cards start with this substring.

      * chr(65 + array_search($suit, $suits)) == A,B,C or D (depending on suit)

      * $lastUnicodeChar:
        - array_keys($values)[$key] == a number, 0 to 12.
        - 1 is then added because the unicode indexes start at 1, not 0.
        - base_convert($int, 10, 16) converts number to hexadecimal (because of unicode indexes)

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