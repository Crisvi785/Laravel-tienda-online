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

       // Verificar si el usuario está autenticado y tiene el rol 1 (administrador)
       if ($request->user() && $request->user()->role == 1) {
        return $next($request); // Permite el acceso
    }

    // Si no tiene el rol necesario, redirige o muestra un mensaje de error
    return redirect('/')->with('error', 'No tienes permiso para acceder a esta página');
    }
}



