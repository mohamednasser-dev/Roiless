<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Fund;

use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function getall(Request $request)
    {
        $category = Category::where('type','cat')->select('id', 'title_ar', 'title_en', 'image')->with('Funds')->get();
        return msgdata($request, success(), 'get categories success', $category);
    }
}
