<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Models\Activity;

class LoginController extends Controller
{
    public function login(){

        $remeber=Request('Remember')==1? true:false ;

        if(auth::guard('web')->attempt( ['email'=>Request('email'),'password'=>Request('password') ],$remeber) ){
            //Check if active user or not

            if(Auth::user()->type !== 'user') {
                if(Auth::user()->status != 'active'){
                    Auth::logout();
                    session()->flash('danger', trans('admin.not_auth'));
                    return redirect('login');
                }else{
                    activity()->log('Login Successfully');
                    return redirect('/');
                }
            }
        }else{
            session()->flash('danger',trans('admin.invaldemailorpassword'));
          return redirect('login');
        }
    }
}
