<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests;
    use ValidatesRequests;

    public function sendResponse(array $result = [], array $message = []) : JsonResponse {
    	$response = [
            'data' => (object)$result,
            'message' => $message
        ];

        return response()->json($response, 200);
    }

    public function sendError(array $errorMessages = [], int $code = 400, array $data = []) : JsonResponse {
    	$response = [
            'data' => (object)$data,
            'message' => $errorMessages
        ];

        return response()->json($response, $code);
    }
}
