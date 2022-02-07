<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\InvestmentRequest;
use App\Models\Investment;
use Illuminate\Http\Request;

class InvestmentController extends Controller
{
    public $objectName;
    public $folderView;

    public function __construct(Investment $model)
    {
        $this->middleware('permission:investments');
        $this->objectName = $model;
        $this->folderView = 'admin.investment.';
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

    public function store(InvestmentRequest $request)
    {
        $data = $request->validated();
        $data['image'] = uploadImage($request->image,'investment' );
         $this->objectName::create($data);
        return redirect()->route('investment')->with('success','تم الاضافه بنجاح');
    }

    public function edit($id)
    {
        $data = $this->objectName::findorfail($id);
        return view($this->folderView . 'edit', compact('data'));
    }
    public function update(InvestmentRequest $request,$id){

        $data = $request->validated();
        $item = $this->objectName->find($id);
        if ($request->hasFile('image')) {
            $data['image'] = uploadImage($request->image,'investment' );
        }
        $item->update($data);
        return redirect()->route('investment')->with('success','تم التعديل بنجاح');

    }
    public function delete(Request $request, $id)
    {
        $data = $this->objectName::findorfail($id);
        $data->delete();
        return redirect()->back()->with('success', 'تم الحذف بنجاح');
    }

}
