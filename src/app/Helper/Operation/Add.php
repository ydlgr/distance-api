<?php

namespace App\Helper\Operation;

use App\Interfaces\OperationInterface;

class Add implements OperationInterface
{
    /**
     * @param array $parameters
     * @return float
     */
    public function evaluate(array $parameters = array()): float
    {
        return ($parameters[0] + $parameters[1]);
    }
}
