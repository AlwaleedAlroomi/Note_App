<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;

class BaseController extends Controller
{
    public function sendResponse($result, $message)
    {
        $ressponse = [
            'success' => true,
            'data' => $result,
            'message' => $message,
        ];
        return response()->json($ressponse, 200);
    }

    public function sendError($error, $errorMessage = [], $code = 404)
    {
        $ressponse = [
            'success' => false,
            'message' => $error,
        ];
        if (!empty($errorMessage)) {
            $ressponse['data'] = $errorMessage;
        }
        return response()->json($ressponse, $code);
    }
}
