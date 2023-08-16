<?php

namespace App\Http\Controllers\Trainer\Trait;

trait TrainerTrait{

    //طريقة جلب البيانات وعرضها 
    
    public function Data_Trainer($data = null , $message = null , $status = null)
    {
        $array =[
        'message' => $message,
        'data' => $data, 
        'status' => $status
        ];

        return response($array,$status);
    }
}
