<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Illuminate\Support\Facades\Redirect;

class SecureYourSelf
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
            $id = $request->input('user_id'); 
            if($id != Auth::user()->id)
            {
                return $next($request);
            } // They're the owner, lets continue...

            return back()->with('faild','You are not allowed to do this action'); // Nope! Get outta' here.
        }
}
