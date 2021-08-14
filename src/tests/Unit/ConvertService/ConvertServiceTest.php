<?php

namespace Tests\Unit\ConvertService;

use App\Helper\CalculateHelper;
use App\Service\ProcessService;

class ConvertServiceTest extends \TestCase
{
    protected static $calculateHelper;
    protected static $processService;

    public static function setUpBeforeClass(): void
    {
        self::$calculateHelper = new CalculateHelper();
        self::$processService = new ProcessService(self::$calculateHelper);
    }

    public function test_convert_parameter_meters_to_yards_with_success_result(): void
    {
        $result = self::$processService->convertParameter(15,'meters', 'yards');

        $this->assertEquals(16.35, $result);
    }

    public function test_convert_parameter_meters_to_yards_with_error_result(): void
    {
        $result = self::$processService->convertParameter(20,'meters', 'yards');

        $this->assertNotEquals(21.32, $result);
    }

    public function test_convert_parameter_yards_to_meters_with_error_result(): void
    {
        $result = self::$processService->convertParameter(10,'yards', 'meters');

        $this->assertNotEquals(9.15, $result);
    }

    public function test_convert_parameter_yards_to_meters_with_success_result(): void
    {
        $result = self::$processService->convertParameter(25,'yards', 'meters');

        $this->assertEquals(22.75, $result);
    }

    public function test_convert_param_type_and_return_type_is_equal(): void
    {
        $result = self::$processService->convertParameter(35,'yards', 'yards');

        $this->assertEquals(35, $result);
    }
}
