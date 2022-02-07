<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\InvestmentRequest;
use App\Http\Requests\InvestmentTyprReques;
use App\Models\Investment;
use App\Models\InvestmentType;
use Illuminate\Http\Request;

class InvestmentTypeController extends Controller
{

    public $objectName;
    public $folderView;

    public function __construct(InvestmentType $model)
    {
        $this->middleware('permission:investments');
        $this->objectName = $model;
        $this->folderView = 'admin.investmentType.';
    }

    public function index()
    {
        $data = $this->objectName::get();
        return view($this->folderView . 'index', compact('data'));
    }

    public function create()
    {
        return view($this->folderView . 'create');
    }

    public function store(InvestmentTyprReques $request)
    {
        $data = $request->validated();
        $this->objectName::create($data);
        return redirect()->route('investmentType')->with('success','تم الاضافه بنجاح');
    }

    public function edit($id)
    {
        $data = $this->objectName::findorfail($id);
        return view($this->folderView . 'edit', compact('data'));
    }
    public function update(InvestmentTyprReques $request,$id){

        $data = $request->validated();
        $item = $this->objectName->find($id);
        $item->update($data);
        return redirect()->route('investmentType')->with('success','تم التعديل بنجاح');

    }
    public function delete(Request $request, $id)
    {
        $data = $this->objectName::findorfail($id);
        $data->delete();
        return redirect()->back()->with('success', 'تم الحذف بنجاح');
    }

}
