<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Admin;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
class employerController extends Controller

{
    public $objectName;
    public $folderView;

    public function __construct(User $model)
    {
        $this->objectName = $model;
        $this->folderView = 'admin.employers.';
    }


    public function index()
    {
        $employers = Admin::where('type', 'employer')->orderBy('name', 'desc')->get();
        return view($this->folderView . 'employers', compact('employers'));
    }

    public function show($id)
    {
        
        $employers = Admin::where('id', $id)->first();
        return view($this->folderView . 'details', compact('employers'));
    }

    public function create()
    {
        $employers = Admin::where('type', 'employer')->orderBy('name', 'desc');
        $categories=Category::get();
        return view($this->folderView . 'create_employer', compact('employers','categories'));
    }

    public function store(Request $request)
    {
        $data = $this->validate(\request(),
            [
                'name' => 'required|unique:admins',
                'email' => 'required|unique:admins',
                'phone' => 'required|unique:admins',
                'image' => 'required',
                'password' => 'required|min:6|confirmed',
                'password_confirmation' => 'required|min:6',
                 'cat_id'=>'required'
            ]);
        if ($request['password'] != null && $request['password_confirmation'] != null) {
            $data['password'] = bcrypt(request('password'));
            //store images
            if ($request->image != null) {
                $data['image'] = $this->MoveImage($request->image, 'uploads/admins_image');
            }
            unset($data['password_confirmation']);
            $data['type'] = 'employer';       
            $employee = Admin::create($data);
            $notification = $request['notification'];
            $employees = new Admin();
            $employees->notifications()->attach($notification);
            if ($employee->save()) {
//                $user->assignRole($request['role_id']);
                Alert::success('تمت العمليه', 'تم انشاء موظف جديد');
                return redirect()->route('employer.index');
            }
        }
    }

    public function edit($id)
    {
        $employer = Admin::where('id', $id)->first();
        return view($this->folderView . 'edit', \compact('employer'));
    }

    public function update(Request $request )
    {
      
        if($request->id==Auth::user()->id){
            $id=$request->id;
        }
        else{
            return redirect()->back();
        }
      
            $data = $this->validate(\request(),
                [
                     'name' => 'required',
                     'email' => 'required|unique:admins,email,' . $id,
                     'phone'=>'required|unique:admins,phone,'.$id
                ]);
            Admin::where('id', $id)->update($data);
            Alert::success('تمت العمليه','تم تحديث معلومات الحساب');
            return redirect()->route('viewprofile',Auth::user()->id);    
    }
     public function updatepassword(Request $request)
     {
       
        if($request->id==Auth::user()->id){
            $id=$request->id;
        }
        else{
            return redirect()->back();
        }
        if ($request['password'] != null && $request['password_confirmation'] != null) {
            $data = $this->validate(\request(),
                [
                     'password' => ['required', 'string', 'min:6', 'confirmed'],
                ]);
                $data['password'] = bcrypt(request('password'));
                Admin::where('id', $id)->update($data);
                Alert::success('تمت العمليه','تم تحديث كلمه مرور الحساب');
                return redirect()->route('viewprofile',Auth::user()->id);    
        } else{
            return redirect()->back();
        }
     }
     public function updateimage(Request $request)
     {
        if($request->id==Auth::user()->id){
            $id=$request->id;
        }
        else{
            return redirect()->back();
        }
        $data = $this->validate(request(),
        [
            'image' => 'required',
        ]);
        if ($request->image != null) {
            $employee=Admin::find($id);
            unlink("uploads/admins_image/".$employee->image);
            $data['image'] = $this->MoveImage($request->image,'uploads/admins_image');
            Admin::where('id', $id)->update($data);
            Alert::success('تمت العمليه','تم تحديث صوره الحساب');
            return redirect()->route('viewprofile',Auth::user()->id);    
        }else{
            return redirect()->back();
        }
     }
    public function destroy($id)
    {
        $employer = Admin::findOrFail($id);
        $employer->delete();
        Alert::success('تمت العمليه', 'تم حذف بنجاح');

        return redirect()->route('employer.index');
    }

    public function changeStatus(Request $request)
    {
        Admin::where('id', $request->id)->update([
            'status' => $request->status
        ]);
        return 1;
    }

}

