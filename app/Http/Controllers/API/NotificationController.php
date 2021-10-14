<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\User_Notification;
use Illuminate\Support\Facades\Auth;
class NotificationController extends Controller
{
    public function getall(Request $request)
    {
        //  $notificaations = Notification::select(['id','title_ar','title_en', 'body_ar', 'body_en','image'])::with()->get();
        //    $notificaations=Notification::with('user',function($q){
               
        //    })->get();
       
            $notificaations=User_Notification::where('user_id',Auth::user()->id)->with('notifications')->get();
            return msgdata($request, success(), 'get services sucess',$notificaations);
      
       
    }
}
