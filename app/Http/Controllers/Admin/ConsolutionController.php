<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Consolution;
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
}
