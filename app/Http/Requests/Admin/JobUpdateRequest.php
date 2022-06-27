<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class JobUpdateRequest extends FormRequest
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
            'job_title' => ['required', 'string', 'max:200', 'min:5'],
            'vacancy' => ['required', 'numeric', 'max:200'],
            'employment_status' => ['required', 'in:full_time,part_time,contract,online,freelance,internship'],
            'job_location' => ['required', 'in:inside_dhaka,outside_dhaka,all_bangladesh'],
            'salary_type' => ['required', 'in:fixed,range,negotiable'],
            'job_categories' => ['required', 'numeric', 'exists:job_categories,id'],
            'min_experience' => ['required'],
            'gender' => ['required', 'in:male,female,both'],
            'age' => ['required', 'string', 'max:6'],
            'educational_requirements' => ['required', 'string', 'exists:education,name'],
            'additional_requirements' => ['array'],
            'job_responsibilities.*' => ['required_if:status,publish', 'max:200'],
            'additional_requirements.*' => ['string', 'max:200'],
            'other_benefits.*' => ['max:200'],
            'salary' => ['required_if:status,publish'],
            'job_context' => ['required','string', 'max:1000'],
            'job_notes' => ['nullable','max:1000'],
            'slug' => ['required']
        ];
    }

    public function prepareForValidation()
    {
        if ($this->salary_type == 'fixed') {
            $salary = $this->salary;
        } elseif ($this->salary_type == 'range') {
            $salary = $this->min_salary.'-'.$this->max_salary;
        } elseif ($this->salary_type == 'negotiable') {
            $salary = 'negotiable';
        }

        $this->merge([
            'salary' => $salary,
            'additional_requirements' =>array_filter($this->additional_requirements, function($a) {
                return trim($a) !== "";
            }),
            'other_benefits' =>array_filter($this->other_benefits, function($a) {
                return trim($a) !== "";
            }),
            'job_notes'=>empty($this->job_notes)?null:$this->job_notes
        ]);
    }

    public function messages()
    {
        return [
            'job_responsibilities.*.required_if'=>'Please Fill up at least one Job Responsibility before publish',
            'job_responsibilities.*.max'=>'Once single responsibility can mbe maximum :max characters'
        ];
    }

}
