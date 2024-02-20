<?php

declare(strict_types=1);

require __DIR__ . "/header.php";
require __DIR__ . "/functions.php";

session_start();

if (!isset($_SESSION["deck"])) {
  $_SESSION["deck"] = createDeck();
}

$deck = $_SESSION["deck"];

if (isset($_SESSION["topFourCards"])) {
  $topFourCards = $_SESSION["topFourCards"];
}

?>

<form action="newCards.php" method="post">
  <button type="submit" name="newCards" value="true">new cards</button>
</form>

<?php

ksort($topFourCards);
// print cards to HTML based on unicode:
foreach ($topFourCards as $arrayKey => $card) :
  $unicodeConverted = base_convert($card["unicode"], 16, 10); ?>

  <?php if ($card["suit"] === "Hearts" || $card["suit"] === "Diamonds") : ?>

    <form class="inline-form" action="removeCard.php" method="post">
      <input type="text" name="arrayKey" value="<?php echo $arrayKey ?>" hidden>
      <button class="card font-red" type="submit">
        <?= mb_chr(intval($unicodeConverted), 'UTF-8'); ?>
      </button>
    </form>

  <?php elseif ($card["suit"] === "Spades" || $card["suit"] === "Clubs") : ?>

    <form class="inline-form" action="removeCard.php" method="post">
      <input type="text" name="arrayKey" value="<?php echo $arrayKey ?>" hidden>
      <button class="card font-black" type="submit">
        <?= mb_chr(intval($unicodeConverted), 'UTF-8'); ?>
      </button>
    </form>

  <?php endif; ?>
<?php endforeach;

echo "<pre>";
echo "piles:\n";
var_dump($_SESSION["piles"]);
echo "topFourCards:\n";
var_dump($topFourCards);
echo "deck:\n";
var_dump($deck);

$_SESSION["deck"] = $deck;
$_SESSION["topFourCards"] = $topFourCards;


?>

</body>

</html>