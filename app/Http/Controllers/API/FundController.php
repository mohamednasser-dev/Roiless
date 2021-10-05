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

class FundController extends Controller
{

    public function getfunddetailes(Request $request, $id)
    {
        try {
            $lang = $request->header('lang');
            if (empty($lang)) {
                $lang = "en";
            }
            $Funddetailes = Fund::select('id', 'name_' . $lang . ' as name', 'image', 'columns','cost')->where('id', $id)->first();
            $Funddetailes->columns = json_decode($Funddetailes->columns);
            if ($Funddetailes) {
                $data['Funddetailes'] = $Funddetailes;
                $bank = Bank::select('name_' . $lang . ' as name', 'image')->get();
                $data['banks'] = $bank;

                $fields = Company_field::select('id','name_' . $lang . ' as name')->get();
                $data['Company_fields'] = $fields;
                $types = Company_type::select('id','name_' . $lang . ' as name')->get();
                $data['Company_types'] = $types;
                return msgdata($request, success(), 'funddetailes_success', $data);
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
        if ($request->file) {
            $length = count($request->file);
            foreach ($request->file as $key => $row) {
                $image = $request->file[$key]['value'];  // your base64 encode
                $image = str_replace('data:image/png;base64,', '', $image);
                $ext = $request->file[$key]['ext'];
                $imageName[$key] = Str::random(12) . '.' . $ext;
                \File::put('uploads/fund_file/' . $imageName[$key], base64_decode($image));
            }
        }
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
                    $file_data['user_fund_id'] = $user_funds->id;
                    $file_data['file_ext'] = $request->file[$key]['ext'] ;
                    $file_data['file_name'] = $imageName[$key];
                    Fund_file::create($file_data);
                }
            }
            return response()->json(['status' => '200', 'msg' => 'add user fund successfully']);
        }
    }
}
