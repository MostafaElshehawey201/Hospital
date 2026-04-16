<?php

namespace App\Trait\Auth;

trait Response
{
    public function success($data , $code){
        return response()->json([
            "success" => true,
            "data" =>$data,
            "errors" => null,
        ],$code);
    }

    public function errors($data , $code){
        return response()->json([
            "success" => false,
            "data" =>null,
            "errors" => $data,
        ],$code);
    }
}
