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
use function PHPUnit\Framework\isNull;

class FundController extends Controller
{

    public function details(Request $request, $id)
    {
        try {
            $lang = $request->header('lang');
            if (empty($lang)) {
                $lang = "en";
            }
            $Funddetailes = Fund::select('id', 'name_ar', 'name_en', 'financing_ratio', 'image', 'columns', 'cost', 'fund_amount_ar', 'fund_amount_en', 'annual_income_ar', 'annual_income_en')->where('id', $id)->where('deleted', '0')->first();
            $Funddetailes->cost = number_format((float)($Funddetailes->cost), 2);
            $Funddetailes->columns = json_decode($Funddetailes->columns);
            if ($Funddetailes) {
                $data['Funddetailes'] = $Funddetailes;
                $bank = Bank::select('id','name_' . $lang . ' as name', 'image')->get();
                $data['banks'] = $bank;

                $fields = Company_field::select('id', 'name_' . $lang . ' as name')->get();
                $data['company_field'] = $fields;
                $types = Company_type::select('id', 'name_' . $lang . ' as name')->get();
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
            'bank_id' => 'required',
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
            $user_fund_data['user_bank_id'] = $request->bank_id;
            $user_fund_data['user_id'] = $user->id;
            foreach ($request->dataform as $row) {
                if ($row['name'] == 'fund_amount') {
                    $user_fund_data['cost'] = $row['value'];
                } elseif ($row['name'] == 'Required_fund_amount') {
                    $user_fund_data['cost'] = $row['value'];
                } elseif ($row['name'] == 'property_financed') {
                    $user_fund_data['cost'] = $row['value'];
                } elseif ($row['name'] == 'car_financed') {
                    $user_fund_data['cost'] = $row['value'];
                }
            }
            $user_funds = User_fund::create($user_fund_data);
            $history_data['user_fund_id'] = $user_funds->id;
            $history_data['type'] = 'user';
            $history_data['show_in'] = 'web';
            $history_data['status'] = 'pending';
            $history_data['user_id'] = auth()->user()->id;
            $history_data['note_ar'] = ' بدايه التمويل';
            $history_data['note_en'] = 'Starting Fund Request';
            Fhistory::create($history_data);
            $history_app_data['user_fund_id'] = $user_funds->id;
            $history_app_data['type'] = 'user';
            $history_app_data['show_in'] = 'app';
            $history_app_data['status'] = 'pending';
            $history_app_data['user_id'] = auth()->user()->id;
            $history_app_data['note_ar'] = ' بدايه التمويل';
            $history_app_data['note_en'] = 'Starting Fund Request';
            Fhistory::create($history_app_data);
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
                    $file_data['file_ext'] = $ext;
                    $file_data['file_name'] = $fileNewName;
                    Fund_file::create($file_data);
                }
            }
            return msgdata($request, success(), 'add user fund successfully', ['fund_id' => $user_funds->id]);
        }
    }

    public function DoPayment($id, $user_id)
    {
        $order = User_fund::find($id);
        $user = User::find($user_id);
        return view('payment.paymentMethods', compact('order', 'user'));
    }

    public function payway(Request $request, $payway = 'visa', $id, $user_id)
    {
        $order = User_fund::find($id);
        if ($order->payment == 'not paid') {
            if ($payway == 'visa') {
                $paymob = new PayMobController;
                return $paymob->checkingOut(env('PAYMOB_VISA_ID'), env('PAYMOB_VISA_IFRAME_ID'), $order->id, $user_id, $request->phone);
            } elseif ($payway == 'wallet') {
                $paymob = new PayMobController;
                return $paymob->checkingOut(env('PAYMOB_WALLET_ID'), 'wallet', $order->id, $user_id, $request->phone);
            }
        } else {
            return redirect('payment-fail');
        }
    }

    public function show_phone_page($payway = 'visa', $id, $user_id)
    {
        return view('payment.phone_page', compact('payway', 'id', 'user_id'));
    }

    public function userFund(Request $request,$id)
    {
        $lang = $request->header('lang');
        if (empty($lang)) {
            $lang = "en";
        }
        $data = User_fund::with('Fund')->find($id);
        if ($data) {
            $data->dataform = json_decode($data->dataform);
            $fields = Company_field::select('id', 'name_' . $lang . ' as name')->get();
            $data->company_field = $fields;
                $types = Company_type::select('id', 'name_' . $lang . ' as name')->get();
                $data['company_type'] = $types;
            $data['userFundFils'] = Fund_file::where('user_fund_id', $id)->get();
            return msgdata('', success(), 'user fund is found', $data);
        } else
            return msgdata('', failed(), 'there is no fund found', $data);
    }

    public function deletefile($id)
    {
        $data = Fund_file::where('id', $id)->first();
        if ($data == null) {
            return msgdata('', failed(), 'there is no fundfile', $data);
        } else{
            Fund_file::where('id', $id)->delete();
        }
        return msgdata('', success(), 'file deleted successfully ', '');
    }

    public function updateUserFund(Request $request, $id)
    {
        $user = auth()->user();
        $myJSON = json_encode($request->dataform);
        $rules = [
            'fund_id' => '',
            'dataform' => 'required',
            'file' => '',
            'old_file_ids'=>'',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['status' => 401, 'msg' => $validator->messages()->first()]);
        } else {
            $user_fund_data['dataform'] = json_encode($request->dataform);
            $user_fund_data['user_id'] = $user->id;
            $user_fund_data['user_status'] = 'user_editing';
            $user_funds = User_fund::where('id', $id)->update($user_fund_data);
            $history_data['user_fund_id'] = $id;
            $history_data['type'] = 'user';
            $history_data['show_in'] = 'web';
            $history_data['status'] = 'user_editing';
            $history_data['user_id'] = auth()->user()->id;
            $history_data['note_ar'] = 'تم التعديل على طلب التمويل عن طريق المستخدم';
            $history_data['note_en'] = 'Fund Editing by user';
            Fhistory::create($history_data);
            $history_app_data['user_fund_id'] = $id;
            $history_app_data['type'] = 'user';
            $history_app_data['show_in'] = 'app';
            $history_app_data['status'] = 'user_editing';
            $history_app_data['user_id'] = auth()->user()->id;
            $history_app_data['note_ar'] = 'تم التعديل على الطلب';
            $history_app_data['note_en'] = 'fund order has been modified';
            Fhistory::create($history_app_data);
            if ($request->old_file_ids){

                foreach ($request->old_file_ids as $key => $row ){
                   $oldfile= Fund_file::where('id',$row)->first();
                   if ($oldfile){
                       Fund_file::where('id',$row)->delete();
                   }
                }
            }

            if ($request->file != null) {
                foreach ($request->file as $key => $row) {
                    // This is Image Information ...
                    $file = $row;
                    $ext = $file->getClientOriginalExtension();
                    $size = $file->getSize();
                    // Move Image To Folder ..
                    $fileNewName = 'file' . $size . '_' . time() . '.' . $ext;
                    $file->move(public_path('uploads/fund_file'), $fileNewName);
                    $file_data['user_fund_id'] = $id;
                    $file_data['file_ext'] = $ext;
                    $file_data['file_name'] = $fileNewName;
                    Fund_file::create($file_data);
                }
            }
            return msgdata($request, success(), 'user fund updated successfully', ['fund_id' => $id]);
        }
    }
}
