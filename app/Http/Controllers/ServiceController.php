<?php

namespace App\Http\Controllers;

use App\Models\Services;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use Exception;


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


    public function show($id)
    {
        $data = $this->objectName::where('id', $id)->first();
        return view($this->folderView . 'details', compact('data'));
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

            $Service = $this->objectName::find($id);
            if (!$Service)
                Alert::warning('خطاء', 'هذه الخدمه ليست موجوه');
            return redirect()->route(' $this->folderView');

            DB::beginTransaction();
            if ($request->has('photo')) {
                $fileName = uploadImage('brands', $request->photo);
                Brand::where('id', $id)
                    ->update([
                        'photo' => $fileName,
                    ]);
            }

            if (!$request->has('is_active'))
                $request->request->add(['is_active' => 0]);
            else
                $request->request->add(['is_active' => 1]);

            $brand->update($request->except('_token', 'id', 'photo'));

            //save translations
            $brand->name = $request->name;
            $brand->save();

            DB::commit();
            return redirect()->route('admin.brands')->with(['success' => 'تم ألتحديث بنجاح']);

        } catch (\Exception $ex) {

            DB::rollback();
            return redirect()->route('admin.brands')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
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
        try {
            //get specific categories and its translations
            $Service = $this->objectName::find($id);

            if (!$Service)


            Alert::warning('خطاء', 'هذه الخدمه ليست موجوه');
            return redirect()->route('services.index');

            $Service->delete();

            Alert::success('تمت العمليه', 'تم انشاء خدمه جديده');

            return redirect()->route('services.index');

        } catch (\Exception $ex) {
            return redirect()->route('admin.brands')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

}
