<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Seller;
use App\Notifications\forget_password;
use App\Notifications\ForgetPassword;
use Carbon\Carbon;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;


class AuthController extends Controller
{
    public function index()
    {
        if (Auth::guard('bank')->check()) {
            return redirect(route('bank.home'));
        } elseif (Auth::guard('web')->check()) {
            return redirect(route('home'));
        } elseif (Auth::guard('seller')->check()) {
            return redirect(route('seller.home'));
        }
        return view('seller.auth.login');
    }


    public function login(Request $request)
    {
        $remeber = $request->Remember == 1 ? true : false;
        if (Auth::guard('seller')->attempt(['email' => $request->email, 'password' => $request->password], $remeber)) {
            //Check if active user or not
//            if (Auth::guard('seller')->user()->status != 'active') {
//                Auth::guard('seller')->logout();
//                session()->flash('danger', trans('bank.not_auth'));
//                return redirect()->route('seller.login');
//            } else {
//                return redirect()->route('seller.home');
//            }
            return redirect()->route('seller.home');
        } else {
            session()->flash('danger', trans('bank.invaldemailorpassword'));
            return redirect(route('seller.login'));
        }
    }

    public function sign_up()
    {
        return view('seller.auth.sign_up');
    }

    public function sign_up_store(Request $request)
    {
        $data = $this->validate(request(),
            [
                'name' => 'required|max:191|min:3',
                'image' => 'nullable|mimes:jpeg,jpg,png',
                'email' => [
                    'required',
                    'email',
                    'max:191',
                    'unique:sellers,email'
                ],
                'phone' => [
                    'required',
                    'regex:/^([0-9\s\-\+\(\)]*)$/',
                    'max:14'
                ],
                'password' => [
                    'required',
                    'min:6',
                    'max:191',
                    'required_with:password_confirm',
                    'confirmed'
                ],
            ]);
        Seller::create($data);
        return redirect()->route('seller.login')->with('success', 'تم انشاء حسابك بنجاح .... يرجى تسجيل الدخول');
    }

    public function forget_password()
    {
        return view('seller.auth.forget_password');
    }

    public function forget_password_store(Request $request)
    {
        $data = $this->validate(request(),
            [
                'email' => [
                    'required',
                    'email',
                    'max:191',
                    'exists:sellers,email'
                ],
            ]);
        $seller = Seller::where('email',$request->email)->first();
        $code = 1234;
//        $code = rand('1000', '9999');
        $email = $request->email;
        $subject = 'تغيير كلمة المرور';
        $message = 'كود التحقق من البريد الالكتروني لتغيير كلمة المرور : ' . $code;
        Mail::send('mail.forget_password', $data, function ($message) use ($email, $subject) {
            $message->to($email)->subject($subject);
        });

//        $data_verify['code'] = $code;
//        $data_verify['message'] = $message;
//        $data_verify['email'] = $email;
//        $seller->notify(new forget_password($data_verify));

        $exist_email_token = DB::table('password_resets')
            ->where('email', $request->email)->first();
        if($exist_email_token){
            DB::table('password_resets')->where('email', $request->email)->update([
                'email' => $request->email,
                'token' => $code, //change 60 to any length you want
                'created_at' => Carbon::now()
            ]);
        }else{
            DB::table('password_resets')->insert([
                'email' => $request->email,
                'token' => $code, //change 60 to any length you want
                'created_at' => Carbon::now()
            ]);
        }
        return redirect()->route('seller.forget_password.check_code', $email)->with('success', 'تم ارسال كود التحقق من البريد الإلكتروني ... لتغيير كلمة المرور');
    }
    public function forget_password_check_code($email)
    {

        return view('seller.auth.forget_password_check_code', compact('email'));
    }

    public function forget_password_check_code_store(Request $request)
    {
        $data = $this->validate(request(),
            [
                'token' => [
                    'required'
                ],
                'email' => 'required|exists:sellers,email'
                ,
            ]);
        $tokenData = DB::table('password_resets')
            ->where('email', $request->email)->where('token', $request->token)->first();
        if ($tokenData) {
            //success
            DB::table('password_resets')
                ->where('email', $request->email)->where('token', $request->token)->delete();
            return redirect()->route('seller.change_password',$request->email)->with('success', 'تم التحقق من البريد الإلكتروني ... يرجى كتابة رقم مرور جديد');
        } else {
            //fail
            return redirect()->back()->with('danger', 'كود التحقق خطأ ... يرجى المحاولة مره اخرى');
        }
    }

    public function change_password_store(Request $request)
    {
        $data = $this->validate(request(),
            [
                'email' => [
                    'required',
                    'email',
                    'max:191'
                ],
                'password' => [
                    'required',
                    'min:6',
                    'max:191',
                    'required_with:password_confirm',
                    'confirmed'
                ],
            ]);
       $seller = Seller::where('email',$request->email)->first();
        if ($seller) {
            //success
            $seller->password = $request->password ;
            $seller->save();
            return redirect()->route('seller.login')->with('success', 'تم تغيير كلمة المرور بنجاح');
        } else {
            //fail
            return redirect()->back()->with('danger', 'لم يتم العثور على حساب التاجر لتغيير كلمة المرور');
        }
    }

    public function change_password($email)
    {
        return view('seller.auth.change_password', compact('email'));
    }

    public function logout()
    {
        Auth::guard('seller')->logout();
        return redirect()->route('seller.login');
    }



}
