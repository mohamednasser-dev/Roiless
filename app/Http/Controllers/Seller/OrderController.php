<?php

namespace App\Http\Controllers\Seller;

use App\DataTables\OrderDataTable;
use App\DataTables\ProductDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Benefit;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductBenefit;
use App\Models\ProductImage;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use RealRashid\SweetAlert\Facades\Alert;
use App\Traits\offerTrait;

class OrderController extends Controller
{
    protected $viewPath = 'dashboard.order';
    protected $path = 'orders';
    private $route = 'seller.orders';
    private $image_path = 'orders';
    protected $paginate = 30;
    use offerTrait;

    public function index(OrderDataTable $dataTable)
    {
        return $dataTable->render('seller.' . $this->viewPath . '.index');
    }

    public function create()
    {
        $benefits = Benefit::all();
        $sections = Section::where('parent_id', null)->get();
        return view('seller.' . $this->viewPath . '.create', compact('benefits', 'sections'));
    }

    public function get_sub_sections($id)
    {
        $data = Section::where('parent_id', $id)->get();
        return view('seller.' . $this->viewPath . '.parts.sub_sections', compact('data'));
    }

    public function store(ProductRequest $request)
    {
        $data = $request->validated();
        unset($data['_token']);
        if ($request->image) {
            if ($request->hasFile('image')) {
                $data['image'] = $this->saveImage($request->file('image'), 'uploads/products');
            }
        } else {
            unset($data['image']);
        }
        unset($data['benefits']);
        $data['seller_id'] = auth()->guard('seller')->user()->id;
//        if($request->sub_section_id){
//            $data['section_id'] = $request->sub_section_id ;
//        }
//        unset($data['sub_section_id']);

        $product = Product::create($data);
        if ($request->benefits) {
            foreach ($request->benefits as $key => $row) {
                if($row != null){
                    $product_benefit_row['benefit_id'] = $key;
                    $product_benefit_row['product_id'] = $product->id;
                    $product_benefit_row['ratio'] = $row;
                    ProductBenefit::create($product_benefit_row);
                }
            }
        }
        if ($request->images) {
            foreach ($request->images as $image) {
                ProductImage::create([
                    'image' => $image,
                    'product_id' => $product->id
                ]);
            }
        }
        return redirect()->route($this->route)->with('success', 'تم الاضافه بنجاح');
    }


    public function edit($id)
    {
        $data = Product::findOrFail($id);
        $benefits = Benefit::all();
        $sections = Section::where('parent_id', null)->get();
        if ($data->sub_section_id) {
            $sub_sections = Section::where('parent_id', $data->section_id)->get();
        } else {
            $sub_sections = [];
        }
        return view('seller.' . $this->viewPath . '.edit', compact('data', 'benefits', 'sections', 'sub_sections'));
    }

    public function uploadImages(Request $request)
    {
        $file = $request->file('dzfile');
        $image = time() . uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads') . '/' . 'products', $image);
        return response()->json([
            'name' => $image,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }


    public function change_status($status, $id)
    {
        Order::whereId($id)->update(['status' => $status]);
        return redirect()->back()->with('success', 'تم تعديل حالة الطلب بنجاح');
    }


    public function image_delete($id)
    {
        $data = ProductImage::findOrFail($id);
        $data->delete();
        return back()->with('success', 'تم حذف الصوره بنجاج');
//        if (ProductImage::where('product_id', $data->car_id)->count() > 1) {
//
//        } else {
//            return back()->with('danger', 'لا يمكن حذف , لابد من وجود علي الاقل صوره واحده');
//        }
    }

    public function show($id)
    {
        $data = Product::findOrFail($id);
        $benefits = ProductBenefit::where('product_id', $id)->get();
        return view('seller.' . $this->viewPath . '.show', compact('data', 'benefits'));
    }

    public function update(ProductRequest $request, $id)
    {
        $data = $request->validated();
        unset($data['_token']);
        if ($request->image) {
            if ($request->hasFile('image')) {
                $data['image'] = $this->saveImage($request->file('image'), 'uploads/products');
            }
        } else {
            unset($data['image']);
        }
        unset($data['benefits']);
        $data['seller_id'] = auth()->guard('seller')->user()->id;
        Product::where('id', $id)->update($data);
        if($request->type != 'direct_installment'){
            ProductBenefit::where('product_id',$id)->delete();
        }else{
            if ($request->benefits) {
                foreach ($request->benefits as $key => $row) {
                    $product_benefit = ProductBenefit::where('product_id',$id)->where('benefit_id', $key)->first();
                    if ($product_benefit) {
                        if($row != null) {
                            $product_benefit->ratio = $row;
                            $product_benefit->save();
                        }
                    } else {
                        if($row != null){
                            $product_benefit_row['benefit_id'] = $key;
                            $product_benefit_row['product_id'] = $id;
                            $product_benefit_row['ratio'] = $row;
                            ProductBenefit::create($product_benefit_row);
                        }

                    }
                }
            }
        }
        if ($request->images) {
            foreach ($request->images as $image) {
                ProductImage::create([
                    'image' => $image,
                    'product_id' => $id
                ]);
            }
        }
        return redirect()->route($this->route)->with('success', 'تم التعديل بنجاح');
    }

    public function delete($id)
    {
        $data = Product::findOrFail($id);
        $data->delete();
        return redirect()->back()->with('success', 'تم الحذف بنجاح');
    }
}
