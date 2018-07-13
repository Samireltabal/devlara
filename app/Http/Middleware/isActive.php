<?php

namespace App\Http\Middleware;
use Auth;
use Closure;

class isActive
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
        if(Auth::check()) {
            if(Auth::user()->active !== 1){
            Auth::logout();
            return redirect()->route('login')->with('Error',"Your account is locked please contact administrator");
            }
        }
        return $next($request);
    }
}
