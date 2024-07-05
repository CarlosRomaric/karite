<?php

namespace App\Http\Requests\Agribusinesses;

use Illuminate\Foundation\Http\FormRequest;

class AgribusinessCreateRequest extends FormRequest
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
            'name' => 'required',
            'acronym' => 'required',
            'address' => 'required',
            'person_responsible_name' => 'required_with:person_responsible_phone',
            'person_responsible_phone' => 'required_with:person_responsible_name'
        ];
    }
}
