<?php

namespace App\Http\Controllers\API\Banko;

use App\Models\OrderInstallment;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;

class OrderController extends Controller
{
    public function my_orders(Request $request)
    {
        $user = auth()->user();
        $data = Order::with(['Product'])->where('user_id', $user->id)->get();
        return msgdata($request, failed(), 'تم عرض البيانات بنجاح', $data);
    }

    public function make_order(Request $request)
    {
        $user = auth()->user();
        $rules = [
            'product_id' => 'required|exists:products,id',
            'installment_type' => 'required|in:direct_installment,not_direct_installment',
            'benefit_id' => 'nullable|exists:product_benefits,id',
            'monthly_amount' => 'nullable',
            'price' => 'required',
            'total' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['status' => 401, 'msg' => $validator->messages()->first()]);
        } else {
            $data['user_id'] = $user->id;
            $data['product_id'] = $request->product_id;
            $data['installment_type'] = $request->installment_type;
            $data['benefit'] = $request->benefit;
            $data['monthly_amount'] = $request->monthly_amount;
            $data['price'] = $request->price;
            $data['total'] = $request->total;
            $order = Order::create($data);
            //generate order installments if direct installment
//            foreach ($dates as $row){
//
//            }
//            $installment_data['order_id'] = $order->id;
//            $installment_data['amount'] = $amount;
//            $installment_data['collection_date'] = $collection_date;
//            OrderInstallment::create($installment_data);
            //end generated installments
            return msgdata($request, success(), 'تم اضافة الطلب بنجاح', $order);
        }
    }
}
