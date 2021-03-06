<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\User;
use App\Models\User_Notification;
use App\Models\Fund;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class NotificationsController extends Controller
{
    public $objectName;
    public $folderView;
    public function __construct(Notification $model)
    {
        $this->middleware('permission:notifications');
        $this->objectName = $model;
        $this->folderView = 'admin.notifications.';
    }

    public function index()
    {

        $notifications = Notification::orderBy('created_at', 'DESC')->paginate(20);
        return view($this->folderView . 'index', compact('notifications'));
    }


    public function create()
    {
        $lang=app()->getLocale();
        $funds=Fund::select('id','name_'.$lang.' as name')->get();
        $users=User::select('id','name')->get();
        return view($this->folderView . 'create',compact('funds','users'));
    }

    public function store(Request $request)
    {

        $data = $this->validate(request(),
            [
                'title_ar' => 'required',
                'title_en' => 'required',
                'body_ar' => 'required',
                'body_en' => 'required',
                'image' => '',
            ]);
            //store images
            if ($request->image != null) {
                $data['image'] = $this->MoveImage($request->image, 'uploads/notification');
            }
            unset($data['users_id']);
            $notification = Notification::create($data);
            if($request->Receive =='all')
            {
                $users= User::get();

            }elseif($request->Receive =='users')
            {
                $validated = $request->validate([
                    'users_id' => 'required',
                ]);
                $users= User::wherein('id',$request->users_id)->get();
            }
            else{
                $validated = $request->validate([
                    'funds' => 'required',
                ]);
                $fund_id=$request->funds;
                $users = User::Wherehas('UserFunds' , function ($query)use ($fund_id) {
                    $query->where('fund_id', $fund_id);
                })->get();

            }
            foreach($users as $key => $user)
            {
                User_Notification::create(['notification_id'=>$notification->id,'user_id'=>$user->id]);
                // $user->update(['seen_notification'=>DB::raw('seen_notification+1')]);
                $fcm_tokens[0] = $user->fcm_token;
                $title='title_'.$user->lang;
                $body='body_'.$user->lang;
                send_notification($notification->$title , $notification->$body ,null, $notification->image , null , $fcm_tokens);
            }

            activity('admin')->log('???? ?????????? ?????????????? ?????????? -'.$notification->title_ar);
            // Alert::success('?????? ??????????????', '???? ?????????? ?????????????? ??????????');
            return redirect()->route('notifications.index')->with('success',trans('???? ?????????? ?????????????? ??????????'));
    }
    public function destroy($id)
    {
        $notification = $this->objectName::findOrFail($id);
        $notification->delete();
        activity('admin')->log('???? ?????? ?????????????? ??????????');

        Alert::success('?????? ??????????????', '???? ?????????? ??????????');

        return redirect()->route('notifications.index');
    }
}
