<?php

namespace App\Http\Controllers\Trainer\Trait;

trait TrainerTrait{

    public function Data_Trainer($data = null , $message = null , $status = null)
    {
        $array =[
        'data' => $data,
         'message' => $message,
         'status' => $status
        ];

        return response($array,$status);
    }
}
