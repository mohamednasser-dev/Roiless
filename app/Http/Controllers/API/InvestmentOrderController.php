<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Investment;
use App\Models\InvestmentImages;
use App\Models\InvestmentOrder;
use App\Models\InvestmentType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InvestmentOrderController extends Controller
{
    public function allInvestments(Request $request)
    {
        $data = Investment::all();
        return msgdata($request, success(), 'All Investments Success', $data);
    }

    public function OrderInvestment(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'investment_id' => 'required|exists:investments,id',
            'investment_type' => 'required',
            'amount' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'phone' => 'required|numeric',
            'address' => 'required|string|max:255',
            'profites' => 'required|min:1',
            'images' => 'required|array|min:1',
        ]);
        if ($validator->fails()) {
            return msgdata($request, failed(), $validator->messages()->first(), (object)[]);
        }
        $user_id = auth()->user()->id;
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

        return msgdata($request, success(), 'data Created Successfully', $data);

    }

    public function user_investments(Request $request)
    {
        $data = InvestmentOrder::with('Investments')->where('user_id', auth()->user()->id)->get();
        return msgdata($request, success(), 'your investments', $data);
    }
    public function make_calculation(Request $request)
    {
        $invest = Investment::findOrFail($request->investment_id);
        $value = $invest->value;
        $data['result'] = 100;
        return msgdata($request, success(), 'your investments', $data);
    }
    public function types(Request $request)
    {
        $invest = InvestmentType::all();
        return msgdata($request, success(), 'your investments', $invest);
    }
}
