<?php

namespace App\Http\Controllers\Bank;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function homeBank()
    {
        return view('bank.home');
    }
}
