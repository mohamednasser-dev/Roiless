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
        $this->folderView = 'admin.investment.';
    }

    public function index()
    {
        $data = $this->objectName::with('Images')->get();
        return view($this->folderView . 'index', compact('data'));
    }
}
