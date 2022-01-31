<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AlreadyLogged
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(  session()->has('LoggedPso') || session()->has('LoggedEmployee')  || session()->has('LoggedAdmin')  || session()->has('LoggedCustomer') && ( url('login') == $request->url() ||  url('register') == $request->url() ) ){
        return back();
        }
        return $next($request);
    }
}
