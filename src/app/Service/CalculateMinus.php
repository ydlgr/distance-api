<?php

namespace App\Service;

use App\Helper\YardsMetersConverter;
use App\Interfaces\Calculate;

class CalculateMinus implements Calculate
{
    /**
     * @param array $params
     * @return float
     */
    public function calculate(array $params): float
    {
        $convertedInput1 = new YardsMetersConverter($params["param1_type"], $params["param2_type"], $params["param1"]);
        $convertedInput2 = new YardsMetersConverter($params["param2_type"], $params["param1_type"], $params["param2"]);

        return $convertedInput1->convert() - $convertedInput2->convert();
    }
}
