<?php

/**
 * Standard view template to generate a simple web page, or part of a web page.
 */

declare(strict_types=1);

use Pama\Game\Dice;
use Pama\Game\DiceHand;

use function Mos\Functions\{
    url,
    recordWinner
};

$header = $header ?? null;

if ($_SESSION["dice"] ?? false) {
    $nrdices = intval($_SESSION["dice"]);
    $playerhand = $_SESSION["twentyone"] ?? 0;
    $continue = $_SESSION["confirm"] ?? "Yes";
    $dicehand = new DiceHand($nrdices);
    $link = url("/game21");
    ?>
    <h1><?= $header ?></h1>

    <?php

    if ($continue === "Yes") {
        $prompt_cont = "Do you want to continue?";
        $dicehand->roll();
        $value = $dicehand->sum();
        if ($_SESSION["twentyone"] ?? false) {
            $_SESSION["twentyone"] += $value;
            if ($_SESSION["twentyone"] === 21) {
                $prompt_cont = "GRATTIS! You should really stop now! Or do you want to continue?";
            } else if ($_SESSION["twentyone"] > 21) {
                $prompt_cont = "Sorry, you lost right there! You can continue to roll, but I suggest you press No below";
            }
        } else {
            $_SESSION["twentyone"] = $value;
        }

        $message = "You rolled a total of " . $value . " which gives you a total of " . $_SESSION["twentyone"];
        echo("<p>" . $message . "</p>");
        echo("<p>" . $prompt_cont . "</p>");

        echo('<form method="post"><input type="submit" name="confirm" value="Yes"><br/><input type="submit" name="confirm" value="No"><br/></form>');
    } else {
        if ($_SESSION["twentyone"] > 21) {
            $prompt_cont = "Do you want to continue?";
            echo("<p>" . $prompt_cont . "</p>");
            echo("<a href=" . $link . ">Play a new round?</a>");
            unset($_SESSION["twentyone"]);
            unset($_SESSION["dice"]);
            unset($_SESSION["confirm"]);
            recordWinner("computer");
            return;
        } else {
            $computerhand = new DiceHand($nrdices);
            $computertwentyone = 0;
            while ($computertwentyone < $_SESSION["twentyone"] && $computertwentyone < 21) {
                $computerhand->roll();
                $computertwentyone += $computerhand->sum();
            }
            if ($computertwentyone > 21) {
                $prompt_cont = "You won! You got " . $_SESSION["twentyone"] . "and computer got " . $computertwentyone;
                recordWinner("you");
            } else if ($computertwentyone === 21 || $computertwentyone > $_SESSION["twentyone"]) {
                $prompt_cont = "Computer won! Computer got " . $computertwentyone . "and you got " . $_SESSION["twentyone"];
                recordWinner("computer");
            } else {
                $prompt_cont = "You won! You got " . $_SESSION["twentyone"] . "and computer got " . $computertwentyone;
                recordWinner("you");
            }
            unset($_SESSION["twentyone"]);
            unset($_SESSION["dice"]);
            unset($_SESSION["confirm"]);
            echo("<p>" . $prompt_cont . "</p>");
            echo("<a href=" . $link . ">Play a new round?</a>");
        }
    }
}
