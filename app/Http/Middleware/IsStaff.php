<?php

namespace App\Http\Middleware;

use Closure;

class IsStaff
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
        if(auth()->user()->is_admin == 2){
        return $next($request);
        }

    return redirect('/')->with('error',"Anda Belum Login/Bukan Staff");
    }
}
