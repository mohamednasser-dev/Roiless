<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Company_field;
use App\Models\Company_type;
use App\Models\Fhistory;
use App\Models\Fund;
use App\Models\Bank;
use App\Models\User;
use App\Models\User_fund;
use App\Models\Fund_file;
use Validator;
use Str;
use Illuminate\Http\Request;
use BaklySystems\PayMob\Facades\PayMob;
use App\Http\Controllers\API\PayMobController;

class FundController extends Controller
{

    public function details(Request $request, $id)
    {
        try {
            $lang = $request->header('lang');
            if (empty($lang)) {
                $lang = "en";
            }
            $Funddetailes = Fund::select('id', 'name_ar','name_en', 'image', 'columns','cost')->where('id', $id)->first();
            $Funddetailes->cost = number_format((float)($Funddetailes->cost), 2);
            $Funddetailes->columns = json_decode($Funddetailes->columns);
            if ($Funddetailes) {
                $data['Funddetailes'] = $Funddetailes;
                $bank = Bank::select('name_' . $lang . ' as name', 'image')->get();
                $data['banks'] = $bank;

                $fields = Company_field::select('id','name_' . $lang . ' as name')->get();
                $data['company_field'] = $fields;
                $types = Company_type::select('id','name_' . $lang . ' as name')->get();
                $data['company_type'] = $types;
                return msgdata($request, success(), 'fund details success', $data);
            }
        } catch (Exception $e) {
            return $this->returnError($e->getCode(), $e->getMessage());
        }
    }

    public function addfund(Request $request)
    {
        $user = auth()->user();

        $myJSON = json_encode($request->dataform);
        $rules = [
            'fund_id' => 'required',
            'dataform' => 'required',
            'file' => '',
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['status' => 401, 'msg' => $validator->messages()->first()]);
        } else {
            $fund = Fund::find($request->fund_id);
            $user_fund_data['fund_amount'] = $fund->cost;
            $user_fund_data['dataform'] = json_encode($request->dataform);
            $user_fund_data['fund_id'] = $request->fund_id;
            $user_fund_data['user_id'] = $user->id;
            $user_funds = User_fund::create($user_fund_data);

            $history_data['user_fund_id'] = $user_funds->id;
            $history_data['type'] = 'user';
            $history_data['status'] = 'pending';
            $history_data['user_id'] =  auth()->user()->id;
            $history_data['note_ar'] = ' بدايه طلب التمويل';
            $history_data['note_en'] = 'Starting Fund Request';
            Fhistory::create($history_data);

            if ($request->file != null) {
                foreach ($request->file as $key => $row) {
                    // This is Image Information ...
                    $file = $row;
                    $ext = $file->getClientOriginalExtension();
                    $size = $file->getSize();
                    // Move Image To Folder ..
                    $fileNewName = 'file' . $size . '_' . time() . '.' . $ext;
                    $file->move(public_path('uploads/fund_file'), $fileNewName);
                    $file_data['user_fund_id'] = $user_funds->id;
                    $file_data['file_ext'] = $ext ;
                    $file_data['file_name'] = $fileNewName;
                    Fund_file::create($file_data);
                }
            }
            return msgdata($request, success(), 'add user fund successfully', ['fund_id'=>$user_funds->id]);
        }
    }
    public function DoPayment($id,$user_id)
    {
        $order = User_fund::find($id);
        $user  = User::find($user_id);
        return view('payment.paymentMethods',compact('order','user'));
    }
    public function payway($payway='visa',$id,$user_id)
    {
        $order = User_fund::find($id);
        if ($order->payment == 'not paid') {
            if ($payway == 'visa') {
                $paymob = new PayMobController;
                return $paymob->checkingOut(env('PAYMOB_VISA_ID'),env('PAYMOB_VISA_IFRAME_ID'),$order->id,$user_id);
            }elseif($payway == 'wallet'){
                $paymob = new PayMobController;
                return $paymob->checkingOut(env('PAYMOB_WALLET_ID'),'wallet',$order->id,$user_id);
            }
        }else{
            return redirect('payment-fail');
        }
    }
}
