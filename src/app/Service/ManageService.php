<?php

namespace App\Service;

use App\Interfaces\ConvertInterface;

class ManageService implements ConvertInterface
{
    private $convertInterface;

    public function __construct(ConvertInterface $convertInterface)
    {
        $this->convertInterface = $convertInterface;
    }

    /**
     * @param int $param
     * @return float
     */
    public function convert(int $param): float
    {
        return $this->convertInterface->convert($param);
    }
}
