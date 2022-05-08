<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Request;
use Illuminate\Validation\Rule;

class ProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true ;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:191|min:3',
            'email' => [
                'required',
                'email',
                'max:191',
                Rule::unique('admins', 'email')->ignore(auth()->guard('seller')->user()->id)
            ],
            'phone' => [
                'required',
                'numeric',
                Rule::unique('admins', 'phone')->ignore(auth()->guard('seller')->user()->id)
            ],
            'password' => [
                'nullable',
                'confirmed',
                'min:6',
                'max:191'
            ],
        ];
    }
}
