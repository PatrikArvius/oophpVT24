<?php
/**
 * Create routes using $app programming style.
 */
//var_dump(array_keys(get_defined_vars()));

/**
* Initiate the guess game.
*/
$app->router->get("guess/init", function () use ($app) {
    // Init the game

    //Starts the session
    session_name("paar19");
    session_start();

    //Starts the game
    if (!isset($_SESSION["guess"])) {
        $_SESSION["guess"] = new Parv\Guess\Guess();
    }

    return $app->response->redirect("guess/play", $data);
});



/**
 * Play the game
 */
$app->router->get("guess/play", function () use ($app) {
    // Playing the game;
    $title = "Guess - the game";
    $guess = $_SESSION["guess"];
    $guesses = $guess->getGuesses();
    $gameWinner = $guess->hasWinner();

    $data = [
        "guesses" => $guesses,
        "gameWinner" => $gameWinner,
    ];

    $app->page->add("guess/play", $data);

    // This is for debugging purposes
    $app->page->add("guess/debug");

    return $app->page->render([
        "title" => $title,
    ]);
});

/**
* Processing route
*/
$app->router->post("guess/post-process", function () use ($app) {

    $app->page->add("guess/post-process");

    try {
        $app->page->render();
    } catch (Exception $e) {
        $errorText = $e->getMessage();
        $_SESSION["GuessError"] = $errorText;
    }

    return $app->response->redirect("guess/init");
});
