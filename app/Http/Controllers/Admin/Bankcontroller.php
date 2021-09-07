<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class Bankcontroller extends Controller
{
    public $objectName;
    public $folderView;
    public function __construct(User $model){
    $this->objectName = $model;
    $this->folderView = 'admin.banks.';
}


    public function index(){
    $banks = User::where('type','bank')->orderBy('name','desc')->get();
    return view($this->folderView.'banks',compact('banks'));
}

   public function show($id){
    $banks = User::where('id',$id)->first();
    return view($this->folderView.'details',compact('banks'));
}

    public function create(){
    $banks = User::where('type','bank')->orderBy('name','desc');
    return view($this->folderView.'create_bank',compact('banks'));
}

    public function store(Request $request){

    $data = $this->validate(\request(),
        [
            'name' => 'required|unique:users',
            'email' => 'required|unique:users',
            'phone' => 'required',
            'image' => '',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6',
        ]);
    if($request['password'] != null  && $request['password_confirmation'] != null ){
        $data['password'] = bcrypt(request('password'));
        $data['cat_id'] = $request->category_id;
//            if($request->status == 'on'){
//                $data['status'] = 'active';
//            }else{
//                $data['status'] = 'unactive';
//            }
        //store images
        if($request->image != null){
            $data['image'] = $this->MoveImage($request->image,'uploads/users_images');
        }
        $data['type']='bank';
        $user = User::create($data);
        $notification=$request['notification'];
        $users=new User();
        $users->notifications()->attach($notification);
        if($user->save()){
//                $user->assignRole($request['role_id']);
            Alert::success('تمت العمليه', 'تم انشاء موظف جديد');
            return redirect(url('banks'));
        }
    }
}

    public function edit($id)
{

    $bank = User::where('id', $id)->first();
    return view($this->folderView.'edit', \compact('bank'));
}

        public function update(Request $request, $id)
    {

        if($request['password'] != null){
            $data = $this->validate(\request(),
                [
                    'name' => 'required',
                    'email' => 'required|unique:users,email,'.$id,
                    'password' => 'required|min:6|confirmed',

                ]);
        }else{
            $data = $this->validate(\request(),
                [
                    'name' => 'required',
                    'email' => 'required|unique:users,email,'.$id,

                ]);
        }

        if($request['password'] != null  && $request['password_confirmation'] != null ){
            $data['password'] = bcrypt(request('password'));
            User::where('id',$id)->update($data);

            return redirect()->route('banks.index');
        }else{
            unset($data['password']);
            unset($data['password_confirmation']);
            User::where('id',$id)->update($data);
            return redirect()->route('banks.index');
        }
    }

    public function destroy($id){
        $bank=User::findOrFail($id);

        $bank->delete();
        Alert::success('تمت العمليه', 'تم حذف بنجاح');

        return redirect()->route('banks.index');
}

}
