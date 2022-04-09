<?php

namespace App\Http\Controllers\Admin\Banko;

use App\DataTables\AdminProductDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\SellerRequest;
use App\Models\Category;
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
        return $dataTable->with('key',$status)->render('admin.banko.product_request.index');
    }

    public function show($id)
    {
        $data = Product::findOrFail($id);
        $categories = Category::where('type', 'cat')->get();
        $benefits = ProductBenefit::where('product_id', $id)->get();
        return view('admin.banko.product_request.show', compact('data', 'benefits','categories'));
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
        return redirect()->route('admin.product.requests')->with('success', 'تم تعديل حالة المنتج بنجاح');
    }

    public function accept_product(Request $request)
    {
        $data = $this->validate(request(),
            [
                'id' => 'required|exists:products,id',
                'category_id' => 'required|exists:categories,id',
            ]);

        Product::whereId($request->id)->update(['status' => 'accepted','category_id'=>$request->category_id]);
        return redirect()->route('admin.product.requests')->with('success', 'تم قبول نشر المنتج بنجاح');
    }
    public function reject_product(Request $request)
    {
        $data = $this->validate(request(),
            [
                'id' => 'required|exists:products,id',
                'reject_reason' => 'required|string',
            ]);
        Product::whereId($request->id)->update(['status' => 'rejected','reject_reason'=>$request->reject_reason]);
        return redirect()->route('admin.product.requests')->with('success', 'تم رفض نشر المنتج وارسال سبب الرفض');
    }

}
