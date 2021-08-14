<?php

namespace App\Helper;

use App\Interfaces\OperationInterface;

class CalculateHelper
{
    protected $parameters = array();

    /** @var OperationInterface $operation */
    private $operation;

    public function setParameters(array $parameters = array()) :self
    {
        $this->parameters = $parameters;
        return $this;
    }

    public function setOperation(OperationInterface $operation): self
    {
        $this->operation = $operation;
        return $this;
    }

    public function process(): float
    {
        return $this->operation->evaluate($this->parameters);
    }
}
