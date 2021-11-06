<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\common_question;
use App\Models\Services;
use App\Models\Service_details;

use Illuminate\Http\Request;

class QuestionsController extends Controller
{
    public function index(Request $request)
    {
        $Services = common_question::select('id','question_ar','question_en')->get();
        return msgdata($request, success(), 'get services sucess',$Services);
    }
    public function detailes(Request $request, $id)
    {
        $service_detailes = common_question::select(['question_ar','question_en','answer_ar','answer_en'])->find($id);
        return msgdata($request, success(), 'get services detailes success',$service_detailes);
    }
}
