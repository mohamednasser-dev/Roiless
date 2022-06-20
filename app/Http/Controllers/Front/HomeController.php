<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Fund;
use App\Models\City;

class HomeController extends Controller
{
    public function index()
    {
        return view('front.index');
    }

    public function funds()
    {
        $data = Fund::all();
        return view('front.investment', compact('data'));
    }

    public function getfund($id)
    {
        $data = Fund::find($id);
        $fields = explode(',', str_replace(['[', '"', ']'], '', $data->columns));
        return view('front.showinvestment', compact('data', 'fields'));
    }

    public function front_login()
    {
        if(Auth::guard('web')->check()){
            Alert::warning('تنبية', 'لا يمكن اظهار الصفحة المختاره');
            return redirect()->back();
        }
        return view('front.login');
    }

    public function store_front_login(Request $request)
    {
        if(Auth::guard('web')->check()){
            Alert::warning('تنبية', 'لا يمكن اظهار الصفحة المختاره');
            return redirect()->back();
        }
        $remeber = $request->Remember == 1 ? true : false;
        //remove first zero in phone
        $request->phone = ltrim($request->phone, "0");
        $city = City::findOrFail($request->city_id);
        $phone = $city->country_code . $request->phone;
        if (Auth::guard('web')->attempt(['phone' => $phone, 'password' => $request->password], false)) {
            //Check if active user or not
            Alert::success('تهانينا', 'تم تسجيل الدخول بنجاح');
            return redirect()->route('landing');
        } else {
            Alert::warning('خطأ', 'الهاتف او كلمة المرور خطأ , يرجى ادخال بيانات صحيحة');
            return redirect()->back();
        }
    }

    public function front_logout()
    {
        Auth::guard('web')->logout();
        Alert::success('تم', 'تم تسجيل الخروج بنجاح');
        return redirect()->back();
    }
}
