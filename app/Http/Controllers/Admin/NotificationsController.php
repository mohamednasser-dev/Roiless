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
        try {
            //store images
            if ($request->image != null) {
                $data['image'] = $this->MoveImage($request->image, 'uploads/notification');
            }
            unset($data['users_id']);
            $notifications = Notification::create($data)->user()->attach($request->users_id);
            activity('admin')->log('تم اضافه الاشعار بنجاح');

            Alert::success('تمت العمليه', 'تم اضافه الاشعار بنجاح');
            return redirect()->route('notifications.create');
        } catch (\Exception $ex) {
            DB::rollback();
            Alert::warning('هنالك خطاء', 'لم يتم التحديث');
            return redirect()->route('notifications.create');
        }
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

        try {
            $notification = $this->objectName::find($id);
            if (!$notification) {
                Alert::warning('خطاء', 'هذه الخدمه ليست موجوه');
                return redirect()->route(' $this->folderView');
            }


            if ($request->hasFile('image')) {
                $file_name = $this->MoveImage($request->file('image'), 'uploads/notifications');
                $data['image'] = $file_name;
            }

            $this->objectName::where('id', $id)->update($data);

            activity('admin')->log('تم تحديث الاشعار بنجاح');

            DB::commit();
            Alert::success('تمت العمليه', 'تم التحديث بنجاح');
            return redirect()->back();

        } catch (\Exception $ex) {

            DB::rollback();
            Alert::warning('هنالك خطاء', 'لم يتم التحديث');

            return redirect()->route('question');

        }
    }


    public function destroy($id)
    {
        $question = $this->objectName::findOrFail($id);
        $question->delete();
        activity('admin')->log('تم حذف الاشعار بنجاح');

        Alert::success('تمت العمليه', 'تم الحذف بنجاح');

        return redirect()->route('question');
    }
}
