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
        $this->middleware('permission:Setting');
        $this->objectName = $model;
        $this->folderView = 'admin.setting';
    }
    public function edit()
    {
        $setting = Setting::first();
        if (!$setting) {
            Setting::create([
                'id' => 1,
                'title_ar' => '',
                'title_en' => '',
                'terms_ar' => '',
                'terms_en' => '',
                'privacy_ar' => '',
                'privacy_en' => '',
                'facebook' => '',
                'youtube' => '',
                'instagram' => '',
                'twitter' => '',
                'linkedin' => '',
                'logo' => '',
                'about_us_ar' => "",
                'about_us_en' => "",
            ]);
        }
        return view($this->folderView . '.' . 'edit', compact('setting'));
    }
    public function update(Request $request, $id)
    {
        $data = $this->validate(\request(),
            [
                'title_ar' => 'required',
                'title_en' => 'required',
                'terms_ar' => 'required',
                'terms_en' => 'required',
                'privacy_ar' => 'required',
                'privacy_en' => 'required',
                'about_us_ar' => 'required',
                'about_us_en' => 'required',
                'facebook' => '',
                'youtube' => '',
                'instagram' => '',
                'twitter' => '',
                'linkedin' => '',
                'logo' => '',
            ]);
        $setting = Setting::find($id);
        if (!$setting) {
            Alert::warning('خطاء', 'هذا الاعداد ليس موجو');
            return redirect()->route(' $this->folderView');
        }
        if ($request->hasFile('logo')) {
            $file_name = $this->MoveImage($request->file('logo'), 'uploads/setting');
            $data['logo'] = $file_name;
        } else {
            unset($data['logo']);
        }
        Setting::where('id', $id)->update($data);
        activity('admin')->log('تم تحديث الاعدادات بنجاح');
        DB::commit();
        Alert::success('تمت العمليه', 'تم التحديث بنجاح');
        return redirect()->route('Setting.edit');
    }
}
