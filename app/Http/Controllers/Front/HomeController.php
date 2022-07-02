<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Consolution;
use App\Models\Product;
use App\Models\Section;
use App\Models\Service_details;
use App\Models\Services;
use App\Models\Setting;
use App\Models\SettingInfo;
use Ghanem\LaravelSmsmisr\Facades\Smsmisr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\City;
use App\Models\Fhistory;
use App\Models\Fund;
use App\Models\Investment;
use App\Models\Bank;
use App\Models\User;
use App\Models\User_fund;
use App\Models\Fund_file;
use Validator;
use Str;
use Teckwei1993\Otp\Otp;
use Teckwei1993\Otp\Rules\OtpValidate;

class HomeController extends Controller
{
    public function index()
    {
        return view('front.index');
    }

    public function section_child($id)
    {
        $data = Section::where('parent_id', $id)->get();
        if (count($data) == 0) {
            $data = Product::where('status', 'accepted')->where('section_id', $id)->with('SellerInfo')->paginate(15);
            return view('front.products.section_products', compact('data'));
        }
        return view('front.products.section_child', compact('data'));
    }

    public function section_products($id)
    {
        $data = Product::where('status', 'accepted')->where('sub_section_id', $id)->with('SellerInfo')->paginate(1);
        return view('front.products.section_products', compact('data'));
    }

    public function profile()
    {
        if (!auth('web')->check()) {
            Alert::warning('تنبية', 'يجب تسجيل الدخول اولا');
            return redirect()->route('landing');
        }
        $id = auth()->user()->id;
        $data = User::findOrFail($id);
        return view('front.profile', compact('data'));
    }

    public function services()
    {
        $data = Services::get();
        return view('front.services', compact('data'));
    }

    public function service_details($id)
    {
        $data = Services::findOrFail($id);
        $service_detailes = Service_details::where('service_id', $id)->first();
        unset($service_detailes['created_at'], $service_detailes['updated_at']);
        return view('front.service_details', compact('data', 'service_detailes'));
    }

    public function about_us()
    {
        $data = Setting::findOrFail(1);
        return view('front.about_us', compact('data'));
    }

    public function contact()
    {
        $phones = SettingInfo::where('type', 'phone')->get();
        $addresses = SettingInfo::where('type', 'address')->get();
        return view('front.contact', compact('addresses', 'phones'));
    }

