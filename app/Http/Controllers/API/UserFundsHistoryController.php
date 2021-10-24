<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Fhistory;
use App\Models\User_fund;
use Illuminate\Http\Request;

class UserFundsHistoryController extends Controller
{
    public function index(Request $request,$id)
    {
        $user = auth()->user()->id;
        $lang = $request->header('lang');
        $data['user_fund']=User_fund::where('id',$id)->with('Fund')->first();
        Session()->put('api_lang', $lang);
        $data['history'] = Fhistory::select('id', 'note_ar', 'note_en', 'status', 'created_at')->where('user_fund_id', $id)->get();
        return msgdata($request, success(), 'there is no history for this id ', $data);
    }
}
