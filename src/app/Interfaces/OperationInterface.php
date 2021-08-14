<?php

namespace App\Interfaces;

interface OperationInterface
{
    /**
     * @param array $parameters
     * @return mixed
     */
    public function evaluate(array $parameters = array());
}
