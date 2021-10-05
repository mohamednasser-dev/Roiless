<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Consolution;
use Illuminate\Support\Facades\Auth;
use App\Models\reply;

class ConsolutionController extends Controller
{
    //

    public function index()
    {
        $consolutions = Consolution::get();
        return view('admin.consolution.index', compact('consolutions'));
    }
    public function show($id)
    {
        $consolution = Consolution::find($id);
    
        $replies = reply::where('consolution_id','=',$id)->get();
       
        return view('admin.consolution.consolution_show', compact('consolution','replies'));
    }
    public function admin_reply(Request $request)
    {
       
       reply::create([
         
           'consolution_id'=>$request->consulation_id,
           'admin_reply'=>$request->admin_reply,
           'admin_id'=>Auth::user()->id
       ]);
       return back();
    }
}
