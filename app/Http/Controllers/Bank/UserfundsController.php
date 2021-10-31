<?php

namespace App\Http\Controllers\Bank;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\User_Notification;
use App\Models\Bank_User_Fund;
use App\Models\Fhistory;
use App\Models\User_fund;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class UserfundsController extends Controller
{

    public $objectName;
    public $folderView;

    public function __construct(User_Fund $model)
    {
        $this->objectName = $model;
        $this->folderView = 'bank.userfunds.';
    }


    public function index()
    {
        $userFundBank = Bank_User_Fund::where('bank_id', \Auth::guard('bank')->user()->id)->pluck('user_fund_id');
        $bank_id = auth()->guard('bank')->user()->id;
        $userfunds = User_fund::whereIn('id', $userFundBank)->orderby('created_at', 'DESC')->get();

        return view($this->folderView . 'index', compact('userfunds'));

    }

    public function details($id)
    {

        $userfund = User_fund::find($id);

        if (!$userfund) {
            Alert::warning('تنبية', 'لا يوجد طلب تمويل');
            return redirect()->back();
        }
        if ($userfund->bank_id == auth()->user()->id) {
            return view($this->folderView . 'details', compact('userfund'));
        } else {
            Alert::warning('تنبية', 'لا يمكنك الدخول الي هذا الطلب');
            return redirect()->route('bank.home');
        }
    }

    public function accept(Request $request, $id)
    {
        $validated = $request->validate([
            'details_ar' => 'required|min:6|max:255',
            'details_en' => 'required|min:6|max:255',
        ]);
        $user_fund = User_fund::find($id);
        $user_fund->update([
            'user_status' => 'finail_accept',
        ]);
        $notification = Notification::create([
            'title_ar' => 'تم قبول التمويل',
            'title_en' => 'fund accepted',
            'body_ar' => 'تم قبول تمويل' . $user_fund->Fund->name_ar . 'يرجي التواصل مع الاداره ',
            'body_en' => 'fund accepted' . $user_fund->Fund->name_ar . 'Please contact the administration',
            'details_ar' => $request->details_ar,
            'details_en' => $request->details_en,
        ]);
        $data['status'] = 'accept';
        $data['type'] = 'user';
        $data['user_fund_id'] = $id;
        $data['note_ar'] = 'تم قبول الطلب';
        $data['note_en'] = 'order has been accepted';
        $data['user_id'] = User_fund::where('id', $id)->value('user_id');
        Fhistory::create($data);
        $data_app['note_ar'] = 'تم الموافقه من البنك';
        $data_app['note_en'] = 'Approved by the bank';
        $data_app['bank_id'] = auth()->user()->id;
        $data_app['type'] = 'bank';
        $data_app['show_in'] = 'app';
        $data_app['status'] = 'accept';
        $data_app['user_fund_id'] = $id;
        Fhistory::create($data_app);
        $user_id = $user_fund->user_id;
        $user = User::find($user_id);
        User_Notification::create(['notification_id' => $notification->id, 'user_id' => $user->id]);
        $fcm_tokens[0] = $user->fcm_token;
        $title = 'title_ar' . $user->lang;
        $body = 'body_ar' . $user->lang;
        $details = 'details_' . $user->lang;
        send_notification($notification->$title, $notification->$body, $notification->$details, null, null, $fcm_tokens);
        Alert::success('تمت العمليه', 'تم  هذا التمويل  بنجاح');
        return redirect()->route('funds.request');
    }

    public function bankChonsen($id)
    {
        if (User_fund::where('id', $id)->whereNull('bank_id')->exists()) {
            User_fund::where('id', $id)->update(['bank_id' => auth()->user()->id]);
            activity('admin')->log('تم اضافه هذا التمويل للبنك بنجاح');
            Alert::success('تمت العمليه', 'تم اضافه هذا التمويل  بنجاح');
            return redirect()->route('request.review', $id);
        } else {
            Alert::warning('تمت العمليه', 'تم تحويل هذا الطلب بالفعل الي بنك اخر');
            return redirect()->back();
        }
    }


    public function redirectEmployer(Request $request, $id)
    {
        $bank_id = auth()->guard('bank')->user()->id;
        $data = $this->validate(request(),
            [
                'note_ar' => 'required|string',
                'note_en' => 'required|string',
            ]);
        $validated = $request->validate([
            'details_ar' => 'required|min:6|max:255',
            'details_en' => 'required|min:6|max:255',
        ]);
        $user_fund_id = User_fund::findOrfail($id);
        $data['status'] = 'reject';
        $data['type'] = 'bank';
        $data['show_in'] = 'web';
        $data['user_fund_id'] = $id;
        $data['user_id'] = $user_fund_id->value('user_id');
        $data['emp_id'] = $user_fund_id->value('emp_id');
        $data['bank_id'] = $bank_id;
        Fhistory::create($data);
        $data_app['note_ar'] = 'تم الرفض من البنك';
        $data_app['note_en'] = 'Rejected by the bank';
        $data_app['bank_id'] = auth()->user()->id;
        $data_app['type'] = 'bank';
        $data_app['show_in'] = 'app';
        $data_app['status'] = 'reject';
        $data_app['user_fund_id'] = $id;
        Fhistory::create($data_app);
        $notification = Notification::create([
            'title_ar' => 'تم رفض الطلب ',
            'title_en' => 'fund rejected',
            'body_ar' => 'تم رفض تمويل' . $user_fund_id->Fund->name_ar . 'يرجي التواصل مع الاداره ',
            'body_en' => 'fund rejected' . $user_fund_id->Fund->name_ar . 'Please contact the administration',
            'details_ar' => $request->details_ar,
            'details_en' => $request->details_en,
        ]);
        $user_id = $user_fund_id->user_id;
        $user = User::find($user_id);
        User_Notification::create(['notification_id' => $notification->id, 'user_id' => $user->id]);
        $fcm_tokens[0] = $user->fcm_token;
        $title = 'title_ar' . $user->lang;
        $body = 'body_ar' . $user->lang;
        $details = 'details_' . $user->lang;
        send_notification($notification->$title, $notification->$body, $notification->$details, null, null, $fcm_tokens);
        $user_fund_id->bank_id = null ;
        $user_fund_id->save();
        User_fund::where('id', $id)->update(['bank_id' => null]);
        Alert::success('عملية ناجحة', 'تم تحويل طلب المراجعه مره اخري الي الموظف ');
        return redirect()->route('funds.request');
    }


}
