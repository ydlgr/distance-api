<?php

namespace App\Service;

use App\Interfaces\Calculate;
use App\Interfaces\CalculateFactory;

class CalculateAdditionFactory implements CalculateFactory
{
    /**
     * @return Calculate
     */
    public function createCalculate(): Calculate
    {
        return new CalculateAddition();
    }
}
