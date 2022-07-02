<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Benefit;
use App\Models\InvestmentImages;
use App\Models\InvestmentOrder;
use App\Models\Order;
use App\Models\OrderInstallment;
use App\Models\Product;
use App\Models\ProductBenefit;
use App\Models\Section;
use Carbon\Carbon;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Validator;
use Str;

class ProductController extends Controller
{
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
        $data = Product::where('status', 'accepted')->where('sub_section_id', $id)->with('SellerInfo')->paginate(15);
        return view('front.products.section_products', compact('data'));
    }

    public function product_details($id)
    {
        $data = Product::find($id);
        $related_products = Product::where('id', '!=', $data->id)->where('seller_id', $data->seller_id)->paginate(20);
        $benefits = Benefit::all();
        return view('front.products.product_details', compact('data', 'related_products', 'benefits'));
    }

    public function benefit_calculate(Request $request)
    {
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
        return response(['status' => true, 'data' => $data]);
    }

    public function order_create(Request $request)
    {
        if (!auth('web')->check()) {
            Alert::warning('تنبية', 'يجب تسجيل الدخول اولا');
            return redirect()->back();
        }
        $data = $this->validate(request(),
            [
                'product_id' => 'required|exists:products,id',
                'product_benefit_id' => 'nullable|exists:product_benefits,id',
            ]);
        $user_id = auth('web')->user()->id;
        $product = Product::find($request->product_id);
        $product_benefit_id = ProductBenefit::find($request->product_benefit_id);
        if ($product->type == 'direct_installment') {
            if ($request->product_benefit_id == null) {
                Alert::warning('تنبية', 'يجب اختيار فائدة اولا -  product_benefit_id ');
                return redirect()->route('landing');
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
            $price = $product->price;
            $total_price = $product->price;
            $month_amount = $product->price;
        }
        $data_added['user_id'] = $user_id;
        $data_added['product_id'] = $request->product_id;
        $data_added['installment_type'] = $product->type;
        $data_added['benefit'] = $benefit;
        $data_added['months_count'] = $months_count;
        $data_added['monthly_amount'] = $month_amount;
        $data_added['price'] = $price;
        $data_added['total'] = $total_price;
        $data_added['status'] = 'pending';
        $order = Order::create($data_added);
        //generate order installments if direct installment
        $today = Carbon::now();
        for ($i = 0; $i < $months_count; $i++) {
            $order_installment_data['order_id'] = $order->id;
            $order_installment_data['amount'] = $month_amount;
            $order_installment_data['collection_date'] = $today;
            OrderInstallment::create($order_installment_data);
            //increase by month
            $today = $today->addMonth();
        }
        //end generated installments
        Alert::success('تمت العمليه', 'تم تقديم الطلب بنجاح');
        return redirect()->route('landing');
    }

}
