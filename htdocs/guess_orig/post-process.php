<?php
/**
 * A processing page that sets number of guesses and redirects.
 */
include(__DIR__ . "/config.php");
include(__DIR__ . "/autoload.php");

//Starts session
session_name("paar19");
session_start();

$guess = $_SESSION["guess"];

// Deals with post form variables
$numGuess = $_POST["numGuess"] ?? null;
$makeGuess = $_POST["makeGuess"] ?? null;
$reset = $_POST["reset"] ?? null;
$cheat = $_POST["cheat"] ?? null;

if ($reset) {
    resetGame();
}

if ($makeGuess) {
    $_SESSION["result"] = $guess->checkGuess((int)$numGuess);
}

if ($cheat) {
    $_SESSION["cheatNr"] = $guess->getNumber();
}

//Resets the game
function resetGame()
{
    // Unset all of the session variables.
    $_SESSION = [];

    // If it's desired to kill the session, also delete the session cookie.
    // Note: This will destroy the session, and not just the session data!
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(
            session_name(),
            '',
            time() - 42000,
            $params["path"],
            $params["domain"],
            $params["secure"],
            $params["httponly"]
        );
    }

    // Finally, destroy the session.
    session_destroy();
}

//Redirect to index
header("Location: index.php");
