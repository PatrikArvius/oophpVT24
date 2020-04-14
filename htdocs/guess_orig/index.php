<?php
/**
 * Guess my number game, my own $_SESSION version.
 */
include(__DIR__ . "/config.php");
include(__DIR__ . "/autoload.php");

//Starts the session
session_name("paar19");
session_start();

//Starts the game
if (!isset($_SESSION["guess"])) {
    $_SESSION["guess"] = new Guess();
}
$guess = $_SESSION["guess"];
$guesses = $guess->getGuesses();
$gameWinner = $guess->hasWinner();

//Renders the game page
require __DIR__ . "/view/guess_my_num.php";
