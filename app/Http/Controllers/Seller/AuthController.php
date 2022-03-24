<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use RealRashid\SweetAlert\Facades\Alert;


class AuthController extends Controller
{
    public function index()
    {
        return view('seller.auth.login');
    }

}
