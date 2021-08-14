<?php

namespace App\Interfaces;

interface CalculateInterface
{
    /**
     * @param array $data
     * @return float
     */
    public function calculate(array $data): float;
}
