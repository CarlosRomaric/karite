<?php

namespace App\Http\Requests\Import;

use Illuminate\Foundation\Http\FormRequest;

class FileImportRequest extends FormRequest
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
            'data' => 'required|file|mimes:csv,xls,xlsx'
        ];
    }

    public function messages()
    {
        return [
            'data.required' => 'Veuillez joindre le fichier excel à importer.'
        ];
    }


}
