<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\category;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
   public function getall()
       {
         $category=category::with('fund')->get();
         return response()->json(['data'=>$category]);
       }


}
