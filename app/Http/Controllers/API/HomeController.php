<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Models\funde;
use App\Models\Services;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
   public function getall()
       {
         $slider=Slider::select(['id','image'])->get();
         $service=Services::select(['id','title_ar','title_en','image'])->get();
         $data['slider']=$slider;
         $data['service']=$service;
        // $funds=Slider::select()->where();
         return response()->json(['data'=>$data]);
       }

}
