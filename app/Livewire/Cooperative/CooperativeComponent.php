<?php

namespace App\Livewire\Cooperative;

use App\Models\Role;
use App\Models\User;
use App\Models\Region;
use Livewire\Component;
use App\Models\Departement;
use App\Models\Agribusiness;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule; 
use App\Models\AgribuisinessSave;

class CooperativeComponent extends Component
{
    use WithFileUploads;

    public $step = 1;
    // Propriétés pour l'étape 1
    public $matricule, $denomination, $sigle, $departement_id, $headquaters,  $address, $certification, $dfe, $bank, $registre_commerce;
    public $number_sections, $number_unite_transformations, $logo;
    public $region_id="";
    public $departements = [];
    // Propriétés pour l'étape 2
    public $firstname_pca, $lastname_pca, $phone_pca, $email_pca, $photo_pca;
    public $firstname_sup, $lastname_sup, $phone_sup, $email_sup, $photo_sup;
    public $close = 0;

    public function rules():array
    {
        $rules = [

            'matricule'=>'required',
            'denomination'=>'required',
            'sigle'=>'required',
            'region_id'=>'required',
            'departement_id'=>'required',
            'headquaters'=>'required',
           
            'certification'=>'required',
            'dfe'=>'required|mimes:pdf,png,jpeg,jpg|max:2048',
            'bank'=>'required',
            'registre_commerce'=>'required|mimes:pdf,png,jpeg,jpg|max:2048',
            'number_sections'=>'required|numeric',
            'number_unite_transformations'=>'required|numeric',

            'firstname_pca'=>'required',
            'lastname_pca'=>'required',
            'phone_pca'=>'required',
            'email_pca'=>'email',
            'photo_pca'=>'image|max:2048',
           
            'firstname_sup'=>'required',
            'lastname_sup'=>'required',
            'phone_sup'=>'required',
            'email_sup'=>'email',
            'photo_sup'=>'image|max:2048',
            

        ];

        if ($this->logo) {
            $rules['logo'] = 'mimes:pdf,png,jpeg,jpg|max:2048';
        }
        
        
        return $rules;
    }

    public function messages():array
    {
        $messages = [
            'required'=>'ce champ est obligatoire',
            'image'=>'ce champ doit être une image',
            'logo.mimes'=>'le fichier que vous devez uploader doit être de l\'un de ces types csv,xlsx,xlsl,xls'
        ];
        
        return $messages;
    }

    public function mount(){
      
    }

    public function updatedRegionId($region_id){
        
        
        if(!is_null($region_id)){
            $this->departements = Departement::where('region_id','=',$region_id)->get();
        }
        
    }


    public function nextStep()
    {
        // Validation éventuelle des données de l'étape actuelle

        // Passage à l'étape suivante
       
        $this->step++;
    }

    public function prevStep()
    {
        // Passage à l'étape précédente
        
        $this->step--;
    }

    public function goToNextStep() {
        switch ($this->step) {
            case 1:
                $this->validate([
                    'matricule'=>'required',
                    'denomination'=>'required',
                    'sigle'=>'required',
                    'region_id'=>'required',
                    'departement_id'=>'required',
                    'headquaters'=>'required',
                    'certification'=>'required',
                    'dfe'=>'required|mimes:pdf,png,jpeg,jpg|max:2048',
                    'bank'=>'required',
                    'registre_commerce'=>'required|mimes:pdf,png,jpeg,jpg|max:2048',
                    'number_sections'=>'required|numeric',
                    'number_unite_transformations'=>'required|numeric',
                ]);

                $this->nextStep();
                break;
            case 2:
                $this->validate([
                    'firstname_pca'=>'required',
                    'lastname_pca'=>'required',
                    'phone_pca'=>'required',
                    'email_pca'=>'email',
                    'photo_pca'=>'image|max:2048',
                
                    'firstname_sup'=>'required',
                    'lastname_sup'=>'required',
                    'phone_sup'=>'required',
                    'email_sup'=>'email',
                    'photo_sup'=>'image|max:2048',
                ]);
                $this->nextStep();
                break;
            
            default:
                // Optionally handle an invalid step
                throw new \Exception("Invalid step: " . $this->step);
        }
        
       
    }

