<?php

declare(strict_types=1);

namespace Pama\Game;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for the functions in src/functions.php.
 */
class GraphicalDiceTest extends TestCase
{
    /**
     * Try to create the dice class.
     */
    public function testCreateDiceClass()
    {
        $dice = new GraphicalDice();
        $this->assertInstanceOf("\Pama\Game\GraphicalDice", $dice);
    }

    /**
     * Verify graphic returns string.
     */
    public function testGraphicReturnsString()
    {
        $dice = new GraphicalDice();
        $ans = $dice->graphic();
        $this->assertStringContainsString("dice", $ans);
    }
}
