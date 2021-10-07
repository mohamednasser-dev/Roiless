<?php

namespace App\Http\Controllers\API;

use App\Mail\UserRestPasswordApi;
use App\Models\Consolution;
use App\Models\consolution_kind;
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

class UsersController extends Controller
{
    use GeneralTrait;

    public $objectName;

    public function __construct(User $model)
    {
        $this->objectName = $model;
    }

    public function updateProfile(Request $request)
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        if (!$user)
            return response()->json(['status' => 401, 'msg' => 'User Not Found']);
        $rules = [
            'name' => 'required|regex:/^[\pL\s\-]+$/u',
            'email' => 'required|email|unique:users,email,' . $id,
            'phone' => 'required|regex:/(01)[0-9]{9}/|unique:users,phone,' . $id,
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['status' => 401, 'msg' => $validator->messages()->first()]);
        } else {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone
            ]);
            $user_data = User::where('id', Auth::user()->id)->select('id', 'image', 'name', 'email', 'phone')->first();
                $user_data['token_api'] = null;
                $user_data['otp_code'] = null;
            if ($user) {
                return msgdata($request, success(), 'update_profile_success',  $user_data);
            } else {
                return response()->json(msg($request, failed(), 'update_profile_warning'));
            }
        }
    }

    public function update_image(Request $request)
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        if (!$user)
            return response()->json(['status' => 401, 'msg' => 'User Not Found']);
        $rules = [
            'image' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['status' => 401, 'msg' => $validator->messages()->first()]);
        } else {
            $image = $request->image;  // your base64 encode
            if ($image) {
                if($request->image != null){
                    $imageName = $this->MoveImage($request->image,'uploads/users_images');
                }
                $user->update([ 'image' => $imageName ]);
                $user_data = User::where('id', Auth::user()->id)->select('id', 'image', 'name', 'email', 'phone')->first();
                $user_data['token_api'] = null;
                $user_data['otp_code'] = null;
                if ($user) {
                    return msgdata($request, success(), 'update_profile_success', $user_data);
                } else {
                    return response()->json(msg($request, failed(), 'update_profile_warning'));
                }
            }else{
                return response()->json(msg($request, failed(), 'you should upload image'));
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
            return msgdata($request, success(), 'send_reset_link', array('token' => $token));
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

    public function getDataProfile()
    {
        $user = User::where('id', Auth::user()->id)->select('id', 'image', 'name', 'email', 'phone')->first();
        $user['token_api'] = null;
        $user['otp_code'] = null;
        return msgdata("", success(), ' successfully_get_data_Profile', $user);
    }
    public function consolutions_data(Request $request)
    {
        $user = consolution_kind::select('id','name_'.$request->header('lang').' as name')->orderBy('created_at','desc')->get();
        return msgdata("", success(), ' successfully get data', $user);
    }

    public function consolutions_store(Request $request)
    {
        $user = Auth::user();
        $user = User::find($user->id);
        if (!$user)
            return response()->json(['status' => 401, 'msg' => 'User Not Found']);
        $rules = [
            'full_name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'country' => 'required',
            'content' => 'required',
            'consolution_kind_id' => 'required|exists:consolution_kinds,id',
            ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['status' => 401, 'msg' => $validator->messages()->first()]);
        } else {
            $data = $request->all();
            $data['user_id'] = $user->id ;
            $result = Consolution::create($data);
            return msgdata($request, success(), 'added successfully', $result);
        }
    }

}
