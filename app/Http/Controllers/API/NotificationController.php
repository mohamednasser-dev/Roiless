<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\User;
use App\Models\User_Notification;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function getall(Request $request)
    {

        //  $notificaations = Notification::select(['id','title_ar','title_en', 'body_ar', 'body_en','image'])::with()->get();
        //    $notificaations=Notification::with('user',function($q){
        //    })->get();
        $id=Auth::user()->id;
        $notificaations=User_Notification::where('user_id',$id)->with('notifications')->orderBy('created_at','Desc')->get();
        $user=User::findorfail($id);
        User_Notification::where('user_id',$id)->update([
            'seen'=>1
        ]);
         return msgdata($request, success(), 'get services sucess',$notificaations);
    }
}
