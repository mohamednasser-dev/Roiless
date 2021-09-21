<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\category;
use App\Models\Fund;
use App\Models\Fundinput;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class fundController extends Controller
{
    public $objectName;
    public $folderView;

    public function __construct(Fund $model)
    {
        $this->objectName = $model;
        $this->folderView = 'admin.fund.';
    }

    public function index()
    {

        $funds = $this->objectName::get();
        return view($this->folderView . 'index', compact('funds'));
    }


    public function create()
    {
        $categories = category::get();
        $fundsinputs = Fundinput::get();
        return view($this->folderView . 'create', compact('categories', 'fundsinputs'));
    }


    public function store(Request $request)
    {

        $data = $this->validate(request(),
            [
                'columns' => 'required|array|min:1',
                'name_ar' => 'required',
                'name_en' => 'required',
                'desc_ar' => 'required',
                'desc_en' => 'required',
                'financing_ratio' => 'required|numeric',
                'cost' => 'required',
                'cat_id' => 'required|numeric',
                'image' => '',

            ]);


        $data['image'] = $this->MoveImage($request->image, 'uploads/funds');
        $data['columns'] = json_encode($request->columns);


        $funds = $this->objectName::create($data);

        activity('admin')->log('تم اضافه التمويل بنجاح');

        DB::commit();
        Alert::success('تمت العمليه', 'تم اضافه التمويل بنجاح');
        return redirect()->route('fund');


    }

    public function details($id)
    {

        $fund = $this->objectName::where('id', $id)->first();
        return view($this->folderView . 'details', compact('fund'));
    }


    public function edit($id)
    {
        $categories = category::get();
        $fundsinputs = Fundinput::get();
        $fund = $this->objectName::where('id', $id)->first();
        return view($this->folderView . 'edit', compact('fund','fundsinputs','categories'));
    }

    public function update(Request $request, $id)
    {

        $data = $this->validate(\request(),
            [
                'name_ar' => 'required',
                'name_en' => 'required',
                'financing_ratio' => 'required|numeric',
                'columns' => 'required|array|min:1',
                'cat_id' => 'required|numeric',
                'image' => '',

            ]);


        try {
            DB::beginTransaction();

            $fund = $this->objectName::find($id);
            if (!$fund) {
                Alert::warning('خطاء', 'هذه الخدمه ليست موجوه');
                return redirect()->route(' $this->folderView');
            }

            if ($request->hasFile('image')) {
                $file_name = $this->MoveImage($request->file('image'), 'uploads/funds');
                $data['image'] = $file_name;
            }
            $this->objectName::where('id', $id)->update($data);

            activity('admin')->log('تم تحديث التمويل بنجاح');

            DB::commit();
            Alert::success('تمت العمليه', 'تم التحديث بنجاح');
            return redirect()->route('fund');

        } catch (\Exception $ex) {

            DB::rollback();
            Alert::warning('هنالك خطاء', 'لم يتم التحديث');

            return redirect()->route('fund');

        }
    }

    public function destroy($id)
    {
        $fund = $this->objectName::findOrFail($id);
        $fund->delete();
        activity('admin')->log('تم حذف التمويل بنجاح');

        Alert::success('تمت العمليه', 'تم الحذف بنجاح');

        return redirect()->route('fund');
    }

    public function changeStatus(Request $request)
    {

        $this->objectName::where('id', $request->id)->update([
            'featured' => $request->status
        ]);

        return 1;

    }

}
