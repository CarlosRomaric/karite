<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'username' => 'required|string',
            'password' => 'required|string|min:4'
        ];
    }


    public function messages()
    {
        return [
            'username.required'=>'le nom d\'utilisateur est obligatoire',
            'username.string'=>'le nom d\'utilisateur doit etre de type alpha numérique',
            'password.required'=>'votre mot de passe est obligatoire',
            'password.min'=>'votre mot de passe doit faire plus de 4 caractères',
        ];
    }
}
