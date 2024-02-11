<?php

declare(strict_types=1);

require __DIR__ . "/header.php";
require __DIR__ . "/functions.php";

$deck = createDeck();
$topFourCards = dealFourCards($deck);
$canBeRemoved = compareCardValue($topFourCards[0], $topFourCards);

// print cards to HTML based on unicode:
foreach ($topFourCards as $card) :
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
<?php endforeach;

echo "<pre>";
echo $canBeRemoved . "\n";
print_r($topFourCards);
print_r($deck);
?>

</body>

</html>