<?php

namespace App\Livewire\Agribusinesses;

use App\Models\User;
use App\Models\Region;
use Livewire\Component;
use App\Models\Departement;
use Livewire\Attributes\On;
use App\Models\Agribusiness;
use App\Utilities\NewSmsAPI;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Http\Requests\Agribusinesses\AgribusinessCreateRequest;

class AgribusinessesComponent extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $step = 1;
    public $agribusinessId;
    public $matricule, $denomination, $sigle, $address, $region_id, $departement_id, $headquaters, $bank, $certification, $registre_commerce, $dfe, $number_sections, $number_unite_transformations, $logo, $status; 
    public $pca, $sup, $photo_pca, $photo_sup;
    public $statusFilter;
    public $agribusinessFilter;
    public $regions, $departements;
    public $doc_dfe, $doc_registre_commerce;
    public $statusCoop;
   
    public $motif;
    public $close = 0;
    
    #[Url] 
    public $search = '';
    public $selectedLimitPaginate;
    
    public $isOpen = 0;
    public $isOpenShow = 0;
    public $isOpenDelete = 0;
    public $isOpenTest = 0;
    



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
        ];

        if ($this->logo) {
            $rules['logo'] = 'mimes:csv,xlsx,xls|max:2048';
        }
        
        return   $rules;
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

    public function updatedRegionId($region_id){
        
        
        if(!is_null($region_id)){
            $this->departements = Departement::where('region_id','=',$region_id)->get();
        }
        
    }


    public function updatedStatusFilter($status){
        
       $this->agribusinessFilter =($this->query()->where('status',$status));
        
    }

    

    public function __construct()
    {

        $this->selectedLimitPaginate = '10';
    }

    public function create(){
        $this->resetInput();
        $this->openModal();
       
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

    public function openModalDelete(){
        $this->isOpenDelete = true;
    }

    public function openModalTest(){
        $this->isOpenDelete = true;
    }



    public function closeModal(){
        $this->isOpen = false;
    }

    public function closeModalDelete(){
        $this->isOpenDelete = false;
    }

    public function closeModalTest(){
        $this->isOpenDelete = false;
    }

    public function openModalShow(){
        $this->isOpenShow = true;
    }

    public function closeModalShow(){
        $this->isOpenShow = false;
    }

    #[On('get-limit-paginate')] 
    public function getLmitPaginate($value){

        $this->selectedLimitPaginate = $value;
        //dd($this->selectedLimitPaginate);
    }
    public function fullnameResponsable($agribusinessId){
        $user = User::where('agribusiness_id',$agribusinessId)->where('job','PCA')->first();
        return $user;
    }
    public function saveAgribusiness(){
       
        $this->validate();
       
        $agribusiness = New Agribusiness();
        $agribusiness->denomination = $this->name;
        $agribusiness->sigle = str_replace(' ', '', $this->sigle);
        $agribusiness->address = $this->address;
      
        $agribusiness->region_id = $this->region_id;
        $agribusiness->departement_id = $this->departement_id;
        $agribusiness->headquaters = $this->headquaters;
        $agribusiness->bank = $this->bank;

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

       

        session()->flash('message','Votre enregistement a été effectué avec success');
        $this->resetInput();
        $this->refreshAgribusinessShow();
        $this->closeModal();
        //$this->showModal = false;
        //$this->dispatch('close-modal');
    }

    public function valideCoop($id){
        if($this->motif != '' ){

       
            $agribusiness = Agribusiness::find($id);
            $agribusiness->status = 1;
            $agribusiness->motif = $this->motif;
            $agribusiness->save();
            if(!empty(session('errorMotif'))){
                session()->forget('errorMotif');
            }
            $this->pca = User::where('agribusiness_id',$this->agribusinessId)->where('job','PCA')->first();
            $this->sup = User::where('agribusiness_id',$this->agribusinessId)->where('job','SUPERVISEUR')->first();
            
                $messageSender = new NewSmsAPI();
                $message ='vos accèss on bien été crée login sur l\'application karite 2.0 login:'.$this->sup->phone.' et le mot de passe est: '.$this->sup->phone;
                $messageSender->sendSMS([$this->sup->phone], $message);
            
           
            $this->closeModalShow();
        }else{
            session()->put('errorMotif','Vous devez renseigner le motif pour valider');
        }
    }

    public function rejetCoop($id){
        
        if($this->motif != '' ){

       
            $agribusiness = Agribusiness::find($id);
            $agribusiness->status = 2;
            $agribusiness->motif = $this->motif;
            $agribusiness->save();
            if(!empty(session('errorMotif'))){
                session()->forget('errorMotif');
            }
            $this->closeModalShow();

        }else{
            session()->put('errorMotif','Vous devez renseigner le motif pour rejeter');
        }
    }





    public function edit($id)
    {
       
        $this->openModal();
        $agribusiness = Agribusiness::findOrFail($id);
        //dd($agribusiness);
        $this->agribusinessId = $id;
        $this->matricule = $agribusiness->matricule;
        $this->denomination = $agribusiness->denomination;
        $this->sigle = $agribusiness->sigle;
        $this->address = $agribusiness->address;
        $this->region_id = $agribusiness->region->name;
        $this->headquaters = $agribusiness->headquaters;
        $this->certification = $agribusiness->certification;
        $this->bank = $agribusiness->bank;
        $this->statusCoop = $agribusiness->status;
        $this->number_sections = $agribusiness->number_sections;
        $this->number_unite_transformations = $agribusiness->number_unite_transformations;
        $this->regions = Region::all();
        $this->departements = Departement::all();
        $this->region_id = $agribusiness->region_id;
        $this->departement_id = $agribusiness->departement_id;
        $this->doc_dfe =str_replace('public/', '' ,$agribusiness->dfe);
        $this->doc_registre_commerce =str_replace('public/', '' ,$agribusiness->registre_commerce);
       
    }

    public function show($id)
    {
        
        $this->openModalShow();
        $agribusiness = Agribusiness::findOrFail($id);
        //dd($agribusiness);
        $this->agribusinessId = $id;
        $this->matricule = $agribusiness->matricule;
        $this->denomination = $agribusiness->denomination;
        $this->sigle = $agribusiness->sigle;
        $this->address = $agribusiness->address;
        $this->region_id = $agribusiness->region->name;
        $this->departement_id = $agribusiness->departement->name;
        $this->headquaters = $agribusiness->headquaters;
        $this->certification = $agribusiness->certification;
        $this->bank = $agribusiness->bank;
      
        $this->number_sections = $agribusiness->number_sections;
        $this->number_unite_transformations = $agribusiness->number_unite_transformations;
        $this->registre_commerce = str_replace('public/', '' ,$agribusiness->registre_commerce);
        $this->dfe = str_replace('public/', '' ,$agribusiness->dfe);
        $this->pca = User::where('agribusiness_id',$this->agribusinessId)->where('job','PCA')->first();
        $this->sup = User::where('agribusiness_id',$this->agribusinessId)->where('job','SUPERVISEUR')->first();
        $this->photo_pca =  str_replace('public/', '', $this->pca->picture);
        $this->photo_sup =  str_replace('public/', '', $this->sup->picture);
        $this->motif = $agribusiness->motif;
        $this->statusCoop = $agribusiness->status;
       
    }   

    public function update()
    {
        $rulesUpdate = [
            'matricule'=>'required',
            'denomination'=>'required',
            'sigle'=>'required',
            'region_id'=>'required',
            'departement_id'=>'required',
            'headquaters'=>'required',
            'address'=>'required',
            'certification'=>'required',
            
            'bank'=>'required',
            
            'number_sections'=>'required|numeric',
            'number_unite_transformations'=>'required|numeric',
        ];
       
        if(!empty($this->dfe))
        {
            $rulesUpdate['dfe']='required|mimes:pdf,png,jpeg,jpg|max:2048';
        }

        if(!empty($this->registre_commerce))
        {
            $rulesUpdate['registre_commerce']='required|mimes:pdf,png,jpeg,jpg|max:2048';
        }
        
        $this->validate($rulesUpdate);

        if ($this->agribusinessId) {
        $agribusiness = Agribusiness::findOrFail($this->agribusinessId);
        $agribusiness->denomination = $this->denomination;
        $agribusiness->sigle = str_replace(' ', '', $this->sigle);
        $agribusiness->address = $this->address;
      
        $agribusiness->region_id = $this->region_id;
        $agribusiness->departement_id = $this->departement_id;
        $agribusiness->headquaters = $this->headquaters;
        $agribusiness->bank = $this->bank;

        if(!empty($this->registre_commerce)){
            $filenameRg = $this->registre_commerce->getClientOriginalName();
            $pathRg = 'public/registre_commerciale/'.trim($this->sigle);
            $agribusiness->registre_commerce = $this->registre_commerce->storeAs($pathRg, $filenameRg);
        }
      

        if(!empty($this->dfe)){
            $filenameDfe = $this->dfe->getClientOriginalName();
            $pathDfe = 'public/dfe/'.trim($this->sigle);
            $agribusiness->dfe = $this->dfe->storeAs($pathDfe, $filenameDfe);
        }

        $agribusiness->number_sections = $this->number_sections;
        $agribusiness->number_unite_transformations = $this->number_unite_transformations;

        if($this->logo){
            $pathFileProducers = $this->logo->getClientOriginalName();
            $filenameFileProducers = 'public/logo/'.trim($this->sigle);
            $agribusiness->logo = $this->logo->storeAs($pathFileProducers, $filenameFileProducers);
        }
      
       
        $agribusiness->save();
            session()->flash('message', 'la coopérative a été modifié avec success');
            $this->closeModal();
            
        }
    }
    
    public function deleteForm($id){
        $this->openModalDelete();
        $this->agribusinessId = $id;
    }

    public function delete($id)
    {
        Agribusiness::find($id)->delete();
        session()->flash('message', 'la suppression de cette coopérative a été effectué avec success');
        $this->reset('name','acronym','address','person_responsible_name','person_responsible_phone','agribusinessId');
        $this->closeModalDelete();
    }

    public function refreshAgribusinessShow(){
        return $this->query();
    }

  

    public function resetSearch(){
        $this->search='';
    }

    public function updatingSearch(){
        $this->resetPage();
    }

    public function query(){
        $search = $this->search;
        $query = Agribusiness::with('region','departement')
                    ->where('denomination', 'like', '%' . $this->search . '%')
                    ->orWhere('sigle', 'like', '%' . $this->search . '%')
                    ->orWhere('address', 'like', '%' . $this->search . '%')
                    ->orwhereHas('region',function($q) use ($search){
                        $q->where('name','like','%'.$search.'%');
                    })
                    ->orwhereHas('departement',function($q) use ($search){
                        $q->where('name','like','%'.$search.'%');
                    })
                    ->orderBy('created_at','DESC')
                    ->paginate($this->selectedLimitPaginate);
        
        return $query;
    }

    public function paginationView()
    {
        return 'custom-pagination-links-view';
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

    }
    
    public function render()
    {
        if(!empty($this->statusFilter)){
            $agribusiness = $this->agribusinessFilter;
        }else{
            $agribusiness = $this->query();
        }
      
        return view('livewire.agribusinesses.agribusinesses-component',[
            'agribusinesses' => $agribusiness,
        ]);
    }
}
