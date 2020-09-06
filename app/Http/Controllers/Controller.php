<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @param bool $status
     * @param string $message
     * @param array $data
     * @param int $httpCode
     * @return JsonResponse
     */
    public function sendResult(
        bool $status,
        string $message,
        array $data,
        int $httpCode
    ): JsonResponse
    {
        return response()->json(
            [
                'status' => $status,
                'message' => $message,
                'result' => $data,
            ],
            $httpCode
        );
    }

    /**
     * @param bool $status
     * @param string $message
     * @param array $errors
     * @param int $httpCode
     * @return JsonResponse
     */
    public function sendError(
        bool $status,
        string $message,
        array $errors,
        int $httpCode
    ): JsonResponse
    {
        return response()->json(
            [
                'message' => $message,
                'errors' => $errors
            ],
            $httpCode
        );
    }
}
