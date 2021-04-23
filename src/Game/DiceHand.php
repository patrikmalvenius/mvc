<?php

declare(strict_types=1);

namespace Pama\Game;

/**
 * A dicehand, consisting of dices.
 */
class DiceHand
{
    /**
     * @var array $dices   Array consisting of dices.
     * @var int  $values  Array consisting of last roll of the dices.
     */
    private $dices;
    private $values;

    /**
     * Constructor to initiate the dicehand with a number of dices.
     *
     * @param int $dicenr Number of dices to create, defaults to five.
     */
    public function __construct(int $dicenr = 5)
    {


        for ($i = 0; $i < $dicenr; $i++) {
            $this->dices[$i]  = new Dice();
            $this->values[$i] = null;
        }
    }

    /**
     * Roll all dices save their value.
     *
     * @return void.
     */
    public function roll()
    {
        for ($i = 0; $i < count($this->dices); $i++) {
            $this->values[$i] = $this->dices[$i]->roll();
        }
    }

    /**
     * Get values of dices from last roll.
     *
     * @return array with values of the last roll.
     */
    public function values()
    {
        $values = [];
        for ($i = 0; $i < count($this->dices); $i++) {
            $values[$i] = $this->values[$i];
        };
        return $values;
    }

    /**
     * Get the sum of all dices.
     *
     * @return int as the sum of all dices.
     */
    public function sum()
    {
        $values = $this->values();
        $sum = 0;
        for ($i = 0; $i < count($values); $i++) {
            $sum += $values[$i];
        }
        return $sum;
    }

    /**
     * Get the average of all dices.
     *
     * @return float as the average of all dices.
     */
    public function average()
    {
        $average = $this->sum() / count($this->dices);
        return $average;
    }
}
