<?php

namespace App\Livewire\Certification;

use App\Models\Certification;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Livewire\Attributes\Url;

class CertificationComponent extends Component
{
    public $name;
    public $certificationId;

    #[Url] 
    public $search = '';
    public $selectedLimitPaginate; 
    public $isOpen = 0;
    public $isOpenDelete = 0;

    public function rules():array
    {
        $rules= [
            'name' => 'required',
        ];
        
        return $rules;
    }

    public function messages():array
    {
        $messages= [
            'name.required' => 'Le nom  de la certification est obligatoire',
        ];
        
        return $messages;
    }

    public function __construct()
    {

        $this->selectedLimitPaginate = '10';
    }

    public function create(){
        $this->reset('name','certificationId');
        $this->openModal();
    }

    public function openModal(){
        $this->isOpen = true;
    }

    public function openModalDelete(){
        $this->isOpenDelete = true;
    }

    public function closeModal(){
        $this->isOpen = false;
    }

    public function closeModalDelete(){
        $this->isOpenDelete = false;
    }

    public function saveCertification()
    {
        $this->validate();
        $certification = New Certification();
        $certification->name = $this->name;
        $certification->save();

        session()->flash('message','Votre enregistement a été effectué avec success');
    }

    public function edit($id)
    {
        
        $this->openModal();
        $certification =certification::findOrFail($id);
        //dd($agribusiness);
        $this->certificationId = $id;
        $this->name = $certification->name;
       
    }

    public function update()
    {
        if ($this->certificationId) {
            $certification =certification::findOrFail($this->certificationId);
            $certification->update([
                'name' => $this->name,
            ]);
            session()->flash('message', 'le certification a été modifié avec success');
            $this->closeModal();
            $this->reset('name','certificationId');
        }
    }

    public function deleteForm($id){
        $this->openModalDelete();
        $this->certificationId = $id;
    }
    
    public function resetInput(){
        $this->name = '';
    }

    public function resetSearch(){
        $this->search='';
    }

    public function updatingSearch(){
        $this->resetPage();
    }

    public function paginationView()
    {
        return 'custom-pagination-links-view';
    }

    public function query(){
        
        $query = Certification::where('name','like','%'.$this->search.'%')
                ->paginate($this->selectedLimitPaginate);
       
        return $query;
    }

    public function render()
    {
        return view('livewire.certification.certification-component',[
            'certifications'=>$this->query()
        ]);
    }
}
