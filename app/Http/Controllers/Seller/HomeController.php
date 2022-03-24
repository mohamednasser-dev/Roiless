<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use RealRashid\SweetAlert\Facades\Alert;


class HomeController extends Controller
{
    public function index()
    {
        return view('seller.index');
    }
    public function home()
    {
        return view('seller.dashboard.home');
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
