<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecruimentStoreRequest extends FormRequest
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
            'user_id'             => 'required',
            'vacancy'             => 'required',
            'quantity'            => 'required',
            'rank_id'             => 'required',
            'type_of_work_id'     => 'required',
            'city_id'             => 'required',
            'career_id'           => 'required',
            'salary_id'           => 'required',
            'description'         => 'required',
            'entitlements'        => 'required',
            'job_requirements'    => 'required',
            'requested_documents' => 'required',
            'photo'               => 'required',
            'end_date'            => 'required',
        ];
    }

    public function messages()
    {
        return [
            'user_id.required'             => 'user_id không được để trống.',
            'vacancy.required'             => 'Tên công việc không được để trống.',
            'quantity.required'            => 'Số lượng không được để trống.',
            'rank_id.required'             => 'rank_id không được để trống.',
            'type_of_work_id.required'     => 'type_of_work_id không được để trống.',
            'city_id.required'             => 'city_id không được để trống.',
            'career_id.required'           => 'career_id không được để trống.',
            'salary_id.required'           => 'salary_id không được để trống.',
            'description.required'         => 'Mô tả công việc không được để trống.',
            'entitlements.required'        => 'Quyền lợi không được để trống.',
            'job_requirements.required'    => 'Yêu cầu công việc không được để trống.',
            'requested_documents.required' => 'Yêu cầu hô sơ không được để trống.',
            'photo.required'               => 'Ảnh công việc không được để trống.',
            'end_date.required'            => 'Hạn nộp hồ sơ không được để trống.',

        ];
    }
}
