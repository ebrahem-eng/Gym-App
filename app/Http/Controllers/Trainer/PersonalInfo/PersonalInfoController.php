<?php

namespace App\Http\Controllers\Trainer\PersonalInfo;

use App\Http\Controllers\Controller;
use App\Models\Trainer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Trainer\Trait\TrainerTrait;

class PersonalInfoController extends Controller
{
    use TrainerTrait;
    
    public function index()
    {
        $trainers_info = Trainer::where('id',Auth::guard('trainer')->user()->id)->get();
        return $this->Data_Trainer($trainers_info, 'Trainers Data Retrieved Successfully', 200);
    }
}
