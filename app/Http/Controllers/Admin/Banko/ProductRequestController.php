<?php

namespace App\Http\Controllers\Admin\Banko;

use App\DataTables\AdminProductDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\SellerRequest;
use App\Models\Category;
use App\Models\Fund;
use App\Models\Product;
use App\Models\ProductBenefit;
use App\Models\Seller;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Traits\offerTrait;
use Str;
use RealRashid\SweetAlert\Facades\Alert;

class ProductRequestController extends Controller
{

    use offerTrait;

    public function index(AdminProductDataTable $dataTable,$status)
    {
//        return $dataTable->with('key',$status)->render('admin.banko.product_request.index');

        $data = Product::where('status',$status)->get();
        return view('admin.banko.product_request.index',compact('data'));
    }

    public function show($id)
    {
        $data = Product::findOrFail($id);
        $funds = Fund::where('appearance', '1')->where('deleted', '0')->get();
        $benefits = ProductBenefit::where('product_id', $id)->get();
        return view('admin.banko.product_request.show', compact('data', 'benefits','funds'));
    }
    public function make_star($id,$stars)
    {
        $data = Product::findOrFail($id);
        $data->stars = $stars;
        $data->save();

        return redirect()->back()->with('success','تم تعديل حالة الظهور في الصفحة الرئيسية بنجاح');
    }

    public function change_status($status, $id)
    {
        Product::whereId($id)->update(['status' => $status]);
        return redirect()->route('admin.product.requests','pending')->with('success', 'تم تعديل حالة المنتج بنجاح');
    }

    public function accept_product(Request $request)
    {
        $data = $this->validate(request(),
            [
                'id' => 'required|exists:products,id',
                'fund_id' => 'required|exists:funds,id',
            ]);

        Product::whereId($request->id)->update(['status' => 'accepted','fund_id'=>$request->fund_id]);
        return redirect()->route('admin.product.requests','pending')->with('success', 'تم قبول نشر المنتج بنجاح');
    }
    public function reject_product(Request $request)
    {
        $data = $this->validate(request(),
            [
                'id' => 'required|exists:products,id',
                'reject_reason' => 'required|string',
            ]);
        Product::whereId($request->id)->update(['status' => 'rejected','reject_reason'=>$request->reject_reason]);
        return redirect()->route('admin.product.requests','pending')->with('success', 'تم رفض نشر المنتج وارسال سبب الرفض');
    }

}
