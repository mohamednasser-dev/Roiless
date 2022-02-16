<?php

namespace App\Http\Controllers\API;

use App\Mail\UserRestPasswordApi;
use Carbon\Carbon;
use Str;
use App\Cases;
use App\Http\Controllers\Controller;
use App\Notifications\UserResetPasswordNotification;
use App\Point;
use App\Sessions;
use App\Verification;
use Illuminate\Http\Request;
use App\Permission;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Tymon\JWTAuth\Facades\JWTAuth;
use Validator;
use App\Models\User;
use PDF;
use DB;
use Ghanem\LaravelSmsmisr\Facades\Smsmisr;

class AuthController extends Controller
{
    use GeneralTrait;

    public $objectName;

    public function __construct(User $model)
    {
        $this->objectName = $model;
    }

    public function login(Request $request)
    {
        try {
            $rules = [
                'phone' => 'required|exists:users,phone',
                'password' => 'required',
                'fcm_token' => '',
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json(['status' => 401, 'msg' => $validator->messages()->first()]);
            }
            $credentials = $request->only(['phone', 'password']);
            //to check the type of user not admine
            $credentials['type'] = "user";
            $token = Auth::guard('user-api')->attempt($credentials);
            //return tokin
            if (!$token) {
                return $this->returnError('e001', ' بيانات الدخول غير صحيحه');
            }
            $user = Auth::guard('user-api')->user();
            if ($user->verified == '0') {
                Auth::guard('user-api')->logout();
                return msgdata($request, not_active(), 'verify_phone_first', null);
            }
            if ($user->status !== 'active') {
                Auth::guard('user-api')->logout();
                return msgdata($request, not_active(), 'Your_Account_NotActive', null);
            }
            if ($request->fcm_token) {
                User::where('id', $user->id)->update(['fcm_token' => $request->fcm_token]);
            }
            $user_data = User::where('id', $user->id)->select('id', 'image', 'name', 'email', 'phone', 'otp_code')->first();
            $user_data->token_api = $token;

            return msgdata($request, success(), 'login_success', $user_data);
        } catch (Exception $e) {
            return $this->returnError($e->getCode(), $e->getMessage());
        }
    }

    public function Register(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'name' => 'required|string',
            'phone' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|max:50'
        ]);
        //Request is valid, create new user
        if ($validator->fails()) {
            return response()->json(['status' => 401, 'msg' => $validator->messages()->first()]);
        }
        //Request is valid, create new user
        $data['password'] = bcrypt($request->password);
        $user = User::create($data);
        if ($user) {
            $token = Auth::guard('user-api')->attempt(['email' => $request->email, 'password' => $request->password]);
            $user->token_api = $token;
            //User created, return success response
            return msgdata($request, success(), 'login_success', array('user' => $user));

        }
    }

    public function logout(Request $request)
    {
        $token = $request->header('authorization');

        $token = explode("Bearer", $token);
        $token = $token[1];
        if ($token) {
            JWTAuth::invalidate($token);

            return response()->json([
                'success' => true,
                'message' => 'User has been logged out'
            ]);
        } else {
            return response()->json(['error' => 'some thing wrong']);
        }
    }

    public function loginasguest(Request $request)
    {
        $data = $request->only(['phone', 'name']);
        $validator = Validator::make($data, [
            'name' => 'required|string',
            'phone' => 'required|unique:users,phone',
        ]);
        $password = Str::random(8);
        $data['password'] = bcrypt($password);
        //Request is valid, create new user
        if ($validator->fails()) {
            return response()->json(['status' => 401, 'msg' => $validator->messages()->first()]);
        } else {
            $data['otp_code'] = \Otp::generate($request->phone);
            $send = Smsmisr::send("كود التفعيل الخاص بك هوا " . $data['otp_code'], $request->phone, null, 2);
            //Request is valid, create new user
            $data['fcm_token'] = $request->fcm_token;
            $user = User::create($data);
            if ($user) {
                $token = Auth::guard('user-api')->attempt(['phone' => $request->phone, 'password' => $password]);
                $user_data = User::where('id', $user->id)->select('id', 'image', 'name', 'email', 'phone', 'otp_code')->first();
                $user_data->token_api = $token;
                return msgdata($request, success(), 'login_success', $user_data);
            }
        }
    }

    public function resend_otp(Request $request)
    {
        $data = $request->only(['phone', 'name']);
        $validator = Validator::make($data, [
            'phone' => 'required',
        ]);
        $user = User::where('phone', $request->phone)->first();
        if ($user) {
            $otp_code = \Otp::generate($request->phone);
            $user->otp_code = $otp_code;
            Smsmisr::send("كود التفعيل الخاص بك هوا " . $otp_code, $request->phone, null, 2);
            $user->save();
            $final_data['status'] = true;
            $final_data['otp_code'] = $otp_code;
            return msgdata("", success(), 'code send successfully again', $final_data);
        } else {
            return response()->json(['status' => 401, 'msg' => 'phone number invalid']);
        }
    }

    public function check_otp($code)
    {
        $user = User::where('id', Auth::user()->id)->where('otp_code', $code)->first();
        if ($user) {
            $user->verified = 1;
            $user->save();
            $data['status'] = true;
            return msgdata("", success(), ' successfully activated', $data);
        } else {
            return response()->json(['status' => 401, 'msg' => 'this code is invalid']);
        }
    }
}
