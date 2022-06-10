<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use App\Models\Service_details;
use App\Models\Services;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;


class CityController extends Controller
{
    public $objectName;
    public $folderView;

    public function __construct(City $model)
    {
//        $this->middleware('permission:cities');
        $this->objectName = $model;
        $this->folderView = 'admin.cities.';
    }


    public function index()
    {
        $data = City::get();
        return view($this->folderView . 'index', compact('data'));
    }


    public function create()
    {
        return view($this->folderView . 'create');
    }


    public function store(Request $request)
    {
        $data = $this->validate(request(),
            [
                'name_ar' => 'required|string|max:255',
                'name_en' => 'required|string|max:255',
                'country_code' => 'required|string|max:255',
            ]);
            City::create($data);
            activity('admin')->log('تم الاضافة بنجاح');
            DB::commit();
            // Alert::success('تمت العمليه', 'تم اضافه الخدمه بنجاح');
            return redirect()->route('cities')->with('success', trans('تم اضافه الخدمه بنجاح'));

    }

    public function edit($id)
    {
        $data = City::where('id', $id)->first();
        return view($this->folderView . 'edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = $this->validate(\request(),
            [
                'name_ar' => 'required|string|max:255',
                'name_en' => 'required|string|max:255',
                'country_code' => 'required|string|max:255',
            ]);
        try {
            DB::beginTransaction();
            City::find($id)->update($data);
            DB::commit();
            // Alert::success('تمت العمليه', 'تم التحديث بنجاح');
            return redirect()->route('cities')->with('success', trans('تم التحديث بنجاح'));
        } catch (\Exception $ex) {
            DB::rollback();
            Alert::warning('هنالك خطاء', 'لم يتم التحديث');
            return redirect()->route('cities');
        }
    }

    public function destroy($id)
    {
        $Services = City::findOrFail($id);
        $Services->delete();
        Alert::success('تمت العمليه', 'تم الحذف بنجاح');
        return redirect()->back();
    }

}
