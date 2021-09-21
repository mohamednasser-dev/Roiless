<?php

namespace App\Http\Controllers\Bank;

use App\Http\Controllers\Controller;
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

        $bank_id = auth()->guard('bank')->user()->id;
        $userfunds = User_Fund::where('bank_id', $bank_id)->get();

        return view($this->folderView . 'index', compact('userfunds'));

    }

    public function details($id)
    {

        $userfund = User_Fund::findorfail($id);

        return view($this->folderView . 'details', compact('userfund'));


    }

    public function redirectEmployer(Request $request, $id)
    {

        $data = $this->validate(request(),
            [
                'note_ar' => 'required|string',
                'note_en' => 'required|string',
            ]);
        $user_fund_id= User_Fund::findOrfail($id);
        $data['status']='reject';
        $data['type']='bank';
        $data['user_fund_id']=$id;
        $data['user_id']= $user_fund_id->value('user_id');
        $data['emp_id']= $user_fund_id->value('emp_id');
//        return $data;
        Fhistory::create($data);
        User_Fund::where('id',$id)->update(['bank_id'=>null]);
        Alert::success('عملية ناجحة', 'تم تحويل طلب المراجعه مره اخري الي الموظف ');
        return redirect()->route('funds.request');

    }


}
