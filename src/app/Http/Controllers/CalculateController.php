<?php

namespace App\Http\Controllers;

use App\Service\CalculateAdditionFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class CalculateController
 * @package App\Http\Controllers
 */
class CalculateController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function calculate(Request $request): JsonResponse
    {
        $this->validateParameters($request);

        try {
            $calculateAdditionFactory = new CalculateAdditionFactory();
            $calculate = $calculateAdditionFactory->createCalculate();
            $result = $calculate->calculate($request->all());

            return response()->json([
                'status' => '200',
                'data' => $result
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => '400',
                'errors' => [$e->getMessage()]
            ]);
        }
    }

    private function validateParameters(Request $request)
    {
        return $this->validate($request, [
            'param1' => 'required|numeric',
            'param2' => 'required|numeric',
            'param1_type' => 'required|in:meters,yards',
            'param2_type' => 'required|in:meters,yards',
            'return_type' => 'required|in:meters,yards'
        ]);
    }
}
