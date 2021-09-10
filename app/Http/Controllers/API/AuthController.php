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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Validator;
use App\Models\User;
use PDF;
use DB;

class AuthController extends Controller
{
    public $objectName;

    public function __construct(User $model)
    {
        $this->objectName = $model;
    }

    public function login(Request $request)
    {
        $rules = [
            'phone' => 'required',
            'password' => 'required',

        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['status' => 401, 'msg' => $validator->messages()->first()]);
        } else {
            if (Auth::attempt([
                'phone' => $request->input('phone'),
                'password' => $request->input('password')
            ])) {
                if (Auth::user()->verified == '0') {
                    Auth::logout();
                    return msgdata($request, not_active(), 'verify_phone_first', null);
                }
                if (Auth::user()->parent_id == null) {
                    $user = Auth::user();
                    $user->api_token = Str::random(60);
                    $user->save();


                    if (Auth::user()->expiry_package == 'n') {
                        return msgdata($request, success(), 'login_success', array('user' => $user));
                    } else {
                        return msgdata($request, success(), 'package_ended', array('user' => $user));
                    }


                } else {
                    $parent_user = User::where('id', Auth::user()->parent_id)->first();
                    $user = Auth::user();
                    $user->api_token = Str::random(60);
                    $user->save();

                    if ($parent_user->expiry_package == 'n') {
                        return msgdata($request, success(), 'login_success', array('user' => $user));
                    } else {
                        return msgdata($request, success(), 'package_ended', array('user' => $user));
                    }
                }
            } else {
                return response()->json(msg($request, failed(), 'login_warrning'));
            }
        }
    }


    public function updateProfile(Request $request, $id)
    {

        $user = User::find($id);
        if(!$user)
            return response()->json(['status' => 401, 'msg' => 'User Not Found']);


        $rules = [
            'name' => 'required|regex:/^[\pL\s\-]+$/u',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'required',
            'phone' => 'required|regex:/(01)[0-9]{9}/|unique:users,phone,'.$id,
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['status' => 401, 'msg' => $validator->messages()->first()]);
        } else {


            $user->update([
                'name' => $request->name,
                'password' => bcrypt($request->password),
                'email' => $request->email,
                'phone' => $request->phone
            ]);

            if ($user) {
                return msgdata($request, success(), 'update_profile_success', array('user' => $user));
            } else {
                return response()->json(msg($request, failed(), 'update_profile_warrning'));
            }

        }
    }


    public function forgot_password_post(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if (!empty($user)) {
            $token = app('auth.password.broker')->createToken($user);
            $data = DB::table('password_resets')->insert([
                'email' => $user->email,
                'token' => $token,
                'created_at' => Carbon::now(),
            ]);
            Mail::to($user->email)->send(new UserRestPasswordApi(['data' => $user, 'token' => $token]));
            return msgdata($request, success(), 'send_reset', array('token' => $token));
        } else
            return response()->json(msg($request, failed(), 'not_found'));
    }


    public function reset_password(Request $request)
    {
        $check_token = DB::table('password_resets')->where('token', $request->token)->where('created_at', '>', Carbon::now()->subHours(1))->first();
        if (!empty($check_token)) {
            return msgdata($request, success(), 'token_confirmed', array('data' => $check_token));
        } else {
            return response()->json(msg($request, failed(), 'not_reseted'));
        }
    }

    public function reset_password_post(Request $request)
    {

        $rules = [
            'email' => 'required',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['status' => 401, 'msg' => $validator->messages()->first()]);
        } else {
            $check_token = DB::table('password_resets')->where('token', $request->token)->where('created_at', '>', Carbon::now()->subHours(1))->first();
            if (!empty($check_token)) {
                $user = User::where('email', $check_token->email)->update(['email' => $check_token->email, 'password' => bcrypt($request->password),
                ]);
                DB::table('password_resets')->where('email', $request->email)->delete();
                return response()->json(msg($request, success(), 'reseted'));
            } else {
                return response()->json(msg($request, failed(), 'not_reseted'));
            }
        }
    }
}
