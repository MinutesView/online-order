<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CustomerCheck
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
        if(!session()->has('LoggedCustomer')){
            if(  session()->has('LoggedPso') || session()->has('LoggedEmployee')  || session()->has('LoggedAdmin') ){
                return back();
                }
            return redirect('/')->with('fail','Please Login to Your Account');
        }
        return $next($request);
    }
}
