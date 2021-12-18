<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Redirect;
use Session;


use Closure;

class authCustom
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
        session_start();
        
        //Refirect::to(route($request->route()));
    
        if(!isset($_SESSION['logged'])) {
            return Redirect::to(route('user.auth.login.errore'));
        }
        return $next($request);
    }
}
