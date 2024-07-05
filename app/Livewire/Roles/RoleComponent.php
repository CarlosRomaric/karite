<?php

namespace App\Livewire\Roles;

use App\Models\Role;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Livewire\Attributes\Url;

class RoleComponent extends Component
{
    use WithPagination;
    public $name; 
    public $roleId;
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
            'name.required' => 'Le nom  du role est obligatoire',
        ];
        
        return $messages;
    }


    public function __construct()
    {

        $this->selectedLimitPaginate = '10';
    }
    public function create(){
        $this->reset('name','roleId');
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

    public function saveRole(){
        
        $this->authorize('ADMIN USER ADD');

        $this->validate();
        //dd($validated);
        //dd($this->name, $this->acronym, $this->address, $this->person_responsible_name, $this->person_responsible_phone);

        $role = New Role();
        $role->name = $this->name;
        $role->save();

        session()->flash('message','Votre enregistement a été effectué avec success');
        $this->resetInput();
        //$this->refreshRoleShow();
        $this->closeModal();
        //$this->showModal = false;
        //$this->dispatch('close-modal');
    }

    public function edit($id)
    {
        
        $this->openModal();
        $role =Role::findOrFail($id);
        //dd($agribusiness);
        $this->roleId = $id;
        $this->name = $role->name;
       
    }
    

    public function update()
    {
        if ($this->roleId) {
            $role =Role::findOrFail($this->roleId);
            $role->update([
                'name' => $this->name,
            ]);
            session()->flash('message', 'le role a été modifié avec success');
            $this->closeModal();
            $this->reset('name','roleId');
        }
    }

    public function deleteForm($id){
        $this->openModalDelete();
        $this->roleId = $id;
    }

    public function delete($id)
    {
        Role::find($id)->delete();
        session()->flash('message', 'la suppression de cet role a été effectué avec success');
        $this->reset('name','roleId');
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
        
        $query = Role::where('name','like','%'.$this->search.'%')
                ->paginate($this->selectedLimitPaginate);
       
        return $query;
    }

    public function paginationView()
    {
        return 'custom-pagination-links-view';
    }

    public function redirectToPermission($id){
        return redirect(route('roles.permission',['role'=>$id]));
    }


    public function render()
    {
        return view('livewire.roles.role-component',[
            'roles' => $this->query(),
        ]);
    }
}
