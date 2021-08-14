<?php

namespace App\Service;

use App\Helper\CalculateHelper;
use App\Helper\Operation\Add;
use App\Interfaces\CalculateInterface;

class ProcessService implements CalculateInterface
{
    private const METERS = 'meters';
    private const YARDS = 'yards';

    /**
     * @var CalculateHelper
     */
    private CalculateHelper $calculateHelper;

    public function __construct(CalculateHelper $calculateHelper)
    {
        $this->calculateHelper = $calculateHelper;
    }

    /**
     * @param array $requestData
     * @return float
     */
    public function calculate(array $requestData): float
    {
        $param1 = $requestData['param1'];
        $param1Type = $requestData['param1_type'];
        $param2 = $requestData['param2'];
        $param2Type = $requestData['param2_type'];
        $returnType = $requestData['return_type'];

        $convertedParam1 = $this->convertParameter($param1, $param1Type, $returnType);
        $convertedParam2 = $this->convertParameter($param2, $param2Type, $returnType);

        $result = $this->calculateHelper
            ->setParameters(array($convertedParam1, $convertedParam2))
            ->setOperation(new Add())
            ->process();

        return $result;
    }

    /**
     * @param int $param
     * @param string $paramType
     * @param string $returnType
     * @return float
     */
    public function convertParameter(int $param, string $paramType, string $returnType): float
    {
        if($paramType == $returnType){
            return $param;
        }

        switch ($returnType){
            case self::METERS:
                $service = new ManageService(new YardConvertService());
                break;
            case self::YARDS:
                $service = new ManageService(new MeterConvertService());
                break;
        }
        return number_format($service->convert($param),2);
    }
}
