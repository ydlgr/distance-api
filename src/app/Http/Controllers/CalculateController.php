<?php

namespace App\Http\Controllers;

use App\Service\ProcessService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class CalculateController
 * @package App\Http\Controllers
 */
class CalculateController extends Controller
{
    /**
     * @var ProcessService
     */
    private $processService;

    public function __construct(ProcessService $processService)
    {
        $this->processService = $processService;
    }

    /**
     * calculate method gets the request parameters and validates them.
     * it sends the request parameters to ProcessService class and gets the calculated value.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function calculate(Request $request): JsonResponse
    {
        $this->validateParameters($request);

        try {
            $result = $this->processService->calculate($request->all());

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
