<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\InvestmentRequest;
use App\Models\Investment;

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

    }

    public function edit($id)
    {
        $data = $this->objectName::findorfail($id);
        return view($this->folderView . 'edit', compact('data'));
    }

}
