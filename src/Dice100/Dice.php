<?php
namespace Parv\Dice100;

/**
 * The Dice class
 */
class Dice
{
    /**
     * @var int $diceValue the number the dice is currently showing.
     * @var int $sides the number of sides on the dice.
     * @var int $startValue the lowest value side of the dice.
    */
    private $diceValue;
    private $sides;
    private $startValue;

    // Constructor
    public function __construct($sides = 6, $startValue = 1)
    {
        $this->diceValue = rand($startValue, $sides);
        $this->sides = $sides;
        $this->startValue = $startValue;
    }

    /**
    * Function that rolls the dice and sets its value to the new value
    */
    public function rollDice()
    {
        $this->diceValue = rand($this->startValue, $this->sides);
    }

    /**
     * Function to get the current value of the dice
     *
     * @return int as the number the dice is showing
     */
    public function getDiceValue()
    {
        return $this->diceValue;
    }

    /**
     * Function to get the current nr of sides on the dice
     *
     * @return int as the number of sides
     */
    public function getSides()
    {
        return $this->sides;
    }

    /**
     * Function to get the start value of the dice
     *
     * @return int as the start value
     */
    public function getStartValue()
    {
        return $this->startValue;
    }

    /**
    * Get a graphic class-value for last rolled dice
    *
    * @return string as class-name that represents rolled dice.
    */
    public function graphic()
    {
        return "dice-" . $this->getDiceValue();
    }
}
