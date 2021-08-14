<?php

namespace App\Interfaces;

interface ConvertInterface
{
    /**
     * @param int $param
     * @return float
     */
    public function convert(int $param): float;
}
