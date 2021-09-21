<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Traits\offerTrait;
use RealRashid\SweetAlert\Facades\Alert;


class categoriesController extends Controller
{


    use offerTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::where('type','cat')->get();
        return view ('admin.categories.index' , compact('categories'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('admin.categories.add' );

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $file_name = $this->saveImage($request->file('image'),'uploads/category' );


        $Category = Category::create([
            'title_ar' => $request->title_ar,
            'title_en' => $request->title_en,
            'image' => $file_name,


        ]);
        activity('admin')->log('تم اضافه القسم بنجاح');

        Alert::success('تمت العمليه', 'تم اضافه القسم بنجاح');
        return redirect()->route('categories');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $category=Category::findOrFail($id);

       return view ('admin.categories.edit',compact('category') );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $category=Category::findOrFail($id);


        if($request->hasFile('image')) {
            $file_name = $this->saveImage($request->file('image'),'uploads/category' );
            $category->update([
                'title_ar' => $request->title_ar,
                'title_en' => $request->title_en,
                'image' => $file_name,
            ]);
        }else{
            $category->update([
                'title_ar' => $request->title_ar,
                'title_en' => $request->title_en,

            ]);
        }
        activity('admin')->log('تم تحديث القسم بنجاح');

        Alert::success('تمت العمليه', 'تم تعديل القسم');

        return redirect()->route('categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category=Category::findOrFail($id);
        $category->delete();
        activity('admin')->log('تم حذف القسم بنجاح');

        Alert::success('تمت العمليه', 'تم الحذف بنجاح');

        return redirect()->route('categories');

    }
}
