<?php

namespace App\Http\Controllers\API;

use App\Mail\UserRestPasswordApi;
use App\Models\City;
use App\Models\Consolution;
use App\Models\consolution_kind;
use Carbon\Carbon;
use phpDocumentor\Reflection\Types\True_;
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
use Teckwei1993\Otp\Otp;
use Teckwei1993\Otp\Rules\OtpValidate;
use Ghanem\LaravelSmsmisr\Facades\Smsmisr;


class UsersController extends Controller
{
    use GeneralTrait;

    public $objectName;

    public function __construct(User $model)
    {
        $this->objectName = $model;
    }

    public function updatelang(Request $request)
    {

        $rules = [
            'lang' => 'required|string',
        ];
        $user = User::find(Auth::user()->id);
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['status' => 401, 'msg' => $validator->messages()->first()]);
        } else {
            $user->update([
                'lang' => $request->lang,
            ]);
            $data['status'] = true;
            return msgdata($request, success(), 'update user lang success', $data);
        }

    }

    public function updateProfile(Request $request)
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        if (!$user)
            return response()->json(['status' => 401, 'msg' => 'User Not Found']);

        //remove first zero in phone
        $request->phone = ltrim($request->phone, "0");
        $city = City::findOrFail($request->city_id);
        $user_phone = $request->phone;
        $request->phone = $city->country_code . $request->phone ;
        $rules = [
            'name' => 'required|regex:/^[\pL\s\-]+$/u',
            'email' => 'required|email|unique:users,email,' . $id,
            'phone' => 'required|unique:users,phone,' . $id,
            'otp_code' => '',
            'city_id' => 'required|exists:cities,id'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['status' => 401, 'msg' => $validator->messages()->first()]);
        } else {
            //check phone change
            if ($request->phone == Auth::user()->phone) {
                $user->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'city_id' => $request->city_id
                ]);
            } else {

                $otb = \Otp::generate($request->phone);
                $user->update([
                    'otp_code' => $otb,
                ]);
                //send here by sms api ...
                if (empty($request->otp_code)) {
                    Smsmisr::send("كود التفعيل الخاص بك هوا " . $otb, $request->phone, null, 2);
                    $data['status'] = true;
                    $data['otp_code'] = $otb;
                    return msgdata($request, success(), 'otp code sent successfully to new phone', $data);
                } else {
                    if ($request->otp_code == Auth::user()->otp_code) {
                        $user->update([
                            'name' => $request->name,
                            'email' => $request->email,
                            'user_phone' => $user_phone,
                            'phone' => $request->phone,
                            'city_id' => $request->city_id,
                            'otp_code' => null,
                        ]);
                    } else {
                        return response()->json(msg($request, failed(), 'update_profile_warning'));
                    }
                }
            }
            $user_data = User::where('id', Auth::user()->id)->select('id', 'image', 'name', 'email', 'phone', 'city_id')->first();
            $user_data['token_api'] = null;
            $user_data['otp_code'] = null;
            if ($user) {
                return msgdata($request, success(), 'update_profile_success', $user_data);
            } else {
                return response()->json(msg($request, failed(), 'update_profile_warning'));
            }
        }
    }

    public function update_city(Request $request)
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        if (!$user)
            return response()->json(['status' => 401, 'msg' => 'User Not Found']);
        $rules = [
            'city_id' => 'required|exists:cities,id'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['status' => 401, 'msg' => $validator->messages()->first()]);
        } else {
            $user->update([
                'city_id' => $request->city_id
            ]);
            return msgdata($request, success(), 'update_profile_success', (object)[]);
        }
    }

    public function update_password(Request $request)
    {
        $rules = [
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['status' => 401, 'msg' => $validator->messages()->first()]);
        } else {
            $id = Auth::user()->id;
            $user = User::find($id);
            if ($request->password == $request->password_confirmation) {
                $user->update(['password' => Hash::make($request->password)]);
                $data['status'] = true;
                return msgdata($request, success(), 'update password successfuly', $data);
            } else {
                return response()->json(['status' => 401, 'msg' => 'o']);
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
                if ($request->image != null) {
                    $imageName = $this->MoveImage($request->image, 'uploads/users_images');
                }
                $user->update(['image' => $imageName]);
                $user_data = User::where('id', Auth::user()->id)->select('id', 'image', 'name', 'email', 'phone', 'city_id')->first();
                $user_data['token_api'] = null;
                $user_data['otp_code'] = null;
                if ($user) {
                    return msgdata($request, success(), 'update_profile_success', $user_data);
                } else {
                    return response()->json(msg($request, failed(), 'update_profile_warning'));
                }
            } else {
                return response()->json(msg($request, failed(), 'you should upload image'));
            }


        }
    }


    public function forgot_password_post(Request $request)
    {
        if (empty($request->otp_code)) {
            $user = User::where('phone', $request->phone)->first();
            if (!empty($user)) {
                $otb = \Otp::generate($user->phone);
                $send = Smsmisr::send("كود إستعادة كلمة المرور الخاصة بك " . $otb, $user->phone, null, 2);
                $user->update([
                    'otp_code' => $otb,
                ]);
                $data['status'] = true;
                $data['otp_code'] = $otb;
                return msgdata($request, success(), 'otp code sent successfully', $data);
            } else {
                $data['status'] = false;
                return msgdata($request, failed(), 'this user not found', $data);
            }
        } else {
            $user_otp = User::select('otp_code')->where('phone', $request->phone)->first();
            if ($request->otp_code == $user_otp->otp_code) {
                $data['status'] = true;

                return msgdata($request, success(), 'otp true', $data);
            } else {
                $data['status'] = false;
                return msgdata($request, failed(), 'otp false', $data);
            }
        }
    }

    public function reset_password_forget(Request $request)
    {
        $rules = [
            'phone' => 'required',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(msg($request, failed(), $validator->messages()->first()));
        } else {

            $user_otb = User::where('phone', $request->phone)->first();

            if ($request->otp_code == $user_otb->otp_code) {

                $user_otb->password = Hash::make($request->password);
                $user_otb->otp_code = null;
                $user_otb->verified = 1;
                $user_otb->save();

                $data['status'] = true;
                return msgdata($request, success(), 'change password true', $data);
            } else {
                $data['status'] = false;
                return msgdata($request, failed(), 'otp false', $data);
            }
        }
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

    public function getDataProfile(Request $request)
    {
        $user = User::where('id', Auth::user()->id)->select('id', 'image', 'name', 'email', 'phone', 'city_id')->first();
        $user->fcm_token = $request->fcm_token;
        $user->save();
        $user['token_api'] = null;
        $user['otp_code'] = null;
        return msgdata("", success(), ' successfully_get_data_Profile', $user);
    }

    public function consolutions_data(Request $request)
    {
        if ($request->header('lang') == null) {
            $lang = 'ar';
        } else {
            $lang = $request->header('lang');
        }
        $user = consolution_kind::select('id', 'name_' . $lang . ' as name')->orderBy('created_at', 'desc')->get();
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
//            'consolution_kind_id' => 'required|exists:consolution_kinds,id',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['status' => 401, 'msg' => $validator->messages()->first()]);
        } else {
            $data = $request->all();
            $data['user_id'] = $user->id;
            $result = Consolution::create($data);
            return msgdata($request, success(), 'added successfully', $result);
        }
    }

    public function generate_otp(Request $request)
    {
        $userPhone = Auth::user()->phone;
        $otb = \Otp::generate($userPhone);
        $send = Smsmisr::send("كود التفعيل الخاص بك هوا " . $otb, $userPhone, null, 2);
        return msgdata($request, success(), 'otp', $otb);
    }

    public function otp_validate(Request $request)
    {
        //phone
        $userPhone = Auth::user()->phone;
        $otp = $request->otp;
        $result = \Otp::validate($userPhone, $otp);
        if ($result->status == true) {
            return msgdata($request, success(), 'this otp is valied', '');
        } else {
            return msgdata($request, failed(), $result->error, '');
        }
    }
}
