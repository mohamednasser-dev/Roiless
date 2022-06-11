<?php

namespace App\Http\Controllers\Admin\Banko;

use App\Http\Controllers\Controller;
use App\Models\Section;
use Illuminate\Http\Request;
use App\Traits\offerTrait;

class SectionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:categories');
    }

    use offerTrait;

    public function index()
    {
        $categories = Section::where('parent_id',null)->get();
        return view('admin.banko.sections.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.banko.sections.add');
    }
    public function create_custom($id)
    {
        return view('admin.banko.sections.add_custom',compact('id'));
    }
    public function show($id)
    {
        $categories = Section::where('parent_id',$id)->get();
        return view('admin.banko.sections.sub_sections',compact('id','categories'));
    }

    public function store(Request $request)
    {
        $file_name = $this->saveImage($request->file('image'), 'uploads/section');

        $Category = Section::create([
            'title_ar' => $request->title_ar,
            'title_en' => $request->title_en,
            'parent_id'=> $request->parent_id ,
            'image' => $file_name,
        ]);
        activity('admin')->log(trans('admin.add_category'));
//        Alert::success(trans('admin.add_category_success'), trans('admin.opretion_success'));
        if($request->parent_id){
            return redirect()->route('sections.show',$request->parent_id)->with('success', trans('admin.add_category_success'));
        }else{
            return redirect()->route('sections')->with('success', trans('admin.add_category_success'));

        }
    }


    public function edit($id)
    {
        $category = Section::findOrFail($id);
        return view('admin.banko.sections.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = Section::findOrFail($id);
        if ($request->hasFile('image')) {
            $file_name = $this->saveImage($request->file('image'), 'uploads/section');
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
        return redirect()->route('sections')->with('success', trans('admin.edit_category_success'));
    }

    public function destroy($id)
    {
        try {
            $category = Section::findOrFail($id);
            $category->delete();
            activity('admin')->log('تم حذف القسم بنجاح');
//        Alert::success('تمت العمليه', 'تم الحذف بنجاح');
            return redirect()->route('sections')->with('success', 'تم الحذف بنجاح');
        }catch (\Exception $ex){
            return redirect()->route('sections')->with('danger', 'لم يتم الحذف لوجود اقسام فرعية أو منتجات داخل القسم المختار');

        }
    }
}
