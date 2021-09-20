<?php

namespace App\Http\Controllers\Bank;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Bank;
use App\Models\Fund;
use App\Models\User;
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

        $bank_id = auth()->guard('bank')->user()->id;
        $userfunds = User_Fund::where('bank_id', $bank_id)->get();

        return view($this->folderView . 'index', compact('userfunds'));

    }

    public function details($id)
    {

        $usefund = User_Fund::where('id', $id)->get();
        return view($this->folderView . 'details', compact('usefund'));
    }
    /*
            public function review($id)
            {
                $requestreview = User_Fund::find($id);
                $empolyers = Admin::where('type', 'employer')->where('id', '!=', auth()->user()->id)->get();
                $banks = Bank::all();
                if ($requestreview->emp_id == auth()->user()->id) {
                    return view($this->folderView . 'details', compact('requestreview', 'empolyers', 'banks'));
                } else {
                    Alert::warning('تنبية', 'مرفوض الدخول');
                    return redirect()->back();
                }
            }

            public function redirect_emp(Request $request, $id)
            {
                $requestreview = User_Fund::find($id);
                $requestreview->emp_id = $request->emp_id;
                $requestreview->save();
                Alert::success('عملية ناجحة', 'تم التحويل بنجاح');
                return redirect()->route('userfunds');
            }

            public function redirect_bank(Request $request, $id)
            {
        //    return $request->all();
                $requestreview = User_Fund::find($id);
                $requestreview->bank_id = $request->bank_id;
                $requestreview->save();
                Alert::success('عملية ناجحة', 'تم التحويل الي البنك');
                return redirect()->route('userfunds');
            }
        */

}
