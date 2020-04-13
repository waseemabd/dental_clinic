<?php

namespace App\Http\Controllers\Api;

trait ApiResponseTrait{


    public function apiResponse($data = null, $code = 200, $error = null){

        $array = [
//            'data' => $data,
//            'status' => in_array($code, $this->successCode()) ? true : false,
//            'error' => $error
            'code' => $code,
            'data' => $data,
            'message' => in_array($code, $this->successCode()) ? 'Successful' : $error,

        ];

        return response($array, $code);
    }

    public function successCode(){
        return [200,201,202];
    }
}
