<?php

namespace App\Http\Controllers\Admin\Banko;

use App\Http\Controllers\Controller;
use App\Http\Requests\SellerRequest;
use App\Models\Seller;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Traits\offerTrait;
use Str;
use RealRashid\SweetAlert\Facades\Alert;

class SellerController extends Controller
{


    use offerTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Seller::get();
        return view('admin.banko.sellers.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.banko.sellers.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(SellerRequest $request)
    {
        $data = $request->validated();
        if ($request->image) {
            if ($request->hasFile('image')) {
                $data['image'] = $this->saveImage($request->file('image'), 'uploads/sellers');
            }
        }
        Seller::create($data);
        return redirect()->route('admin.sellers')->with('success', 'تم الاضافه بنجاح');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Seller::findOrFail($id);
        return view('admin.banko.sellers.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(SellerRequest $request, $id)
    {
        $data = $request->validated();
        if ($request->image) {
            if ($request->hasFile('image')) {
                $data['image'] = $this->saveImage($request->file('image'), 'uploads/sellers');
            }
        }
        if (!$request->password) {
            unset($data['password']);
        }
        Seller::where('id', $id)->update($data);
        return redirect()->route('admin.sellers')->with('success', 'تم التعديل بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Slider = Slider::findOrFail($id);
        $Slider->delete();
        activity('admin')->log('تم حذف الاعلان بنجاح');
        // Alert::success('تمت العمليه', 'تم حذف الاعلان بنجاح');
        return redirect()->route('sliders')->with('success', trans('تم حذف الاعلان بنجاح'));;

    }
}
