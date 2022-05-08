<?php

namespace App\Http\Controllers\Seller;

use App\DataTables\OrderDataTable;
use App\DataTables\ProductDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Benefit;
use App\Models\Order;
use App\Models\OrderInstallment;
use App\Models\Product;
use App\Models\ProductBenefit;
use App\Models\ProductImage;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use RealRashid\SweetAlert\Facades\Alert;
use App\Traits\offerTrait;

class InstallmentController extends Controller
{
    protected $viewPath = 'dashboard.installments';
    protected $path = 'installments';
    private $route = 'seller.installments';
    private $image_path = 'installments';
    protected $paginate = 30;
    use offerTrait;

    public function index($status)
    {
        $data = OrderInstallment::seller()->accepted()->where('status',$status)->orderBy('collection_date','asc')->paginate(20);
        return view('seller.' . $this->viewPath . '.index',compact('data'));
    }

    public function change_status($status, $id)
    {
        OrderInstallment::whereId($id)->update(['status' => $status]);
        if($status == 'pending'){
            return redirect()->back()->with('success', 'تم ارجاع المبلغ للتقسيط مره اخرى ');
        }else{
            return redirect()->back()->with('success', 'تم تحصيل المبلغ بنجاح');
        }
    }

}
