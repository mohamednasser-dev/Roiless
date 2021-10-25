<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User_fund;
use App\Models\fund;
use App\Models\User;
use Illuminate\Http\Request;

class UserfundsController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user()->id;
        $lang = $request->header('lang');
        Session()->put('api_lang', $lang);
        $userfunds = User_fund::select(['id','user_id','fund_id','dataform','user_status','fund_amount','created_at'])
        ->where('user_id', $user)->with('Fund_details')->with('Users')->get();
//        ->map(function($data){
//        $data->fund_amount = number_format((float)($data->fund_amount), 3) ;
//        return $data;
//    });
        $userfunds->makeHidden(['emp_id', 'bank_id']);
        return msgdata($request, success(), 'get all user funds ', $userfunds);

    }
}

//select(['id','fund_amount','user_status'])->
