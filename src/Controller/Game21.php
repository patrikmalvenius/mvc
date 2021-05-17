<?php

declare(strict_types=1);

namespace Mos\Controller;

use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Message\ResponseInterface;

use function Mos\Functions\{
    destroySession,
    renderView,
    url
};

/**
 * Controller showing how to work with games.
 */
class Game21
{
    public function view(): ResponseInterface
    {
        $data = [
            "header" => "Game of 21",
            "message" => "This is Game",
        ];
        $body = renderView("layout/game21start.php", $data);

        $psr17Factory = new Psr17Factory();
        return $psr17Factory
            ->createResponse(200)
            ->withBody($psr17Factory->createStream($body));
    }



    public function handle(): ResponseInterface
    {
        if (isset($_POST["dice"])) {
            $_SESSION["dice"] = $_POST["dice"] ?? "banan";
            $psr17Factory = new Psr17Factory();
            return $psr17Factory
                ->createResponse(301)
                ->withHeader("Location", url("/game21play"));
        } else {
            unset($_SESSION["rounds"]);
            $psr17Factory = new Psr17Factory();
            return $psr17Factory
                ->createResponse(301)
                ->withHeader("Location", url("/game21"));
        }
    }
}
