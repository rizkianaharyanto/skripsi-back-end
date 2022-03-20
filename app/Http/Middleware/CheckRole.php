<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,...$roles)
    {
        // $roles = array_slice(func_get_args(), 2);

        // foreach ($roles as $role) { 
            // $user = Auth::user()->roles;
            // if( $user == 'distributor'){
            //     return $next($request);
            // }
        // }
    
        // return redirect('/')->with('error',"Anda bukan Admin distributor");
        if (in_array($request->user()->roles,$roles)){
            return $next($request);
        }
        return redirect('/');
        
    }
}
