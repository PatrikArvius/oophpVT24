<?php

namespace Parv\Dice100;

//Starts session
if (session_status() == PHP_SESSION_NONE) {
    session_name("paar19");
    session_start();
}

//Deals with initiation form.
$numDice = $_POST["nrOfDiceRange"] ?? null;

//Saves Game object in session, initiated with number of dice from form.
if (!isset($_SESSION["dice100"])) {
    $_SESSION["dice100"] = new Game($numDice);
}
