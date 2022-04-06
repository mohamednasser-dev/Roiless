<?php

namespace App\Http\Controllers\Seller;

use App\DataTables\ProductDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Benefit;
use App\Models\Product;
use App\Models\ProductBenefit;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use RealRashid\SweetAlert\Facades\Alert;
use App\Traits\offerTrait;

class ProductsController extends Controller
{
    protected $viewPath = 'dashboard.products';
    protected $path = 'products';
    private $route = 'seller.products';
    private $image_path = 'products';
    protected $paginate = 30;

    public function index(ProductDataTable $dataTable)
    {
        return $dataTable->render('seller.' . $this->viewPath . '.index');
    }

    use offerTrait;



    public function create()
    {
        $benefits = Benefit::all();
        $sections = Section::where('parent_id',null)->get();
        return view('seller.' . $this->viewPath . '.create', compact('benefits','sections'));
    }
    public function get_sub_sections($id)
    {
        $data = Section::where('parent_id',$id)->get();
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
        $product = Product::create($data);
        if ($request->benefits) {
            foreach ($request->benefits as $key => $row) {
                $product_benefit_row['benefit_id'] = $key;
                $product_benefit_row['product_id'] = $product->id;
                $product_benefit_row['ratio'] = $row;

                ProductBenefit::create($product_benefit_row);
            }
        }
        return redirect()->route($this->route)->with('success', 'تم الاضافه بنجاح');
    }


    public function edit($id)
    {
        $data = Product::findOrFail($id);
        $benefits = Benefit::all();
        return view('seller.' . $this->viewPath . '.edit', compact('data','benefits'));
    }

    public function show($id)
    {
        $data = Product::findOrFail($id);
        $benefits = ProductBenefit::where('product_id',$id)->get();
        return view('seller.' . $this->viewPath . '.show', compact('data','benefits'));
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
        Product::where('id',$id)->update($data);
        if ($request->benefits) {
            foreach ($request->benefits as $key => $row) {
                $product_benefit = ProductBenefit::where('benefit_id',$key)->first();
                if($product_benefit){
                    $product_benefit->ratio = $row ;
                    $product_benefit->save() ;
                }else{
                    $product_benefit_row['benefit_id'] = $key;
                    $product_benefit_row['product_id'] = $id;
                    $product_benefit_row['ratio'] = $row;
                    ProductBenefit::create($product_benefit_row);
                }
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
