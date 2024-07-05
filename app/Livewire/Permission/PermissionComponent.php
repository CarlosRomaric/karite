<?php

namespace App\Livewire\Permission;

use App\Models\Permission;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Livewire\Attributes\Url;

class PermissionComponent extends Component
{
    use WithPagination;
    public $name; 
    public $permissionId;
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
            'name.required' => 'Le nom  de la permission est obligatoire',
        ];
        
        return $messages;
    }

    public function __construct()
    {

        $this->selectedLimitPaginate = '50';
    }   

    public function create(){
        $this->reset('name','permissionId');
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

    public function savePermission(){
       
        $this->validate();
        //dd($validated);
        //dd($this->name, $this->acronym, $this->address, $this->person_responsible_name, $this->person_responsible_phone);

        $permission = New Permission();
        $permission->name = $this->name;
        $permission->save();

        session()->flash('message','Votre enregistement a été effectué avec success');
        $this->resetInput();
        $this->refreshPermissionShow();
        $this->closeModal();
        //$this->showModal = false;
        //$this->dispatch('close-modal');
    }

    public function edit($id)
    {
        
        $this->openModal();
        $permission = Permission::findOrFail($id);
        //dd($agribusiness);
        $this->permissionId = $id;
        $this->name = $permission->name;
       
    }

    public function update()
    {
        if ($this->permissionId) {
            $permission = Permission::findOrFail($this->permissionId);
            $permission->update([
                'name' => $this->name,
            ]);
            session()->flash('message', 'la permission a été modifié avec success');
            $this->closeModal();
            $this->reset('name','permissionId');
        }
    }

    public function deleteForm($id){
        $this->openModalDelete();
        $this->permissionId = $id;
    }

    public function delete($id)
    {
        Permission::find($id)->delete();
        session()->flash('message', 'la suppression de cette permission a été effectué avec success');
        $this->reset('name','permissionId');
        $this->closeModalDelete();
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

    public function query(){
        
        $query = Permission::where('name','like','%'.$this->search.'%')
                ->paginate($this->selectedLimitPaginate);
       
        return $query;
    }

    public function paginationView()
    {
        return 'custom-pagination-links-view';
    }

    public function render()
    {
        return view('livewire.permission.permission-component',[
            'permissions' => $this->query(),
        ]);
    }
}
