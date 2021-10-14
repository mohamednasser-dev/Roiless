<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;
class NotificationController extends Controller
{
    public function getall(Request $request)
    {
        $notificaations = Notification::select(['id','title_ar','title_en', 'body_ar', 'body_en','image'])->get();
        return msgdata($request, success(), 'get services sucess',$notificaations);
    }
}
