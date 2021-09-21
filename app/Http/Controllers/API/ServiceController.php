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
        $lang = $request->header('lang');
        if(empty($lang))
        {
            $lang="ar";
        }
        $Services = Services::select(['title_'.$lang.' as title', 'image'])->get();
        $data = $Services;
        return msgdata($request, success(), 'get services sucess',$Services);
        
    }

    public function getservicedetailes(Request $request, $id)
    {
        $lang = $request->header('lang');
        if(empty($lang))
        {
            $lang="ar";
        }
        $service_detailes = Service_details::select(['title_'.$lang.' as title','desc_'.$lang.' as desc'])->find($id);
        unset($service_detailes['created_at'], $service_detailes['updated_at']);
        return msgdata($request, success(), 'get services detailes success',$service_detailes);
        
    }

}
