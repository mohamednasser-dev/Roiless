<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use RealRashid\SweetAlert\Facades\Alert;


class HomeController extends Controller
{
    public function index()
    {
//        if(\Auth::guard('admin')->check()) {
//            dd('here');
//        }
        return view('home');
    }
    public function landing()
    {
        return view('landing_page');
    }
    public function viewprofile(Request $request)
    {
        return view('viewprofile');
    }

    public function change_lang(Request $request,$lang)
    {
        if (session()->has('lang')) {
            session()->forget('lang');
        }
        session()->put('lang', $lang);
        \App::setLocale($lang);
        return back();
    }
}
