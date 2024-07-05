<?php

namespace App\Http\Requests\Farmers;

use Illuminate\Foundation\Http\FormRequest;

class FarmerUpdateRequest extends FormRequest
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
            'fullname' => 'required',
            'identifier' => 'required',
            'born_date' => 'required',
            'born_place' => 'required',
            'locality' => 'required',
            'phone' => 'required|min:2',
            'sexe' => 'required|in:AUCUN,H,F',
            'number_of_children' => 'required|min:0',
            'number_of_dependants' => 'required|min:0',
            'marital_status' => 'required',
            'number_of_women' => 'required|min:0',
            'number_of_plots' => 'required|min:0',
            'picture' => 'file|mimes:jpeg,bmp,png,gif',
            'agribusiness_id' => 'required|exists:agribusinesses,id',

            'gps_code.*' => 'required_if:number_of_plots,>=,1',
            'total_area.*' => 'required_with:gps_code',
            'latitude.*' => 'required_with:gps_code',
            'longitude.*' => 'required_with:gps_code',
        ];
    }

    public function messages()
    {
        return [
            'fullname.required' => 'Le champ nom et prénoms est obligatoire.',
            'identifier.required' => 'Le champ identifiant est obligatoire.',
            'born_date.required' => 'Le champ date de naissance est obligatoire.',
            'born_place.required' => 'Le champ lieu de naissance est obligatoire.',
            'locality.required' => 'Le champ localité est obligatoire.',
            'number_of_children.required' => 'Le champ nombre d\'enfants est obligatoire.',
            'marital_status.required' => 'Le champ statut matrimonial est obligatoire.',
            'number_of_women.required' => 'Le champ nombre de femme est obligatoire.',
            'number_of_dependants.required' => 'Le champ nombre de personne à charge est obligatoire.',
            'agribusiness_id.required' => 'Le champ coopérative est obligatoire.',
            'picture.required' => 'Le champ photo du producteur est obligatoire.',
        ];
    }

}
