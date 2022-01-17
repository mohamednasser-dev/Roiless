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

    public function category_funds(Request $request,$id)
    {
        $lang = $request->header('lang');
        if (empty($lang)) {
            $lang = "ar";
        }
        $id = AUth::user()->id;
        $funds = Fund::select(['id', 'name_ar', 'name_en', 'desc_ar', 'desc_en', 'cat_id', 'image'])
            ->where('featured', '1')->where('cat_id', $id)->where('appearance', '1')->where('deleted', '0')->get();
        return msgdata($request, success(), 'update_profile_success', $funds);
    }
}
