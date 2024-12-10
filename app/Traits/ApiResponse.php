<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponse
{
    /**
     * 
     *
     * @param mixed $data
     * @param string $message 
     * @param int $statusCode
     * 
     * @return JsonResponse
     */
    public function apiResponse($data, $message = null, $status = 200)
    {
        $message = $message ? __($message) : ('Successfull query') ; 
         return response()->json([
            'message' => $message,
            'data' => !empty($data) ? $data :[] ,
            'status' => in_array($status , [200,201,202,203]),
            'code' => $status 
        ], $status);
    }
}
