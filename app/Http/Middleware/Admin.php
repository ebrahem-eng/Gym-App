<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    
    public function handle(Request $request, Closure $next)
    {
        try{
            if(!FacadesAuth::guard('admin')->check() && FacadesAuth::guard('admin')->user()->status == 0)
            {
                return redirect()->route('admin.login');
            }
            return $next($request);

        }catch(\Exception $ex)
        {
            return redirect()->route('notfound');
        }

    }
}
