<?php

namespace App\Http\Controllers\Seller;

use App\DataTables\OrderDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Models\Order;
use App\Models\OrderInstallment;
use App\Models\Product;
use App\Models\Seller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;


class HomeController extends Controller
{
    public function index()
    {
        return view('seller.index');
    }

    public function home(OrderDataTable $dataTable)
    {
        $seller_id = auth()->guard('seller')->user()->id ;
        $data['products'] = Product::where('seller_id',$seller_id)->count();
        $data['remain_installments'] = OrderInstallment::seller()->accepted()->where('status','pending')->count();
        $data['sum_collected_installments'] = OrderInstallment::seller()->accepted()->where('status','collected')->sum('amount');
        $data['bayed_products'] = Order::where('status','accepted')
            ->seller()->count();
        //for newest orders in home page
        $newest_orders = Order::seller()->orderBy('created_at','desc')->get()->take(5);
        return view('seller.dashboard.home',compact('data','newest_orders'));
    }

    public function change_lang(Request $request,$lang)
    {
        if (session()->has('lang')) {
            session()->forget('lang');
        }
        session()->put('lang', $lang);
        \App::setLocale($lang);
        return back();
    }
    //profile
    public function profile()
    {
        $data = Seller::findOrFail(auth()->guard('seller')->user()->id);
        return view('seller.dashboard.profile.edit',compact('data'));
    }

    public function update_profile(ProfileRequest $request, $id)
    {
        $data = $request->validated();
        // Get and Check Data
        $data = Seller::findOrfail($id);
        // Get data from request
        $inputs = $request->validated();
        // Set Password if exist inputs data
        if (!empty($request->input('password'))) {
//            $inputs['password'] = bcrypt($request->input('password'));
        } else {
            unset($inputs['password']);
        }
        $data->update($inputs);
        return redirect()->back()->with('success', 'تم تعديل الملف الشخصي بنجاح');
    }
}
