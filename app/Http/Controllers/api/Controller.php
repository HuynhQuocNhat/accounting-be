<?php

namespace App\Http\Controllers\api;

abstract class Controller
{
    public function response($message, $status, $data = null)
    {
        $response = [
            'status' => $status,
            'message' => $message,
        ];

        if (!empty($data)) {
            $response['data'] = $data;
        }

        return response()->json($response, $status);
    }
}
