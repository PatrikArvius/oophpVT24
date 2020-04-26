<?php
namespace Parv\Dice100;

/**
 * The Game class
 */
class Game
{
    /**
     * @var Player as a player class object
     * @var Computer as a computer class object
     * @var bool as if the player starts the game
     */
    public $player;
    public $computer;
    private $playerTurn;

    /**
     * Constructor
     *
     * @param int as number of dice objects each player will have in their hand.
     * @param int as initial value to decide who starts, added for testing purpose
     */
    public function __construct($nrDice = 3, $playerTurn = -1)
    {
        $this->player = new Player($nrDice);
        $this->computer = new Computer($nrDice);
        $this->playerTurn = $playerTurn;

        if ($this->playerTurn === -1) {
            $playerRoll = rand(1, 12);
            $compRoll = rand(1, 12);

            $this->playerTurn = false;

            if ($playerRoll >= $compRoll) {
                $this->playerTurn = true;
            }
        }
    }

    /**
     * Method that returns if its the players turn or not.
     *
     * @return bool as players turn or not.
     */
    public function isPlayerTurn()
    {
        return $this->playerTurn;
    }

    /**
     * Method that sets if it is the players turn or not.
     *
     * @param bool as players turn.
     */
    public function setPlayerTurn($isPTurn)
    {
        $this->playerTurn = $isPTurn;
    }

    /**
     * Method to see if there is a game winner
     *
     * @return string as the winner of the game.
     */
    public function checkForWinner()
    {
        if ($this->player->getSavedScore() >= 100) {
            return "Player wins!";
        }

        if ($this->computer->getSavedScore() >= 100) {
            return "Computer wins!";
        }
    }
}
