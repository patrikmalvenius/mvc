<?php

declare(strict_types=1);

namespace Pama\Game;

use PHPUnit\Framework\TestCase;

class HistogramTraitTest extends TestCase
{
    use HistogramTrait;

    public function testgetHistogramSerie()
    {
        $ans = $this->getHistogramSerie();
        $this->assertEmpty($ans);
    }

    public function testPrintHistogram()
    {
        $this->printHistogram(null, null, [1, 1, 2, 2]);
        $ans = $this->getHistogramSerie();
        $this->assertArrayHasKey(1, $ans);
    }
}
