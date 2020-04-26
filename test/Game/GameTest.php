<?php

namespace Parv\Dice100;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Game.
 */
class GameTest extends TestCase
{
    /**
     * Construct object test
     */
    public function testCreateObjectNoArguments()
    {
        $game = new Game();
        $this->assertInstanceOf("\Parv\Dice100\Game", $game);
    }

    /**
     * Testing that isPlayerTurn get set to the value we initiate the game with
     */
    public function testIsPlayerTurnByCreatingObjectWithArg()
    {
        $game = new Game(3, true);
        $exp = true;
        $res = $game->isPlayerTurn();
        $this->assertEquals($exp, $res);

        $game = new Game(5, false);
        $exp = false;
        $res = $game->isPlayerTurn();
        $this->assertEquals($exp, $res);
    }

    /**
     * Tests that correct string is returned when player
     * or computer reaches 100 or more points and tests that
     * nothing is returned when none have reached 100.
     */
    public function testCheckForComputerOrPlayerWinner()
    {
        $game = new Game();
        $game->player->setSavedScore(100);
        $exp = "Player wins!";
        $res = $game->checkForWinner();
        $this->assertEquals($exp, $res);

        $game = new Game();
        $exp = false;
        $res = $game->checkForWinner();
        $this->assertEquals($exp, $res);

        $game = new Game();
        $game->computer->setSavedScore(100);
        $exp = "Computer wins!";
        $res = $game->checkForWinner();
        $this->assertEquals($exp, $res);
    }

    public function testSetPlayerTurn()
    {
        $game = new Game();
        $game->setPlayerTurn(false);
        $exp = false;
        $res = $game->isPlayerTurn();
        $this->assertEquals($exp, $res);

        $game = new Game();
        $game->setPlayerTurn(true);
        $exp = true;
        $res = $game->isPlayerTurn();
        $this->assertEquals($exp, $res);
    }
}
