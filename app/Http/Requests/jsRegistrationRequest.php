<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class jsRegistrationRequest extends FormRequest
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
            'first_name' => 'required|regex:/^[\pL\s\-]+$/u|max:255',
            'last_name' => 'required|regex:/^[\pL\s\-]+$/u|max:255',
            'email' => 'required|email:rfc,dns|unique:employees,email',
            'phone_number' => 'bail|numeric|digits:11|regex:/^(?:\+?88)?01[3-9]\d{8}$/',
            'password' => 'required|min:8|max:20|confirmed',
        ];
    }
}
