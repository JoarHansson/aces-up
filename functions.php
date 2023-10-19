<?php

declare(strict_types=1);

// deal a hand of 4 cards (remove 4 cards from $deck and add them to $handOfCards)
$handOfCards = [];

function dealCards(array &$deck, array &$handOfCards)
{
  $handOfCards = array_splice($deck, 0, 4);

  // print unicode card:
  foreach ($handOfCards as $card) :
    $unicodeConverted = base_convert($card["unicode"], 16, 10); ?>

    <?php if ($card["suit"] === "Hearts" || $card["suit"] === "Diamonds") : ?>
      <span class="card font-red">
        <?= mb_chr(intval($unicodeConverted), 'UTF-8'); ?>
      </span>
    <?php elseif ($card["suit"] === "Spades" || $card["suit"] === "Clubs") : ?>
      <span class="card font-black">
        <?= mb_chr(intval($unicodeConverted), 'UTF-8'); ?>
      </span>
    <?php endif; ?>
  <?php endforeach; ?>
<?php }
