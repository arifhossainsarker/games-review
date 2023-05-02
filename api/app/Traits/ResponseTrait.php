<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ResponseTrait
{
    /**
     * Success Response
     * @param array $data
     * @param string $message
     * @return JsonResponse
     */

    public function SuccessResponse($data, $message = "Successfully"): JsonResponse
    {
        return response()->json([
            'status' => true,
            'message' => $message,
            'data' => $data,
            'error' => NULL

        ]);
    }

    /**
     * Error Response
     * @param array $data
     * @param string $message
     * @return JsonResponse
     */

    public function ErrorResponse($error, $message = "Data is Invalid"): JsonResponse
    {
        return response()->json([
            'status' => false,
            'message' => $message,
            'data' => NULL,
            'error' => $error

        ]);
    }
}
