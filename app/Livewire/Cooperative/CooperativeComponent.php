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
use App\Models\Certification;
use App\Utilities\NewSmsAPI;

class CooperativeComponent extends Component
{
    use WithFileUploads;

    public $step = 1;
    // Propriétés pour l'étape 1
    public $numRegistreCommerce, $denomination, $sigle, $departement_id, $headquaters,  $address, $certification_id, $dfe, $bank, $registre_commerce;
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

            
            'denomination'=>'required',
            'sigle'=>'required',
            'region_id'=>'required',
            'departement_id'=>'required',
            'headquaters'=>'required',
            'numRegistreCommerce' => [
                'required',
              
            ],
            'certification_id'=>'required',
            'bank'=>'required',
            'registre_commerce'=>'required|mimes:pdf,png,jpeg,jpg|max:2048',
            'number_sections'=>'required|numeric',
            'number_unite_transformations'=>'required|numeric',

            'firstname_pca'=>'required',
            'lastname_pca'=>'required',
            'phone_sup' => 'required|unique:users,phone|unique:users,username', 
            'email_pca'=>'email|unique:users,email',
            'photo_pca'=>'nullable|image|max:2048',
           
            'firstname_sup'=>'required',
            'lastname_sup'=>'required',
            'phone_sup' => 'required|unique:users,phone|unique:users,username',
            'email_sup'=>'email|unique:users,email',
            'photo_sup'=>'nullable|image|max:2048',
            

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
            'logo.mimes'=>'le fichier que vous devez uploader doit être de l\'un de ces types pdf,png,jpeg,jpg',
            'email_pca.unique'=>'L\'email du PCA existe déjà sur notre plateforme',
            'email_sup.unique'=>'L\'email du superviseur existe déjà sur notre plateforme',
           
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
                    'numRegistreCommerce' => [
                        'required',
                    ],
                    'denomination'=>'required',
                    'sigle'=>'required',
                    'region_id'=>'required',
                    'departement_id'=>'required',
                    'headquaters'=>'required',
                    'certification_id'=>'required',
                    
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
                    'phone_pca'=>'required|unique:users,phone',
                    'email_pca'=>'emailemail|unique:users,email',
                    'photo_pca'=>'nullable|image|max:2048',
                
                    'firstname_sup'=>'required',
                    'lastname_sup'=>'required',
                    'phone_sup'=>'required|unique:users,phone',
                    'email_sup'=>'email|unique:users,email',
                    'photo_sup'=>'nullable|image|max:2048',
                ], $this->messages());
                $this->nextStep();
                break;
            
            default:
                // Optionally handle an invalid step
                throw new \Exception("Invalid step: " . $this->step);
        }
        
       
    }

    public function saveCoop(){
       
        $validated = $this->validate($this->rules(), $this->messages());
        //dd($validated);

        $agribusiness = new Agribusiness();
        $agribusiness->numRegistreCommerce = $this->numRegistreCommerce;
        $agribusiness->denomination = $this->denomination;
        $agribusiness->sigle = $this->sigle;
        $agribusiness->address = $this->address;
        $agribusiness->region_id = $this->region_id;
        $agribusiness->departement_id = $this->departement_id;
        $agribusiness->headquaters= $this->headquaters;
       // $agribusiness->bank = json_encode($this->bank);
        $agribusiness->bank = $this->bank;
        $agribusiness->certification_id = $this->certification_id;

        if(!empty($this->registre_commerce)){
            $filenameRg = $this->registre_commerce->getClientOriginalName();
            $pathRg = 'docs/registre_commerciale/'.trim($this->sigle);
            $agribusiness->registre_commerce = $this->registre_commerce->storeAs($pathRg, $filenameRg,'public');
        }

        $agribusiness->number_sections = $this->number_sections;
        $agribusiness->number_unite_transformations = $this->number_unite_transformations;

        if(!empty($this->logo)){
            $pathFileProducers = $this->logo->getClientOriginalName();
            $filenameFileProducers = 'logo/'.trim($this->sigle);
            $agribusiness->logo = $this->logo->storeAs($pathFileProducers, $filenameFileProducers, 'public');
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
        if(!empty($this->photo_pca)){
            $pathPhotoPca = 'images/photo_pca/'.trim($this->sigle);
            $filenamePhotoPca = trim($this->photo_pca->getClientOriginalName());
            $pca->picture = $this->photo_pca->storeAs($pathPhotoPca, $filenamePhotoPca,'public');
        }
      
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
        if(!empty($this->photo_sup)){
            $pathPhotoSup = 'photo_sup/'.trim($this->sigle);
            $filenamePhotoSup = trim($this->photo_sup->getClientOriginalName());
            $sup->picture = $this->photo_sup->storeAs($pathPhotoSup, $filenamePhotoSup,'public');
        }
      
        $sup->job = 'SUPERVISEUR';
        $sup->status = 0;
        $sup->save();

        $sup->roles()->sync(Role::where('name', 'SUPERVISEUR COOPERATIVE')->first()->id);
        $this->resetInput();
        session()->flash('message','votre demande d\'inscription de cooperative a bien été enregistré ');
        $this->dispatch('inscription', ['message' => 'Votre inscription a bien été enregistrée.']);
    }

    public function resetInput(){
        $this->numRegistreCommerce = '';
        $this->denomination = '';
        $this->sigle = '';
        $this->address='';
        $this->region_id='';
        $this->certification_id='';
        
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
        $certifications = Certification::all();
        $data = [
            'regions'=>$regions,
            'departements'=>$this->departements,
            'certifications'=>$certifications
        ];
        return view('livewire.cooperative.cooperative-component')->with($data);
    }
}
