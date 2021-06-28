<?php

namespace Pama\Game;

/**
 * A trait implementing histogram for integers.
 */
trait HistogramTrait
{
    /**
     * @var array $serie  The numbers stored in sequence.
     */
    private $serie;



    /**
     * Get the serie.
     *
     * @return array with the serie.
     */
    public function getHistogramSerie()
    {
        return $this->serie;
    }



    /**
     * Print out the histogram, default is to print out only the numbers
     * in the serie, but when $min and $max is set then print also empty
     * values in the serie, within the range $min, $max.
     *
     * @param int $min The lowest possible integer number.
     * @param int $max The highest possible integer number.
     *
     */
    public function printHistogram(int $min = null, int $max = null, array $values)
    {
        $this->serie = [];
        if ($min != null) {
            for ($min; $min <= $max; $min++) {
                $this->serie[$min] = 0;
            }
            for ($i = 0; $i < count($values); $i++) {
                $this->serie[$values[$i]] += 1;
            }
        } else {
            for ($i = 0; $i < count($values); $i++) {
                if (isset($this->serie[$values[$i]])) {
                    $this->serie[$values[$i]] += 1;
                } else {
                    $this->serie[$values[$i]] = 1;
                }
            }
        }
        echo("<table><tr><th>Siffra</th><th>Antal</th></tr>");
        foreach ($this->serie as $key => $value) {
            echo "<tr><td>{$key}</td><td>{$value}</td></tr>";
        }
        echo("</table>");
    }
}
