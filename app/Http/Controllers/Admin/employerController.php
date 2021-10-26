<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmployerCategory;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Admin;
use App\Models\Category;
use App\Models\User_fund;
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
//        return $request;
        $data = $this->validate(\request(),
            [
                'name'                   => 'required|unique:admins|max:255',
                'email'                  => 'required|unique:admins|email',
                'phone'                  => 'required|unique:admins|numeric',
                'image'                  => 'required',
                'password'               => 'required|min:6|confirmed',
                'password_confirmation'  => 'required|min:6',
                'role_id'                => 'required|numeric',
                'cat_id'                 => 'required',
            ]);

        if ($request['password'] != null && $request['password_confirmation'] != null) {
            $data['password'] = bcrypt(request('password'));
            //store images
            if ($request->image != null) {
                $data['image'] = $this->MoveImage($request->image, 'uploads/admins_image');
            }
            unset($data['password_confirmation']);
            $data['type'] = 'employer';
            unset($data['cat_id']);
            $employee = Admin::create($data);
            foreach($request->cat_id as  $c){
               EmployerCategory::create([
                    'emp_id'=>$employee->id,
                    'cat_id'=>$c,
                ]);
                $employee_log='تم اضافه موظف'.$employee->name;
                store_history(Auth::user()->id , $employee_log);
            }
            $employee->assignRole($request->input('role_id'));
            activity('admin')->log(trans('admin.employee_add'));
            $notification = $request['notification'];
            $employees = new Admin();
            $employees->notifications()->attach($notification);
            if ($employee->save()) {
                Alert::success(trans('admin.opretion_success'),trans('admin.employer_created') );
                return redirect()->route('employer.index');
            }
        }
    }

    public function edit($id)
    {

//        $categories = EmployerCategory::where('emp_id',$id)->get();
        $allcategories = Category::get();
        $employer = Admin::where('id', $id)->first();
        $roles = Role::get();
        return view($this->folderView . 'edit', \compact('employer', 'roles','allcategories'));
    }

    public function update(Request $request, $id)
    {

        $employee = Admin::find($id);
        if ($request['password'] != null && $request['password_confirmation'] != null) {
            $data = $this->validate(\request(),
                [
                    'name'                   => 'required|max:255,' . $id,
                    'email'                  => 'required|unique:admins,email|email,' . $id,
                    'phone'                  => 'required|unique:admins,phone|numeric,' . $id,
                    'password'               => 'required|min:6|confirmed',
                    'password_confirmation'  => 'required|min:6',
                    'cat_id'                 => 'required|numeric',
                    'role_id'                => 'required|numeric'
                ]);
            $data['password'] = bcrypt(request('password'));
            unset($data['password_confirmation']);
        } else {
            $data = $this->validate(\request(),
                [
                    'name'                   => 'required|max:255,' . $id,
                    'email'                  => 'required|unique:admins,email|email,' . $id,
                    'phone'                  => 'required|unique:admins,phone|numeric,' . $id,
                    'cat_id'                 => 'required|numeric',
                    'role_id'                => 'required|numeric'
                ]);
        }
        $data['type'] = 'employer';
        $data['image'] = Str::after($employee->image, 'admins_image/');
        if ($request->image != null) {
            $data['image'] = $this->MoveImage($request->image, 'uploads/admins_image');
        }
        unset($data['cat_id']);
        Admin::where('id', $id)->update($data);
        EmployerCategory::where('emp_id',$id)->delete();
        foreach($request->cat_id as  $c){
            EmployerCategory::create([
                'emp_id'=>$employee->id,
                'cat_id'=>$c,
            ]);
        }
        $employee->assignRole($request->input('role_id'));
        Alert::success(trans('admin.opretion_success'),trans('admin.employer_update') );
        return redirect()->route('employer.index');
    }

    public function destroy($id)
    {
        $employer = Admin::findOrFail($id);
        $employer->delete();
        $employee_log='تم حدذف موظف'.$employer->name;
        store_history(Auth::user()->id , $employee_log);
        Alert::success(trans('admin.Deleted'), trans('admin.Deleted_Success'));

        return redirect()->route('employer.index');
    }

    public function changeStatus(Request $request)
    {
        $employee=  Admin::where('id', $request->id)->update([
            'status' => $request->status
        ]);
        $employee_log='تم تغير حاله موظف'.$employee->name;
        store_history(Auth::user()->id , $employee_log);
        return 1;
    }

    public function showLog($id)
    {
        $activities = Activity::where('causer_id', $id)->get();
        return view($this->folderView . 'viewLog', \compact('activities'));
    }

    public function showLogs()
    {
        $activities = \App\Models\Adminhistory::orderBy('created_at','Desc')->paginate(30);
        return view($this->folderView . 'showLogs', \compact('activities'));
    }


}

