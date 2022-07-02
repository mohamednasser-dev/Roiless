<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Benefit;
use App\Models\Product;
use App\Models\Section;
use Validator;
use Str;

class ProductController extends Controller
{
    public function section_child($id)
    {
        $data = Section::where('parent_id', $id)->get();
        if (count($data) == 0) {
            $data = Product::where('status', 'accepted')->where('section_id', $id)->with('SellerInfo')->paginate(15);
            return view('front.products.section_products', compact('data'));
        }
        return view('front.products.section_child', compact('data'));
    }

    public function section_products($id)
    {
        $data = Product::where('status', 'accepted')->where('sub_section_id', $id)->with('SellerInfo')->paginate(1);
        return view('front.products.section_products', compact('data'));
    }

    public function product_details($id)
    {
        $data = Product::find($id);
        $related_products = Product::where('id', '!=', $data->id)->where('seller_id', $data->seller_id)->paginate(20);
        $benefits = Benefit::all();
        return view('front.products.product_details', compact('data', 'related_products','benefits'));
    }

}
