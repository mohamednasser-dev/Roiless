<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Investment;
use App\Models\InvestmentImages;
use App\Models\InvestmentOrder;
use App\Models\InvestmentType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Fund;
use App\Models\City;

class InvestmentController extends Controller
{

    public function investment_details($id)
    {
        if(!auth('web')->check()){
            Alert::warning('تنبية' , 'يجب تسجيل الدخول اولا');
            return redirect()->back();
        }

        $invest_types = InvestmentType::all();
        $data = Investment::find($id);
        return view('front.investment_details', compact('data', 'invest_types'));
    }

    public function store(Request $request)
    {
        if(!auth('web')->check()){
            Alert::warning('تنبية' , 'يجب تسجيل الدخول اولا');
            return redirect()->back();
        }
        $data = $this->validate(request(),
            [
                'investment_id' => 'required|exists:investments,id',
                'investment_type' => 'required',
                'amount' => 'required|string|max:255',
                'name' => 'required|string|max:255',
                'phone' => 'required|numeric',
                'address' => 'required|string|max:255',
                'profites' => 'required|min:1',
                'images' => 'required|array|min:1',
            ]);
        $user_id = auth('web')->user()->id;
        unset($data['images']);
        $data['user_id'] = $user_id;
        $investment = InvestmentOrder::create($data);
        foreach ($request['images'] as $row) {
            $image = uploadImage($row, 'Investments');
            InvestmentImages::create([
                'investment_order_id' => $investment['id'],
                'image' => $image,
            ]);
        }
        Alert::success('تمت العمليه', 'تم اضافه طلب الاستثمار بنجاح');
        return redirect()->route('landing');
    }

}
