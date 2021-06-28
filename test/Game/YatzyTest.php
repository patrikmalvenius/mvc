<?php

declare(strict_types=1);

namespace Pama\Game;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for the functions in src/functions.php.
 */
class YatzyTest extends TestCase
{
    use HistogramTrait;

    /**
     * Try to create the yatzy class.
     */
    public function testCreateYatzyClass()
    {
        $yatzy = new Yatzy();
        $this->assertInstanceOf("\Pama\Game\Yatzy", $yatzy);
    }

    /**
     * test start rolls som dice.
     */
    public function testStart()
    {
        $yatzy = new Yatzy();
        $yatzy->start();
        $this->assertEquals($yatzy->getRolls(), 1);
    }

    public function testStart2()
    {
        $yatzy = new Yatzy();

        $yatzy->start();
        var_dump($yatzy->getDiceHandSum());
        $_SESSION["score"] = 1;
        $_SESSION["scorebox"] = [0 => '1'];
        $_SESSION["dicetoroll"] = [0];
        $yatzy->start();
        $this->assertEquals($yatzy->getRolls(), 2);
    }

    /**
     * test play works.
     */
    public function testPlay2()
    {
        $yatzy = new Yatzy();
        $yatzy->start();
        $yatzy->play();
        $this->assertEquals($yatzy->getRolls(), 2);
    }

    /**
     * test play works.
     */
    public function testPlay()
    {
        $yatzy = new Yatzy();
        $yatzy->start();
        $_SESSION["dicetoroll"] = [0];
        $yatzy->play();
        $this->assertEquals($yatzy->getRolls(), 2);
    }

    /**
     * test choose score works.
     */
    public function testScore()
    {
        $yatzy = new Yatzy();
        $yatzy->start();
        $_SESSION["dicetoroll"] = [0];
        $yatzy->play();
        $yatzy->chooseScore();
        $this->assertEquals($yatzy->getRolls(), 0);
    }


    /**
     * test calc score works.
     */
    public function testCalcScore()
    {
        $yatzy = new Yatzy();
        $yatzy->start();
        $sum = $yatzy->calcScore("chans");
        $this->assertEquals($sum, $yatzy->getDiceHandSum());
    }
}
