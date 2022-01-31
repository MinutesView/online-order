<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminEmployee
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
        if(!session()->has('LoggedAdmin')  && !session()->has('LoggedEmployee') ){
            if(  session()->has('LoggedPso') || session()->has('LoggedCustomer') ){
                return back();
                }
            return redirect('/')->with('fail','Please Login to Your Account');
        }
        return $next($request);
    }
}
