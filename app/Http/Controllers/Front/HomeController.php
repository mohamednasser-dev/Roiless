<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Investment;
use App\Models\Fund;
use App\Models\InvestmentImages;
use App\Models\InvestmentOrder;
use App\Models\InvestmentType;

class HomeController extends Controller
{
    public function index()
    {
        return view('front.index');
    }
    public function funds()
    {
        $data = Fund::all();
        return view('front.investment',compact('data'));
    }
    public function getfund($id)
    {
        $data = Fund::find($id);
        $fields = explode(',',str_replace(['[','"',']'],'',$data->columns));
        return view('front.showinvestment',compact('data','fields'));
    }
}
