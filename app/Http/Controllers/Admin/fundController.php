<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
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
        $categories = Category::get();
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
        Alert::success( trans('admin.fund_added_successfully'),trans('admin.opretion_success'));
        return redirect()->route('fund');


    }

    public function details($id)
    {

        $fund = $this->objectName::where('id', $id)->first();
        return view($this->folderView . 'details', compact('fund'));
    }


    public function edit($id)
    {
        $categories = Category::get();
        $fundsinputs = Fundinput::get();
        $fund = $this->objectName::where('id', $id)->first();
        $columns = json_decode($fund->columns);
        return view($this->folderView . 'edit', compact('fund','fundsinputs','categories','columns'));
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
                Alert::warning( trans('admin.service_not_found'),trans('admin.wron'));
                return redirect()->route(' $this->folderView');
            }

            if ($request->hasFile('image')) {
                $file_name = $this->MoveImage($request->file('image'), 'uploads/funds');
                $data['image'] = $file_name;
            }

            $data['desc_ar'] = $request->desc_ar;
            $data['desc_en'] = $request->desc_en;
            $this->objectName::where('id', $id)->update($data);

            activity('admin')->log('تم تحديث التمويل بنجاح');

            DB::commit();
            Alert::success( trans('admin.updated_successfully'),trans('admin.opretion_success'));
            return redirect()->route('fund');

        } catch (\Exception $ex) {

            DB::rollback();
            Alert::warning( trans('admin.not_updated'),trans('admin.wron'));

            return redirect()->route('fund');

        }
    }

    public function destroy($id)
    {
        $fund = $this->objectName::findOrFail($id);
        $fund->delete();
        activity('admin')->log(trns('admin.fund_deleted_success'));

        Alert::success( trans('admin.deleted'),trans('admin.opretion_success'));
        return redirect()->route('fund');
    }

    public function changeStatus(Request $request)
    {

        $this->objectName::where('id', $request->id)->update([
            'featured' => $request->status
        ]);


    }

}
