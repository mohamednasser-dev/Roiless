<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Fund;
use App\Models\Fundinput;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use RealRashid\SweetAlert\Facades\Alert;

class fundController extends Controller
{
    public $objectName;
    public $folderView;

    public function __construct(Fund $model)
    {
        $this->middleware('permission:funds');
        $this->objectName = $model;
        $this->folderView = 'admin.fund.';
    }

    public function index()
    {
        $funds = Fund::orderBy('created_at','desc')->get();
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
                'name_ar' => 'required|string|max:255',
                'name_en' => 'required|string|max:255',
                'desc_ar' => 'required|string|max:255',
                'desc_en' => 'required|string|max:255',
                'financing_ratio' => 'required|numeric',
                'cost' => 'required',
                'cat_id' => 'required|numeric',
                'image' => '',
            ]);
        $data['image'] = $this->MoveImage($request->image, 'uploads/funds');
        $newarray = [];
        foreach ($request->columns as $key => $row) {
            if ($row == 'annual_income') {
                $newarray[$key] = 'annual_income';
                $data['annual_income_ar'] = 'الدخل السنوي';
                $data['annual_income_en'] = 'annual income';
            }elseif($row == 'annual_sales'){
                $newarray[$key] = 'annual_income';
                $data['fund_amount_ar'] = 'المبيعات السنوية';
                $data['fund_amount_en'] = 'annual sales';
            }elseif ($row == 'Required_fund_amount') {
                $newarray[$key] = 'fund_amount';
                $data['fund_amount_ar'] = 'قيمة القرض المطلوب';
                $data['fund_amount_en'] = 'Required fund amount';
            }elseif($row == 'property_financed'){
                $newarray[$key] = 'fund_amount';
                $data['fund_amount_ar'] = 'قيمة القرض المطلوب';
                $data['fund_amount_en'] = 'The value of the property to be financed';
            }elseif($row == 'car_financed'){
                $newarray[$key] = 'fund_amount';
                $data['fund_amount_ar'] = 'قيمة السيارة المطلوب تمويلها';
                $data['fund_amount_en'] = 'car financed';
            }elseif($row == 'fund_amount'){
                $newarray[$key] = 'fund_amount';
                $data['fund_amount_ar'] = 'مبلغ التمويل';
                $data['fund_amount_en'] = 'fund amount';
            }else{
                $newarray[$key] = $row;
            }
        }
        $data['columns'] = json_encode($newarray);
        $funds = Fund::create($data);
        $fund_admin = 'تم اضافه تمويل' . $funds->name_ar;
        store_history(Auth::user()->id, $fund_admin);
        DB::commit();
        Alert::success(trans('admin.opretion_success'), trans('admin.fund_added_successfully'));
        return redirect()->route('fund');
    }

    public function details($id)
    {
        $fund = Fund::where('id', $id)->first();
        return view($this->folderView . 'details', compact('fund'));
    }

    public function edit($id)
    {
        $categories = Category::get();
        $fundsinputs = Fundinput::get();
        $fund = Fund::where('id', $id)->first();
        $old_columns = json_decode($fund->columns);
        $columns = [] ;
        foreach ($old_columns as $key=> $row){
            if($row  == 'fund_amount'){
                if($fund->fund_amount_en == 'Required fund amount'){
                    $columns[$key] = 'Required_fund_amount';
                }elseif($fund->fund_amount_en == 'The value of the property to be financed'){
                    $columns[$key] = 'property_financed';
                }elseif($fund->fund_amount_en == 'car financed'){
                    $columns[$key] = 'car_financed';
                }else{
                    $columns[$key] = 'fund_amount';
                }
            }elseif($row  == 'fund_amount'){
                if($fund->annual_income_ar == 'annual sales'){
                    $columns[$key] = 'annual_sales';
                }else{
                    $columns[$key] = 'annual_income';
                }
            }else{
                $columns[$key] = $row;
            }
        }
        return view($this->folderView . 'edit', compact('fund', 'fundsinputs', 'categories', 'columns'));
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
        DB::beginTransaction();
        $fund = Fund::find($id);
        if (!$fund) {
            Alert::warning(trans('admin.service_not_found'), trans('admin.wron'));
            return redirect()->route(' $this->folderView');
        }

        if ($request->hasFile('image')) {
            $file_name = $this->MoveImage($request->file('image'), 'uploads/funds');
            $data['image'] = $file_name;
        }

        $data['desc_ar'] = $request->desc_ar;
        $data['desc_en'] = $request->desc_en;

        $newarray = [];
        foreach ($request->columns as $key => $row) {
            if ($row == 'annual_income') {
                $newarray[$key] = 'annual_income';
                $data['annual_income_ar'] = 'الدخل السنوي';
                $data['annual_income_en'] = 'annual income';
            }elseif($row == 'annual_sales'){
                $newarray[$key] = 'annual_income';
                $data['fund_amount_ar'] = 'المبيعات السنوية';
                $data['fund_amount_en'] = 'annual sales';
            }elseif ($row == 'Required_fund_amount') {
                $newarray[$key] = 'fund_amount';
                $data['fund_amount_ar'] = 'قيمة القرض المطلوب';
                $data['fund_amount_en'] = 'Required fund amount';
            }elseif($row == 'property_financed'){
                $newarray[$key] = 'fund_amount';
                $data['fund_amount_ar'] = 'قيمة القرض المطلوب';
                $data['fund_amount_en'] = 'The value of the property to be financed';
            }elseif($row == 'car_financed'){
                $newarray[$key] = 'fund_amount';
                $data['fund_amount_ar'] = 'قيمة السيارة المطلوب تمويلها';
                $data['fund_amount_en'] = 'car financed';
            }elseif($row == 'fund_amount'){
                $newarray[$key] = 'fund_amount';
                $data['fund_amount_ar'] = 'مبلغ التمويل';
                $data['fund_amount_en'] = 'fund amount';
            }else{
                $newarray[$key] = $row;
            }
        }
        $data['columns'] = json_encode($newarray);
        Fund::where('id', $id)->update($data);
        $fund_admin = 'تم تحديث تمويل' . $fund->name_ar;
        store_history(Auth::user()->id, $fund_admin);
        DB::commit();
        return redirect()->route('fund')->with('success', trans('admin.opretion_success'));
    }

    public function destroy($id)
    {
        $fund = Fund::findOrFail($id);
        $fund->delete();
        $fund_admin = 'تم حذف تمويل' . $fund->name_ar;
        store_history(Auth::user()->id, $fund_admin);
        Alert::success(trans('admin.deleted'), trans('admin.opretion_success'));
        return redirect()->route('fund');
    }

    public function changeStatus(Request $request)
    {
        Fund::where('id', $request->id)->update([
            'featured' => $request->status
        ]);
    }

    public function appearance(Request $request)
    {
        Fund::where('id', $request->id)->update([
            'appearance' => $request->status
        ]);
    }
}
