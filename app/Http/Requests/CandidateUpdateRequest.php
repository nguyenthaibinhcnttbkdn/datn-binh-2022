<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CandidateUpdateRequest extends FormRequest
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
            'name'       => 'required',
            'phone'      => 'required',
            'avatar'     => 'required',
            'position'   => 'required',
            'address'    => 'required',
            'experience' => 'required',
            'birthday'   => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required'       => 'Email không được để trống.',
            'phone.required'      => 'Số điện thoại không được để trống.',
            'avatar.required'     => 'Avatar không được để trống.',
            'position.required'   => 'Vị trí không được để trống.',
            'address.required'    => 'Địa chỉ không được để trống.',
            'experience.required' => 'Kinh nghiệm không được để trống.',
            'birthday.required'   => 'Ngày sinh không được để trống.',
        ];
    }
}
