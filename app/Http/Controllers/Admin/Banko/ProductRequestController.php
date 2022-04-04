<?php

namespace App\Http\Controllers\Admin\Banko;

use App\DataTables\AdminProductDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\SellerRequest;
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

    public function index(AdminProductDataTable $dataTable)
    {
        return $dataTable->render('admin.banko.product_request.index');
    }

    public function show($id)
    {
        $data = Product::findOrFail($id);
        $benefits = ProductBenefit::where('product_id', $id)->get();
        return view('admin.banko.product_request.show', compact('data', 'benefits'));
    }

    public function change_status($status, $id)
    {
        Product::whereId($id)->update(['status' => $status]);
        return redirect()->route('admin.product.requests')->with('success', 'تم تعديل حالة المنتج بنجاح');
    }

}
