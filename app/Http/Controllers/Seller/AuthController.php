<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;


class AuthController extends Controller
{
    public function index()
    {
        if (Auth::guard('bank')->check()) {
            return redirect(route('bank.home'));
        }elseif (Auth::guard('web')->check()) {
            return redirect(route('home'));
        }elseif (Auth::guard('seller')->check()) {
            return redirect(route('seller.home'));
        }
        return view('seller.auth.login');
    }

    public function login(Request $request)
    {
        $remeber = $request->Remember == 1 ? true : false;
        if (Auth::guard('seller')->attempt(['email' => $request->email, 'password' => $request->password], $remeber)) {
            //Check if active user or not
//            if (Auth::guard('seller')->user()->status != 'active') {
//                Auth::guard('seller')->logout();
//                session()->flash('danger', trans('bank.not_auth'));
//                return redirect()->route('seller.login');
//            } else {
//                return redirect()->route('seller.home');
//            }
            return redirect()->route('seller.home');
        } else {
            session()->flash('danger', trans('seller.invaldemailorpassword'));
            return redirect(route('seller.login'));
        }
    }

    public function logout()
    {
        Auth::guard('seller')->logout();
        return redirect()->route('seller.login');
    }

}
