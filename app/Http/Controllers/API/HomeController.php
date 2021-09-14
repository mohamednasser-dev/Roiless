<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Models\Fund;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
   public function getall()
       {
         $slider=Slider::select(['id','image'])->get();
         $funds=Fund::select(['name_ar','name_en','cat_id','image'])->wherein('featured',['1'])->get();
         $data['slider']=$slider;
         $data['funds']=$funds;
         return response()->json(['data'=>$data]);
       }

}
