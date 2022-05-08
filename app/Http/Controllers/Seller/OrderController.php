<?php

namespace App\Http\Controllers\Seller;

use App\DataTables\OrderDataTable;
use App\DataTables\ProductDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Benefit;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductBenefit;
use App\Models\ProductImage;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use RealRashid\SweetAlert\Facades\Alert;
use App\Traits\offerTrait;

class OrderController extends Controller
{
    protected $viewPath = 'dashboard.orders';
    protected $path = 'orders';
    private $route = 'seller.orders';
    private $image_path = 'orders';
    protected $paginate = 30;
    use offerTrait;

    public function index()
    {
        $data = Order::seller()->paginate(20);
        return view('seller.' . $this->viewPath . '.index',compact('data'));
    }


    public function change_status($status, $id)
    {
        Order::whereId($id)->update(['status' => $status]);
        return redirect()->back()->with('success', 'تم تعديل حالة الطلب بنجاح');
    }


    public function show($id)
    {
        $data = Product::findOrFail($id);
        $benefits = ProductBenefit::where('product_id', $id)->get();
        return view('seller.' . $this->viewPath . '.show', compact('data', 'benefits'));
    }

}
