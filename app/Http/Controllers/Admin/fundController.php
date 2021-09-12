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
                'financing_ratio' => 'required|numeric',
                'cat_id' => 'required|numeric',
                'image' => 'required',

            ]);


        $data['image'] = $this->MoveImage($request->image, 'uploads/funds');
        $data['columns'] = json_encode($request->columns);


        $funds = $this->objectName::create($data);


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
            $question = $this->objectName::where('id', $id)->first();
            return view($this->folderView . 'edit', compact('question'));
        }
    /*
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
    public function changeStatus(Request $request) {

        $this->objectName::where('id',$request->id)->update([
            'featured' => $request->status
        ]);

        return 1;

    }

}
