<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CareerInfoRequest extends FormRequest
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
            'job_level'=>'required',
            'job_nature'=>'required',
            'present_salary' => 'required|integer|digits_between:2,10',
            'expected_salary' => 'required|integer|digits_between:2,10',
            'objective'=>'required',
            'pre_job_categories'=>'required',
            'pre_organization_type'=>'required',
            'pre_job_location'=>'required',
            'career_summary'=>'required',
        ];
    }
}
