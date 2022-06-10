<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
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

    public function viewprofile(Request $request)
    {
        return view('viewprofile');
    }

    public function change_lang(Request $request, $lang)
    {
        if (session()->has('lang')) {
            session()->forget('lang');
        }
        session()->put('lang', $lang);
        \App::setLocale($lang);
        return back();
    }

    public function change_city(Request $request, $id)
    {
        Admin::findOrFail(Auth::user()->id)->update(['city_id' => $id]);
        return back();
    }
}
