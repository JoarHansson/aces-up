<?php

declare(strict_types=1);
require __DIR__ . "/functions.php";
session_start();

if (isset($_POST["newCards"])) {

    $deck = $_SESSION["deck"];

    $topFourCards = dealFourCards($deck);

    if (!isset($_SESSION["piles"])) {
        $_SESSION["piles"] = [];
    }

    foreach ($topFourCards as $key => $card) {
        $_SESSION["piles"][$key][] = $card;
    }

    $_SESSION["topFourCards"] = $topFourCards;
    $_SESSION["deck"] = $deck;
}

header("Location: index.php");
exit;
