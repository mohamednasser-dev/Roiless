<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmployerCategory;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;
use App\Models\Bank_User_Fund;
use Illuminate\Http\Request;
use App\Models\User_fund;
use App\Models\Category;
use App\Models\Fhistory;
use App\Models\Admin;
use App\Models\User;
use App\Models\Notification;
use App\Models\User_Notification;
use Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\user_fund_Export;
use App\Exports\user_fundExport;
use App\Models\Bank;

class UserfundsController extends Controller
{
    public $objectName;
    public $folderView;

    public function __construct(User_fund $model)
    {
        $this->middleware('permission:Client Funds');
        $this->objectName = $model;
        $this->folderView = 'admin.userfunds.';
    }

    public function index()
    {
        if (auth()->user()->type == 'admin') {
            $usefunds = User_fund::with('Fund')->paginate(30);
            return view($this->folderView . 'index', compact('usefunds'));;
        }else{

            $catids =EmployerCategory::where('emp_id',auth()->user()->id)->pluck('cat_id');

            $usefunds = User_fund::whereHas('Fund', function ($q) use($catids) {
              $q->whereIN('cat_id',$catids);
            })->paginate(30);
            return view($this->folderView . 'index', compact('usefunds'));;
        }

    }

    public function employerchosen($id)
    {
        if (User_fund::where('id', $id)->whereNull('emp_id')->exists()) {
            User_fund::where('id', $id)->update(['emp_id' => auth()->user()->id]);;
            $employee_log= 'تم اضافه هذا التمويل لوظائف '.Auth::user()->name .' بنجاح';
            store_history(Auth::user()->id , $employee_log);
            $data['note_ar'] = 'تم استلام التمويل من قبل الموظف '.auth()->user()->name;
            $data['note_en'] = 'Funding received by the employee '.auth()->user()->name;
            $data['emp_id'] = auth()->user()->id;
            $data['type'] = 'emp';
            $data['show_in'] = 'web';
            $data['status'] = 'pending';
            $data['user_fund_id'] = $id;
            Fhistory::create($data);
            $data_app['note_ar'] = 'جاري المراجعة';
            $data_app['note_en'] = 'Reviewing';
            $data_app['emp_id'] = auth()->user()->id;
            $data_app['type'] = 'emp';
            $data_app['show_in'] = 'app';
            $data_app['status'] = 'pending';
            $data_app['user_fund_id'] = $id;
            Fhistory::create($data_app);
            Alert::success('تمت العمليه', 'تم اضافه هذا التمويل لوظائفك بنجاح');
            return redirect()->route('review', $id);
        } else {
            Alert::success('تمت العمليه', 'تم تحويل هذا الطلب بالفعل الي موظف');
            return redirect()->route('userfunds');
        }
    }

    public function review($id)
    {
        $userfund = User_fund::find($id);
        if (!$userfund) {
            Alert::warning('تنبية', 'لا يوجد طلب تمويل');
            return redirect()->back();
        }
        $requestreview = User_fund::find($id);
        $user_id=$requestreview->user_id;
        $user=User::find($user_id);
        $empolyers = Admin::where('type', 'employer')->where('cat_id', auth()->user()->cat_id)->where('id', '<>', auth()->user()->id)->get();
        $banks = Bank::where('status','active')->wherenotnull('parent_id')->orderBy('parent_id','DESC')->get();
        $histories = Fhistory::where('user_fund_id', $id)->where('show_in','web')->orderBy('created_at', 'DESC')->get();
        if ($requestreview->emp_id == auth()->user()->id) {

            $employee_log= 'تم مراجعه تمويل'.$userfund->Users->name;
            store_history(Auth::user()->id , $employee_log);
            return view($this->folderView . 'details', compact('requestreview', 'empolyers', 'banks', 'histories','user'));
        } else {
            Alert::warning('تنبية', 'مرفوض الدخول');
            return redirect()->back();
        }
    }

    public function employerunchosen($id)
    {
        User_fund::where('id', $id)->update(['emp_id' => null]);
        activity('admin')->log('تم الغاء طلب المراجع');
        Alert::success('تمت العمليه', 'تم الغاء طلب المراجعه');
        return redirect()->route('userfunds');
    }

