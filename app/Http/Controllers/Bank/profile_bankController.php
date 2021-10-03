<?php

namespace App\Http\Controllers\Bank;
use App\Http\Controllers\Controller;
use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Admin;
use App\Models\Bank;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Str;
use Illuminate\Http\Request;

class profile_bankController extends Controller
{
    //
    public function profile_bank(Request $request)
    {
        return view('bank.profile_bank');
    }
    public function update(Request $request)
    {
        $id=Auth::user()->id;
        $bank = Bank::find($id);
        if($request['password'] != null && $request['password_confirmation'] != null){
            $data = $this->validate(\request(),
                [
                    'name_ar' => 'required|unique:banks,name_ar,'.$id,
                    'name_en' => 'required|unique:banks,name_en,'.$id,
                    'email' => 'required|unique:banks,email,'.$id,
                    'phone' => 'required|unique:banks,phone,'.$id,
                    'password' => 'required|min:6|confirmed',
                    'password_confirmation' => 'required|min:6',
                ]);
            $data['password'] = bcrypt(request('password'));
            unset($data['password_confirmation']);
        }else{
            $data = $this->validate(\request(),
                [
                    'name_ar' => 'required|unique:banks,name_ar,'.$id,
                    'name_en' => 'required|unique:banks,name_en,'.$id,
                    'email' => 'required|unique:banks,email,'.$id,
                    'phone' => 'required|unique:banks,phone,'.$id,
                ]);
        }
        $data['image']  = Str::after($bank->image, 'banks_image/');
        if($request->image != null){
            $data['image'] = $this->MoveImage($request->image,'uploads/banks_image');
        }
        Bank::where('id', $id)->update($data);
        Alert::success( 'تمت العمليه','تم تحديث معلومات الحساب');
        return redirect()->back();
    }
     public function updatepassword(Request $request)
     {
        $id=Auth::user()->id;
         $data = $this->validate(\request(),
        [
             'old_password'=>['required'],
             'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
                $bank = Bank::find($id);
                if(Hash::check($request->old_password, $bank->password)){
                        $data['password'] = bcrypt(request('password'));
                        unset($data['old_password']);
                        Bank::where('id', $id)->update($data);
                        Alert::success('تمت العمليه','تم تحديث كلمه مرور الحساب');
                        return redirect()->route('viewprofile',Auth::user()->id);
                    }
                    else{
                        return redirect()->back()->with(["wrong_pass"=>'كلمه المرور القديمه خاطئه']);;
                    }
     }
     public function updateimage(Request $request)
     {
        $id=Auth::user()->id;
        $data = $this->validate(request(),
        [
            'image' => 'required',
        ]);
        if ($request->image != null) {
            $bank=Bank::find($id);
     
            $image= explode("/",$bank->image);
            $length=count($image)-1;//the name of photo in the last index in array
            $data['image'] = $this->MoveImage($request->image,'uploads/banks_image');
            Bank::where('id', $id)->update($data);
               if( $bank->image !== null){
                  unlink("uploads/banks_image/".$image[$length]);
              }
            // activity('admin')->log('تم تحديث الموظف بنجاح');
            Alert::success('تمت العمليه','تم تحديث صوره الحساب');
            return redirect()->route('profile_bank',Auth::user()->id);
        }else{
            return redirect()->back();
        }
     }
}
