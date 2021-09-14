<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
class LoginController extends Controller
{
    public function login() {
        return view('admin.auth.login');
    }

    public function loginBank(Request $request) {

        $remeber= $request->Remember==1? true:false ;

        if(Auth::guard('admin')->attempt( ['email'=>$request->email,'password'=>$request->password ],$remeber) ){
            //Check if active user or not

            if(Auth::guard('admin')->user()->status != 'active'){
                Auth::guard('admin')->logout();
                session()->flash('danger', trans('admin.not_auth'));
                return redirect()->route('admin.login');
            }else{
                return redirect()->route('home');
            }
        }else{
            session()->flash('danger',trans('admin.invaldemailorpassword'));
            return redirect(route('admin.login'));
        }
    }
    public function logout(){
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }

}