    public function redirect_emp(Request $request, $id)
    {
        $emp = $this->validate(request(),
            [
                'emp_id' => 'required|string',
            ]);
        $data = $this->validate(request(),
            [
                'note_ar' => 'required|string',
                'note_en' => 'required|string',

            ]);
        $Emp_request_redirect = User_fund::find($id);
        $Emp_request_redirect->emp_id = $request->emp_id;
        $Emp_request_redirect->save();
        $data['emp_id'] = auth()->user()->id;
        $data['return_emp_id'] = $request->emp_id;
        $data['type'] = 'emp';
        $data['status'] = 'return';
        $data['user_fund_id'] = $id;
        Fhistory::create($data);
        Alert::success('عملية ناجحة', 'تم التحويل بنجاح');
        return redirect()->route('userfunds');
    }

    public function redirect_bank(Request $request, $id)
    {
        $data = $this->validate(request(),
            [
                'note_ar' => 'required|string',
                'note_en' => 'required|string',
            ]);
        $bank_req = $this->validate(request(),
            [
                'banks' => 'required',
            ]);
        $bank_id = $request->banks;
        DB::beginTransaction();
        if ($bank_id) {
            foreach ($bank_id as $bank) {
                Bank_User_Fund::create([
                    'user_fund_id' => $id,
                    'bank_id' => $bank
                ]);
            }
        }
        Alert::success('عملية ناجحة', 'تم التحويل الي البنك');
        $data['emp_id'] = auth()->user()->id;
        $data['user_fund_id'] = $id;
        $data['type'] = 'emp';
        $data['show_in'] = 'web';
        $data['status'] = 'accept';
        $data['status'] = 'accept';
        Fhistory::create($data);
        $data_app['note_ar'] = 'تم التحويل الى البنك';
        $data_app['note_en'] = 'Transferred to the bank';
        $data_app['emp_id'] = auth()->user()->id;
        $data_app['type'] = 'emp';
        $data_app['show_in'] = 'app';
        $data_app['status'] = 'pending';
        $data_app['user_fund_id'] = $id;
        Fhistory::create($data_app);
        DB::commit();
        User_fund::where('id',$id)->update(['user_status' => 'under_revision']);
        return redirect()->route('userfunds');
    }

    public function redirect_user(Request $request, $id)
    {
        $data = $this->validate(request(),
            [
                'note_ar' => 'required|string',
                'note_en' => 'required|string',
            ]);
        $data['status'] = 'reject';
        $data['type'] = 'user';
        $data['user_fund_id'] = $id;
        $data['user_id'] = User_fund::where('id', $id)->value('user_id');
         Fhistory::create($data);
        //تعديل الحاله user_status في ال user_funds
        User_fund::where('id',$id)->update(['user_status' => 'finail_rejected']);
        $user_fund=User_fund::find($id);
        $notification = Notification::create([
            'title_ar'=>'تم رفض التمويل',
            'title_en'=>'fund rejected',
            'body_ar'=>'تم رفض تمويل'.$user_fund->Fund->name_ar.'سيتم التحويل الي بنك اخر ',
            'body_en'=>'fund rejected'.$user_fund->Fund->name_en.'It will be transferred to another bank',
        ]);
        $user_id=$user_fund->user_id;
        $user=User::find($user_id);
        User_Notification::create(['notification_id'=>$notification->id,'user_id'=>$user->id]);
        $fcm_tokens[0] = $user->fcm_token;
        $title='title_ar'.$user->lang;
        $body='body_ar'.$user->lang;
        send_notification($notification->$title , $notification->$body , null , null , $fcm_tokens);
        Alert::success('عملية ناجحة', 'تم تحويل الملحوظات الي المستحدم بنجاح');
        return redirect()->route('userfunds');
    }
    public function export_view()
    {
        $categories=Category::all();
         return view('admin.userfunds.expet_excel',compact('categories'));
    }
    public function export(Request $request)
    {
        //   dd($request->all());
       if($request->group1 == 1)
       {
        return Excel::download(new user_fund_Export($request->month ,$request->annual ,$request->group1), 'bulkData.xlsx');
       }
       elseif($request->group1 == 2)
       {
        $validated = $request->validate([
            'month' => 'required',
            'annual' => 'required',
        ]);
        return Excel::download(new user_fund_Export($request->month ,$request->annual ,$request->group1), 'bulkData.xlsx');
       }
       elseif($request->group1 == 3)
       {
        return Excel::download(new user_fund_Export($request->month ,$request->annualy ,$request->group1 ) , 'bulkData.xlsx');
       }
       else{
        return Excel::download(new user_fund_Export($request->month ,$request->annualy ,$request->group1 ,$request->category), 'bulkData.xlsx');
       }
    }
}
