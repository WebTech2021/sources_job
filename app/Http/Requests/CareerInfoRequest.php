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
            'objective'=>'required|max:760',
            'career_summary'=>'required|max:760',
            'special_qualification'=>'required|max:760',
        ];
    }
}
