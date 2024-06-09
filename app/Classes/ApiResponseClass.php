<?php

namespace App\Classes;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Log;

class ApiResponseClass
{
    public static function rollback($e, $message = "Algo salió mal")
    {
        DB::rollBack();
        self::throw($e, $message);
    }

    public static function throw($e, $message = "Algo salió mal")
    {
        Log::error($e);
        throw new HttpResponseException(response()->json(
            [
                'success' => false,
                'message' => $message,
                'data' => $e->getMessage(),
                'status' => 500
            ]
        ));
    }

    public static function sendResponse($data, $message, $code=200)
    {
        $response=[
            'success' => true,
            'message' => $message,
            'data' => $data,
            'status' => $code
        ];
        if(!empty($message)){
            $response['message']=$message;
        }
        return response()->json($response, $code);
    }

}
