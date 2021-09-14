<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Traits\offerTrait;
use RealRashid\SweetAlert\Facades\Alert;


class sliderController extends Controller
{


    use offerTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            $Sliders = Slider::all();
        return view ('admin.sliders.index' , compact('Sliders'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('admin.sliders.add' );

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $file_name = $this->saveImage($request->file('image'),'uploads/slider' );


        $Slider = Slider::create([
            'image' => $file_name,
        ]);
        Alert::success('تمت العمليه', 'تم اضافه الاعلان بنجاح');
        return redirect()->route('sliders');
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
       $Slider=Slider::findOrFail($id);

       return view ('admin.sliders.edit',compact('Slider') );
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

        $Slider=Slider::findOrFail($id);


            $file_name = $this->saveImage($request->file('image'),'uploads/slider' );
            $Slider->update([
                'image' => $file_name,
            ]);
        Alert::success('تمت العمليه', 'تم تعديل الاعلان بنجاح');


        return redirect()->route('sliders');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Slider=Slider::findOrFail($id);
        $Slider->delete();
        Alert::success('تمت العمليه', 'تم حذف الاعلان بنجاح');

         return redirect()->route('sliders');

    }
}
