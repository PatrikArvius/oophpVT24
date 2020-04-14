<?php
/**
 * The Guess game class
 */
class Guess
{
    /**
     * @var int $number The correct number of the Guess instance.
     * @var int $allowedGuesses The amount of guesses the player has.
     * @var bool $winner is a boolean for if there has been a winner.
     */
    private $number;
    private $guesses;
    private $winner;

    /**
     * Constructor to create an instance of Guess class.
     */
    public function __construct()
    {
        $this->number = rand(1, 100);
        $this->guesses = 6;
        $this->winner = false;
    }

    /**
     * Function to get the number of the game
     * 
     * @return int The number of the game to guess
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Function to return the guesses int
     * 
     * @return int as the number of allowed guesses.
     */
    public function getGuesses()
    {
        return $this->guesses;
    }

    /**
     * Function get the winner bool
     * 
     * @return bool as weather or not a winner exists.
     */
    public function hasWinner()
    {
        return $this->winner;
    }

    /**
     * Function to check guess against the game number
     * throws custom exception if number not within range
     * 
     * @param int $number as the guessed number
     * 
     * @return string as the result string of the guess.
     */
    public function checkGuess($number = 1)
    {
        if ($number > 100 || $number < 0) {
            throw new GuessException("Only numbers from 1 to 100 are valid guesses!");
        }
        $this->guesses -= 1;

        if ($number == $this->number) {
            $this->winner = true;
            return "<p><b>YOU WIN!</b></p>";
        } elseif ($number > $this->number) {
            return "<p>Awwww your guess was <b>too high!</b></p>";
        }

        return "<p>Awwww your guess was <b>too low!</b></p>";
    }
}
