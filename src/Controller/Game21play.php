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
class Game21play
{
    public function view(): ResponseInterface
    {
        $data = [
            "header" => "Game of 21",
        ];
        $body = renderView("layout/game21.php", $data);

        $psr17Factory = new Psr17Factory();
        return $psr17Factory
            ->createResponse(200)
            ->withBody($psr17Factory->createStream($body));
    }

    public function handle(): ResponseInterface
    {
        $_SESSION["confirm"] = $_POST["confirm"] ?? "banan";
        $psr17Factory = new Psr17Factory();
        return $psr17Factory
            ->createResponse(301)
            ->withHeader("Location", url("/game21play"));
    }
}
