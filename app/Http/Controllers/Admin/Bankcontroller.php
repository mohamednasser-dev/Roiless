<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\User_fund;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Bank;
use App\Models\Adminhistory;
use Auth;
use Str;
class Bankcontroller extends Controller
{
    public $objectName;
    public $folderView;

    public function __construct(User $model)
    {
        $this->middleware('permission:Banks');
        $this->objectName = $model;
        $this->folderView = 'admin.banks.';
    }
    public function index()
    {
        $banks = Bank::whereNull('parent_id')->orderBy('name_en', 'desc')->get();
        $active_banks=Bank::where('status','active')->get();

        return view($this->folderView . 'banks', compact('banks','active_banks'));
    }
    public function show($id)
    {
        $banks = Bank::where('id', $id)->first();
        return view($this->folderView . 'details', compact('banks'));
    }

    public function funds($id)
    {
        $banks = Bank::where('id', $id)->first();
        return view($this->folderView . 'details', compact('banks'));
    }
    public function create($id)
    {
        $banks = Bank::orderBy('name_en', 'desc');
        return view($this->folderView . 'create_bank', compact('banks', 'id'));
    }
    public function store(Request $request, $id)
    {
        $data = $this->validate(\request(),
            [
                'name_ar' => 'required|unique:banks,name_ar',
                'name_en' => 'required|unique:banks,name_en',
                'email' => 'required|unique:banks,email',
                'phone' => 'required|unique:banks,phone',
                'image' => 'required',
                'password' => 'required|min:6|confirmed',
                'password_confirmation' => 'required|min:6',
                'address' => 'required',
            ]);
        if ($request['password'] != null && $request['password_confirmation'] != null) {
            $data['password'] = bcrypt(request('password'));
            //store images
            if ($request->image != null) {
                $data['image'] = $this->MoveImage($request->image, 'uploads/banks_image');
            }
            unset($data['password_confirmation']);
            if ($id == 0) {
                $data['parent_id'] = null;
            } else {
                $data['parent_id'] = $id;
            }
            $bank = Bank::create($data);
            $notification = $request['notification'];
            $banks = new Bank();
            activity('admin')->log('تم اضافه البنك بنجاح');
            $banks->notifications()->attach($notification);
            if ($bank->save()) {
                Alert::success('تمت العمليه', 'تم انشاء بنك جديد');
                if ($bank->parent_id == null) {
                    return redirect()->route('banks.index');
                } else {
                    return redirect()->route('banks.branches', $bank->parent_id);
                }
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
                    'name_en' => 'required|unique:banks,name_en,' . $id,
                    'email' => 'required|unique:users,email,' . $id,
                ]);
        }
        if ($request['password'] != null && $request['password_confirmation'] != null) {
            $data['password'] = bcrypt(request('password'));
            unset($data['password_confirmation']);
            $data['image'] = Str::after($bank->image, 'banks_image/');
            if ($request->image != null) {
                $data['image'] = $this->MoveImage($request->image, 'uploads/banks_image');
            }
            Bank::where('id', $id)->update($data);
            return redirect()->route('banks.index');
        } else {
            unset($data['password']);
            unset($data['password_confirmation']);
            $data['image'] = Str::after($bank->image, 'banks_image/');
            if ($request->image != null) {
                $data['image'] = $this->MoveImage($request->image, 'uploads/banks_image');
            }
            Bank::where('id', $id)->update($data);
            $bank_log='تم تحديث بنك '.$bank->name_ar;
            store_history(Auth::user()->id , $bank_log);
            Alert::success('تمت العمليه', 'تم التعديل بنجاح');
            if ($bank->parent_id == null) {
                return redirect()->route('banks.index');
            } else {
                return redirect()->route('banks.branches', $bank->parent_id);
            }
        }
    }
    public function update_Actived($id)
    {
      $bank=Bank::find($id);
      $bank->update([
          'status'=>"active",
      ]);
      $bank_log='تم الغاء تفعيل بنك '.$bank->name_ar;
      store_history(Auth::user()->id , $bank_log);
      return redirect()->back();
    }
    public function unupdate_Actived(Request $request)
    {
       if($request->bank_id)
       {
                if($request->bank_id=="no_bank")
                {
                    $id=$request->id;
                    $bank=Bank::find($id);
                    $bank->update([
                        'status'=>"unactive",
                    ]);
                    $bank_log='تم الغاء تفعيل بنك '.$bank->name_ar;
                    store_history(Auth::user()->id , $bank_log);
                    return redirect()->back();
                }else{
                    $bank_id=$request->bank_id;
                    $id=$request->id;
                    $user_fund=User_fund::where('bank_id',$id)->update([
                        'bank_id'=>$bank_id
                    ]);
                    $bank=Bank::find($id);
                    $bank->update([
                        'status'=>"unactive",
                    ]);
                    $bank_log='تم الغاء تفعيل بنك '.$bank->name_ar;
                    store_history(Auth::user()->id , $bank_log);
                    return redirect()->back();
                }
              }else{
                $id=$request->id;
                $bank=Bank::find($id);
                $bank->update([
                    'status'=>"unactive",
                ]);
                return redirect()->back();
          }

    }
    public function destroy($id)
    {
        $bank = Bank::findOrFail($id);
        if ($bank->parent_id == null) {
            if($bank->delete()){
                $bank_log='تم حذف بنك '.$bank->name_ar;
                store_history(Auth::user()->id , $bank_log);
                Alert::success(trans('admin.deleted'), trans('admin.opretion_success'));
                Bank::where('parent_id',$id)->delete();
                return redirect()->route('banks.index');
             }
        }
        else{
            $bank_log='تم حذف بنك '.$bank->name_ar;
            store_history(Auth::user()->id , $bank_log);
            Alert::success(trans('admin.deleted'), trans('admin.opretion_success'));
            $bank->delete();
            return redirect()->route('banks.branches', $bank->parent_id);
        }
    }
    public function bankBranch($id)
    {
        $branches = Bank::where('parent_id', $id)->get();
        $active_banks=Bank::where('status','active')->get();
        return view($this->folderView . 'branches', \compact('branches', 'id','active_banks'));
    }
    public function BankFunds($id)
    {
        $branches_ids =Bank::where('parent_id',$id)->get()->pluck('id')->toArray();
        array_push($branches_ids,$id);
        $BankFunds = User_fund::wherein('bank_id', $branches_ids)->orderBy('created_at', 'DESC')->get();
        return view($this->folderView . 'BankFunds', compact('BankFunds'));
    }
}
