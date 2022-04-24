<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Services;
use App\Models\Service_details;

use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function getallservices(Request $request)
    {
        $Services = Services::select(['id','title_ar','title_en', 'image'])->with('Services')->get();
        return msgdata($request, success(), 'get services sucess',$Services);
    }
    public function getservicedetailes(Request $request, $id)
    {
        $service_detailes = Service_details::select(['title_ar','title_en','desc_ar','desc_en'])->where('service_id',$id)->first();
        unset($service_detailes['created_at'], $service_detailes['updated_at']);
        return msgdata($request, success(), 'get services detailes success',$service_detailes);
    }
}
