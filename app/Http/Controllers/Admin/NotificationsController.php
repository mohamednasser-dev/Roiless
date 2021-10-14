<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\User;
use App\Models\User_Notification;
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

        $notifications = Notification::get();
        return view($this->folderView . 'index', compact('notifications'));
    }


    public function create()
    {
        $users=User::select('id','name')->get();
        return view($this->folderView . 'create',compact('users'));
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
                'users_id'=>'required',
            ]);
            //store images
            if ($request->image != null) {
                $data['image'] = $this->MoveImage($request->image, 'uploads/notification');
            }
            unset($data['users_id']);
            $notification = Notification::create($data);
            $users= User::wherein('id',$request->users_id)->get();
//            $title='title_ar'.$user->lang;
//            $body='body_ar'.$user->lang;
            foreach($users as $key => $user)
            {
                User_Notification::create(['notification_id'=>$notification->id,'user_id'=>$user->id]);
                $fcm_tokens[$key] = $user->fcm_token;
            }
            $notification = send_notification($notification->title_ar , $notification->body_ar , $notification->image , null , $fcm_tokens);
            activity('admin')->log('تم اضافه الاشعار بنجاح اسمة'.$notification->title_ar);
            Alert::success('تمت العمليه', 'تم اضافه الاشعار بنجاح');
            return redirect()->route('notifications.index');
    }
    // send notification and insert it in database
    public function send(Request $request){
        $notification = new Notification();
        if($request->file('image')){
            $image_name = $request->file('image')->getRealPath();
            Cloudder::upload($image_name, null);
            $imagereturned = Cloudder::getResult();
            $image_id = $imagereturned['public_id'];
            $image_format = $imagereturned['format'];
            $image_new_name = $image_id.'.'.$image_format;
            $notification->image = $image_new_name;
        }else{
            $notification->image = null;
        }
        $notification->title = $request->title;
        $notification->body = $request->body;
        $notification->save();
        $users = Visitor::select('id','fcm_token','user_id')->where('fcm_token' ,'!=' , null)->get();
        for($i =0; $i < count($users); $i++){
            $fcm_tokens[$i] = $users[$i]['fcm_token'];
            $user_notification = new UserNotification();
            $user_notification->user_id = $users[$i]['user_id'];
            $user_notification->notification_id = $notification->id;
            $user_notification->visitor_id = $users[$i]['id'];
            $user_notification->save();
        }
		$the_image = "https://res.cloudinary.com/duwmvqjpo/image/upload/w_100,q_100/v1581928924/".$notification->image;
        $notificationss = APIHelpers::send_notification($notification->title , $notification->body , $the_image , null , $fcm_tokens);
        return redirect('admin-panel/notifications/show');
    }







    public function edit($id)
    {
        $notification = $this->objectName::where('id', $id)->first();
        return view($this->folderView . 'edit', compact('notification'));
    }

    public function update(Request $request, $id)
    {

        $data = $this->validate(\request(),
            [
                'title_ar' => 'required',
                'title_en' => 'required',
                'body_ar' => 'required',
                'body_en' => 'required',
                'image' => '',

            ]);


            $notification = $this->objectName::find($id);
            if (!$notification) {
                Alert::warning('خطاء', 'هذه الخدمه ليست موجوه');
                return redirect()->route(' $this->folderView');
            }
            if ($request->hasFile('image')) {
                $file_name = $this->MoveImage($request->file('image'), 'uploads/notification');
                $data['image'] = $file_name;
                $notification=notification::find($id);
                $image= explode("/",$notification->image);
                $length=count($image)-1;//the name of photo in the last index in array
                $this->objectName::where('id', $id)->update($data);
                if( $notification->image !== null){
                    unlink("uploads/notification/".$image[$length]);
                 }
            }
             $this->objectName::where('id', $id)->update($data);

            activity('admin')->log('تم تحديث الاشعار بنجاح');

            DB::commit();
            Alert::success('تمت العمليه', 'تم التحديث بنجاح');
            return redirect()->route('notifications.index');;

    }


    public function destroy($id)
    {
        $notification = $this->objectName::findOrFail($id);
        $notification->delete();
        activity('admin')->log('تم حذف الاشعار بنجاح');

        Alert::success('تمت العمليه', 'تم الحذف بنجاح');

        return redirect()->route('notifications.index');
    }
}
