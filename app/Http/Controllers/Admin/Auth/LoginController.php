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

    public function loginAdmin(Request $request) {

        $remeber= $request->Remember==1? true:false ;

        if(Auth::guard('admin')->attempt( ['email'=>$request->email,'password'=>$request->password ],$remeber) ){
            //Check if active user or not

            if(Auth::guard('admin')->user()->status != 'active'){
                Auth::guard('admin')->logout();
                session()->flash('danger', trans('admin.not_auth'));
                return redirect()->route('login');
            }else{
              //  activity('admin')->log('Login Successfully');
/*
                activity('admin')
                    ->causedBy(Auth::guard('admin')->user()->id)
                    ->log('Login Successfully');
  */
                return redirect()->route('home');
            }
        }else{
            session()->flash('danger',trans('admin.invaldemailorpassword'));
            return redirect(route('login'));
        }
    }

    public function logout(){
        Auth::guard('admin')->logout();
        /*
        activity('admin')->log('Logout Successfully');
        */
        return redirect()->route('login');
    }

}
