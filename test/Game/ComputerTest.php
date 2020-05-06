<?php

namespace Parv\Dice100;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Game.
 */
class ComputerTest extends TestCase
{
    /**
     * Tests if playRound works as intended
     * with the limited AI logic.
     */
    public function testPlayRound()
    {
        $comp = new Computer(3, 6, 4);
        $comp->playRound();
        $res = $comp->getSavedScore();
        $this->assertTrue($res > 0);
        $this->assertTrue($comp->getCurrentScore() === 0);

        $comp = new Computer(3, 2, 2);
        $comp->playRound(40, 60);
        $res = $comp->getSavedScore();
        $this->assertTrue($res > 0);
        $this->assertTrue($comp->getCurrentScore() === 0);

        $comp = new Computer(3, 1);
        $comp->playRound();
        $this->assertTrue($comp->getCurrentScore() === 0);
    }

    public function testGetLastRollArray()
    {
        $comp = new Computer(6);
        $comp->playRound();
        $res = count($comp->getLastRollArray());
        $this->assertEquals($res, 6);
    }
}
