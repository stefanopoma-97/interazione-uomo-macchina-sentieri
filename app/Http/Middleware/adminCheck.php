<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Redirect;


use Closure;

class adminCheck
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
        
        if(!isset($_SESSION['admin'])) {
            return Redirect::to(route('sentiero.errore'));
        }
        return $next($request);
    }
}