    public function contact_store(Request $request)
    {
        if (!auth('web')->check()) {
            Alert::warning('تنبية', 'يجب تسجيل الدخول اولا');
            return redirect()->route('landing');
        }
        $user = auth()->user();
        $data = $request->all();
        $rules = [
            'full_name' => 'required|max:255',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'content' => 'required|max:255',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['status' => 401, 'msg' => $validator->messages()->first()]);
        } else {
            $data['user_id'] = $user->id;
            $data['type'] = 'contact_us';
            $data['country'] = 'egypt';

            $inbox = Consolution::create($data);
            Alert::success('تم', 'تم ارسال الرسالة بنجاح');
            return redirect()->route('landing');
        }
    }

    public function update_profile(Request $request)
    {
        if (!auth('web')->check()) {
            Alert::warning('تنبية', 'يجب تسجيل الدخول اولا');
            return redirect()->route('landing');
        }
        $user = auth()->user();
        //remove first zero in phone
        $request->phone = ltrim($request->phone, "0");
        $city = City::findOrFail($request->city_id);
        $user_phone = $request->phone;
        $basic_phone = $city->country_code . $request->phone;
        $request->phone = $basic_phone;
        //check phone change
        $data = $this->validate(request(),
            [
                'name' => 'required|regex:/^[\pL\s\-]+$/u',
                'email' => 'required|email|unique:users,email,' . $user->id,
                'phone' => 'required|unique:users,phone,' . $user->id,
                'city_id' => 'required|exists:cities,id'
            ]);
        //check phone change
        if ($request->phone == auth('web')->user()->phone) {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'city_id' => $request->city_id
            ]);
        } else {
            $otb = \Otp::generate($request->phone);
            $user->update([
                'otp_code' => $otb,
            ]);
            //send here by sms api ...
            if (empty($request->otp_code)) {
                if (env('production')) {
                    Smsmisr::send("كود التفعيل الخاص بك هوا " . $otb, $request->phone, null, 2);
                }
                $data['status'] = true;
                $data['otp_code'] = $otb;
                $data['phone'] = $user_phone;
                Alert::success('عملية ناجحه', 'تم ارسال كود التحقق بنجاح');
                return view('front.otp_verify', compact('data'));
            }
        }
        alert::success('عملية ناجحه', 'تم تحديث الملف الشخصي بنجاح');
        return redirect()->route('landing');
    }

    public function code_verify(Request $request)
    {
        if (!auth('web')->check()) {
            Alert::warning('تنبية', 'يجب تسجيل الدخول اولا');
            return redirect()->route('landing');
        }
        $user = auth()->user();
        //remove first zero in phone
        $request->phone = ltrim($request->phone, "0");
        $city = City::findOrFail($request->city_id);
        $user_phone = $request->phone;
        $basic_phone = $city->country_code . $request->phone;
        $request->phone = $basic_phone;
        //check phone change
        $data = $this->validate(request(),
            [
                'name' => 'required|regex:/^[\pL\s\-]+$/u',
                'email' => 'required|email|unique:users,email,' . $user->id,
                'phone' => 'required|unique:users,phone,' . $user->id,
                'city_id' => 'required|exists:cities,id',
                'otp_code' => 'required|numeric',
            ]);
        $validated_otp = \Otp::validate($request->phone, $request->otp_code);
        if ($validated_otp->status == true) {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'user_phone' => $user_phone,
                'phone' => $request->phone,
                'city_id' => $request->city_id,
                'otp_code' => null,
            ]);
        } else {
            Alert::warning('تنبية', 'كود التفعيل خطأ');
            $data['phone'] = $user_phone;
            $otb = $request->otp_code;
            return view('front.otp_verify', compact('data'));
        }
        alert::success('عملية ناجحه', 'تم تحديث الملف الشخصي بنجاح');
        return redirect()->route('landing');

    }


    public function funds()
    {
        $data = Fund::all();
        return view('front.funds', compact('data'));
    }


    public function investment()
    {
        $data = Investment::all();
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
        if (Auth::guard('web')->check()) {
            Alert::warning('تنبية', 'لا يمكن اظهار الصفحة المختاره');
            return redirect()->route('landing');
        }
        return view('front.login');
    }

    public function store_front_login(Request $request)
    {
        if (Auth::guard('web')->check()) {
            Alert::warning('تنبية', 'لا يمكن اظهار الصفحة المختاره');
            return redirect()->route('landing');
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

    public function addfund(Request $request)
    {
        $user = auth()->user();
        $data = [];
        foreach ($request->dataform as $key => $value) {
            $data[] = ['name' => $key, 'value' => $value];
        }
        $myJSON = json_encode($request->dataform);
        $rules = [
            'fund_id' => 'required',
            'dataform' => 'required',
            'file' => '',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['status' => 401, 'msg' => $validator->messages()->first()]);
        } else {
            $fund = Fund::find($request->fund_id);
            $user_fund_data['fund_amount'] = $fund->cost;
            $user_fund_data['dataform'] = json_encode($data);
            $user_fund_data['fund_id'] = $request->fund_id;
            $user_fund_data['user_id'] = $user->id;
            foreach ($data as $row) {
                if ($row['name'] == 'fund_amount') {
                    $user_fund_data['cost'] = $row['value'];
                } elseif ($row['name'] == 'Required_fund_amount') {
                    $user_fund_data['cost'] = $row['value'];
                } elseif ($row['name'] == 'property_financed') {
                    $user_fund_data['cost'] = $row['value'];
                } elseif ($row['name'] == 'car_financed') {
                    $user_fund_data['cost'] = $row['value'];
                }
            }
            $user_funds = User_fund::create($user_fund_data);
            $history_data['user_fund_id'] = $user_funds->id;
            $history_data['type'] = 'user';
            $history_data['show_in'] = 'web';
            $history_data['status'] = 'pending';
            $history_data['user_id'] = auth()->user()->id;
            $history_data['note_ar'] = ' بدايه التمويل';
            $history_data['note_en'] = 'Starting Fund Request';
            Fhistory::create($history_data);
            $history_app_data['user_fund_id'] = $user_funds->id;
            $history_app_data['type'] = 'user';
            $history_app_data['show_in'] = 'app';
            $history_app_data['status'] = 'pending';
            $history_app_data['user_id'] = auth()->user()->id;
            $history_app_data['note_ar'] = ' بدايه التمويل';
            $history_app_data['note_en'] = 'Starting Fund Request';
            Fhistory::create($history_app_data);
            if ($request->file != null) {
                foreach ($request->file as $key => $row) {
                    // This is Image Information ...
                    $file = $row;
                    $ext = $file->getClientOriginalExtension();
                    $size = $file->getSize();
                    // Move Image To Folder ..
                    $fileNewName = 'file' . $size . '_' . time() . '.' . $ext;
                    $file->move(public_path('uploads/fund_file'), $fileNewName);
                    $file_data['user_fund_id'] = $user_funds->id;
                    $file_data['file_ext'] = $ext;
                    $file_data['file_name'] = $fileNewName;
                    Fund_file::create($file_data);
                }
            }
            return redirect()->to(url('loan/pay/' . $user_funds->id . '/' . auth()->user()->id));
        }
    }


    public function DoPayment($id, $user_id)
    {
        $order = User_fund::find($id);
        $user = User::find($user_id);
        return view('payment.paymentMethods', compact('order', 'user'));
    }

    // change_password
    public function change_password()
    {
        return view('front.change_password');
    }

    public function generate_otp_password()
    {
        $phone = auth('web')->user()->phone;
        $otb = \Otp::generate($phone);
        //send here by sms api ...
        if (env('production')) {
            Smsmisr::send("كود التفعيل الخاص بك هوا " . $otb, $phone, null, 2);
        }
//        Alert::success('عملية ناجحه', 'تم ارسال كود التحقق بنجاح');
        return view('front.otp_password', compact('otb'));
    }

    public function password_code_verify(Request $request)
    {
        if (!auth('web')->check()) {
            Alert::warning('تنبية', 'يجب تسجيل الدخول اولا');
            return redirect()->route('landing');
        }
        $user = auth()->user();
        $data = $this->validate(request(),
            [
                'otp_code' => 'required|numeric',
            ]);
        $validated_otp = \Otp::validate($user->phone, $request->otp_code);
        if ($validated_otp->status == true) {
            alert::success('عملية ناجحه', 'تم التحقق من الكود بنجاح');
            return redirect()->route('front.profile.password_page');
        } else {
            alert::warning('خطأ', 'كود التحقق غير صحيح');
            return redirect()->back();
        }
    }

    public function password_page()
    {
        return view('front.change_password');
    }

    public function update_password(Request $request)
    {
        if (!auth('web')->check()) {
            Alert::warning('تنبية', 'يجب تسجيل الدخول اولا');
            return redirect()->route('landing');
        }
        $user = auth()->user();
        $rules = [
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['status' => 401, 'msg' => $validator->messages()->first()]);
        }
        $user->update(['password' => Hash::make($request->password)]);
        $data['status'] = true;
        alert::success('عملية ناجحه', 'تم تحديث رقم المرور بنجاح');
        return redirect()->route('landing');

    }

}
