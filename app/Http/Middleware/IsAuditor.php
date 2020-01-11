<?php

namespace App\Http\Middleware;

use Closure;

class IsAuditor
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
        if(auth()->user()->is_admin == 3){
        return $next($request);
        }

    return redirect('home')->with('error',"Anda Belum Login/Bukan IT Staff");
    }
}
