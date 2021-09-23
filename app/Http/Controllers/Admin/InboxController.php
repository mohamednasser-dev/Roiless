<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inbox;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class InboxController extends Controller
{
    public $objectName;
    public $folderView;

    public function __construct(Inbox $model)
    {
        $this->objectName = $model;
        $this->folderView = 'admin.inbox.';
    }

    public function index()
    {

        $inboxs = $this->objectName::get();
        return view($this->folderView . 'index', compact('inboxs'));
    }

    public function destroy($id)
    {
        $inbox = $this->objectName::findOrFail($id);
        $inbox->delete();
        activity('admin')->log('تم حذف رساله التواصل معنا بنجاح');

        Alert::success('تمت العمليه', 'تم الحذف بنجاح');

        return redirect()->route('inbox');
    }
}
