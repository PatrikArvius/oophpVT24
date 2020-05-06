<?php
namespace Parv\Dice100;

/**
 * The computer class
 */
class Computer extends Player
{
    /**
     * @var array as array containing all rolls computer
     * made during its turn.
     */
    private $rolls;

    /**
     * Method that plays round for the computer
     *
     * @param int representing the score of the player
     * @param int representing the score of the computer
     */
    public function playRound($pScore = 0, $cScore = 0)
    {
        $this->hasSaved = false;
        $this->hand->rollAllDice();
        $this->saveRollsToArray();
        $rolledOne = $this->hand->hasRolledAOne();

        if (!$rolledOne) {
            $handSum = $this->hand->getHandSum();
            $nrOfDice = $this->hand->getNrOfDice();
            $this->currentScore += $handSum;

            // Comp will play safe and save if ahead by at least 20pts.
            if ($cScore - $pScore >= 20) {
                $this->saveCurrentScore();
                return;
            }

            // Comp saves if avg dice value is equal or greater than 3.5.
            if ($handSum / $nrOfDice >= 3.5) {
                $this->saveCurrentScore();
                return;
            }
            // If avg dice value is less than 3.5 comp rolls again.
            $this->playRound();
        }
        $this->currentScore = 0;
    }

    /**
     * Method that saves a round of rolls to an array
     * which we use since we simulate the computer turn
     * rather than manually rolling for it.
     */
    public function saveRollsToArray()
    {
        foreach ($this->hand->getDiceValuesArray() as $value) {
            $this->rolls[] = $value;
        }
    }

    /**
     * Method to get an array of last rolled
     * values
     *
     * @return array as values of dice rolled.
     */
    public function getLastRollArray()
    {
        $tempArr = $this->rolls;
        $this->rolls = [];
        return $tempArr;
    }
}
