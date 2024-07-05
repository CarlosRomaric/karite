<?php

namespace App\Http\Requests\Roles;

use Illuminate\Foundation\Http\FormRequest;

class RolePermissionAssignmentRequest extends FormRequest
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
            //'permission_id' => 'required|array'
        ];
    }

    public function messages()
    {
        return [
            'permission_id.required' => 'Veuillez cocher au moins une permission'
        ];
    }
}
