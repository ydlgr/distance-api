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
     * Process Service calculate method process the logic.
     * This class sends converted parameters to CalculateHelper Class.
     *
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

        /**
         * If another mathematic logic will be added in the future like minus, mod etc,
         * it can be used like setOperation(new Mod()) without changing other parameters and classes.
         *
         */
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
        /**
         * if the first parameter equals returnType , it can be returned its owned value or
         * if the second parameter equals returnType , it can be returned itself.
         */
        if($paramType == $returnType){
            return $param;
        }

        /**
         * ManageService implements ConvertInterface and gets it as constructor
         *
         * if any other returnType like centimeter want to be added ,
         * it will just be enough to create a new Class like CentimeterConvertService.
         */

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
