<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // if (Auth::guard('bank')->check()) {
        //     return redirect(route('bank.home'));
        // }elseif (Auth::guard('admin')->check()) {
        //     return redirect(route('home'));
        // }
        return $next($request);
    }
}
