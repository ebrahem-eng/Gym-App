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

 public function store(Request $request)
 {
    $check = $request->all();
    if(FacadesAuth::guard('admin')->attempt(['email'=>$check['email'],
    'password'=>$check['password']])){

        return redirect()->route('admin.index');
    }else{
        return redirect()->route('admin.show.login')->with('login_error_message','error login please enter valid username and password');
    }
 }

 public function logout()
 {
    FacadesAuth::guard('admin')->logout();
    return redirect()->route('admin.show.login');
 }
}
