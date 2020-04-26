<?php

namespace Anax\View;

//Starts session
if (session_status() == PHP_SESSION_NONE) {
    session_name("paar19");
    session_start();
}
$dice100 = $_SESSION["dice100"];
$comp = $dice100->computer;
$player = $dice100->player;

//Deals with the form.
$newGame = $_POST["newGame"] ?? null;
$compRoll = $_POST["compRoll"] ?? null;
$playerRoll = $_POST["nextRound"] ?? null;
$save = $_POST["save"] ?? null;

//Logic based on form values

// If the computer rolled.
if ($compRoll) {
    $comp->playRound();
    if ($comp->hasRolledOne() || $comp->hasSaved()) {
        $dice100->setPlayerTurn(true);
    }
}

if ($playerRoll) {
    $player->playRound();
    if ($player->hasRolledOne() || $player->hasSaved()) {
        $dice100->setPlayerTurn(false);
    }
}

if ($save) {
    $dice100->player->saveCurrentScore();
    $dice100->setPlayerTurn(false);
}

if ($newGame) {
    $_SESSION["newGame"] = "yes";
}
