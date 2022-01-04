<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Fund;

use App\Models\User_Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{

    public function getall(Request $request)
    {
        $category = Category::where('type','cat')->select('id', 'title_ar', 'title_en', 'image')->with('Funds')->get();

        $id = Auth::user()->id;

        $data['categories'] = $category;
        $seen = User_Notification::select('seen')->where('user_id', $id)->where('seen', 0)->count();
        $data['unseen'] = $seen;
        return msgdata($request, success(), 'get categories success', $data);
    }
}
