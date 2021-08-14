<?php

namespace Tests\Unit\CalculateServiceTest;

use App\Helper\CalculateHelper;
use App\Helper\Operation\Add;
use App\Service\ProcessService;

class CalculateServiceTest extends \TestCase
{
    protected static $calculateHelper;
    protected static $processService;

    public static function setUpBeforeClass(): void
    {
        self::$calculateHelper = new CalculateHelper();
        self::$processService = new ProcessService(self::$calculateHelper);
    }

    public function test_calculator_helper_sum_without_convert_with_success(): void
    {
        $result = self::$calculateHelper
            ->setParameters([20,20])
            ->setOperation(new Add())
            ->process();

        $this->assertEquals(40, $result);
    }

    public function test_calculator_helper_sum_without_convert_with_error(): void
    {
        $result = self::$calculateHelper
            ->setParameters([5.55,7.12])
            ->setOperation(new Add())
            ->process();

        $this->assertNotEquals(12.68, $result);
    }

    public function test_calculator_helper_sum_with_convert_meters_to_yards_with_success(): void
    {
        $result = self::$calculateHelper
            ->setParameters([
                self::$processService->convertParameter(10,'meters','yards'),
                self::$processService->convertParameter(15, 'meters', 'yards')
                ])
            ->setOperation(new Add())
            ->process();

        $this->assertEquals(27.25, $result);
    }

    public function test_calculator_helper_sum_with_convert_meters_to_yards_with_error(): void
    {
        $processService = new ProcessService(self::$calculateHelper);

        $result = self::$calculateHelper
            ->setParameters([
                $processService->convertParameter(30,'meters','yards'),
                $processService->convertParameter(50, 'meters', 'yards')
            ])
            ->setOperation(new Add())
            ->process();

        $this->assertNotEquals(85.49, $result);
    }

    public function test_calculator_helper_sum_with_convert_yards_to_meters_with_success(): void
    {
        $processService = new ProcessService(self::$calculateHelper);

        $result = self::$calculateHelper
            ->setParameters([
                $processService->convertParameter(30,'yards','meters'),
                $processService->convertParameter(45, 'yards', 'meters')
            ])
            ->setOperation(new Add())
            ->process();

        $this->assertEquals(68.25, $result);
    }

    public function test_calculator_helper_sum_with_convert_yards_to_meters_with_wrong_result(): void
    {
        $processService = new ProcessService(self::$calculateHelper);

        $result = self::$calculateHelper
            ->setParameters([
                $processService->convertParameter(30,'yards','yards'),
                $processService->convertParameter(50, 'yards', 'meters')
            ])
            ->setOperation(new Add())
            ->process();

        $this->assertNotEquals(73.15, $result);
    }
}

