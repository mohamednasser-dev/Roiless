<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Consolution;
use App\Models\Inbox;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class InboxController extends Controller
{
    public $objectName;
    public $folderView;

    public function __construct(Inbox $model)
    {
        $this->middleware('permission:communication');
        $this->objectName = $model;
        $this->folderView = 'admin.inbox.';
    }

    public function index()
    {
        $consolutions = Consolution::where('type','contact_us')->paginate(30);
        return view('admin.inbox.index', compact('consolutions'));
    }

    public function destroy($id)
    {
        $inbox = $this->objectName::findOrFail($id);
        $inbox->delete();
        activity('admin')->log('تم حذف رساله التواصل معنا بنجاح');

        Alert::success( trans('admin.deleted'),trans('admin.opretion_success'));

        return redirect()->route('inbox');
    }
}
