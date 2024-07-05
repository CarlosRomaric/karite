<?php

namespace App\Livewire\Farmer;

use Carbon\Carbon;
use App\Models\Plot;
use App\Models\Farmer;
use App\Models\Region;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Agribusiness;
use App\Models\Departement;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Livewire\WithFileUploads;


class FarmerComponent extends Component
{
    use WithPagination, WithFileUploads;
    public  $farmerId;
    public  $identifier, $fullname, $born_date, $born_place,  $phone, $phone_payment, $sexe;
    public  $region_id, $departement_id, $regions, $departements, $locality;
    public  $picture, $agribusiness_id, $activity;
    public  $farmer_id, $farmerInfo;
    public  $step = 1;

    #[Url] 
    public $search = '';
    public $selectedLimitPaginate;

    public $isClose = 0;
    public $isOpen = 0;
    public $isOpenShow = 0;
    public $isOpenDelete = 0;
    public $plotFormCount = 1;
    protected $listeners = ['farmerEdited'=>'editFromFarmerComponent'];
    
    public  function rules(){
        $rules =  [
            'agribusiness_id' => 'required|exists:agribusinesses,id',
            'locality' => 'required',
            //'identifier' => 'required',
            'fullname' => 'required',
            'sexe' => 'required|in:AUCUN,H,F',
            'phone_payment' => 'required|min:2',
            'phone' => 'required|min:2',
            'born_date' => 'required',
            'born_place' => 'required',
            'region_id'=>'required',
            'departement_id'=>'required',
            'activity'=>'required'
        ];

        if(!empty($this->picture)){
            $rule['picture']= 'file|mimes:jpeg,bmp,png,gif';
        }

        return $rules;
    }  
      

    public function messages()
    {
        $messages = [
            'picture.required' => 'Le champ photo du producteur est obligatoire.',
            'phone.required'=>'le numéro de téléphone est obligatoire',
            'phone_payment.required'=>'le numéro de téléphone mobile money est obligatoire',
            'fullname.required' => 'Le champ nom et prénoms est obligatoire.',
            //'identifier.required' => 'Le champ identifiant est obligatoire.',
            'born_date.required' => 'Le champ date de naissance est obligatoire.',
            'born_place.required' => 'Le champ lieu de naissance est obligatoire.',
            'locality.required' => 'Le lieu de residence est obligatoire.',
            'region_id'=>'le choix de la region est obligatoire',
            'departement_id'=>'le choix du departement est obligatoire',
            'agribusiness_id.required' => 'Le champ coopérative /indepandant est obligatoire.',
            'sexe.required' => 'Le sexe du producteur est obligatoire.',
            'activity.required'=>'l\'activité du producteur est obligatoire'
        ];

        return $messages;
    }

    public function __construct()
    {
        $this->selectedLimitPaginate = '10';
      
    }

    public function updatedRegionId($region_id){
        
        
        if(!is_null($region_id)){
            $this->departements = Departement::where('region_id','=',$region_id)->get();
        }
        
    }

    public function editFromFarmerComponent($id)
    {
        // Appel de  la méthode editFarmer du deuxième composant
        $this->call('FarmerEditComponent.editFarmer',$id);
    }

    public function create(){
        $this->plotFormCount = 1;
        $this->openModal();
       
    }

    public function mount(){
        $this->regions = Region::all();
        $this->departements = Departement::all();
    }

    public function edit($id){
        $this->openModal();

        $this->farmerId = $id;
        $farmer = Farmer::findOrFail($id);

        //$this->identifier = $farmer->identifier;
        $this->picture = $farmer->picture;
        $this->fullname = $farmer->fullname;
        $this->sexe = $farmer->sexe;
        $this->born_date = $farmer->born_date;
        $this->born_place = $farmer->born_place;
        $this->region_id = $farmer->region_id;
        $this->departement_id = $farmer->departement_id;
        $this->locality = $farmer->locality;
        $this->phone = $farmer->phone;
        $this->phone_payment = $farmer->phone_payment;
        $this->agribusiness_id = $farmer->agribusiness_id;
        $this->activity = $farmer->activity;
       
    }

