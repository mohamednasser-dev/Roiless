<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Inbox;
use App\Models\Services;
use App\Models\Service_details;
use App\Traits\GeneralTrait;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InboxController extends Controller
{
    public function store(Request $request)
    {
        $user = auth()->user()->id;
        try {
            $data = $request->all();
            $validator = Validator::make($data, [
                'name' => 'required|max:255',
                'email' => 'required|email',
                'phone' => 'required|numeric',
                'message' => 'required|max:255',
            ]);
            //Request is valid, create new user
            if ($validator->fails()) {
                return msgdata($request, failed(), $validator->messages()->first(), array());
            }
            $data['user_id'] = $user;
            $inbox = Inbox::create($data);
            return msgdata($request, success(), 'inbox_added', $data);


        } catch (Exception $e) {
            return msgdata($request, failed(), 'faild to inbox', array());
        }
    }
}
