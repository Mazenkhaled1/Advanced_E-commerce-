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

    public function success ($data , $message = '' , $code = 200) 
    {
        return response()->json([
            'status_code' => $code , 
            'message' => $message , 
            'data' => $data 
         ] , $code ) ; 
    }
    public function error ($data  , $message , $code ) 
    {
        return response()->json([
            'status_code' => $code , 
            'message' => $message , 
            'data' => $data 
         ] , $code ) ; 
    }
}
