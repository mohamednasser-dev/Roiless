<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Fhistory;
use App\Models\Order;
use App\Models\User_fund;
use Illuminate\Http\Request;

class MyfatoorahController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

//restaurant register payment
    public function paywith(Request $request,$id,$user_id)
    {
        $user_fund = User_fund::findOrFail($id);
        $root_url = $request->root();
        $path = 'https://apitest.myfatoorah.com/v2/SendPayment';
        $token ='bearer rLtt6JWvbUHDDhsZnfpAhpYk4dxYDQkbcPTyGaKp2TYqQgG7FGZ5Th_WD53Oq8Ebz6A53njUoo1w3pjU1D4vs_ZMqFiz_j0urb_BH9Oq9VZoKFoJEDAbRZepGcQanImyYrry7Kt6MnMdgfG5jn4HngWoRdKduNNyP4kzcp3mRv7x00ahkm9LAK7ZRieg7k1PDAnBIOG3EyVSJ5kK4WLMvYr7sCwHbHcu4A5WwelxYK0GMJy37bNAarSJDFQsJ2ZvJjvMDmfWwDVFEVe_5tOomfVNt6bOg9mexbGjMrnHBnKnZR1vQbBtQieDlQepzTZMuQrSuKn-t5XZM7V6fCW7oP-uXGX-sMOajeX65JOf6XVpk29DP6ro8WTAflCDANC193yof8-f5_EYY-3hXhJj7RBXmizDpneEQDSaSz5sFk0sV5qPcARJ9zGG73vuGFyenjPPmtDtXtpx35A-BVcOSBYVIWe9kndG3nclfefjKEuZ3m4jL9Gg1h2JBvmXSMYiZtp9MR5I6pvbvylU_PP5xJFSjVTIz7IQSjcVGO41npnwIxRXNRxFOdIUHn0tjQ-7LwvEcTXyPsHXcMD8WtgBh-wxR8aKX7WPSsT1O8d8reb2aR7K3rkV3K82K_0OgawImEpwSvp9MNKynEAJQS6ZHe_J_l77652xwPNxMRTMASk1ZsJL';
        $headers = array(
            'Authorization:' . $token,
            'Content-Type:application/json'
        );

        $call_back_url = $root_url . "/api/myfatoorah-oncomplate?user_id=" . $user_id . '&fund_id=' . $id;
        $error_url = $root_url . "/payment-fail";
        $fields = array(
            "CustomerName" => $user_fund->Users->name,
            "NotificationOption" => "LNK",
            "InvoiceValue" => $user_fund->cost,
            "CallBackUrl" => $call_back_url,
            "ErrorUrl" => $error_url,
            "Language" => "AR",
            "CustomerEmail" => $user_fund->Users->email
        );
        $payload = json_encode($fields);
        $curl_session = curl_init();
        curl_setopt($curl_session, CURLOPT_URL, $path);
        curl_setopt($curl_session, CURLOPT_POST, true);
        curl_setopt($curl_session, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl_session, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl_session, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl_session, CURLOPT_IPRESOLVE, CURLOPT_IPRESOLVE);
        curl_setopt($curl_session, CURLOPT_POSTFIELDS, $payload);
        $result = curl_exec($curl_session);
        curl_close($curl_session);
        $result = json_decode($result);
        if ($result) {
            return redirect()->to($result->Data->InvoiceURL);
        } else {
            print_r($request["errors"]);
        }
    }

    public function oncomplate(Request $request)
    {
        $order = User_fund::findOrFail($request->fund_id);
        $order->user_status = 'payed_success';
        $order->payment = 'paid';
        $order->save();
        $history_data['user_fund_id'] = $order->id;
        $history_data['type'] = 'user';
        $history_data['show_in'] = 'web';
        $history_data['status'] = 'pending';
        $history_data['user_id'] =  $order->user_id;
        $history_data['note_ar'] = 'تم دفع الرسوم';
        $history_data['note_en'] = 'Fund Cost Has Been Paid';
        Fhistory::create($history_data);
        $history_app_data['user_fund_id'] = $order->id;
        $history_app_data['type'] = 'user';
        $history_app_data['show_in'] = 'app';
        $history_app_data['status'] = 'pending';
        $history_app_data['user_id'] =  $order->user_id;
        $history_app_data['note_ar'] = 'تم دفع الرسوم';
        $history_app_data['note_en'] = 'Fund Cost Has Been Paid';
        Fhistory::create($history_app_data);
        return redirect()->route('succeeded');
    }

    public function error(Request $request)
    {
        return dd($request);
    }
//     public function getPaymentStatus(Request $request)
//     {
//         if($request->status == "paid"){
//             DB::table('orders')
//                 ->where('transaction_reference', $request->id)
//                 ->update(['order_status' => 'confirmed', 'payment_status' => 'paid', 'transaction_reference' => $request->id]);
//             $order = Order::where('transaction_reference', $request->id)->first();
//             if ($order->callback != null) {
//                 return redirect($order->callback . '/success');
//             }else{
//                 return \redirect()->route('payment-success');
//             }
//         }
//         $order = Order::where('transaction_reference', $payment_id)->first();
//         if ($order->callback != null) {
//             return redirect($order->callback . '/fail');
//         }else{
//             return \redirect()->route('payment-fail');
//         }
//     }
//     public function oncomplate(Request $request,Order $order)
//     {
//         DB::table('orders')
//         ->where('id', $order->id)
//         ->update([
//             'transaction_reference' => $request->id,
//             'payment_method' => 'paypal',
//             'order_status' => 'failed',
//             'updated_at' => now()
//         ]);
//     }
}
