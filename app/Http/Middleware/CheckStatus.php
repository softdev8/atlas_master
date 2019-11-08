<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckStatus
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
            if($request->user()->status !== 1) {
                Auth::logout();
                return  redirect('/login')
                        ->withErrors(['status' => 'Your account has been suspended, please contact your manager.']);
            }
        }
        return $next($request);
    }
}
