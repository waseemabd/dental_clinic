<?php

namespace App\Http\Middleware;

use Closure;
use http\Exception;
use http\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use function foo\func;

class IsAdmin
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
        if(Auth::user() && Auth::user()->role  == 1){
            return $next($request);
        }else{
           return redirect('/')->with(Auth::logout()) ;

        }
    }
}
