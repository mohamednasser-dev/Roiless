<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\City;
use App\Models\Category;
use App\Models\Company_field;
use App\Models\Company_type;
use App\Models\Fhistory;
use App\Models\Fund;
use App\Models\investment;
use App\Models\Bank;
use App\Models\User;
use App\Models\User_fund;
use App\Models\Fund_file;
use Validator;
use Str;
use BaklySystems\PayMob\Facades\PayMob;
use App\Http\Controllers\API\PayMobController;
use App\Http\Controllers\API\FundController;
use function PHPUnit\Framework\isNull;

class HomeController extends Controller
{
    public function index()
    {
        return view('front.index');
    }

    public function funds()
    {
        $data = Fund::all();
        return view('front.funds', compact('data'));
    }
    public function investment()
    {
        $data = investment::all();
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
    public function addfund(Request $request)
    {
        $user = auth()->user();
        $data = [];
        foreach($request->dataform as $key => $value){
            $data[] = ['name' => $key,'value'=>$value];
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
            return redirect()->to(url('loan/pay/'.$user_funds->id.'/'.auth()->user()->id));
        }
    }
    public function DoPayment($id, $user_id)
    {
        $order = User_fund::find($id);
        $user = User::find($user_id);
        return view('payment.paymentMethods', compact('order', 'user'));
    }
}
