<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'body_ar' => 'nullable|string',
            'body_en' => 'nullable|string',
            'price' => 'required|string|max:255',
            'quantity' => 'required|numeric',
            'benefits' => 'nullable|array',
            'section_id' => 'required|exists:sections,id',
            'sub_section_id' => 'nullable|exists:sections,id',
            'type' => 'required|in:direct_installment,not_direct_installment',
            'image' => [
                'nullable',
                'mimes:jpeg,jpg,png',
                Rule::requiredIf(function () {
                    return Request::routeIs('seller.product.store');
                })
            ],
        ];
    }
}
