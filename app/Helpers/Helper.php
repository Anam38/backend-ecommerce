<?php

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
