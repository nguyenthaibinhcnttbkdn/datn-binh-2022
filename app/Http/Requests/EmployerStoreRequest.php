<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployerStoreRequest extends FormRequest
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
            'email'    => 'required',
            'password' => 'required',
            'contact'  => 'required',
            'company'  => 'required',
            'phone'    => 'required',
            'address'  => 'required',
        ];
    }

    public function messages()
    {
        return [
            'email.required'    => 'Email không được để trống.',
            'password.required' => 'Mật khẩu không được để trống.',
            'contact.required'  => 'Tên liên hệ không được để trống.',
            'company.required'  => 'Tên công ty không được để trống.',
            'phone.required'    => 'phone không được để trống.',
            'address.required'  => 'company_name không được để trống.',
        ];
    }
}
