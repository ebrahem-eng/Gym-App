<?php

namespace App\Http\Controllers\Employe\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //

        //اظها صفحة تسجيل الدخول للمدير 

 public function index()
 {
    try{
      return view('Employe/Auth/login');
    }catch(\Exception $ex)
    {
        return redirect()->route('notfound');
    }
  
 }

 //التحقق من عملية تسجيل الدخول

 public function store(Request $request)
 {
    try{
        $check = $request->all();
        if(Auth::guard('employe')->attempt(['email'=>$check['email'],
        'password'=>$check['password']])){
    
            return redirect()->route('employe.index');
        }else{
            return redirect()->route('employe.show.login')->with('login_error_message','error login please enter valid username and password');
        }

    }catch(\Exception)
    {
    return redirect()->route('notfound');
    }

 }

 //تسجيل الخروج

 public function logout()
 {
    try{
        Auth::guard('employe')->logout();
        return redirect()->route('employe.show.login');

    }catch(\Exception $ex)
    {
    return redirect()->route('notfound');
    }
  
 }
}
