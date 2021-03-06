<?php

namespace App\Http\Controllers\API\Banko;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Fund;
use App\Models\Investment;
use App\Models\Product;
use App\Models\Seller;
use App\Models\Section;
use App\Models\Slider;
use App\Models\User_Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    public function home(Request $request)
    {
        $data['categories'] = Section::where('parent_id',null)->with(['Child','Products'])->get();
        $data['sliders'] = Slider::where('city_id',$request->header('city_id'))->get();
        $data['funds'] = Fund::with(['Category'])->where('featured','1')->where('deleted','0')->get();
        $data['stars_products'] = Product::with(['Seller','Section','SubSection'])->where('status','accepted')->where('stars',1)->get();
        return msgdata($request, success(), 'تم عرض البيانات', $data);
    }
    public function funds(Request $request)
    {
        $data['funds'] = Fund::where('featured','1')->where('deleted','0')->get();
        return msgdata($request, success(), 'تم عرض البيانات', $data);
    }
    public function slider(Request $request)
    {
        $data['sliders'] = Slider::get();
        return msgdata($request, success(), 'تم عرض البيانات', $data);
    }
    public function investment(Request $request)
    {
        $data['investment'] = Investment::all();
        return msgdata($request, success(), 'تم عرض البيانات', $data);
    }
    public function products_cat(Request $request)
    {
//        ,'Products'
        $data = Section::where('parent_id',null)->with(['Child'])->get();
        return msgdata($request, success(), 'تم عرض البيانات', $data);
    }
    public function category_child(Request $request,$id)
    {
        $data  = Section::find($id)->Child;
        return msgdata($request, success(), 'تم عرض البيانات', $data);
    }
    public function cat_pro(Request $request)
    {
        $result = Product::where('status','accepted')->when(request('section_id'), function ($q) {
                return $q->where('section_id', request('section_id'));
            })
            ->when(request('sub_section_id'), function ($q) {
            return $q->where('sub_section_id', request('sub_section_id'));
        })->with('SellerInfo')->paginate(15);
        $result = (ProductResource::collection($result))->response()->getData(true);
        return msgdata($request, success(), 'تم عرض البيانات', $result);
    }
    public function seller_products(Request $request,$id)
    {
        $result = Product::where('status','accepted')->where('seller_id',$id)->with('SellerInfo')->inRandomOrder()->take(10)->get();
        $result = (ProductResource::collection($result));
        return msgdata($request, success(), 'تم عرض البيانات', $result);
    }
    public function f_details(Request $request,$id)
    {
        $data['funds'] = Fund::find($id);
        return msgdata($request, success(), 'تم عرض البيانات', $data);
    }
    public function i_details(Request $request,$id)
    {
        $data['funds'] = Investment::find($id);
        return msgdata($request, success(), 'تم عرض البيانات', $data);
    }
}
