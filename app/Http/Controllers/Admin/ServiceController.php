<?php

namespace App\Http\Controllers\Admin;

use App\Models\Service_details;
use App\Models\Services;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;



class ServiceController extends Controller
{
    public $objectName;
    public $folderView;

    public function __construct(Services $model)
    {
        $this->middleware('permission:Services');
        $this->objectName = $model;
        $this->folderView = 'admin.service.';
    }


    public function index()
    {

        $Services = $this->objectName::get();
        return view($this->folderView . 'index', compact('Services'));
    }



    public function create()
    {

        return view($this->folderView . 'create');
    }


    public function store(Request $request)
    {

        $data = $this->validate(request(),
            [
                'title_ar' => 'required',
                'title_en' => 'required',
                'image' => '',

            ]);
        try
        {
            DB::beginTransaction();
        //store images
        if ($request->image != null) {
            $data['image'] = $this->MoveImage($request->image, 'uploads/services');
        }


        $Service = Services::create($data);

        foreach ($request->rows as $row) {
            if ($row['title_ar'] != null && $row['title_en'] != null && $row['desc_ar'] != null && $row['desc_en'] != null) {

                $row['Service_id'] = $Service->id;
                Service_details::create($row);
            }
        }
            activity('admin')->log('تم اضافه الخدمه بنجاح');

            DB::commit();
            // Alert::success('تمت العمليه', 'تم اضافه الخدمه بنجاح');
            return redirect()->route('services')->with('success',trans('تم اضافه الخدمه بنجاح'));

        } catch (\Exception $ex) {

            DB::rollback();
            Alert::warning('هنالك خطاء', 'لم يتم التحديث');

            return redirect()->route('services');

        }
    }

    public function edit($id)
    {
         $Service = $this->objectName::where('id', $id)->first();
        return view($this->folderView . 'edit', compact('Service'));
    }

    public function update(Request $request, $id)
    {
//        dd($request->all());
        $data = $this->validate(\request(),
            [
                'title_ar' => 'required',
                'title_en' => 'required',
                'image' => '',

            ]);

        try
        {
            DB::beginTransaction();

            $Service = $this->objectName::find($id);
            if (!$Service){
                // Alert::warning('خطاء', 'هذه الخدمه ليست موجوه');
            return redirect()->route(' $this->folderView')->with('danger',trans('هذه الخدمه ليست موجوه'));
            }
            

            if($request->hasFile('image')) {
                $file_name = $this->MoveImage($request->file('image'),'uploads/services' );
                $data['image'] = $file_name;
            }

            $this->objectName::where('id',$id)->update($data);


            DB::commit();
            // Alert::success('تمت العمليه', 'تم التحديث بنجاح');
            return redirect()->route('services')->with('success',trans('تم التحديث بنجاح'));

        } catch (\Exception $ex) {

            DB::rollback();
            Alert::warning('هنالك خطاء', 'لم يتم التحديث');

            return redirect()->route('services');

        }
    }



    public function destroy($id)
    {
        $Services=$this->objectName::findOrFail($id);
        $Services->delete();
        Alert::success('تمت العمليه', 'تم الحذف بنجاح');

        return redirect()->back();
    }

    public function details($id)
    {
        $services_details = Service_details::where('service_id',$id)->get();
        return view($this->folderView . 'details.details',compact('services_details','id'));

    }

    public function detcreate($id)
    {
        $services_details = Service_details::where('service_id',$id)->get();
        return view($this->folderView . 'details.create' ,compact('services_details','id'));
    }


    public function detstore(Request $request)
    {
        $data = $this->validate(request(),
            [
                'title_ar' => 'required',
                'title_en' => 'required',
                'desc_ar' => 'required',
                'desc_en' => 'required',
                'service_id' => 'required',

            ]);

            $service_details = Service_details::create($data);


            // Alert::success('تمت العمليه', 'تم الاضافه بنجاح');
            return redirect()->route('services.details',$request->service_id)->with('success',trans('تم الاضافه بنجاح'));


    }

    public function detedit($id)
    {
        $service_details = Service_details::where('id', $id)->first();
        return view($this->folderView . 'details.edit', compact('service_details'));
    }

    public function detupdate(Request $request, $id)
    {
//return $request;
        $data = $this->validate(\request(),
            [
                'title_ar' => 'required',
                'title_en' => 'required',
                'desc_ar' => 'required',
                'desc_en' => 'required',

            ]);


            Service_details::where('id',$id)->update($data);

            // Alert::success('تمت العمليه', 'تم التعديل بنجاح');
        return redirect()->route('services.details',$request->service_id)->with('success',trans('تم التعديل بنجاح'));;

    }

    public function detdestroy($id)
    {
        $Services=Service_details::findOrFail($id);
        $Services->delete();
        Alert::success('تمت العمليه', 'تم حذف بنجاح');

        return redirect()->back();
    }

}
