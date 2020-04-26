<?php
namespace Parv\Dice100;

/**
 * DiceHand class
 */
class DiceHand
{
    /**
     * @var Dice $hand Array of dice objects
     * @var int $dices the number of dice objects
     */
    private $hand;
    private $dices;

    /**
     * Constructor
     *
     * @param int as number of dice objects the class will consist of
     * @param int as number of sides each dice should have
     */
    public function __construct($dices = 3, $sides = 6, $startValue = 1)
    {
        $this->dices = $dices;
        $this->hand = [];

        for ($i = 0; $i < $dices; $i++) {
            $this->hand[] = new Dice($sides, $startValue);
        }
    }

    /**
     * Method that returns the sum of all dice values in the hand.
     *
     * @return int as sum of dice values
     */
    public function getHandSum()
    {
        $handSum = 0;

        for ($i = 0; $i < $this->dices; $i++) {
            $handSum += $this->hand[$i]->getDiceValue();
        }
        return $handSum;
    }

    /**
     * Method that returns nr of dice
     *
     * @return int as number of dice
     */
    public function getNrOfDice()
    {
        return $this->dices;
    }

    /**
     * Method that rolls all dice in hand.
     */
    public function rollAllDice()
    {
        foreach ($this->hand as $dice) {
            $dice->rollDice();
        }
    }

    /**
     * Method to get the individual dice values
     *
     * @return string as string of ind dice values
     */
    public function getDiceValues()
    {
        $values = "";

        foreach ($this->hand as $dice) {
            $values .= $dice->getDiceValue() . ", ";
        }

        $values = rtrim($values, ", ");
        return $values;
    }

    /**
     * Method that checks if a one has been rolled.
     *
     * @return bool as weather or not a 1 has been rolled.
     */
    public function hasRolledAOne()
    {
        foreach ($this->hand as $dice) {
            if ($dice->getDiceValue() === 1) {
                return true;
            }
        }
        return false;
    }
}
