<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bank;
use App\Models\User;
use App\Models\Fund;
use App\Models\User_fund;
use App\Models\Admin;
use Carbon\Carbon;
use Teckwei1993\Otp\Otp;

class DashboardController extends Controller
{


    public function __construct()
    {
    }

    public function index()
    {

        $usercount = User::count();
        $bankcount = Bank::count();
        $fundcount = Fund::count();
        $employercount = Admin::count();
        $consolution_replyes = 5;

        // for chart 3
        $pending_fund = User_fund::where(['user_status' => 'pending'])->get()->count();
        $accepted_fund = User_fund::where(['user_status' => 'finail_accept'])->get()->count();
        $rejected_fund = User_fund::where(['user_status' => 'finail_rejected'])->get()->count();

        $pending_fund = json_encode($pending_fund);
        $accepted_fund = json_encode($accepted_fund);
        $rejected_fund = json_encode($rejected_fund);
        for ($i = 1; $i <= 12; $i++) {
            $user_count[$i] = User::whereYear('created_at', '=', Carbon::yesterday())->whereMonth('created_at', '=', $i)->get()->count();
        };
        $user_count = json_encode($user_count);
        //dd($user_count);


        return view('home', compact('usercount', 'bankcount', 'fundcount', 'employercount', 'rejected_fund', 'accepted_fund', 'pending_fund', 'user_count'));
    }
}
