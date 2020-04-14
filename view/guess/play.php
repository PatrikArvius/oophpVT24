<?php

namespace Anax\View;

/**
* Render content within an article.
*/

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());
?>
<article>
<h1>Guess my number game</h1>

<?php if ((isset($_SESSION["result"])) && $gameWinner) : ?>
    <?= $_SESSION["result"]; ?>
<?php else : ?>
<p>Guess a number between 1 and 100, you have <?= $guesses ?> guesses left</p>
<?php endif; ?>


<form method="POST" action="post-process">
    <input type="text" name ="numGuess" placeholder="1">
    <?php if ($guesses > 0 && !$gameWinner) : ?>
    <input type="submit" name ="makeGuess" value="Make a guess">
    <?php endif; ?>
    <input type="submit" name ="reset" value="Reset the game">
    <?php if ($guesses > 0 && !$gameWinner) : ?>
    <input type="submit" name ="cheat" value="Cheat">
    <?php endif; ?>
</form>
<br>

<?php if (isset($_SESSION["cheatNr"])) : ?>
<p>The correct number is <b><?= $_SESSION["cheatNr"] ?></b></p>
    <?php unset($_SESSION["cheatNr"]); ?>
<?php endif; ?>
<?php
if (!$gameWinner && $guesses == 0) {
    echo "<p><b>YOU LOSE!</b></p>";
} elseif ((isset($_SESSION["result"])) && !$gameWinner) {
    echo $_SESSION["result"];
}
?>
<?php if (isset($_SESSION["GuessError"])) : ?>
<p><b><?= $_SESSION["GuessError"] ?></b></p>
    <?php unset($_SESSION["GuessError"]); ?>
<?php endif; ?>
