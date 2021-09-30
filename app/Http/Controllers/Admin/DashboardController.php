<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bank;
use App\Models\User;
use App\Models\Fund;
use App\Models\User_fund;
use App\Models\Admin;



class DashboardController extends Controller
{
    public function index()
    {
//        if(\Auth::guard('admin')->check()) {
//            dd('here');
//        }
        $usercount=User::count();
        $bankcount=Bank::count();
        $fundcount=Fund::count();
        $employercount=Admin::count();
        $resent_fund=User_fund::where(['user_status' => 'pending'])->get()->count();
        $accepted_fund=User_fund::where(['user_status' => 'finail_accept'])->get()->count();
        $rejected_fund=User_fund::where(['user_status' => 'finail_rejected'])->get()->count();
       
        return view('home', compact('usercount','bankcount','fundcount','employercount'));
    }
}
