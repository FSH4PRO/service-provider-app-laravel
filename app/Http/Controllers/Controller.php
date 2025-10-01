<?php

namespace App\Http\Controllers;

abstract class Controller
{
    public function success($data, $message = 'Success', $code = 200)
    {
        return response()->json([
            'code' => $code,
            'message' => $message,
            'data' => $data,


        ], $code);
    }
}
