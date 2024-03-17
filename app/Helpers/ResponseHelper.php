<?php

namespace App\Helpers;

class ResponseHelper
{
    public static function response($status, $message, $data = null)
    {
        return [
            'status' => $status,
            'message' => $message,
            'data' => $data
        ];
    }
}
