<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employe;
use App\Models\Trainer;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //عرض الصفحة الرئيسية للادمن
    
    public function index()
    {
        try{
            $trainer_count = Trainer::all()->count();
            $employe_count = Employe::all()->count();
            return view('admin.index',compact('trainer_count','employe_count'));
        }
        catch(\Exception $ex)
        {
            return redirect()->route('notfound');
        }
      
    }
}
