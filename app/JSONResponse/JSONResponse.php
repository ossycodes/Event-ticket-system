<?php

namespace App\JSONResponse\JSONResponse;

trait JSONResponse
{
    public function sendSuccessResponse($data)
    {
        $response = [
            'status' => 'Success',
            'data' => $data
        ];
        return response()->json($data);
    }
}
