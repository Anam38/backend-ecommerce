<?php

use App\DataAccess\Cache\Gateway;

if (!function_exists('resp')) {
    function resp($success, $responseCode, $message, $data = [], $errors = null)
    {
        if ($success == true) {
            $errors = null;
        }else{
            $errors = $data;
            $data = null;
        }

        return [
            'success' => $success,
            'response_code' => $responseCode,
            'message' => $message,
            'data' => $data,
            'errors' => $errors
        ];
    }
}

if (! function_exists('cache_gateway')) {
    function cache_gateway($repo) {
        return new Gateway($repo);
    }
}
