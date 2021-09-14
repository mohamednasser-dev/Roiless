<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Fund;

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
    $Funddetailes->columns =json_decode($Funddetailes->columns);
    if($Funddetailes)
    {
      return msgdata($request, success(), 'funddetailes_success', array('funddetailes' =>$Funddetailes));
      return response()->json(['data'=>$Funddetailes]);
    }
   
  }catch(Exception $e){
    return  $this->returnError($e->getCode(), $e->getMessage());
  }
   
 }
 }



