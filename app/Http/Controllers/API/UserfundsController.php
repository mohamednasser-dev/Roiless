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
        $userfunds = User_fund::select(['id', 'user_id', 'fund_id', 'dataform', 'user_status', 'fund_amount', 'cost', 'created_at'])
            ->where('user_id', $user)->with('Fund_details')->with('Users')->orderby('created_at', 'DESC')->get()
            ->map(function ($data) {
                $full_name = "";
                foreach (json_decode($data->dataform, true) as $row) {
                    if ($row['name'] == 'full_name') {
                        $full_name = $row['value'];
                    }
                }
                $data->full_name = $full_name;
                return $data;
            });


        return msgdata($request, success(), 'get all user funds ', $userfunds);

    }
}

//select(['id','fund_amount','user_status'])->
