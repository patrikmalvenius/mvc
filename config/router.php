<?php

/**
 * Load the routes into the router, this file is included from
 * `htdocs/index.php` during the bootstrapping to prepare for the request to
 * be handled.
 */

declare(strict_types=1);

use FastRoute\RouteCollector;

$router = $router ?? new RouteCollector(
    new \FastRoute\RouteParser\Std(),
    new \FastRoute\DataGenerator\MarkBased()
);
/*
declare(strict_types=1);

use FastRoute\RouteCollector;

$router = $router ?? null;
*/
$router->addRoute("GET", "/test", function () {
    // A quick and dirty way to test the router or the request.
    return "Testing response";
});

$router->addRoute("GET", "/", "\Mos\Controller\Index");
$router->addRoute("GET", "/debug", "\Mos\Controller\Debug");
$router->addRoute("GET", "/twig", "\Mos\Controller\TwigView");

$router->addGroup("/session", function (RouteCollector $router) {
    $router->addRoute("GET", "", ["\Mos\Controller\Session", "index"]);
    $router->addRoute("GET", "/destroy", ["\Mos\Controller\Session", "destroy"]);
});

$router->addGroup("/some", function (RouteCollector $router) {
    $router->addRoute("GET", "/where", ["\Mos\Controller\Sample", "where"]);
});

$router->addGroup("/form", function (RouteCollector $router) {
    $router->addRoute("GET", "/view", ["\Mos\Controller\Form", "view"]);
    $router->addRoute("POST", "/process", ["\Mos\Controller\Form", "process"]);
});

$router->addRoute("GET", "/game21", ["\Mos\Controller\Game21", "view"]);
$router->addRoute("POST", "/game21", ["\Mos\Controller\Game21", "handle"]);
$router->addRoute("GET", "/game21play", ["\Mos\Controller\Game21play", "view"]);
$router->addRoute("POST", "/game21play", ["\Mos\Controller\Game21play", "handle"]);
$router->addRoute("GET", "/yatzy", ["\Mos\Controller\Yatzy", "view"]);
$router->addRoute("POST", "/yatzy", ["\Mos\Controller\Yatzy", "handlepost"]);
