<?php

namespace Parv\Dice100;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Dice.
 */
class DiceTest extends TestCase
{
    /**
     * Construct object test
     */
    public function testCreateObjectNoArguments()
    {
        $dice = new Dice();
        $this->assertInstanceOf("\Parv\Dice100\Dice", $dice);
    }

    /**
     * Tests if we can set number of sides and get
     * the correct value back
     */
    public function testCreateWithNumberOfSidesParam()
    {
        $dice = new Dice(42);
        $exp = 42;
        $res = $dice->getSides();
        $this->assertEquals($exp, $res);
    }

    /**
     * Tests that we can roll dice with set nr of sides
     * and that we get correct value back, due to randomness
     * it is only reliable for one case, sides = 1.
     */
    public function testRollDiceAndGetDiceValue()
    {
        $dice = new Dice(1);
        $dice->rollDice();
        $exp = 1;
        $res = $dice->getDiceValue();
        $this->assertEquals($exp, $res);
    }

    /**
     * Tests we get correct class string
     */
    public function testDiceClassString()
    {
        $dice = new Dice();
        $exp = "dice-" . $dice->getDiceValue();
        $res = $dice->graphic();
        $this->assertEquals($exp, $res);
    }
}
