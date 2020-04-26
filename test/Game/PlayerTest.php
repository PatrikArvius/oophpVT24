<?php

namespace Parv\Dice100;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Game.
 */
class PlayerTest extends TestCase
{
    /**
     * Tests if playRound works as intended
     * setting current score to 0 if a 1 was
     * rolled
     */
    public function testPlayRound()
    {
        $player = new Player(3, 6, 3);
        $player->playRound();
        $this->assertTrue($player->getCurrentScore() > 0);

        $player = new Player(3, 1);
        $player->playRound();
        $this->assertTrue($player->getCurrentScore() === 0);
    }

    /**
     * Tests that saveCurrentScore works and saves it then
     * resets the current value
     */
    public function testSaveCurrentScore()
    {
        $player = new Player(3, 6, 3);
        $player->playRound();
        $player->saveCurrentScore();
        $this->assertTrue($player->getSavedScore() > 0);
        $this->assertTrue($player->getCurrentScore() === 0);
    }

    /**
     * Tests if correct string is returned from getLastRoll().
     */
    public function testGetLastRoll()
    {
        $player = new Player(3, 1);
        $exp = "1, 1, 1";
        $res = $player->getLastRoll();
        $this->assertEquals($exp, $res);
    }

    /**
     * Tests that hasRolledOne method returns correct
     * boolean. Signifying if a one has been rolled or not.
     */
    public function testHasRolledOne()
    {
        $player = new Player(3, 1);
        $exp = true;
        $res = $player->hasRolledOne();
        $this->assertEquals($exp, $res);

        $player = new Player(3, 6, 2);
        $exp = false;
        $res = $player->hasRolledOne();
        $this->assertEquals($exp, $res);
    }

    /**
     * Tests if booleans for having rolled and saved
     * are being updated correctly based on actions
     * the player takes.
     */
    public function testHasSavedAndRolled()
    {
        $player = new Player(3, 6, 2);
        $player->saveCurrentScore();
        $exp = true;
        $res = $player->hasSaved();
        $this->assertEquals($exp, $res);

        $exp = false;
        $res = $player->hasRolled();
        $this->assertEquals($exp, $res);

        $player = new Player(3, 6, 2);
        $player->playRound();
        $exp = true;
        $res = $player->hasRolled();
        $this->assertEquals($exp, $res);
    }
}
