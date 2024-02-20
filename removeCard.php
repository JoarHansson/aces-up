<?php

declare(strict_types=1);
require __DIR__ . "/functions.php";
session_start();


if (isset($_POST["arrayKey"])) {
    $arrayKey = $_POST["arrayKey"];

    $topFourCards = $_SESSION["topFourCards"];

    $canBeRemoved = compareCardValue($topFourCards[$arrayKey], $topFourCards);

    if ($canBeRemoved) {
        unset($topFourCards[$arrayKey]);
        array_pop($_SESSION["piles"][$arrayKey]);

        $topFourCards[$arrayKey] = $_SESSION["piles"][$arrayKey][count($_SESSION["piles"][$arrayKey]) - 1];
    }

    $_SESSION["topFourCards"] = $topFourCards;
}

header("Location: index.php");
exit;
