<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class SearchPageMiddleware
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
        {
            if(Auth::guest()) {
                return redirect('/');
            }

            if (in_array($request->user()->role_id, [1,2,3,4,5]) AND $request->user()->status == 1) {
                return $next($request);
            } else {
                return redirect('/');
            }
        }
    }
}
