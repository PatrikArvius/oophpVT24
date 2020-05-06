<?php
/**
 * Dice101 controller
 */
return [
    // Path where to mount the routes, is added to each route path.
    //"mount" => "sample",

    // All routes in order
    "routes" => [
        [
            "info" => "Dice100 controller",
            "mount" => "dice101",
            "handler" => "\Parv\Dice100\Dice100Controller",
        ],
    ]
];
