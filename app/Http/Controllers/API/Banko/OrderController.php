<?php

namespace App\Http\Controllers\API\Banko;

use App\Models\OrderInstallment;
use App\Models\ProductBenefit;
use Carbon\Carbon;
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

    public function calculate_installment(Request $request)
    {
        $user = auth()->user();
        $rules = [
            'product_id' => 'required|exists:products,id',
            'product_benefit_id' => 'nullable|exists:product_benefits,id',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['status' => 401, 'msg' => $validator->messages()->first()]);
        } else {
            //generate installment amounts
            $product = Product::find($request->product_id);
            $product_benefit_id = ProductBenefit::find($request->product_benefit_id);
            $ratio = $product_benefit_id->ratio / 100;
            $added_price = $product->price * $ratio;
            $data['basic_price'] = $product->price;
            $total_price = $product->price + $added_price;
            $data['added_price'] = $added_price;
            $data['total_price'] = $total_price;
            $data['months_count'] = $product_benefit_id->Benefit->months_count;
            $data['month_amount'] = $total_price / $product_benefit_id->Benefit->months_count;
            return msgdata($request, success(), 'تم اظهار الاقساط ', $data);
        }
    }

    public function make_order(Request $request)
    {
        $user = auth()->user();
        $rules = [
            'product_id' => 'required|exists:products,id',
            'product_benefit_id' => 'nullable|exists:product_benefits,id',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['status' => 401, 'msg' => $validator->messages()->first()]);
        } else {
            $product = Product::find($request->product_id);
            $product_benefit_id = ProductBenefit::find($request->product_benefit_id);
            if ($product->type == 'direct_installment') {
                if($request->product_benefit_id == null){
                    return msgdata($request, failed(), 'يجب اختيار فائدة اولا -  product_benefit_id ', (object)[]);
                }
                //generate installment amounts
                $benefit = $product_benefit_id->ratio;
                $ratio = $product_benefit_id->ratio / 100;
                $added_price = $product->price * $ratio;
                $price = $product->price;
                $total_price = $product->price + $added_price;
                $months_count = $product_benefit_id->Benefit->months_count;
                $month_amount = $total_price / $product_benefit_id->Benefit->months_count;

            } else {
                $benefit = null;
                $months_count = 0;
                $price = $product->price ;
                $total_price = $product->price ;
                $month_amount = $product->price;
            }


            $data['user_id'] = $user->id;
            $data['product_id'] = $request->product_id;
            $data['installment_type'] = $product->type;
            $data['benefit'] = $benefit;
            $data['months_count'] = $months_count;
            $data['monthly_amount'] = $month_amount;
            $data['price'] = $price;
            $data['total'] = $total_price;
            $data['status'] = 'pending';
            $order = Order::create($data);

            //generate order installments if direct installment
                $today = Carbon::now();
                for ($i = 0; $i < $months_count; $i++) {
                    $order_installment_data['order_id'] = $order->id;
                    $order_installment_data['amount'] = $month_amount;
                    $order_installment_data['collection_date'] = $today;
                    OrderInstallment::create($order_installment_data);
                    //increase by month
                    $today  = $today->addMonth();
                }
            //end generated installments
            return msgdata($request, success(), 'تم اضافة الطلب بنجاح', $order);
        }
    }


}
