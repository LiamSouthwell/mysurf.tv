<?php

namespace App\Http\Middleware;
use Auth;
use Closure;

class AdminAuth 
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::check()){
            if(Auth::User()->role == 2){
                return $next($request);
            }
            else
                return redirect('/');
        }
        else
            return redirect('/');

    }
}
