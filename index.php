<?php

declare(strict_types=1);

$suits = ["Spades", "Hearts", "Clubs", "Diamonds"];

$values = ["2", "3", "4", "5", "6", "7", "8", "9", "10", "J", "Q", "K", "A"];

$deck = [];

foreach ($suits as $suit) {
  foreach ($values as $value) {
    $deck[] = ["suit" => $suit, "value" => $value];
  }
}
shuffle($deck);

echo "<pre>";
var_dump($deck);
