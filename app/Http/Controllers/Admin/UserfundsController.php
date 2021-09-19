<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
        $this->folderView = 'admin.usefunds.';
    }


    public function index(){
        $usefunds=User_Fund::where('cat_id',auth()->user()->cat_id)->get();

        return   view($this->folderView . 'index', compact('usefunds'));

    }

    public function employerchosen($id){


        if(  User_Fund::where('id',$id)->whereNull('emp_id')->exists()  ){
            User_Fund::where('id', $id)->update(['emp_id' => auth()->user()->id]) ;
            activity('admin')->log('تم اضافه هذا التمويل لوظائفك بنجاح');
            Alert::success('تمت العمليه', 'تم اضافه هذا التمويل لوظائفك بنجاح');
            return redirect()->route('review',$id);
        }else{
            Alert::success('تمت العمليه', 'تم تحويل هذا الطلب بالفعل الي موظف');
            return redirect()->route('userfunds');
        }
    }

    public function review($id){

        $requestreview =User_Fund::where('id',$id)->first();
        return   view($this->folderView . 'details', compact('requestreview'));

    }

    public function employerunchosen($id,$emp_id){

        User_Fund::where('id', $id)->update(['emp_id' =>null]) ;
        activity('admin')->log('تم الغاء طلب المراجع');
        Alert::success('تمت العمليه', 'تم الغاء طلب المراجعه');
        return redirect()->route('userfunds');

    }
}
