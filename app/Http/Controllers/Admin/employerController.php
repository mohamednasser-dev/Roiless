<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Admin;

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
        return view($this->folderView . 'create_employer', compact('employers'));
    }

    public function store(Request $request)
    {

        $data = $this->validate(\request(),
            [
                'name' => 'required|unique:admins',
                'email' => 'required|unique:admins',
                'phone' => 'required',
                'image' => '',
                'password' => 'required|min:6|confirmed',
                'password_confirmation' => 'required|min:6',
            ]);
        if ($request['password'] != null && $request['password_confirmation'] != null) {
            $data['password'] = bcrypt(request('password'));
            //  $data['cat_id'] = $request->category_id;
//            if($request->status == 'on'){
//                $data['status'] = 'active';
//            }else{
//                $data['status'] = 'unactive';
//            }
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

    public function update(Request $request, $id)
    {

        if ($request['password'] != null) {
            $data = $this->validate(\request(),
                [
                    'name' => 'required',
                    'email' => 'required|unique:users,email,' . $id,
                    'password' => 'required|min:6|confirmed',

                ]);
        } else {
            $data = $this->validate(\request(),
                [
                    'name' => 'required',
                    'email' => 'required|unique:users,email,' . $id,

                ]);
        }

        if ($request['password'] != null && $request['password_confirmation'] != null) {
            $data['password'] = bcrypt(request('password'));
            Admin::where('id', $id)->update($data);

            return redirect()->route('employer.index');
        } else {
            unset($data['password']);
            unset($data['password_confirmation']);
            Admin::where('id', $id)->update($data);
            return redirect()->route('employer.index');
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

