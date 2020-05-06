<?php

namespace Anax\View;

$comp = $dice101->computer;
$player = $dice101->player;

//Logic based on data

// If the computer rolled.
if ($compRoll) {
    // Plays round for computer
    $comp->playRound($pScore, $cScore);

    //Turns over the turn if computer rolls 1 or saves.
    if ($comp->hasRolledOne() || $comp->hasSaved()) {
        // Adds all values the computer rolled to histogram
        $dice101->populateHistogramSerie("computer");

        //Sets turn to players
        $dice101->setPlayerTurn(true);
    }
}

// If the player has rolled
if ($playerRoll) {
    // Plays round for player
    $player->playRound();

    // Adds rolled values to histogram
    $dice101->populateHistogramSerie("player");

    // Sets players turn to false if player rolls 1 or saves.
    if ($player->hasRolledOne() || $player->hasSaved()) {
        $dice101->setPlayerTurn(false);
    }
}

// Saves score and turn goes over if save button is pressed.
if ($save) {
    $dice101->player->saveCurrentScore();
    $dice101->setPlayerTurn(false);
}
