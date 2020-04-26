<?php
namespace Parv\Dice100;

/**
 * The computer class
 */
class Computer extends Player
{
    /**
     * Method that plays round for the computer
     */
    public function playRound()
    {
        $this->hasSaved = false;
        $this->hand->rollAllDice();
        $rolledOne = $this->hand->hasRolledAOne();

        if (!$rolledOne) {
            $handSum = $this->hand->getHandSum();
            $nrOfDice = $this->hand->getNrOfDice();
            $this->currentScore += $handSum;

            if ($handSum / $nrOfDice >= 3.5) {
                $this->saveCurrentScore();
                return;
            }
            $this->playRound();
        }
        $this->currentScore = 0;
    }
}
