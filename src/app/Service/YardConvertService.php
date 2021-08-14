<?php

namespace App\Service;

use App\Interfaces\ConvertInterface;

class YardConvertService implements ConvertInterface
{
    private const YARD_TO_METER = 0.91;

    /**
     * convert from yard to meter
     *
     * @param int $meter
     * @return float
     */
    public function convert(int $param): float
    {
        return $param * self::YARD_TO_METER;
    }
}
