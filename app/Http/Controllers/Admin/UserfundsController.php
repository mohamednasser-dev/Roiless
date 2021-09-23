<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Bank;
use App\Models\Fhistory;
use App\Models\Fund;
use App\Models\User_Fund;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class UserfundsController extends Controller
{
// new push
    public $objectName;
    public $folderView;

    public function __construct(User_Fund $model)
    {
        $this->objectName = $model;
        $this->folderView = 'admin.userfunds.';
    }


    public function index()
    {
        $usefunds = User_Fund::with(['Fund' => function ($query) {
            $query->where('cat_id', auth()->user()->cat_id);
        }])->get();


        return view($this->folderView . 'index', compact('usefunds'));

    }

    public function employerchosen($id)
    {


        if (User_Fund::where('id', $id)->whereNull('emp_id')->exists()) {
            User_Fund::where('id', $id)->update(['emp_id' => auth()->user()->id]);
            activity('admin')->log('تم اضافه هذا التمويل لوظائفك بنجاح');
            Alert::success('تمت العمليه', 'تم اضافه هذا التمويل لوظائفك بنجاح');
            return redirect()->route('review', $id);
        } else {
            Alert::success('تمت العمليه', 'تم تحويل هذا الطلب بالفعل الي موظف');
            return redirect()->route('userfunds');
        }
    }

    public function review($id)
    {
        $requestreview = User_Fund::find($id);
        $empolyers = Admin::where('type', 'employer')->where('cat_id', auth()->user()->cat_id)->where('id', '<>', auth()->user()->id)->get();
        $banks = Bank::all();
        $histories = Fhistory::where('user_fund_id', $id)->orderBy('created_at', 'DESC')->get();
        if ($requestreview->emp_id == auth()->user()->id) {
            return view($this->folderView . 'details', compact('requestreview', 'empolyers', 'banks', 'histories'));
        } else {
            Alert::warning('تنبية', 'مرفوض الدخول');
            return redirect()->back();
        }
    }

    public function employerunchosen($id)
    {
        User_Fund::where('id', $id)->update(['emp_id' => null]);
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
        $Emp_request_redirect = User_Fund::find($id);
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
                'bank_id' => 'required',


            ]);


        $requestreview = User_Fund::find($id);
        $requestreview->bank_id = $request->bank_id;
        $requestreview->save();
        Alert::success('عملية ناجحة', 'تم التحويل الي البنك');

        $data['emp_id'] = auth()->user()->id;
        $data['user_fund_id'] = $id;
        $data['type'] = 'bank';
        $data['status'] = 'accept';
        Fhistory::create($data);
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
        $data['user_id'] = User_Fund::where('id', $id)->value('user_id');
        Fhistory::create($data);
        //تعديل الحاله user_status في ال user_funds


        Alert::success('عملية ناجحة', 'تم تحويل الملحوظات الي المستحدم بنجاح');
        return redirect()->route('userfunds');
    }

}
