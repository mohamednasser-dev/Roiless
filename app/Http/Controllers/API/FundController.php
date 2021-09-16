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
use Illuminate\Http\Request;

class FundController extends Controller
{
      
    public function getfunddetailes(Request $request,$id)
    {
          try{
            $lang = $request->header('lang');
            if(empty($lang))
            {
              $lang="en";
            }
            $Funddetailes=Fund::select('id','name_'.$lang.' as name','image','columns')->where('id',$id)->first();
            $bank=Bank::select('name_'.$lang.' as name','image')->get();
            $Funddetailes->columns =json_decode($Funddetailes->columns);
            if($Funddetailes)
            {
              $data['Funddetailes']=$Funddetailes;
              $data['banks']=$bank;
              return msgdata($request, success(), 'funddetailes_success', array('data' =>$data));
              return response()->json(['data'=>$Funddetailes]);
            }
          
          }catch(Exception $e){
            return  $this->returnError($e->getCode(), $e->getMessage());
          } 
    }
    public function addfund(Request $request)
    {
      $user = auth()->user();
      
      $myJSON = json_encode($request->dataform);
    
    //  return response()->json(["dataform"=>$user]);
        try{
                $rules = [
                  'fund_id'=>'required',
                  'dataform'=>'required',
                  'file' => 'required',
                 ];
              $validator = Validator::make($request->all(), $rules);
              if ($request->hasFile('file'))
              {
                    // Get filename with the extension
                    $filenameWithExt = $request->file('file')->getClientOriginalName();
                    //Get just filename
                    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    // Get just ext
                    $extension = $request->file('file')->getClientOriginalExtension();
                    // Filename to store
                    $fileNameToStore = $filename.'_'.time().'.'.$extension;
                    // Upload Image
                    $path = $request->file('file')->storeAs('public/Documents/Funds_file',$fileNameToStore);
              }
              if ($validator->fails())
              {
                return response()->json(['status' => 401, 'msg' => $validator->messages()->first()]);
              }else{
                  $fund=Fund::find($request->fund_id);  
            //    return response()->json(["fdf"=>$fund->id]);
                  $user_funds=$user->Funds()->attach($request->fund_id,
                  [
                    'fund_amount'=>$fund->cost,
                    'dataform'=>json_encode($request->dataform),
                  ]        
                ); 
                $intialpass="kkkk";
                $user_fund=User_Fund::latest()->first();
                $user_fund->fund_file()->create(['file_name'=>$intialpass]);
               // Fund_file::create(['user_fund_id'=>$user_fund,'file_name'=>$intialpass]);
              }  
              }catch(Exception $e){

              }

          }  
  
 }



