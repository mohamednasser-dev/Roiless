<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\consolution_kind;
use App\Models\Fund;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class ConsolutionKindControler extends Controller
{
    public $objectName;
    public $folderView;

    public function __construct(consolution_kind $model)
    {
        $this->middleware('permission:funds');
        $this->objectName = $model;
        $this->folderView = 'admin.consolution.ConsolutionKind.';
    }

    public function index()
    {
        $kinds = $this->objectName::paginate(30);
        return view($this->folderView . 'index', compact('kinds'));
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
            ]);


        $funds = $this->objectName::create($data);

        activity('admin')->log('تم اضافه التمويل بنجاح');

        Alert::success( trans('admin.opretion_success'),trans('admin.sweet_kind_add'));
        return redirect()->route('consolutionKind');


    }


    public function edit($id)
    {
          $kind = $this->objectName::where('id',$id)->first();
        return view($this->folderView . 'edit', compact('kind'));
    }

    public function update(Request $request, $id)
    {

        $data = $this->validate(\request(),
            [
                'name_ar' => 'required',
                'name_en' => 'required',
            ]);


        try {
            DB::beginTransaction();

            $this->objectName::where('id', $id)->update($data);

            activity('admin')->log('تم تحديث التمويل بنجاح');

            DB::commit();
            Alert::success(trans('admin.updated_successfully'), trans('admin.opretion_success'));
            return redirect()->back();

        } catch (\Exception $ex) {

            DB::rollback();
            Alert::warning(trans('admin.not_updated'), trans('admin.wron'));

            return redirect()->back();

        }
    }

    public function destroy($id)
    {
        $fund = $this->objectName::findOrFail($id);
        $fund->delete();

        Alert::success(trans('admin.deleted'), trans('admin.opretion_success'));
        return redirect()->back();
    }



}
