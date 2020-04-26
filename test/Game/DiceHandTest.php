<?php

namespace Parv\Dice100;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Game.
 */
class DiceHandTest extends TestCase
{
    /**
     * Construct object test
     */
    public function testCreateObjectNoArguments()
    {
        $diceHand = new DiceHand();
        $this->assertInstanceOf("\Parv\Dice100\DiceHand", $diceHand);
    }

    /**
     * Tests if we get the correct sum of all dice in a hand
     * when the dice can only roll a 1, would have to do
     * mocking to properly test randomness.
     */
    public function testGetHandSumWithSetDiceValue()
    {
        $diceHand = new DiceHand(5, 1);
        $exp = 5;
        $res = $diceHand->getHandSum();
        $this->assertEquals($exp, $res);

        $diceHand = new DiceHand(42, 1);
        $exp = 42;
        $res = $diceHand->getHandSum();
        $this->assertEquals($exp, $res);
    }

    /**
     * Tests if we get a different sum when rolling all dice
     * implying rollAllDice() rolls the dice. Due to how randomness works
     * this test needs to be expanded to always give expected result.
     */
    public function testRollAllDice()
    {
        $diceHand = new DiceHand(100, 12);
        $exp = $diceHand->getHandSum();
        $diceHand->rollAllDice();
        $res = $diceHand->getHandSum();
        $this->assertNotEquals($exp, $res);
    }

    /**
     * Tests that we get the correct string of dice values.
     */
    public function testGetDiceValuesString()
    {
        $diceHand = new DiceHand(1, 1);
        $exp = "1";
        $res = $diceHand->getDiceValues();
        $this->assertEquals($exp, $res);

        $diceHand = new DiceHand(8, 1);
        $exp = "1, 1, 1, 1, 1, 1, 1, 1";
        $res = $diceHand->getDiceValues();
        $this->assertEquals($exp, $res);
    }

    /**
     * Tests if a dice hand with dice that can only roll a one returns true on
     * rolling a one and that a dice hand with dice that can never roll a one
     * return false on rolling a one.
     */
    public function testIfDiceHasRolledAOne()
    {
        $diceHand = new DiceHand(1, 1);
        $this->assertTrue($diceHand->hasRolledAOne());

        $diceHand = new DiceHand(6, 6, 2);
        $this->assertFalse($diceHand->hasRolledAOne());
    }

    /**
     * Tests if we get the correct return of number of dice
     */
    public function testGetNrOfDice()
    {
        $diceHand = new DiceHand();
        $exp = 3;
        $res = $diceHand->getNrOfDice();
        $this->assertEquals($exp, $res);
    }
}
