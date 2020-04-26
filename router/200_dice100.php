<?php
/**
 * Create routes using $app programming style.
 */

/**
* Initiate the dice100 game.
*/
$app->router->get("dice100/init", function () use ($app) {

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

    $title = "Dice100 - another game";

    $app->page->add("dice100/init");

    return $app->page->render([
        "title" => $title,
    ]);
});

/**
 * Play the game
 */
$app->router->get("dice100/play", function () use ($app) {
    //Starts session
    if (session_status() == PHP_SESSION_NONE) {
        session_name("paar19");
        session_start();
    }

    // Playing the game;
    $title = "Dice100 - another game";
    $dice100 = $_SESSION["dice100"];
    $pScore = $dice100->player->getSavedScore();
    $cScore = $dice100->computer->getSavedScore();
    $playerTurn = $dice100->isPlayerTurn();
    $winner = $dice100->checkForWinner();
    $currentScore = $dice100->player->getCurrentScore();
    $lastRoll = $dice100->player->getLastRoll();

    $data = [
        "pScore" => $pScore,
        "cScore" => $cScore,
        "playerTurn" => $playerTurn,
        "currentScore" => $currentScore,
        "winner" => $winner,
        "lastRoll" => $lastRoll,
    ];

    $app->page->add("dice100/play", $data);

    // This is for debugging purposes
    //$app->page->add("dice100/debug");

    return $app->page->render([
        "title" => $title,
    ]);
});

/**
 * Init process route
 */
$app->router->post("dice100/init-process", function () use ($app) {

    $app->page->add("dice100/init-process");

    $app->page->render();

    return $app->response->redirect("dice100/play");
});

/**
 * Play process route
 */
$app->router->post("dice100/play-process", function () use ($app) {

    $app->page->add("dice100/play-process");

    $app->page->render();

    if ($_SESSION["newGame"]) {
        return $app->response->redirect("dice100/init");
    }

    return $app->response->redirect("dice100/play");
});
