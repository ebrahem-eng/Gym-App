<?php

namespace App\Http\Controllers\Admin\Employe;

use App\Http\Controllers\Controller;
use App\Models\Employe;
use Illuminate\Http\Request;

class EmployeController extends Controller
{
    //
    public function index()
    {
        $employes = Employe::all();
        return view('Admin/Employe/index' , compact('employes'));
    }

    public function create()
    {
        return view('Admin/Employe/create');
    }

   public function Archive(){
    return view('Admin/Employe/Archive');
   }

   public function store(Request $request)
   {
     Employe::create([
        'first_name'=>$request->firstName,
        'last_name'=>$$request->lastName,
     ]);
   }
}
