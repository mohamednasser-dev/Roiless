<?php

namespace App\Http\Controllers\API\Banko;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;

class ProductController extends Controller
{

    public function details(Request $request, $id)
    {
        $data = Product::with(['Seller', 'Section', 'SubSection'])->where('status', 'accepted')->where('stars', 1)->find($id);
        if ($data) {
            return msgdata($request, success(), 'تم عرض البيانات', $data);
        } else {
            return msg($request, failed(), 'يجب اختيار منتج صحيح');
        }
    }
}
