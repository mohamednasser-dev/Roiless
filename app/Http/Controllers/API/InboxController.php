<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Consolution;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
class InboxController extends Controller
{
    public function store(Request $request)
    {
        $user = auth()->user()->id;
            $data = $request->all();
            $validator = Validator::make($data, [
                'full_name' => 'required|max:255',
                'email' => 'required|email',
                'phone' => 'required|numeric',
                'content' => 'required|max:255',
            ]);
            //Request is valid, create new user
            if ($validator->fails()) {
                return msgdata($request, failed(), $validator->messages()->first(), array());
            }
            $data['user_id'] = $user;
            $data['type'] = 'contact_us';
            $data['country'] = 'egypt';
            $inbox = Consolution::create($data);
            return msgdata($request, success(), 'inbox_added', $data);

    }
}
