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
    public function getall_consolution()
    {
      $consolutions=Consolution::select(['id','content','created_at'])->where('user_id',Auth::user()->id)->get()->makeHidden(['UnSeenReply']);
      return  response()->json([$consolutions]);
    }
    public function getall_consolution_detailes($id)
    {
      $reply=reply::select('reply')->where('consolution_id',$id)->get();
        if($reply)
        {
            reply::where('consolution_id', '=',$id)
             ->update(['seen' => '1']);
        }
      return  response()->json([$reply]);
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
                'seen'=>'1'
            ]);
            return response()->json(['status' => '200', 'msg' => 'add reply successfully']);
        }
    }
    public function Delete($id)
    {
        $Consolution=Consolution::where('id',$id)->first();
        $Consolution->Delete();
        return response()->json(['status' => '200', 'msg' => 'consolution deleted successfully']);
    }
}
