<?php

namespace Parv\Dice100;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Game.
 */
class GameHistogramTest extends TestCase
{
    /**
     * Construct object test
     */
    public function testCreateObjectNoArguments()
    {
        $game = new GameHistogram();
        $this->assertInstanceOf("\Parv\Dice100\Game", $game);
    }

    /**
     * Test to see if histogram array gets populated correctly.
     */
    public function testPopulatingHistogramSerie()
    {
        $game = new GameHistogram();
        $exp = 0;
        $res = count($game->getHistogramSerie());
        $this->assertEquals($exp, $res);

        $game->player->playRound();
        $game->populateHistogramSerie("player");
        $exp = 3;
        $res = count($game->getHistogramSerie());
        $this->assertEquals($exp, $res);

        $game = new GameHistogram();
        $game->computer->playRound();
        $game->populateHistogramSerie("computer");
        $res = count($game->getHistogramSerie());
        $this->assertTrue($res >= 3);
    }

    /**
     * Test to see if average histogram dice value
     * gets returned correctly.
     */
    public function testHistogramAvgDiceValue()
    {
        $game = new GameHistogram();
        $game->player->playRound();
        $game->populateHistogramSerie("player");
        $res = $game->getHistogramAvgDiceValue();
        $this->assertTrue($res >= 1);
    }

    /**
     * Test to see if histogram text is correct.
     */
    public function testGetHistogramAsText()
    {
        $game = new GameHistogram();
        $exp = "1: \n2: \n3: \n4: \n5: \n6: \n";
        $res = $game->getHistogramAsText();
        $this->assertEquals($res, $exp);

        $game->player->playRound();
        $game->populateHistogramSerie("player");
        $res = $game->getHistogramAsText();
        $this->assertNotEquals($res, $exp);
    }
}
