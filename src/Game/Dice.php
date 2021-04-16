<?php

declare(strict_types=1);

namespace Pama\Game;

class Dice
{
    public $sides;

    public function roll()
    {
        return  rand(1, $this->sides);
    }

    public function __construct(int $sides = 6)
    {
        $this->sides = $sides;
    }
}
