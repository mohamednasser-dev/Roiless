<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Consolution;
use App\Models\reply;
use App\Models\consolution_kind;
use Validator;
use Illuminate\Support\Facades\Auth;

class ConsolutionController extends Controller
{
    //  
    public function getall_consolution(Request $request)
    {
      $consolutions=Consolution::select(['id','content','created_at'])->where('user_id',Auth::user()->id)->get()->makeHidden(['UnSeenReply']);
      return msgdata($request, success(), 'get services sucess',$consolutions);
    }
    public function getall_consolution_detailes(Request $request,$id)
    {
      $reply=reply::select('id','reply','created_at','admin_id','user_id')->with('user')->with('admin')->where('consolution_id',$id)->get();
        if($reply){
            reply::where('consolution_id', '=',$id)
             ->update(['seen' => '1']);
        }
        return msgdata($request, success(), 'get services sucess',$reply);
    }
    public function Reply(Request $request)
    {
        $rules = [
            'reply' => 'required|max:255',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['status' => 401, 'msg' => $validator->messages()->first()]);
        } else {
            reply::create([
                'user_id'=>Auth::user()->id,
                'reply'=>$request->reply,
                'consolution_id'=>$request->consolution_id,
                'seen'=>'0'
            ]);
            return msgdata($request, success(), 'add reply successfully',null);
        }
    }
    public function Delete(Request $request,$id)
    {
        $Consolution=Consolution::where('id',$id)->first();
        $Consolution->Delete();
        return msgdata($request, success(), 'consolution deleted successfully',null);
    }
}
