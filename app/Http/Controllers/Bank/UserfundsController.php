<?php

namespace App\Http\Controllers\Bank;

use App\Http\Controllers\Controller;
use App\Models\Bank_User_Fund;
use App\Models\Fhistory;
use App\Models\User_Fund;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class UserfundsController extends Controller
{

    public $objectName;
    public $folderView;

    public function __construct(User_Fund $model)
    {
        $this->objectName = $model;
        $this->folderView = 'bank.userfunds.';
    }


    public function index()
    {
        $userFundBank = Bank_User_Fund::where('bank_id', \Auth::guard('bank')->user()->id)->pluck('user_fund_id');
        $bank_id = auth()->guard('bank')->user()->id;
        $userfunds = User_Fund::whereIn('id', $userFundBank)->get();

        return view($this->folderView . 'index', compact('userfunds'));

    }

    public function details($id)
    {

        $userfund = User_Fund::find($id);

        if (!$userfund) {
            Alert::warning('تنبية', 'لا يوجد طلب تمويل');
            return redirect()->back();
        }
        if ($userfund->bank_id == auth()->user()->id){
            return view($this->folderView . 'details', compact('userfund'));
        }else{
            Alert::warning('تنبية', 'لا يمكنك الدخول الي هذا الطلب');
            return redirect()->route('bank.home');
        }
    }

    public function bankChonsen($id)
    {
        if (User_fund::where('id', $id)->whereNull('bank_id')->exists()) {
            User_fund::where('id', $id)->update(['bank_id' => auth()->user()->id]);
            activity('admin')->log('تم اضافه هذا التمويل للبنك بنجاح');
            Alert::success('تمت العمليه', 'تم اضافه هذا التمويل  بنجاح');
            return redirect()->route('request.review', $id);
        } else {
            Alert::warning('تمت العمليه', 'تم تحويل هذا الطلب بالفعل الي بنك اخر');
            return redirect()->back();
        }
    }


    public function redirectEmployer(Request $request, $id)
    {
        $bank_id = auth()->guard('bank')->user()->id;
        $data = $this->validate(request(),
            [
                'note_ar' => 'required|string',
                'note_en' => 'required|string',
            ]);
        $user_fund_id = User_Fund::findOrfail($id);
        $data['status'] = 'reject';
        $data['type'] = 'bank';
        $data['user_fund_id'] = $id;
        $data['user_id'] = $user_fund_id->value('user_id');
        $data['emp_id'] = $user_fund_id->value('emp_id');
        $data['bank_id'] = $bank_id;
//        return $data;
        Fhistory::create($data);
        User_Fund::where('id', $id)->update(['bank_id' => null]);
        Alert::success('عملية ناجحة', 'تم تحويل طلب المراجعه مره اخري الي الموظف ');
        return redirect()->route('funds.request');

    }


}
