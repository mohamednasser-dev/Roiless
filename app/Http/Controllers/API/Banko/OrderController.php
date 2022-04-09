<?php

namespace App\Http\Controllers\API\Banko;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;

class OrderController extends Controller
{
    public function my_orders(Request $request, $user_id)
    {
        $data = Order::with(['Product'])->where('user_id', $user_id)->get();
        return msgdata($request, failed(), 'تم عرض البيانات بنجاح', $data);
    }

    public function make_order(Request $request)
    {
//        $user = auth()->user();
        $rules = [
            'user_id' => 'required|exists:users,id',
            'product_id' => 'required|exists:products,id',
            'installment_type' => 'required|in:direct_installment,not_direct_installment',
            'benefit' => 'nullable',
            'monthly_amount' => 'nullable',
            'price' => 'required',
            'total' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['status' => 401, 'msg' => $validator->messages()->first()]);
        } else {
            $data['user_id'] = $request->user_id;
            $data['product_id'] = $request->product_id;
            $data['installment_type'] = $request->installment_type;
            $data['benefit'] = $request->benefit;
            $data['monthly_amount'] = $request->monthly_amount;
            $data['price'] = $request->price;
            $data['total'] = $request->total;
            $order = Order::create($data);
            return msgdata($request, success(), 'تم اضافة الطلب بنجاح', $order);
        }
    }
}
