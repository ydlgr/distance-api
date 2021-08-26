<?php

namespace App\Helper;

class YardsMetersConverter extends AbstractConverter
{
    private const YARDS = "yards";

    private const YARDS_TO_METERS = 1.09;
    private const METERS_TO_YARDS = 0.91;

    /**
     * @return float
     */
    public function convert(): float
    {
        if ($this->fromDistanceType == $this->toDistanceType) {
            return $this->returnValue;
        }

        if ($this->toDistanceType == self::YARDS) {
            return $this->returnValue * self::YARDS_TO_METERS;
        }

        return $this->returnValue * self::METERS_TO_YARDS;
    }
}
