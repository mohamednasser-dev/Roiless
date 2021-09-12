<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fund;
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

        $funds = $this->objectName::with('category')->get();
        return view($this->folderView . 'index', compact('funds'));
    }


    public function create()
    {

        return view($this->folderView . 'create');
    }
/*

    public function store(Request $request)
    {

        $data = $this->validate(request(),
            [
                'question_ar' => 'required',
                'answer_ar' => 'required',
                'question_en' => 'required',
                'answer_en' => 'required',
                'image' => '',

            ]);
        try {
            DB::beginTransaction();
            //store images
            if ($request->image != null) {
                $data['image'] = $this->MoveImage($request->image, 'uploads/question');
            }


            $questios = $this->objectName::create($data);


            DB::commit();
            Alert::success('تمت العمليه', 'تم اضافه الخدمه بنجاح');
            return redirect()->route('question');

        } catch (\Exception $ex) {

            DB::rollback();
            Alert::warning('هنالك خطاء', 'لم يتم التحديث');

            return redirect()->route('question');

        }
    }

    public function edit($id)
    {
        $question = $this->objectName::where('id', $id)->first();
        return view($this->folderView . 'edit', compact('question'));
    }

    public function update(Request $request, $id)
    {

        $data = $this->validate(\request(),
            [
                'question_ar' => 'required',
                'answer_ar' => 'required',
                'question_en' => 'required',
                'answer_en' => 'required',
                'image' => '',

            ]);

        try {
            DB::beginTransaction();

            $question = $this->objectName::find($id);
            if (!$question) {
                Alert::warning('خطاء', 'هذه الخدمه ليست موجوه');
                return redirect()->route(' $this->folderView');
            }


            if ($request->hasFile('image')) {
                $file_name = $this->MoveImage($request->file('image'), 'uploads/question');
                $data['image'] = $file_name;
            }

            $this->objectName::where('id', $id)->update($data);


            DB::commit();
            Alert::success('تمت العمليه', 'تم التحديث بنجاح');
            return redirect()->route('question');

        } catch (\Exception $ex) {

            DB::rollback();
            Alert::warning('هنالك خطاء', 'لم يتم التحديث');

            return redirect()->route('question');

        }
    }

*/
    public function destroy($id)
    {
        $fund = $this->objectName::findOrFail($id);
        $fund->delete();
        Alert::success('تمت العمليه', 'تم الحذف بنجاح');

        return redirect()->route('fund');
    }


}
