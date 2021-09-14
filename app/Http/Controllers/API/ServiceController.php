<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Services;
use App\Models\Service_details;

use Illuminate\Http\Request;

class ServiceController extends Controller
{

    public function getallservices()
    {
        $Services = Services::select(['title_ar', 'title_en', 'image'])->get();
        $data = $Services;
        return response()->json(['data' => $data]);
    }

    public function getservicedetailes($id)
    {
        $service_detailes = Service_details::find($id);
        unset($service_detailes['created_at'], $service_detailes['updated_at']);
        return response()->json(["service_detailes" => $service_detailes]);
    }

}
