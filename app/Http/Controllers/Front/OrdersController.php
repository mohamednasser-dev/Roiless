<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Consolution;
use App\Models\InvestmentOrder;
use App\Models\Order;
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

class OrdersController extends Controller
{
    public function my_funds()
    {
        $user_id = auth('web')->user()->id;
        $result = User_fund::where('user_id', $user_id)->with('Fund_details')->with('Users')->orderby('created_at', 'DESC')->get()
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
        return view('front.orders.my_funds', compact('result'));
    }

    public function fund_detail($id)
    {
        $user_id = auth('web')->user()->id;
        $data = User_fund::where('id', $id)->with('Fund')->first();
        $history = Fhistory::select('id', 'note_ar', 'note_en', 'status', 'created_at')->where('show_in', 'app')->where('user_fund_id', $id)->orderBy('created_at', 'asc')->get();
        return view('front.orders.fund_detail', compact('data', 'history'));
    }

    public function my_investments()
    {
        $user_id = auth('web')->user()->id;
        $result = InvestmentOrder::with('Investments')->where('user_id', $user_id)->orderBy('created_at','desc')->get();
        return view('front.orders.my_investments', compact('result'));
    }
    public function my_orders()
    {
        $user_id = auth('web')->user()->id;
        $result = Order::where('user_id', $user_id)->orderBy('created_at','desc')->paginate(25);
        return view('front.orders.my_orders', compact('result'));
    }
    public function order_details($id)
    {
        $user_id = auth('web')->user()->id;
        $row = Order::whereId($id)->where('user_id',$user_id)->first();
        return view('front.orders.order_details', compact('row'));
    }
    public function investment_details($id)
    {
        $data = InvestmentOrder::with('Investments')->where('id', $id)->first();
        return view('front.orders.investment_details', compact('data'));
    }

}
