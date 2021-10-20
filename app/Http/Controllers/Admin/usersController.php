<?php
namespace App\Http\Controllers\Admin;

use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\Notification;
use Exception;
use Str;

class usersController extends Controller{
    public $objectName;
    public $folderView;
    public function __construct(User $model){
        $this->middleware('permission:Users');
        $this->objectName = $model;
        $this->folderView = 'admin.users.';
    }


    public function index(){
        $users = $this->objectName::where('type','user')->orderBy('name','desc')->paginate(30);

        return view($this->folderView.'users',compact('users'));
    }

   public function show($id){
        $data = $this->objectName::where('id',$id)->first();
        return view($this->folderView.'details',compact('data'));
    }

    public function create(){
         $categories = Category::all();

        return view($this->folderView.'create_user',compact('categories'));

    }

    public function store(Request $request){

        $data = $this->validate(\request(),
        [
            'name'                  => 'required|max:255',
            'email'                 => 'required|unique:users|email',
            'phone'                 => 'required|numeric',
            'image'                 => '',
            'password'              => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6',
        ]);
        if($request['password'] != null  && $request['password_confirmation'] != null ){
            $data['password'] = bcrypt(request('password'));
//            if($request->status == 'on'){
//                $data['status'] = 'active';
//            }else{
//                $data['status'] = 'unactive';
//            }
            //store images
            if($request->image != null){
                $data['image'] = $this->MoveImage($request->image,'uploads/users_images');
            }
            $user = User::create($data);
            activity('admin')->log('تم اضافه مستخدم  بنجاح');

            $notification=$request['notification'];
            $users=new User();
            $users->notifications()->attach($notification);
            if($user->save()){
//                $user->assignRole($request['role_id']);
                Alert::success(trans('admin.opretion_success'),trans('admin.user_created') );
                return redirect(url('users'));
            }
        }
    }

    public function edit($id)
    {
        $user_data = $this->objectName::where('id', $id)->first();
        return view($this->folderView.'edit', \compact('user_data'));
    }

    public function update(Request $request, $id)
    {
        if($request['password'] != null){
            $data = $this->validate(\request(),
                [
                    'name' => 'required',
                    'email' => 'required|unique:users,email,'.$id,
                    'phone' => 'required',
                    'password' => 'required|min:6|confirmed',
                ]);
        }else{
            $data = $this->validate(\request(),
                [
                    'name' => 'required',
                    'email' => 'required|unique:users,email,'.$id,
                    'phone' => 'required',
                ]);
        }
            $user = User::find($id);
        if($request['password'] != null  && $request['password_confirmation'] != null ){
            $data['password'] = bcrypt(request('password'));
            $newData['name'] =$request['name'];
            $data['image']  = Str::after($user->image, 'users_images/');
            if($request->image != null){
                $data['image'] = $this->MoveImage($request->image,'uploads/users_images');
            }
            User::where('id',$id)->update($data);
            activity('admin')->log('تم تحديث مستخدم  بنجاح');
            Alert::success(trans('admin.opretion_success'),trans('admin.user_update') );
            return redirect(url('users'));
        }else{
            unset($data['password']);
            unset($data['password_confirmation']);
            $data['image']  = Str::after($user->image, 'users_images/');
            if($request->image != null){
                $data['image'] = $this->MoveImage($request->image,'uploads/users_images');
            }
            User::where('id',$id)->update($data);
            Alert::success(trans('admin.opretion_success'),trans('admin.updated_Success') );
            return redirect(url('users'));
        }
    }

    public function update_Actived(Request $request){
        $data['status'] = $request->status ;
        $user = User::where('id', $request->id)->update($data);
        activity('admin')->log('تم تحديث حاله المستخدم  بنجاح');

        return 1;
    }

    public function destroy($id){
        $user = $this->objectName::where('id', $id)->first();
        try {
            $user->delete();
            $user->save();
            activity('admin')->log('تم حذف مستخدم  بنجاح');
            Alert::success(trans('admin.Deleted'),trans('admin.Deleted_Success') );
        }catch(Exception $ex){
            Alert::warning('الحذف', trans('admin.emp_no_delete'));
            return $ex;
        }
        return back();
    }
     public function ltr()
    {
        return view('home_ltr');
    }
}
