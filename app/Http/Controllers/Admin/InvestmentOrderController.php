<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Investment;
use App\Models\InvestmentOrder;

class InvestmentOrderController extends Controller
{
    public $objectName;
    public $folderView;

    public function __construct(InvestmentOrder $model)
    {
        $this->middleware('permission:investments');
        $this->objectName = $model;
        $this->folderView = 'admin.investmentOrder.';
    }

    public function index()
    {
        $data = $this->objectName::with('Images')->get();
        return view($this->folderView . 'index', compact('data'));
    }
    public function view($id){
        $data=$this->objectName::findorfail($id);
        $data->with('images')->get();
        return view($this->folderView . 'view', compact('data'));

    }
}
