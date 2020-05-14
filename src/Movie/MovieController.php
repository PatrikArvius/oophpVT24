<?php

namespace Parv\Movie;

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
class MovieController implements AppInjectableInterface
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
        $title = "Movie - the movie db | oophp";

        $this->app->db->connect();
        $sql = "SELECT * FROM movie;";
        $res = $this->app->db->executeFetchAll($sql);

        $data = [
            "res" => $res,
        ];

        $this->app->page->add("movie/index", $data);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }



    /**
     * This is the overview action, it handles:
     * ANY METHOD mountpoint/overview
     *
     * @return object
     */
    public function overviewAction() : object
    {
        $title = "Movie - the movie db | oophp";

        $this->app->db->connect();
        $sql = "SELECT * FROM movie;";
        $res = $this->app->db->executeFetchAll($sql);

        $data = [
            "res" => $res,
        ];

        $this->app->page->add("movie/overview", $data);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }



    /**
     * This is the search action
     *
     * It handles ANY METHOD mountpoint/search
     *
     * @return object
     * @SuppressWarnings(PHPMD.TooManyPublicMethods)
     */
    public function searchAction() : object
    {
        $title = "Movie - the movie db | oophp";

        $this->app->db->connect();
        $db = $this->app->db;
        $request = $this->app->request;

        //Deals with the form.
        $searchTitle = htmlentities($request->getPost("searchTitle"));
        $year1 = $request->getPost("year1");
        $year2 = $request->getPost("year2");

        // Sets up the sql query
        $res = "";

        if ($searchTitle && $year1 && $year2) {
            $sql = "SELECT * FROM movie WHERE title LIKE ? AND year >= ? AND year <= ?;";
            $res = $db->executeFetchAll($sql, [$searchTitle, $year1, $year2]);
        } elseif ($searchTitle && $year1) {
            $sql = "SELECT * FROM movie WHERE title LIKE ? AND year >= ?;";
            $res = $db->executeFetchAll($sql, [$searchTitle, $year1]);
        } elseif ($searchTitle && $year2) {
            $sql = "SELECT * FROM movie WHERE title LIKE ? AND year <= ?;";
            $res = $db->executeFetchAll($sql, [$searchTitle, $year2]);
        } elseif ($searchTitle) {
            $sql = "SELECT * FROM movie WHERE title LIKE ?;";
            $res = $db->executeFetchAll($sql, [$searchTitle]);
        } elseif ($year1 && $year2) {
            $sql = "SELECT * FROM movie WHERE year >= ? AND year <= ?;";
            $res = $db->executeFetchAll($sql, [$year1, $year2]);
        } elseif ($year1) {
            $sql = "SELECT * FROM movie WHERE year >= ?;";
            $res = $db->executeFetchAll($sql, [$year1]);
        } elseif ($year2) {
            $sql = "SELECT * FROM movie WHERE year <= ?;";
            $res = $db->executeFetchAll($sql, [$year2]);
        }

        $data = [
            "res" => $res
        ];

        $this->app->page->add("movie/search", $data);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }



    /**
     * This is the select action
     *
     * Handles: ANY METHOD mountpoint/select
     *
     * @return object
     */
    public function selectAction() : object
    {
        $title = "Movie - the movie db | oophp";

        $this->app->db->connect();
        $db = $this->app->db;

        $sql = "SELECT id, title FROM movie;";
        $movies = $db->executeFetchAll($sql);

        $data = [
            "movies" => $movies,
        ];

        $this->app->page->add("movie/select", $data);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }



/**
     * This is the edit action
     *
     * Handles: Post METHOD mountpoint/edit
     *
     * @return object
     */
    public function editActionPost() : object
    {
        $title = "Movie - the movie db | oophp";

        $this->app->db->connect();
        $db = $this->app->db;
        $request = $this->app->request;

        // Handle edit form
        $movieId = $request->getPost("movieId");
        $movieTitle = $request->getPost("movieTitle");
        $movieYear  = $request->getPost("movieYear");
        $movieImage = $request->getPost("movieImage");

        // Handle select and edit form
        if ($request->getPost("doDelete")) {
            $sql = "DELETE FROM movie WHERE id = ?;";
            $db->execute($sql, [$movieId]);
            return $this->app->response->redirect("movie/overview");
        } elseif ($request->getPost("doAdd")) {
            $sql = "INSERT INTO movie (title, year, image) VALUES (?, ?, ?);";
            $db->execute($sql, ["A title", 2017, "img/noimage.png"]);
            $movieId = $db->lastInsertId();
        } elseif ($request->getPost("doSave")) {
            $sql = "UPDATE movie SET title = ?, year = ?, image = ? WHERE id = ?;";
            $db->execute($sql, [$movieTitle, $movieYear, $movieImage, $movieId]);
            return $this->app->response->redirect("movie/overview");
        }

        $sql = "SELECT * FROM movie WHERE id = ?;";
        $movie = $db->executeFetchAll($sql, [$movieId]);
        $movie = $movie[0];

        $data = [
            "movie" => $movie,
        ];

        $this->app->page->add("movie/edit", $data);

        return $this->app->page->render([
            "title" => $title,
        ]);
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
