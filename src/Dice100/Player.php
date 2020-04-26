<?php
namespace Parv\Dice100;

/**
 * The Player class
 */
class Player
{
    /**
     * @var DiceHand $hand as the hand of dice objects
     * @var int $currentScore as the score prior to saving or hitting a one.
     * @var int $savedScore as the score that's been saved away.
     */
    protected $hand;
    protected $currentScore;
    protected $savedScore;
    protected $saved;
    protected $rolled;

    /**
     * Constructor method
     */
    public function __construct($nrOfDice = 3, $sides = 6, $startValue = 1)
    {
        $this->hand = new DiceHand($nrOfDice, $sides, $startValue);
        $this->currentScore = 0;
        $this->savedScore = 0;
        $this->saved = false;
        $this->rolled = false;
    }

    /**
     * Method that rolls dice and adds their sum to player score
     * unless a one has been rolled in which case score goes back
     * to 0.
     */
    public function playRound()
    {
        $this->saved = false;
        $this->rolled = false;
        $this->hand->rollAllDice();

        if (!$this->hand->hasRolledAOne()) {
            $this->currentScore += $this->hand->getHandSum();
            $this->rolled = true;
            return;
        }
        $this->currentScore = 0;
    }

    /**
     * Method that saves current score then resets it.
     */
    public function saveCurrentScore()
    {
        $this->savedScore += $this->currentScore;
        $this->currentScore = 0;
        $this->saved = true;
        $this->rolled = false;
    }

    /**
     * Method that returns the current score
     *
     * @return int as the current score of the player.
     */
    public function getCurrentScore()
    {
        return $this->currentScore;
    }

    /**
     * Method that returns the saved score.
     *
     * @return int as the saved score.
     */
    public function getSavedScore()
    {
        return $this->savedScore;
    }

    /**
     * Method to set saved score, for
     * testing purposes.
     *
     * @param int as number to set as the saved score.
     */
    public function setSavedScore($num)
    {
        $this->savedScore = $num;
    }

    /**
     * Method to get a string of last rolled
     * values
     *
     * @return string as values of dice rolled.
     */
    public function getLastRoll()
    {
        return $this->hand->getDiceValues();
    }

    /**
     * Method that gets if player has rolled a one.
     *
     * @return bool as if player rolled a one or not.
     */
    public function hasRolledOne()
    {
        return $this->hand->hasRolledAOne();
    }

    /**
     * Method that returns if player has saved or not.
     *
     * @return bool as if player has saved or not.
     */
    public function hasSaved()
    {
        return $this->saved;
    }

    /**
     * Method that returns if player has rolled or not.
     *
     * @return bool as if player has rolled or not.
     */
    public function hasRolled()
    {
        return $this->rolled;
    }
}
