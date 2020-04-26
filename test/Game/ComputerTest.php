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

        $comp = new Computer(3, 1);
        $comp->playRound();
        $this->assertTrue($comp->getCurrentScore() === 0);
    }
}
