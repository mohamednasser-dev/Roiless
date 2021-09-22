<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Fhistory;
use Illuminate\Http\Request;

class UserFundsHistoryController extends Controller
{
    public function index(Request $request)
    {
//        return $request->header('id');
        try {
            $lang = $request->header('lang');
            $user_fund_id = $request->header('id');
            Session()->put('api_lang', $lang);

          $userfunds = Fhistory::select('id', 'note_' . $lang . ' as note', 'status', 'created_at')->where('user_fund_id', $user_fund_id)->get();
            if ($userfunds!==null){
                return msgdata($request, success(), 'there is no history for this id ', $userfunds);
            }
                return msgdata($request, success(), 'userfunds history for the id ', $userfunds);

        } catch (\Exception $e) {
            return msgdata($request, failed(), '', $userfunds);
        }
    }
}
