<?php

namespace Parv\Dice100;

/**
 * Generating histogram data.
 */
trait HistogramTrait
{
    /**
     * @var array $serie  The numbers stored in sequence.
     */
    private $serie = [];

    /**
     * Get the serie.
     *
     * @return array with the histogram serie.
     */
    public function getHistogramSerie()
    {
        return $this->serie;
    }

    /**
     * Get the min value.
     *
     * @return int as min value.
     */
    public function getHistogramMin()
    {
        return 1;
    }

    /**
     * Get max value for the histogram.
     *
     * @return int with the max value.
     */
    public function getHistogramMax()
    {
        return 6;
    }


    /**
     * Return a string with a textual representation of the histogram.
     *
     * @return string representing the histogram.
     */
    public function getHistogramAsText()
    {
        $numbers = array();
        $word = "";

        for ($i = $this->getHistogramMin(); $i <= $this->getHistogramMax(); $i++) {
            $numbers[$i . ":"] = "";
        }

        foreach ($this->serie as $value) {
            if (array_key_exists($value . ":", $numbers)) {
                $numbers[$value . ":"] .= "*";
            }
        }

        foreach ($numbers as $key => $value) {
            $word .= "$key $value\n";
        }

        return $word;
    }
}
