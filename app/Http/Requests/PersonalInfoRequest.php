<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PersonalInfoRequest extends FormRequest
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
            'image'=>['image','mimes:jpg,png'],
            'first_name' => ['required','regex:/^[\pL\s\-]+$/u','max:255'],
            'last_name' => ['required','regex:/^[\pL\s\-]+$/u','max:255'],
            'phone_number' => ['bail','numeric','digits:11','regex:/^(?:\+?88)?01[3-9]\d{8}$/','unique:job_seekers,phone_number,'.$this->id],
            'nid' => ['numeric','digits_between:10,17','unique:job_seekers,nid,'.$this->id],
            'father_name'=>['required','regex:/^[\pL\s\-]+$/u','max:255'],
            'mother_name'=>['required','regex:/^[\pL\s\-]+$/u','max:255'],
        ];
    }

}
