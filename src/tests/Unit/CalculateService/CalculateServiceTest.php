<?php

namespace Tests\Unit\CalculateServiceTest;

use App\Service\CalculateAdditionFactory;

class CalculateServiceTest extends \TestCase
{
    protected static $calculateAdditionFactory;
    protected static $calculateAddition;

    public static function setUpBeforeClass(): void
    {
        self::$calculateAdditionFactory = new CalculateAdditionFactory();
        self::$calculateAddition = self::$calculateAdditionFactory->createCalculate();

        //self::$yardsMetersConverter = new YardsMetersConverter();
    }

    public function test_calculator_helper_sum_without_convert_with_success(): void
    {
        $result = self::$calculateAddition->calculate([
            "param1_type" => "yards",
            "param1" => 3,
            "param2_type" => "meters",
            "param2" => 5,
            "return_type" => "meters"
        ]);

        $this->assertEquals(7.73, $result);
    }

    public function test_calculator_helper_sum_without_convert_with_error(): void
    {
        $result = self::$calculateAddition->calculate([
            "param1_type" => "meters",
            "param1" => 7,
            "param2_type" => "meters",
            "param2" => 8,
            "return_type" => "meters"
        ]);

        $this->assertEquals(15, $result);

    }

    public function test_calculator_helper_sum_with_convert_meters_to_yards_with_success(): void
    {
        $result = self::$calculateAddition->calculate([
            "param1_type" => "meters",
            "param1" => 7,
            "param2_type" => "yards",
            "param2" => 3,
            "return_type" => "yards"
        ]);

        $this->assertEquals(10.63, $result);

    }

    public function test_calculator_helper_sum_with_convert_meters_to_yards_with_error(): void
    {
        $result = self::$calculateAddition->calculate([
            "param1_type" => "meters",
            "param1" => 30,
            "param2_type" => "meters",
            "param2" => 50,
            "return_type" => "yards"
        ]);

        $this->assertNotEquals(85.49, $result);
    }

    public function test_calculator_helper_sum_with_convert_yards_to_meters_with_success(): void
    {
        $result = self::$calculateAddition->calculate([
            "param1_type" => "yards",
            "param1" => 30,
            "param2_type" => "yards",
            "param2" => 45,
            "return_type" => "meters"
        ]);

        $this->assertEquals(68.25, $result);
    }

    public function test_calculator_helper_sum_with_convert_yards_to_meters_with_wrong_result(): void
    {
        $result = self::$calculateAddition->calculate([
            "param1_type" => "yards",
            "param1" => 30,
            "param2_type" => "meters",
            "param2" => 50,
            "return_type" => "meters"
        ]);

        $this->assertNotEquals(73.15, $result);
    }
}

