<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CandidateStoreRequest extends FormRequest
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
            'name'     => 'required',
            'phone'    => 'required',
            'email'    => 'required',
            'password' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required'     => 'Email không được để trống.',
            'phone.required'    => 'Số điện thoại không được để trống.',
            'email.required'    => 'Email không được để trống.',
            'password.required' => 'Mật khẩu không được để trống.',
        ];
    }
}
