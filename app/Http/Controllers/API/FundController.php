<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
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
            $Funddetailes=Fund::select('id','name_'.$lang.' as name','image','columns')->where('id',$id)->first();
            $bank=Bank::select('name_'.$lang.' as name','image')->get();
            $Funddetailes->columns =json_decode($Funddetailes->columns);
            if($Funddetailes)
            {
              $data['Funddetailes']=$Funddetailes;
              $data['banks']=$bank;
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

        //  return response()->json(["dataform"=>$user]);
        try {
            $rules = [
                'fund_id' => 'required',
                'dataform' => 'required',
                'file' => 'required',
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($request->file) {
                    $length= count($request->file);
                    for($i=0;$i<$length;$i++)
                    {
                        $image = $request->file[0];  // your base64 encoded
                        $image = str_replace('data:image/png;base64,', '', $image);
                        $image = str_replace(' ', '+', $image);
                        $imageName[$i] = Str::random(8).'.'.'png';
                        \File::put('uploads/fund_file/' . $imageName[$i], base64_decode($image));
                    }
            }
            if ($validator->fails()) {
                return response()->json(['status' => 401, 'msg' => $validator->messages()->first()]);
              }else{
                  $fund=Fund::find($request->fund_id);  
                  $user_funds=$user->Funds()->attach($request->fund_id,
                  [
                    'fund_amount'=>$fund->cost,
                    'dataform'=>json_encode($request->dataform),
                  ]        
                ); 
                $user_fund=User_Fund::latest()->first();
                for($i=0;$i<$length;$i++)
                {
                    $user_fund->fund_file()->create(['file_name'=>$imageName[$i]]);
                }    
               return response()->json(['status'=>'200','msg'=>'add user fund successfully']);
              }  
              }catch(Exception $e){
              }
          }  
 }
