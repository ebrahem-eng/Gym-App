<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Employes
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
            if(!Auth::guard('employe')->check() || Auth::guard('employe')->user()->status == 0)
            {
                return redirect()->route('employe.show.login');
            }
            return $next($request);

        }catch(\Exception $ex)
        {
            return redirect()->route('notfound');
        }
    }
}
