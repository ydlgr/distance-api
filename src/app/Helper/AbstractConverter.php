<?php

namespace App\Helper;

abstract class AbstractConverter
{
    protected string $fromDistanceType;
    protected string $toDistanceType;
    protected float $returnValue;

    public function __construct(string $fromDistanceType, string $toDistanceType, float $returnValue)
    {
        $this->fromDistanceType = $fromDistanceType;
        $this->toDistanceType = $toDistanceType;
        $this->returnValue = $returnValue;
    }

    abstract public function convert() : float;
}
