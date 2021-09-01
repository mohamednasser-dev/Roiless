<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Traits\offerTrait;



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
            $categories = Category::all();
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
        $file_name = $this->saveImage($request->file('image'),'images/category' );
        

        $Category = Category::create([
            'title_ar' => $request->title_ar,
            'title_en' => $request->title_en,
            'image' => $file_name,
            'financing_ratio' => $request->financing_ratio,


        ]);
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
        $file_name = $this->saveImage($request->file('image'),'images/category' );  
        $category=Category::findOrFail($id);
        $category->update([
            'title_ar' => $request->title_ar,
            'title_en' => $request->title_en,
            'image' => $file_name,
            'financing_ratio' => $request->financing_ratio,


        ]);
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

         return redirect()->back();

    }
}
