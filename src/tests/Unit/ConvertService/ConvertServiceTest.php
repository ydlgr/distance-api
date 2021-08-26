<?php

namespace Tests\Unit\ConvertService;

use App\Helper\YardsMetersConverter;

class ConvertServiceTest extends \TestCase
{
    public function test_convert_parameter_meters_to_yards_with_success_result(): void
    {
        $yardsMetersConverter = new YardsMetersConverter("meters","yards",15);

        $this->assertEquals(16.35, $yardsMetersConverter->convert());
    }

    public function test_convert_parameter_meters_to_yards_with_error_result(): void
    {
        $yardsMetersConverter = new YardsMetersConverter("meters","yards",20);

        $this->assertNotEquals(21.32, $yardsMetersConverter->convert());
    }

    public function test_convert_parameter_yards_to_meters_with_error_result(): void
    {
        $yardsMetersConverter = new YardsMetersConverter("yards","meters",10);

        $this->assertNotEquals(9.15, $yardsMetersConverter->convert());
    }

    public function test_convert_parameter_yards_to_meters_with_success_result(): void
    {
        $yardsMetersConverter = new YardsMetersConverter("yards","meters",25);

        $this->assertEquals(22.75, $yardsMetersConverter->convert());
    }

    public function test_convert_param_type_and_return_type_is_equal(): void
    {
        $yardsMetersConverter = new YardsMetersConverter("yards","yards",35);


        $this->assertEquals(35, $yardsMetersConverter->convert());
    }
}
