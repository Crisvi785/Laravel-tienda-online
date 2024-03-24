<?php

namespace App\Http\Middleware;

use Closure, Illuminate\Support\Facades\Auth;




class IsAdmin{
      
        /**
         * Handle an incoming request.
         *
         * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
         */
       
    
    public function handle($request, Closure $next){

        if(Auth::user()-> role == 1){
            return $next($request);

        }else{
            return redirect('/');
        }
    }

}

