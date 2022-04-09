<?php

namespace App\Http\Controllers\API\Banko;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Fund;

use App\Models\Product;
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
        $data['sliders'] = Slider::get();
        $data['funds'] = Fund::with(['Category'])->where('featured','1')->where('deleted','0')->get();
        $data['stars_products'] = Product::with(['Seller','Section','SubSection'])->where('status','accepted')->where('stars',1)->get();
        return msgdata($request, success(), 'تم عرض البيانات', $data);
    }
}
