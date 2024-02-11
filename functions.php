<?php

declare(strict_types=1);

function createDeck(): array
{
  $suits = ["Spades", "Hearts", "Diamonds", "Clubs"];
  $charsOnCards = ["A", "2", "3", "4", "5", "6", "7", "8", "9", "10", "J", "Q", "K"];
  $deck = [];

  foreach ($suits as $suit) {
    foreach ($charsOnCards as $key => $charsOnCard) {

      $lastUnicodeChar = 1; // (1,2,3,4,5,6,7,8,9,a,b,d,e)

      switch (base_convert(strval(array_keys($charsOnCards)[$key] + 1), 10, 16)) {
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
          $lastUnicodeChar = base_convert(strval(array_keys($charsOnCards)[$key] + 1), 10, 16);
      }

      if ($key == 0) {
        $deck[] = [
          "suit" => $suit,
          "charsOnCard" => $charsOnCard,
          "value" => 14,  // Aces (index 0) are worth 14 in this game
          "unicode" =>
          "U+1F0" . chr(65 + array_search($suit, $suits)) . $lastUnicodeChar,
        ];
      } else {
        $deck[] = [
          "suit" => $suit,
          "charsOnCard" => $charsOnCard,
          "value" => $key + 1, // ex: 2 of spades (index 1) has the value of 2
          "unicode" =>
          "U+1F0" . chr(65 + array_search($suit, $suits)) . $lastUnicodeChar,
        ];
      }

      /*
    $deck[x]["unicode"] explained:

      * "U+1F0" - all cards start with this substring.

      * chr(65 + array_search($suit, $suits)) == A,B,C or D (depending on suit)

      * $lastUnicodeChar:
        - array_keys($charsOnCards)[$key] == a number, 0 to 12.
        - 1 is then added because the unicode indexes start at 1, not 0.
        - base_convert($int, 10, 16) converts number to hexadecimal (because of unicode indexes)

    See this chart for more clarity:
    https://en.wikipedia.org/wiki/Playing_Cards_(Unicode_block)
    */
    }
  }
  return $deck;
}

// return a "hand" of 4 cards (and remove those 4 cards from the $deck)
function dealFourCards(array &$deckOfCards): array
{
  shuffle($deckOfCards);
  return array_splice($deckOfCards, 0, 4);
}

// return true if the $cardToEvaluate can be removed from the game
// (it matches the suit of one or more of the other 3 cards, and has a lower value than at least one of them). 
function compareCardValue(array $cardToEvaluate, array $cardsToCompareAgainst): bool
{
  foreach ($cardsToCompareAgainst as $card) {
    if (
      $card["suit"] === $cardToEvaluate["suit"] &&
      $card["value"] > $cardToEvaluate["value"]
    ) {
      return true;
    }
  }
  return false;
}
