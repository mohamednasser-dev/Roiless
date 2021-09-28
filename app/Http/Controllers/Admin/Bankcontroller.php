<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Bank;
use Str;

class Bankcontroller extends Controller
{
    public $objectName;
    public $folderView;

    public function __construct(User $model)
    {
        $this->objectName = $model;
        $this->folderView = 'admin.banks.';
    }

    public function index()
    {
        $banks = Bank::orderBy('name_en', 'desc')->get();
        return view($this->folderView . 'banks', compact('banks'));
    }

    public function show($id)
    {
        $banks = Bank::where('id', $id)->first();
        return view($this->folderView . 'details', compact('banks'));
    }

    public function create()
    {
        $banks = Bank::orderBy('name_en', 'desc');
        return view($this->folderView . 'create_bank', compact('banks'));
    }

    public function store(Request $request)
    {
        $data = $this->validate(\request(),
            [
                'name_ar' => 'required|unique:banks',
                'name_en' => 'required|unique:banks',
                'email' => 'required|unique:banks',
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
                $data['image'] = $this->MoveImage($request->image, 'uploads/banks_image');
            }
            /*
            $data['type']='bank';
            $user = User::create($data);
            */
            unset($data['password_confirmation']);
            $bank = Bank::create($data);
            $notification = $request['notification'];
            $banks = new Bank();
            activity('admin')->log('تم اضافه البنك بنجاح');
            $banks->notifications()->attach($notification);
            if ($bank->save()) {
//                $user->assignRole($request['role_id']);
                Alert::success('تمت العمليه', 'تم انشاء بنك جديد');
                return redirect(url('banks'));
            }
        }
    }

    public function edit($id)
    {
        $bank = Bank::where('id', $id)->first();
        return view($this->folderView . 'edit', \compact('bank'));
    }

    public function update(Request $request, $id)
    {
        $bank = Bank::find($id);
        if ($request['password'] != null) {
            $data = $this->validate(\request(),
                [
                    'name_ar' => 'required|unique:banks,name_ar,' . $id,
                    'name_en' => 'required|unique:banks,name_en,' . $id,
                    'email' => 'required|unique:users,email,' . $id,
                    'password' => 'required|min:6|confirmed',
                ]);
        } else {
            $data = $this->validate(\request(),
                [
                    'name_ar' => 'required|unique:banks,name_ar,' . $id,
                    'name_en' => 'required|unique:banks,name_en,'  . $id,
                    'email' => 'required|unique:users,email,' . $id,
                ]);
        }

        if ($request['password'] != null && $request['password_confirmation'] != null) {
            $data['password'] = bcrypt(request('password'));
            unset($data['password_confirmation']);
            $data['image']  = Str::after($bank->image, 'banks_image/');
            if($request->image != null){
                $data['image'] = $this->MoveImage($request->image,'uploads/banks_image');
            }

            Bank::where('id', $id)->update($data);

            return redirect()->route('banks.index');
        } else {
            unset($data['password']);
            unset($data['password_confirmation']);
            $data['image']  = Str::after($bank->image, 'banks_image/');
            if($request->image != null){
                $data['image'] = $this->MoveImage($request->image,'uploads/banks_image');
            }
            Bank::where('id', $id)->update($data);
            activity('admin')->log('تم تحديث البنك بنجاح');

            return redirect()->route('banks.index');
        }
    }

    public function destroy($id)
    {
        $bank = Bank::findOrFail($id);
        $bank->delete();
        activity('admin')->log('تم حذف البنك بنجاح');
        Alert::success('تمت العمليه', 'تم حذف بنجاح');
        return redirect()->route('banks.index');
    }

}
