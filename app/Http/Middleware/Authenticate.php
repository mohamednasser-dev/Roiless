<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        /*
        if (! $request->expectsJson()) {
            return route('login_user');
        }
        */

//        if(\Auth::guard('web')->check()) {
//            return redirect()->route('login');
//        } else if(\Auth::guard('bank')->check()) {
//            return redirect()->route('bank.login');
//        } else if(\Auth::guard('seller')->check()) {
//            return redirect()->route('seller.login');
//        } else{
//            return redirect()->route('login');
//        }
    }
}
