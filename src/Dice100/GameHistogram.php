<?php

namespace Parv\Dice100;

/**
 * A dice which has the ability to present data to be used for creating
 * a histogram.
 */
class GameHistogram extends Game implements HistogramInterface
{
    use HistogramTrait;

    /**
     * Populates the histogram series with array of rolled
     * values from Player/Computer
     *
     * @param string as who has rolled and thus who's rolls
     * to add to the histogram serie.
     */
    public function populateHistogramSerie($who)
    {
        if ($who === "player") {
            foreach ($this->player->getLastRollArray() as $value) {
                $this->serie[] = $value;
            }
            return;
        }

        foreach ($this->computer->getLastRollArray() as $value) {
            $this->serie[] = $value;
        }
        return;
    }

    /**
     * Method that returns the average value in the serie
     *
     * @return float as avg value
     */
    public function getHistogramAvgDiceValue()
    {
        if (count($this->serie) > 0) {
            $avg = round(array_sum($this->serie) / count($this->serie), 1);
            return $avg;
        }
    }
}
