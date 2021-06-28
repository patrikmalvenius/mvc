<?php

declare(strict_types=1);

namespace Pama\Game;

/**
 * A gameof yatzy.
 */
class Yatzy
{
    /**
     * @var array $scoreboard   Array holding the scoreboard.
     * @var int  $score  Array holding the score.
     * @var DiceHand $dicehand object holding the dicehand
     * @var int $rolls int holding number of rolls this turn
     */
    use HistogramTrait;

    private $scoreboard;
    private $myscore;
    private $score;
    private $dicehand;
    private $rolls;

    /**
     * Constructor to initiate the game of yatzy.
     *
     *
     */
    public function __construct()
    {
        $this->scoreboard = [1, 2, 3, 4, 5, 6, "chans"];
        $this->myscore = [];
        $this->score = 0;
        $this->dicehand = new DiceHand();
        $this->rolls = 0;
    }

    /**
     * Roll the dices you want to roll. Increment rolls
     *
     * @return void.
     */
    public function roll($indexes)
    {
        foreach ($indexes as $index) {
            $this->dicehand->getdice($index)->roll();
        }
        $this->rolls += 1;
    }

    public function getRolls()
    {
        return $this->rolls;
    }

    public function getDiceHandSum()
    {
        return $this->dicehand->sum();
    }

    public function start()
    {
        if (isset($_SESSION["scorebox"])) {
            $idx = array_keys($_SESSION["scorebox"])[0];
            $this->myscore[$_SESSION["scorebox"][$idx]] = $this->calcScore($this->scoreboard[$idx]);
            unset($this->scoreboard[$idx]);
            unset($_SESSION["scorebox"]);
            if (count($this->scoreboard) == 0) {
                echo("NU ÄR SPELET SLUT! DINA POÄNG ÄR: <br/>");
                echo $this->score;
                echo("Vill du spela igen?<br/>");
                echo("Destroya session så kan du köra!!");
                return;
            }
        }
        if (count($this->myscore) > 0) {
            echo("Dina ifyllda rutor: <br/>");
            echo("<table><tr><th>Ruta</th><th>Poäng</th></tr>");
            foreach ($this->myscore as $key => $value) {
                echo "<tr><td>{$key}</td><td>{$value}</td></tr>";
            }
            echo("</table>");
        }


        if ($this->rolls < 2) {
            if ($this->rolls === 0) {
                $this->dicehand->roll();
                $this->rolls += 1;
                echo('Välkommen till Yatzy! Ditt första slag ser du nedan.');
                $this->showDice();
                echo("</br></br>");
                $this->choose();
                $this->showScore();
            } else {
                 $this->play();
                 $this->showScore();
            }
        } else {
            $this->showScore();
            $this->chooseScore();
        }
    }

    public function choose()
    {
        echo("Slå igen? Välj de tärningar du vill slå om och klicka SKICKA<br/>");
        echo("Vill du inte slå om några tärningar, klicka bara SKICKA");
        echo('<form action = "" method = "POST">');
        foreach ($this->dicehand->values() as $key => $value) {
            echo "<input type='checkbox' id={$key} name={$key} value={$value}>";
            echo "<label for={$key}> {$value} </label><br>";
        }
        echo '<input type="submit" value="SKICKA"></form>';
    }

    public function play()
    {
        if (count($_SESSION["dicetoroll"]) < 1) {
            $this->chooseScore();
        } else {
            foreach (array_keys($_SESSION["dicetoroll"]) as $key) {
                $this->roll([$key]);
            }
            $this->showDice();
            $this->choose();
        }
    }

    public function calcScore($score)
    {
        if ($score == "chans") {
            $this->score += $this->dicehand->sum();
            return $this->dicehand->sum();
        } else {
            return $score * (array_count_values($this->dicehand->values())[$score] ?? 0);
        }
    }

    public function chooseScore()
    {
        $_SESSION["score"] = 1;
        $this->rolls = 0;
        echo("Dina tärningsslag ser du i tabellen nedan");
        $this->printHistogram(1, 6, $this->dicehand->values());
        echo('Vilken ruta vill du stoppa dina tärningar i?');
        echo('<form action = "" method = "POST">');
        foreach ($this->scoreboard as $key => $value) {
            echo "<input type='radio' id={$key} name={$key} value={$value}>";
            echo "<label for={$key}> {$value} </label><br>";
        }
        echo '<input type="submit" value="Submit"></form>';
    }

    public function showScore()
    {
        echo('Dessa rutor i protokollet är oifyllda: <br/>');
        echo('<p>');
        foreach ($this->scoreboard as $key => $value) {
            $numr = $key + 1;
            echo "Ruta {$numr}: {$value} <br/>";
        }
        echo('</p>');
    }

    public function showDice()
    {
        echo('Dina tärningar är:');
        echo('<br/><br/>');
        echo('<p>');
        foreach ($this->dicehand->values() as $key => $value) {
            $numr = $key + 1;
            echo "Tärning nummer {$numr} :   {$value} <br/>";
        }
        echo('</p>');
    }
}
