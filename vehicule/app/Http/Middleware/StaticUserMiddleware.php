<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Contracts\Session\Session;
use Symfony\Component\HttpFoundation\Response;

class StaticUserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $staticUserId = 1; 
        
        $staticUserId = 1; // ID de l'utilisateur spécifié
        $staticUserName = 'Chater'; // Nom de l'utilisateur spécifié
        $staticUserAutoecoleId = 2; // autoecole_id de l'utilisateur spécifié

        $request->session()->put('user_autoecole_id', $staticUserAutoecoleId);
        $request->session()->put('user_id', $staticUserId);
        $request->session()->put('user_name', $staticUserName);
        
        
        return $next($request);
    }
    
}
