<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Admin;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Str;
use Spatie\Activitylog\Models\Activity;

class employerController extends Controller

{
    public $objectName;
    public $folderView;

    public function __construct(User $model)
    {
        $this->middleware('permission:Employers');
        $this->objectName = $model;
        $this->folderView = 'admin.employers.';
    }


    public function index()
    {
        $employers = Admin::where('type', 'employer')->orderBy('name', 'desc')->paginate(30);
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
        $roles = Role::get();
        $categories = Category::get();
        return view($this->folderView . 'create_employer', compact('employers', 'categories', 'roles'));
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
                'cat_id' => 'required',
                'role_id' => 'required'
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

            $employee->assignRole($request->input('role_id'));

            activity('admin')->log(trans('admin.employee_add'));
            $notification = $request['notification'];
            $employees = new Admin();
            $employees->notifications()->attach($notification);
            if ($employee->save()) {
//                $user->assignRole($request['role_id']);
                Alert::success(trans('admin.employee_add_success'), trans('admin.opretion_success'));
                return redirect()->route('employer.index');
            }
        }
    }

    public function edit($id)
    {
        $categories = Category::get();
        $employer = Admin::where('id', $id)->first();
        $roles = Role::get();
        return view($this->folderView . 'edit', \compact('employer', 'categories','roles'));
    }

    public function update(Request $request, $id)
    {
        $employee = Admin::find($id);
        if ($request['password'] != null && $request['password_confirmation'] != null) {
            $data = $this->validate(\request(),
                [
                    'name' => 'required|unique:admins,name,' . $id,
                    'email' => 'required|unique:admins,email,' . $id,
                    'phone' => 'required|unique:admins,phone,' . $id,
                    'password' => 'required|min:6|confirmed',
                    'password_confirmation' => 'required|min:6',
                    'cat_id' => 'required',
                    'role_id' => 'required'
                ]);
            $data['password'] = bcrypt(request('password'));
            unset($data['password_confirmation']);
        } else {
            $data = $this->validate(\request(),
                [
                    'name' => 'required|unique:admins,name,' . $id,
                    'email' => 'required|unique:admins,email,' . $id,
                    'phone' => 'required|unique:admins,phone,' . $id,
                    'cat_id' => 'required',
                    'role_id' => 'required'

                ]);
        }
        $data['type'] = 'employer';
        $data['image'] = Str::after($employee->image, 'admins_image/');
        if ($request->image != null) {
            $data['image'] = $this->MoveImage($request->image, 'uploads/admins_image');
        }
        Admin::where('id', $id)->update($data);
        $employee->assignRole($request->input('role_id'));
        Alert::success('تمت العمليه', 'تم تحديث الموظف بنجاح');
        return redirect()->route('employer.index');
    }

    public function destroy($id)
    {
        $employer = Admin::findOrFail($id);
        $employer->delete();
        activity('admin')->log('تم حذف الموظف بنجاح');

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

    public function showLog($id)
    {
        $activities = Activity::where('causer_id', $id)->get();
        return view($this->folderView . 'viewLog', \compact('activities'));
    }

    public function showLogs()
    {
        $activities = \App\Models\Activity::with('employees')->get();
        return view($this->folderView . 'showLogs', \compact('activities'));
    }


}

