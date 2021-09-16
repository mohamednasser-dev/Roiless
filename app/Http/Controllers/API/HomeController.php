<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\Slider;
use App\Models\Fund;
use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    //
    public function getall()
    {
        $slider = Slider::select(['id', 'image'])->get();
        $funds = Fund::select(['name_ar', 'name_en', 'cat_id', 'image'])->wherein('featured', ['1'])->get();
        $data['slider'] = $slider;
        $data['funds'] = $funds;
        return response()->json(['data' => $data]);
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
                $aboutUS = Setting::select('about_us_' . $request->header('lang'))->get();
                return msgdata($request, success(), 'success_data', array('about_us' => $aboutUS));
            }
        }
    }
}
