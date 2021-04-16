<?php

/**
 * Standard view template to generate a simple web page, or part of a web page.
 */

declare(strict_types=1);

use Pama\Game\Dice;
use Pama\Game\DiceHand;

use function Mos\Functions\{
    url
};

$header = $header ?? null;
$message = $message ?? null;
$action = url("/game21");
$html = "";
if ($_SESSION["rounds"] ?? false) {
    $html .= "<p>The game is on! </p>";
    $html .= "<p>Computer: " . (isset($_SESSION["rounds"]["computer"]) ? strval($_SESSION["rounds"]["computer"]) : "0") . "</p>";
    $html .= "<p>You: " . (isset($_SESSION["rounds"]["you"]) ? strval($_SESSION["rounds"]["you"]) : "0") . "</p>";
    $html .= "<p>Do you want to cancel the score sofar? </p>";
    $html .= '<form method="post"><input type="submit" name="zero" value="Yes"><br/></form>';
    echo $html;
}



?><h1><?= $header ?></h1>
<p>Select 1 or 2 dices here. Click on the button "Press me" to throw the dice!</p>

<form method="post" action = <?= $action ?>>
    <p>
        <input type="number" min="1" max="2" name="dice" value="1">
    </p>

    <p>
        <input type="submit" value="Press me">
    </p>
</form>






