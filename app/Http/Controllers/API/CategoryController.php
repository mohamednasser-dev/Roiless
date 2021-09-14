<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Fund;

use Illuminate\Http\Request;

class CategoryController extends Controller
{

 
    //
   public function getall(Request $request)
       {
         try{
          $lang = $request->header('lang');
          Session()->put('api_lang',$lang);
          $category=Category::select('id','title_'.$lang.' as title','image')->with('Funds')->get();
        }catch(Exception $e){
          return  $this->returnError($e->getCode(), $e->getMessage());
        }
         return response()->json(['data'=>$category]);
       }
}
