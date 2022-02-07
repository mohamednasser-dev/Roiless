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
                'all_category_image' => "",
                'invest_image' => "",
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
                'phones' => 'array|min:1',
                'facebook' => '',
                'youtube' => '',
                'instagram' => '',
                'twitter' => '',
                'linkedin' => '',
                'all_category_image' => '',
                'invest_image' => '',
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
        if ($request->hasFile('all_category_image')) {
            $file_name = $this->MoveImage($request->file('all_category_image'), 'uploads/setting');
            $data['all_category_image'] = $file_name;
        } else {
            unset($data['all_category_image']);
        }
        if ($request->hasFile('invest_image')) {
            $file_name = $this->MoveImage($request->file('invest_image'), 'uploads/setting');
            $data['invest_image'] = $file_name;
        } else {
            unset($data['invest_image']);
        }
        if ($request->show_otp == '1') {
            $data['show_otp'] = 1;
        } else {
            $data['show_otp'] = 0;
        }
        Setting::where('id', $id)->update($data);

        if ($request->phones) {
            SettingInfo::where('type', 'phone')->delete();
            foreach ($request->phones as $phone) {
                SettingInfo::create([
                    'setting_id' => $id,
                    'type' => 'phone',
                    'phone' => $phone,
                ]);
            }
        }
        if ($request->adress) {
            foreach ($request->adress as $adress) {
                SettingInfo::create([
                    'setting_id' => $id,
                    'type' => 'address',
                    'address_en' => $adress['adress_en'],
                    'address_ar' => $adress['adress_ar'],
                    'url' => $adress['url'],
                ]);
            }
        }
        activity('admin')->log('تم تحديث الاعدادات بنجاح');
        DB::commit();
        // Alert::success('تمت العمليه', 'تم التحديث بنجاح');
        return redirect()->route('Setting.edit')->with('success', trans('تم التحديث بنجاح'));

    }

    public function delete($id)
    {
        $address = SettingInfo::findorfail($id);
        $address->delete();
        return redirect()->back()->with('success', trans('تم حذف العنوان بنجاح'));
    }
}