    public function saveCoop(){
       
        $validated = $this->validate($this->rules());
        //dd($validated);

        $agribusiness = new Agribusiness();
        $agribusiness->matricule = $this->matricule;
        $agribusiness->denomination = $this->denomination;
        $agribusiness->sigle = $this->sigle;
        $agribusiness->address = $this->address;
        $agribusiness->region_id = $this->region_id;
        $agribusiness->departement_id = $this->departement_id;
        $agribusiness->headquaters= $this->headquaters;
       // $agribusiness->bank = json_encode($this->bank);
        $agribusiness->bank = $this->bank;
        $agribusiness->certification = $this->certification;

        $filenameRg = $this->registre_commerce->getClientOriginalName();
        $pathRg = 'public/registre_commerciale/'.trim($this->sigle);
        $agribusiness->registre_commerce = $this->registre_commerce->storeAs($pathRg, $filenameRg);

        $filenameDfe = $this->dfe->getClientOriginalName();
        $pathDfe = 'public/dfe/'.trim($this->sigle);
        $agribusiness->dfe = $this->dfe->storeAs($pathDfe, $filenameDfe);
        $agribusiness->number_sections = $this->number_sections;
        $agribusiness->number_unite_transformations = $this->number_unite_transformations;

        if($this->logo){
            $pathFileProducers = $this->logo->getClientOriginalName();
            $filenameFileProducers = 'public/logo/'.trim($this->sigle);
            $agribusiness->logo = $this->logo->storeAs($pathFileProducers, $filenameFileProducers);
        }
      

        $agribusiness->status = 0;
        $agribusiness->save();

        $pca = new User();
        $pca->fullname = $this->lastname_pca.' '.$this->firstname_pca;
        $pca->username = str_replace(" ", "", $this->phone_pca);
        $pca->phone = str_replace(" ", "", $this->phone_pca);
        $pca->email = $this->email_pca; 
        $pca->agribusiness_id = $agribusiness->id;
        $pca->password = bcrypt($this->phone_pca);
        $pathPhotoPca = 'public/photo_pca/'.trim($this->sigle);
        $filenamePhotoPca = trim($this->photo_pca->getClientOriginalName());
        $pca->picture = $this->photo_pca->storeAs($pathPhotoPca, $filenamePhotoPca);
        $pca->job ='PCA';
        $pca->status = 0;
        $pca->save();
        $pca->roles()->sync(Role::where('name', 'SUPERVISEUR COOPERATIVE')->first()->id);

        $sup = new User();
        $sup->fullname = $this->lastname_sup.' '.$this->firstname_sup;
        $sup->username = trim($this->phone_sup);
        $sup->phone = trim($this->phone_sup);
        $sup->email = $this->email_sup; 
        $sup->agribusiness_id = $agribusiness->id;
        $sup->password = bcrypt($this->phone_sup);
        $pathPhotoSup = 'public/photo_sup/'.trim($this->sigle);
        $filenamePhotoSup = trim($this->photo_sup->getClientOriginalName());
        $sup->picture = $this->photo_sup->storeAs($pathPhotoSup, $filenamePhotoSup);
      
     
        $sup->job = 'SUPERVISEUR';
        $sup->status = 0;
        $sup->save();
        $sup->roles()->sync(Role::where('name', 'SUPERVISEUR COOPERATIVE')->first()->id);
        $this->resetInput();
        session()->flash('message','votre demande d\'inscription de cooperative a bien été enregistré ');
    }

    public function resetInput(){
        $this->matricule = '';
        $this->denomination = '';
        $this->sigle = '';
        $this->address='';
        $this->region_id='';
        $this->certification='';
        $this->dfe='';
        $this->bank='';
        $this->registre_commerce='';
        $this->number_sections='';
        $this->number_unite_transformations="";
        $this->logo="";
        $this->departement_id='';
        $this->firstname_pca='';
        $this->lastname_pca="";
        $this->phone_pca ='';
        $this->email_pca='';
      
        $this->photo_pca="";
        $this->firstname_sup="";
        $this->lastname_sup="";
        $this->phone_sup="";
        $this->email_sup="";
        $this->photo_sup="";
        $this->photo_pca="";

    }

   

    public function render()
    {
        $regions= Region::all();
        $data = [
            'regions'=>$regions,
            'departements'=>$this->departements
        ];
        return view('livewire.cooperative.cooperative-component')->with($data);
    }
}
