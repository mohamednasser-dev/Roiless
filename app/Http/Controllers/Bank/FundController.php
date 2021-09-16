<?php

namespace App\Http\Controllers\Bank;

use App\Http\Controllers\Controller;
use App\Models\Bank_Fund;
use Illuminate\Http\Request;

class FundController extends Controller
{
    public function getFund() {
        return Bank_Fund::where('bank_id', \Auth::guard('bank')->user()->id)->get();
    }
}
