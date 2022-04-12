<?php

namespace App\Http\Controllers\API\Banko;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;

class ProfileController extends Controller
{
    public function get(Request $request)
    {
        $user = auth()->user();
        $data = User::where('id', $user->id)->first();
        return msgdata($request, failed(), 'تم عرض البيانات بنجاح', $data);
    }

    public function update(Request $request)
    {
        $user = auth()->user();
        $data = $request->all();
        $rules = [
            'name' => 'required|string',
            'phone' => 'required|string|unique:users,phone,' . $user->id,
            'image' => 'nullable|image',
            'email' => 'nullable|email|unique:users,email,' . $user->id,
            'password' => 'nullable|confirmed'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['status' => 401, 'msg' => $validator->messages()->first()]);
        } else {
            if ($request->password) {
                $data['password'] = bcrypt(request('password'));
            } else {
                unset($data['password']);
            }
            if ($request->image) {
                $data['image'] = $this->MoveImage($request->image, 'uploads/users_images');
            } else {
                unset($data['image']);
            }
            unset($data['password_confirmation']);
            User::where('id', $user->id)->update($data);
            $user = User::findOrFail($user->id);
            return msgdata($request, success(), 'تم تعديل الملف الشخصي بنجاح', $user);
        }
    }
}
