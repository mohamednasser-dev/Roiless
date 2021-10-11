<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;
class NotificationController extends Controller
{
    //
    public function getall(Request $request)
    {
        $lang = $request->header('lang');
        if(empty($lang))
        {
            $lang="ar";
        }
        $notificaations = Notification::select(['id','title_'.$lang.' as title', 'body_'.$lang.' as body','image'])->get();
        return msgdata($request, success(), 'get services sucess',$notificaations);
    }
}