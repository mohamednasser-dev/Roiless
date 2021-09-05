<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class SettingController extends Controller
{
    public $objectName;
    public $folderView;

    public function __construct(Setting $model)
    {
        $this->objectName = $model;
        $this->folderView = 'admin.setting';
    }
    public function edit()
    {
        $setting = $this->objectName::get()->first();
        return view($this->folderView .'.'. 'edit' , compact('setting'));
    }

    public function update(Request $request, $id)
    {
//    return $request;
        $data = $this->validate(\request(),
            [
                'name_ar' => 'required',
                'name_en' => 'required',
                'terms_ar' => 'required',
                'terms_en' => 'required',
                'privacy_ar' => 'required',
                'privacy_en' => 'required',
                'facebook' => 'required',
                'youtube' => 'required',
                'gmail' => 'required',
                'instagram' => 'required',
                'twitter' => 'required',
                'linkedin' => 'required',
                'image' => '',

            ]);


            DB::beginTransaction();

            $setting = $this->objectName::find($id);
            if (!$setting){
                Alert::warning('خطاء', 'هذا الاعداد ليس موجو');
                return redirect()->route(' $this->folderView');
            }


            if($request->hasFile('image')) {
                $file_name = $this->MoveImage($request->file('image'),'uploads/setting' );
                $data['image'] = $file_name;
            }

            $this->objectName::where('id',$id)->update($data);


            DB::commit();
            Alert::success('تمت العمليه', 'تم التحديث بنجاح');
            return redirect()->route('Setting.edit');


    }
}
