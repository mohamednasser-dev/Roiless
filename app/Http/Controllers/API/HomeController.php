<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\City;
use App\Models\Setting;
use App\Models\Slider;
use App\Models\User_Notification;
use App\Models\Fund;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    //
    public function getall(Request $request)
    {
        $lang = $request->header('lang');
        if (empty($lang)) {
            $lang = "ar";
        }
        $id = AUth::user()->id;
        $funds = Fund::select(['id', 'name_ar', 'name_en', 'desc_ar', 'desc_en', 'cat_id', 'image'])
            ->where('featured', '1')->where('appearance', '1')->where('deleted', '0')->get();
        $data['funds'] = $funds;
        $seen = User_Notification::select('seen')->where('user_id', $id)->where('seen', 0)->count();
        $data['unseen'] = $seen;
        return msgdata($request, success(), 'update_profile_success', $data);
    }

    public function updatePassword(Request $request)
    {
        $rules = [
            'password_old' => 'required',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
        ];
        $validator = \Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['status' => 401, 'msg' => $validator->messages()->first()]);
        } else {
            $user = User::where('id', \Auth::user()->id)->first();
            if (Hash::check($request->password_old, $user->password)) {
                $user = User::where('id', \Auth::user()->id)->update(['password' => bcrypt($request->password)]);
                return response()->json(msg($request, success(), 'Updated_Successfully'));
            } else {
                return response()->json(msg($request, failed(), 'wrong_old_password'));
            }
        }
    }

    public function aboutUs(Request $request)
    {
        $lang = $request->header('lang');
        if (!$lang) {
            return response()->json(msg($request, failed(), 'Lang_field_required'));
        } else {
            if (\Auth::check()) {
                $setting = Setting::select('about_us_' . $request->header('lang') . ' as about')->find(1);
                return msgdata($request, success(), 'success_data', $setting);
            }
        }
    }

    public function cities(Request $request)
    {
        $data = City::get();
        return msgdata($request, success(), 'data shown successfully', $data);
    }
}
