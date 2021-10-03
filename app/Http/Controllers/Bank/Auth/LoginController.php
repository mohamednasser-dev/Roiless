<?php

namespace App\Http\Controllers\Bank\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
    public  function login() {
        if (Auth::guard('bank')->check()) {
            return redirect(route('bank.home'));
        }elseif (Auth::guard('web')->check()) {
            return redirect(route('home'));
        }
        return view('bank.auth.login');
    }

    public function loginBank(Request $request) {

        $remeber= $request->Remember==1? true:false ;

        if(Auth::guard('bank')->attempt( ['email'=>$request->email,'password'=>$request->password ],$remeber) ){
            //Check if active user or not

                if(Auth::guard('bank')->user()->status != 'active'){
                    Auth::guard('bank')->logout();
                    session()->flash('danger', trans('bank.not_auth'));
                    return redirect()->route('bank.login');
                }else{
                    return redirect()->route('bank.home');
                }
        }else{
            session()->flash('danger',trans('bank.invaldemailorpassword'));
            return redirect(route('bank.login'));
        }
    }

    public function logout(){
        Auth::guard('bank')->logout();
        return redirect()->route('bank.login');
    }

}
