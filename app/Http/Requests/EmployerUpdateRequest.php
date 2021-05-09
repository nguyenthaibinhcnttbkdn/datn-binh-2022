<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployerUpdateRequest extends FormRequest
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
            'avatar'      => 'required',
            'contact'     => 'required',
            'company'     => 'required',
            'phone'       => 'required',
            'address'     => 'required',
            'website'     => 'required',
            'description' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'avatar.required'      => 'avatar không được để trống.',
            'contact.required'     => 'Tên liên hệ không được để trống.',
            'company.required'     => 'Tên công ty không được để trống.',
            'phone.required'       => 'Số điện thoại không được để trống.',
            'address.required'     => 'Địa chỉ không được để trống.',
            'website.required'     => 'Địa chỉ website không được để trống.',
            'description.required' => 'Mô không được để trống.',
        ];
    }
}
