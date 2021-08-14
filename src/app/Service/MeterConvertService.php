<?php
namespace App\Service;

use App\Interfaces\ConvertInterface;

class MeterConvertService implements ConvertInterface
{
    private const METER_TO_YARD = 1.09;

    /**
     * convert from meter to yard
     *
     * @return float
     */
    public function convert(int $param): float
    {
        return $param * self::METER_TO_YARD;
    }
}
