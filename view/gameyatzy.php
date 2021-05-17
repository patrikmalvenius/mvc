<?php

/**
 * Standard view template to generate a simple web page, or part of a web page.
 */

declare(strict_types=1);

use Pama\Game\Yatzy;

use function Mos\Functions\{
    url
};

$header = $header ?? null;
$message = $message ?? null;

if (!isset($_SESSION["yatzy"])) {
    $_SESSION["yatzy"] = new \Pama\Game\Yatzy();
}






?><h1><?= $header ?></h1>

<?php $_SESSION["yatzy"]->start(); ?>








