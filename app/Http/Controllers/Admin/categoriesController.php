<?php
namespace App\Http\Controllers\Admin;
//use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\offerTrait;
use App\Models\Category;
class categoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:categories');
    }
    use offerTrait;
    public function index()
    {
        $categories = Category::where('type', 'cat')->get();
        return view('admin.categories.index', compact('categories'));
    }
    public function create()
    {
        return view('admin.categories.add');
    }
    public function store(Request $request)
    {
        $file_name = $this->saveImage($request->file('image'), 'uploads/category');
        $Category = Category::create([
            'title_ar' => $request->title_ar,
            'title_en' => $request->title_en,
            'image' => $file_name,
        ]);
        activity('admin')->log(trans('admin.add_category'));
//        Alert::success(trans('admin.add_category_success'), trans('admin.opretion_success'));
        return redirect()->route('categories')->with('success',trans('admin.add_category_success'));
    }
    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        if ($request->hasFile('image')) {
            $file_name = $this->saveImage($request->file('image'), 'uploads/category');
            $category->update([
                'title_ar' => $request->title_ar,
                'title_en' => $request->title_en,
                'image' => $file_name,
            ]);
        } else {
            $category->update([
                'title_ar' => $request->title_ar,
                'title_en' => $request->title_en,

            ]);
        }
        activity('admin')->log(trans('admin.edit_category_success'));
//        Alert::success(trans('admin.edit_category_success'), trans('admin.opretion_success'));
        return redirect()->route('categories')->with('success',trans('admin.edit_category_success'));
    }
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        activity('admin')->log('تم حذف القسم بنجاح');
//        Alert::success('تمت العمليه', 'تم الحذف بنجاح');
        return redirect()->route('categories')->with('success','تم الحذف بنجاح');
    }
}
