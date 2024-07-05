<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
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
            'fullname' => 'required|string',
            'username' => 'required|string',
            'phone' => 'required|string',
            'current_password' => 'nullable|required_with:password_confirmation,password|min:4',
            'password' => 'nullable|min:4|required_with:password_confirmation,current_password|same:password_confirmation',
            'password_confirmation' => 'nullable|min:4|required_with:current_password,password|same:password',
        ];
    }
}
