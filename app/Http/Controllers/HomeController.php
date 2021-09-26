<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
    public function change_lang(Request $request)
    {
       return $request->all();
    }
}
