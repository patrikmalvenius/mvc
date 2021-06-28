<?php

declare(strict_types=1);

namespace Pama\Game;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for the functions in src/functions.php.
 */
class DiceTest extends TestCase
{
    /**
     * Try to create the dice class.
     */
    public function testCreateDiceClass()
    {
        $dice = new Dice();
        $this->assertInstanceOf("\Pama\Game\Dice", $dice);
    }
}
