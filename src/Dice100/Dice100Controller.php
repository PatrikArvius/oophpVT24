<?php

namespace Parv\Dice100;

use Anax\Commons\AppInjectableInterface;
use Anax\Commons\AppInjectableTrait;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 * A sample controller to show how a controller class can be implemented.
 * The controller will be injected with $app if implementing the interface
 * AppInjectableInterface, like this sample class does.
 * The controller is mounted on a particular route and can then handle all
 * requests for that mount point.
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class Dice100Controller implements AppInjectableInterface
{
    use AppInjectableTrait;



    /**
     * @var string $db a sample member variable that gets initialised
     */
    //private $db = "not active";



    /**
     * The initialize method is optional and will always be called before the
     * target method/action. This is a convienient method where you could
     * setup internal properties that are commonly used by several methods.
     *
     * @return void
     */
    /* public function initialize() : void
    {
        // Use to initialise member variables.
        $this->db = "active";

        // Use $this->app to access the framework services.
    } */



    /**
     * This is the init action, it handles:
     * ANY METHOD mountpoint
     *
     * @return object
     */
    public function indexAction() : object
    {
        $title = "Dice101 - another game";

        $this->app->page->add("dice101/index");

        return $this->app->page->render([
            "title" => $title,
        ]);
    }



    /**
     * This is the init action, it handles:
     * ANY METHOD mountpoint/init
     *
     * @return object
     */
    public function initAction() : object
    {
        $title = "Dice101 - another game";

        $this->app->page->add("dice101/init");

        return $this->app->page->render([
            "title" => $title,
        ]);
    }



    /**
     * This is the init-process action
     *
     * It handles POST METHOD mountpoint/init-process
     *
     * @return object
     */
    public function initProcessActionPost() : object
    {
        // Reading framework post
        $numDice = $this->app->request->getPost("nrOfDiceRange");

        // Using framework session
        $dice101 = new GameHistogram($numDice);
        $this->app->session->set("dice101", $dice101);

        return $this->app->response->redirect("dice101/play");
    }



    /**
     * This is the play action
     *
     * Handles: ANY METHOD mountpoint/play
     *
     * @return object
     */
    public function playAction() : object
    {
        // Playing the game;
        $title = "Dice101 - another game";
        $dice101 = $this->app->session->get("dice101");
        $pScore = $dice101->player->getSavedScore();
        $cScore = $dice101->computer->getSavedScore();
        $playerTurn = $dice101->isPlayerTurn();
        $winner = $dice101->checkForWinner();
        $currentScore = $dice101->player->getCurrentScore();
        $lastRoll = $dice101->player->getLastRoll();

        $data = [
            "pScore" => $pScore,
            "cScore" => $cScore,
            "playerTurn" => $playerTurn,
            "currentScore" => $currentScore,
            "winner" => $winner,
            "lastRoll" => $lastRoll,
            "dice101" => $dice101
        ];

        $this->app->page->add("dice101/play", $data);

        // This is for debugging purposes
        //$app->page->add("dice100/debug");

        return $this->app->page->render([
            "title" => $title,
        ]);
    }



    /**
     * This is the play-process action
     *
     * Handles: POST METHOD mountpoint/play-process
     *
     * @return object
     */
    public function playProcessActionPost() : object
    {
        $request = $this->app->request;
        $dice101 = $this->app->session->get("dice101");

        //Deals with the form.
        $compRoll = $request->getPost("compRoll");
        $playerRoll = $request->getPost("nextRound");
        $save = $request->getPost("save");
        $newGame = $request->getPost("newGame");
        $pScore = $dice101->player->getSavedScore();
        $cScore = $dice101->computer->getSavedScore();

        $data = [
            "dice101" => $dice101,
            "compRoll" => $compRoll,
            "playerRoll" => $playerRoll,
            "save" => $save,
            "pScore" => $pScore,
            "cScore" => $cScore,
        ];

        $this->app->page->add("dice101/play-process", $data);

        $this->app->page->render();

        if ($newGame) {
            return $this->app->response->redirect("dice101/init");
        }

        return $this->app->response->redirect("dice101/play");
    }



    /**
     * This is the debug action, it handles:
     * ANY METHOD mountpoint/debug
     *
     * @return string
     */
    public function debugAction() : string
    {
        // Deal with the action and return a response.
        return "Test debug action route, debugging!";
    }
}
