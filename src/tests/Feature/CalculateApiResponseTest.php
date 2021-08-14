<?php

namespace Tests\Feature;

use Tests\TestCase;

class CalculateApiResponseTest extends \TestCase
{
    public function test_calculate_api_success_response(): void
    {
        $parameters = [
            'param1' => 10,
            'param1_type' => 'yards',
            'param2' => 15,
            'param2_type' => 'yards',
            'return_type' => 'meters'
        ];

        $this->post("api/calculate", $parameters, []);
        $this->seeJsonEquals(
            [
                "status" => "200",
                "data" => 22.75
            ]
        );
    }

    public function test_calculate_api_yards_to_meters_success_response(): void
    {
        $parameters = [
            'param1' => 10,
            'param1_type' => 'meters',
            'param2' => 15,
            'param2_type' => 'meters',
            'return_type' => 'yards'
        ];

        $this->post("api/calculate", $parameters, []);
        $this->seeJsonEquals(
            [
                "status" => "200",
                "data" => 27.25
            ]
        );
    }

    public function test_calculate_api_all_types_meter_success_response(): void
    {
        $parameters = [
            'param1' => 10,
            'param1_type' => 'meters',
            'param2' => 15,
            'param2_type' => 'meters',
            'return_type' => 'meters'
        ];

        $this->post("api/calculate", $parameters, []);
        $this->seeJsonEquals(
            [
                "status" => "200",
                "data" => 25
            ]
        );
    }

    public function test_calculate_api_all_types_yards_success_response(): void
    {
        $parameters = [
            'param1' => 30,
            'param1_type' => 'yards',
            'param2' => 45,
            'param2_type' => 'yards',
            'return_type' => 'yards'
        ];

        $this->post("api/calculate", $parameters, []);
        $this->seeJsonEquals(
            [
                "status" => "200",
                "data" => 75
            ]
        );
    }

    public function test_calculate_api_with_param1_is_null(): void
    {
        $parameters = [
            'param1' => null,
            'param1_type' => 'yards',
            'param2' => 10,
            'param2_type' => 'yards',
            'return_type' => 'meters'
        ];

        $this->post("api/calculate", $parameters, []);

        $this->seeJsonEquals(
            [
                "status" => 422,
                "errors" => [
                    "param1" => ["The param1 field is required."]
                ]
            ]
        );
    }

    public function test_calculate_api_with_param1_type_is_null(): void
    {
        $parameters = [
            'param1' => 10,
            'param1_type' => '',
            'param2' => 10,
            'param2_type' => 'yards',
            'return_type' => 'meters'
        ];

        $this->post("api/calculate", $parameters, []);

        $this->seeJsonEquals(
            [
                "status" => 422,
                "errors" => [
                    "param1_type" => ["The param1 type field is required."]
                ]
            ]
        );
    }

    public function test_calculate_api_with_invalid_type(): void
    {
        $parameters = [
            'param1' => 10,
            'param1_type' => 'yards',
            'param2' => 10,
            'param2_type' => 'centimeters',
            'return_type' => 'meters'
        ];

        $this->post("api/calculate", $parameters, []);

        $this->seeJsonEquals(
            [
                "status" => 422,
                "errors" => [
                    "param2_type" => ["The selected param2 type is invalid."]
                ]
            ]
        );
    }

    public function test_calculate_api_more_than_one_invalid_type_parameters(): void
    {
        $parameters = [
            'param1' => 10,
            'param1_type' => 'yardssss',
            'param2' => 10,
            'param2_type' => 'centimeterssss',
            'return_type' => 'meterssss'
        ];

        $this->post("api/calculate", $parameters, []);

        $this->seeJsonEquals(
            [
                "status" => 422,
                "errors" => [
                    "param1_type" => ["The selected param1 type is invalid."],
                    "param2_type" => ["The selected param2 type is invalid."],
                    "return_type" => ["The selected return type is invalid."],
                ]
            ]
        );
    }
}
