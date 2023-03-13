<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class AuthController extends Controller
{
    //اظها صفحة تسجيل الدخول للمدير 

 public function index()
 {
    try{
        return view('Admin/Auth/login');
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
        if(FacadesAuth::guard('admin')->attempt(['email'=>$check['email'],
        'password'=>$check['password']])){
    
            return redirect()->route('admin.index');
        }else{
            return redirect()->route('admin.show.login')->with('login_error_message','error login please enter valid username and password');
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
        FacadesAuth::guard('admin')->logout();
        return redirect()->route('admin.show.login');

    }catch(\Exception $ex)
    {
    return redirect()->route('notfound');
    }
  
 }
}
