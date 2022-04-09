<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;


class HomeController extends Controller
{
    public function index()
    {
        return view('seller.index');
    }
    public function home()
    {
        return view('seller.dashboard.home');
    }


    public function viewprofile(Request $request)
    {
        return view('viewprofile');
    }

    public function change_lang(Request $request,$lang)
    {
        if (session()->has('lang')) {
            session()->forget('lang');
        }
        session()->put('lang', $lang);
        \App::setLocale($lang);
        return back();
    }
    //profile
    public function profile()
    {
        return view('seller.dashboard.profile.edit');
    }

    public function update_profile(ProfileRequest $request, $id)
    {
        $data = $request->all();
        $validator = Validator::make($data,
            [
                'name' => 'required|max:191|min:3',
                'email' => [
                    'required',
                    'email',
                    'max:191',
                    Rule::unique('admins', 'email')->ignore(auth()->user()->id)
                ],
                'phone' => [
                    'required',
                    'numeric',
                    Rule::unique('admins', 'phone')->ignore(auth()->user()->id)
                ],
                'password' => [
                    'nullable',
                    'min:6',
                    'max:191',
                    Rule::requiredIf(function() {
                        return \Illuminate\Support\Facades\Request::routeIs('admins.store');
                    })
                ],
            ]
        );
        if ($validator->fails()) {
            return msgdata($request, failed(), $validator->messages()->first(), (object)[]);
        }

        // Get and Check Data
        $data = $this->model->findOrfail($id);

        // Get data from request
        $inputs = $request->validated();
        // Set Password if exist inputs data
        if (!empty($request->input('password'))) {
//            $inputs['password'] = bcrypt($request->input('password'));
        } else {
            unset($inputs['password']);
        }
        $updated = $data->update($inputs);

        return redirect()->route($this->route)->with('success', 'تم تعديل الملف الشخصي بنجاح');
    }
}
