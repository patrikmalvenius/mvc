<?php

declare(strict_types=1);

namespace Mos\Router;

use function Mos\Functions\{
    destroySession,
    redirectTo,
    renderView,
    renderTwigView,
    sendResponse,
    url
};

/**
 * Class Router.
 */
class Router
{
    public static function dispatch(string $method, string $path): void
    {
        if ($method === "GET" && $path === "/") {
            $data = [
                "header" => "Index page",
                "message" => "Hello, this is the index page, rendered as a layout.",
            ];
            $body = renderView("layout/page.php", $data);
            sendResponse($body);
            return;
        } else if ($method === "GET" && $path === "/session") {
            $body = renderView("layout/session.php");
            sendResponse($body);
            return;
        } else if ($method === "GET" && $path === "/session/destroy") {
            destroySession();
            redirectTo(url("/session"));
            return;
        } else if ($method === "GET" && $path === "/debug") {
            $body = renderView("layout/debug.php");
            sendResponse($body);
            return;
        } else if ($method === "GET" && $path === "/twig") {
            $data = [
                "header" => "Twig page",
                "message" => "Hey, edit this to do it youreself!",
            ];
            $body = renderTwigView("index.html", $data);
            sendResponse($body);
            return;
        } else if ($method === "GET" && $path === "/some/where") {
            $data = [
                "header" => "Rainbow page",
                "message" => "Hey, edit this to do it youreself!",
            ];
            $body = renderView("layout/page.php", $data);
            sendResponse($body);
            return;
        } else if ($method === "GET" && $path === "/form/view") {
            $data = [
                "header" => "Form",
                "message" => "Press submit to send the message to the result page.",
                "action" => url("/form/process"),
                "output" => $_SESSION["output"] ?? null,
            ];
            $body = renderView("layout/form.php", $data);
            sendResponse($body);
            return;
        } else if ($method === "POST" && $path === "/form/process") {
            $_SESSION["output"] = $_POST["content"] ?? null;
            redirectTo(url("/form/view"));
            return;
        } else if ($method === "GET" && $path === "/game21") {
            $data = [
                "header" => "Game of 21",
                "message" => "This is Game",
            ];
            $body = renderView("layout/game21start.php", $data);
            sendResponse($body);
            return;
        } else if ($method === "POST" && $path === "/game21") {
            if (isset($_POST["dice"])) {
                $_SESSION["dice"] = $_POST["dice"] ?? "banan";
                redirectTo(url("/game21play"));
            } else {
                unset($_SESSION["rounds"]);
                redirectTo(url("/game21"));
            }
            return;
        } else if ($method === "GET" && $path === "/game21play") {
            $data = [
                "header" => "Game of 21",
            ];
            $body = renderView("layout/game21.php", $data);
            sendResponse($body);
            return;
        } else if ($method === "POST" && $path === "/game21play") {
            $_SESSION["confirm"] = $_POST["confirm"] ?? "banan";
            redirectTo(url("/game21play"));
            return;
        }
        $data = [
            "header" => "404",
            "message" => "The page you are requesting is not here. You may also checkout the HTTP response code, it should be 404.",
        ];
        $body = renderView("layout/page.php", $data);
        sendResponse($body, 404);
    }
}
