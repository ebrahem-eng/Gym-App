<?php

namespace App\Http\Controllers\Employe;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmployeController extends Controller
{
    //
       //عرض الصفحة الرئيسية للموظف
    
       public function index()
       {
           try{
        
               return view('Employe/index');
           }
           catch(\Exception $ex)
           {
               return redirect()->route('notfound');
           }
         
       }
}
