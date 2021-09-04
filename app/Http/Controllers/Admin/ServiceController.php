<?php

namespace App\Http\Controllers\Admin;

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
        $this->objectName = $model;
        $this->folderView = 'admin.service.';
    }


    public function index()
    {

        $Services = $this->objectName::paginate(10);
        return view($this->folderView . 'service', compact('Services'));
    }



    public function create()
    {

        return view($this->folderView . 'create_service');
    }

    public function store(Request $request)
    {

        $data = $this->validate(request(),
            [
                'title_ar' => 'required',
                'title_en' => 'required',
                'image' => '',

            ]);

        //store images
        if ($request->image != null) {
            $data['image'] = $this->MoveImage($request->image, 'uploads/services');
        }

        $Service = Services::create($data);
        if ($Service->save()) {
            Alert::success('تمت العمليه', 'تم انشاء خدمه جديده');

            return redirect(url('services'));
        }

    }

    public function edit($id)
    {
         $Service = $this->objectName::where('id', $id)->first();
        return view($this->folderView . 'edit', compact('Service'));
    }

    public function update(Request $request, $id)
    {
        $data = $this->validate(\request(),
            [
                'title_ar' => 'required',
                'title_en' => 'required',
                'image' => '',

            ]);
        try {
            DB::beginTransaction();

            $Service = $this->objectName::find($id);
            if (!$Service){
                Alert::warning('خطاء', 'هذه الخدمه ليست موجوه');
            return redirect()->route(' $this->folderView');
            }


            if ($request->image != null) {
                $image = $this->MoveImage($request->image, 'uploads/services');


                $this->objectName::where('id', $id)
                    ->update([
                        'image' => $image,
                    ]);
            }

            $Service->update($request->except('_token', 'id', 'photo'));
            $Service->save();


            DB::commit();
            Alert::success('تمت العمليه', 'تم تحديث الخدمه بنجاح');
            return redirect()->route('services');

        } catch (\Exception $ex) {

            DB::rollback();
            Alert::warning('هنالك خطاء', 'لم يتم التحديث');

            return redirect()->route('services');

        }
    }

    public function update_Actived(Request $request)
    {
        $data['status'] = $request->status;
        $user = User::where('id', $request->id)->update($data);
        return 1;
    }

    public function destroy($id)
    {
        $Services=$this->objectName::findOrFail($id);
        $Services->delete();
        Alert::success('تمت العمليه', 'تم حذف الخدمه بنجاح');

        return redirect()->back();
    }

}
