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
class Yatzy
{
    public function view(): ResponseInterface
    {
        $data = [
            "header" => "Yatzy",
        ];
        $body = renderView("layout/yatzy.php", $data);

        $psr17Factory = new Psr17Factory();
        return $psr17Factory
            ->createResponse(200)
            ->withBody($psr17Factory->createStream($body));
    }

    public function handlepost(): ResponseInterface
    {
        if (isset($_SESSION["score"]) && $_SESSION["score"] == 1) {
            var_dump($_POST);
            $_SESSION["scorebox"] = $_POST;
            $_SESSION["score"] = 0;
        } else {
            $_SESSION["dicetoroll"] = $_POST ?? null;
        }

        $psr17Factory = new Psr17Factory();
        return $psr17Factory
            ->createResponse(301)
            ->withHeader("Location", url("/yatzy"));
    }
}