    public function show($id){
        $this->openModalShow();
        $this->farmerId = $id;
        $this->farmerInfo = Farmer::findOrFail($id);
    }


    public function nextStep()
    {
        $this->step++;
    }

    public function prevStep()
    {
        $this->step--;
    }
 

    public function openModal(){
        $this->isOpen = true;
    }

    public function openModalShow(){
        $this->isOpenShow = true;
    }


    public function openModalDelete(){
        $this->isOpenDelete = true;
    }

    public function closeModal(){
        $this->resetInput();
        $this->step = 1;
        $this->isOpen = false;
    }

    public function closeModalShow(){
        $this->isOpenShow = false;
    }

    public function closeModalDelete(){
        $this->isOpenDelete = false;
    }

    #[On('get-limit-paginate')] 
    public function getLmitPaginate($value){

        $this->selectedLimitPaginate = $value;
        
    }


    public function resetInput(){

        //$this->identifier = '';
        $this->picture= '';
        $this->fullname = '';
        $this->sexe = '';
        $this->born_date = '';
        $this->born_place = '';
        $this->region_id = '';
        $this->departement_id = '';
        $this->locality = '';
        $this->phone= '';
        $this->agribusiness_id='';
        $this->activity = '';
    }

    public function saveFarmer(){
        $this->authorize('ADMIN PRODUCTEUR ADD');
       
       $this->validate();
       
       $farmer = Farmer::create($this->getFarmerData());
      
       session()->flash('message','Votre enregistement a été effectué avec success');
       $this->resetInput();
       $this->refreshFarmerShow();
       $this->closeModal();
       
    }

    public function update(){
        $this->authorize('ADMIN PRODUCTEUR UPDATE');
       
       $this->validate();
       $farmer = Farmer::find($this->farmerId);
       $farmer->update($this->getFarmerData());
       session()->flash('message','Votre enregistement a été effectué avec success');
       $this->resetInput();
       $this->refreshFarmerShow();
       $this->closeModal();
       
    }
    function custom_date_format($from, $to, $date) {
        return Carbon::createFromFormat($from, $date)->format($to);
    }

    public function refreshFarmerShow(){
        return $this->query();
    }

    private function getFarmerData()
    {
        $data = [
            //'identifier' => $this->identifier,
            'fullname' => $this->fullname,
            'sexe'=>$this->sexe,
            //'born_date' => $this->custom_date_format('Y-m-d', 'd/m/Y', $this->born_date),
            'born_date' => $this->born_date,
            'born_place'=> $this->born_place,
            'phone'=>$this->phone,
            'phone_payment'=>$this->phone_payment,
            'region_id'=>$this->region_id,
            'departement_id'=>$this->departement_id,
            'locality'=>$this->locality,
            'agribusiness_id'=>$this->agribusiness_id,
            'activity'=>$this->activity
        ];
        if(gettype($this->picture)!=="string"){
            $path = 'public/farmers';
            $filename = $this->picture->getClientOriginalName();
            $data['picture'] =  $this->picture->storeAs('farmers');
        }
        return $data;
    }

        public function query(){
        
        $query = Farmer::where('fullname','like','%'.$this->search.'%')
                        ->orWhere('phone','like','%'.$this->search.'%')
                        ->orWhere('sexe','like','%'.$this->search.'%')
                        ->orWhere('locality','like','%'.$this->search.'%')
                        ->paginate($this->selectedLimitPaginate);
       
        return $query;
    }
      
    public function deleteForm($id){
        $this->openModalDelete();
        $this->farmerId = $id;
    }

    public function delete($id)
    {
       
        Farmer::findOrFail($id)->delete();
        session()->flash('message', 'la suppression de cette coopérative a été effectué avec success');
        $this->closeModalDelete();
    }

    public function paginationView()
    {
        return 'custom-pagination-links-view';
    }

    public function resetSearch(){
        $this->search='';
    }


    public function render()
    {
        $agribusinesses = Agribusiness::retrievingByUsersType()->get();
        
        return view('livewire.farmer.farmer-component',[
            'farmers'=>$this->query(),
            'regions'=>$this->regions,
            'departements'=>$this->departements,
            'agribusinesses'=>$agribusinesses
        ]);
    }
}
