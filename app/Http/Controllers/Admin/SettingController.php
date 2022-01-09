<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\SettingInfo;
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
        $setting = Setting::with('Phones')->first();

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
                'phone' => ""
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
                'phone' => 'required',
                'phones' => 'array|min:1',
                'facebook' => '',
                'youtube' => '',
                'instagram' => '',
                'twitter' => '',
                'linkedin' => '',
                'logo' => '',
            ]);

        $setting = Setting::find($id);
        if (!$setting) {
            // Alert::warning('خطاء', 'هذا الاعداد ليس موجو');
            return redirect()->route(' $this->folderView')->with('danger', trans('هذا الاعداد ليس موجود'));
        }
        if ($request->hasFile('logo')) {
            $file_name = $this->MoveImage($request->file('logo'), 'uploads/setting');
            $data['logo'] = $file_name;
        } else {
            unset($data['logo'], $data['phones']);
        }
        if ($request->show_otp == '1') {
            $data['show_otp'] = 1;
        } else {
            $data['show_otp'] = 0;
        }
        Setting::where('id', $id)->update($data);

        if ($request->phones) {
            SettingInfo::truncate();
            foreach ($request->phones as $phone) {
                SettingInfo::create([
                    'setting_id' => $id,
                    'type' => 'phone',
                    'phone' => $phone,
                ]);
            }

        }

        activity('admin')->log('تم تحديث الاعدادات بنجاح');
        DB::commit();
        // Alert::success('تمت العمليه', 'تم التحديث بنجاح');
        return redirect()->route('Setting.edit')->with('success', trans('تم التحديث بنجاح'));
    }
}
