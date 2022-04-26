<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UpdateProfileRequest extends FormRequest
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
            'first_name' => 'regex:/^[\pL\s\-]+$/u|max:255',
            'last_name' => 'regex:/^[\pL\s\-]+$/u|max:255',
            'email' => ['email:rfc,dns', 'unique:job_seekers,email,' . decrypt($this->id)],
            'phone_number' => 'bail|numeric|digits:11|regex:/^(?:\+?88)?01[3-9]\d{8}$/',
            'password' => 'min:8|max:20|confirmed',
            'old_password' => ['required_if:password,', function ($attribute, $value, $fail) {
                if (!Hash::check($value, Auth::user()->password)) {
                    $fail('Wrong Old Password');
                }
            },],
        ];
    }
}
