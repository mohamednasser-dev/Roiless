<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User_fund;
use Illuminate\Http\Request;

class UserfundsController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user()->id;
        $lang = $request->header('lang');
        Session()->put('api_lang', $lang);
        $userfunds = User_fund::where('user_id', $user)->with('Fund')->get();

        $userfunds->makeHidden(['emp_id', 'bank_id']);
        return msgdata($request, success(), 'get all user funds ', $userfunds);

    }
}
