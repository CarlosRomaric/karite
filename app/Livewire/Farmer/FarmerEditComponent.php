<?php

namespace App\Livewire\Farmer;

use App\Models\Plot;
use App\Models\Farmer;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Agribusiness;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Carbon\Carbon;

class FarmerEditComponent extends Component
{
    use WithPagination, WithFileUploads;
    public $farmerId;

    public  $identifier, $gps_code, $fullname, $born_date, $born_place, $locality, $phone,  $sexe;
    public  $number_of_children, $number_of_dependants,  $marital_status,  $number_of_women;
    public  $manager_fullname, $manager_phone, $manager_sexe,  $picture, $agribusiness_id;


    #[Url] 
    public $search = '';
    public $selectedLimitPaginate;

    public $isOpenEdit = 0;
    public $isOpenDelete = 0;
    public $plotFormCount = 1;

    public  function rules(){
        $rules =  [
            'picture' => 'file|mimes:jpeg,bmp,png,gif',
            'agribusiness_id' => 'required|exists:agribusinesses,id',
            'locality' => 'required',
            'identifier' => 'required',
            'gps_code'=>'required',
            'fullname' => 'required',
            'sexe' => 'required|in:AUCUN,H,F',
            'phone' => 'required|min:2',
            'born_date' => 'required',
            'born_place' => 'required',
            'manager_fullname'=>'required',
            'manager_sexe'=>'required',
            'manager_phone'=>'required',
            'marital_status'=>'required',
            'number_of_children' => 'required|min:0',
            'number_of_dependants' => 'required|min:0',
            'marital_status' => 'required',
            'number_of_women' => 'required|min:0',
        ];

        return $rules;
    }

    public function messages()
    {
        $messages = [
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

        return $messages;
    }

    public function openModalEdit(){
        $this->isOpenEdit = true;
    }

    public function closeModalEdit(){
        $this->resetInputEdit();
        $this->isOpenEdit = false;
    }
    public function editFarmer($id){
        $this->openModalEdit();
        $farmer = Farmer::findOrFail($id);
        $this->identifier = $farmer->identifier;
        $this->gps_code = $farmer->gps_code;
        $this->fullname = $farmer->fullname;
        $this->born_date = $farmer->born_date;
        $this->locality = $farmer->locality;
        $this->phone= $farmer->phone;
        $this->sexe = $farmer->sexe;
        $this->number_of_children = $farmer->number_of_children;
        $this->number_of_dependants =$farmer->number_of_dependants;
        $this->marital_status= $farmer->marital_status;
        $this->number_of_women =$farmer->number_of_women;
        $this->manager_fullname= $farmer->manager_fullname;
        $this->manager_phone= $farmer->manager_phone;
        $this->manager_sexe= $farmer->manager_sexe;
        $this->picture= $farmer->picture;
        $this->agribusiness_id=$farmer->agribusiness_id;
        $this->emit('farmerEdited', $id);
    }
    public function updateFarmer(){
       $this->validate();
    }

    public function resetInputEdit(){
        $this->identifier = '';
        $this->gps_code = '';
        $this->fullname = '';
        $this->born_date = '';
        $this->locality = '';
        $this->phone= '';
        $this->sexe = '';
        $this->number_of_children = '';
        $this->number_of_dependants ='';
        $this->marital_status= '';
        $this->number_of_women ='';
        $this->manager_fullname= '';
        $this->manager_phone= '';
        $this->manager_sexe= '';
        $this->picture= '';
        $this->agribusiness_id='';
    }


    public function render()
    {
        return view('livewire.farmer.farmer-edit-component');
    }
}
