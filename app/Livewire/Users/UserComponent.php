<?php

namespace App\Livewire\Users;

use App\Models\Role;
use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Agribusiness;
use Livewire\Attributes\Url;
use Livewire\WithPagination;

class UserComponent extends Component
{
    use WithPagination;
    public $fullname, $username, $phone, $password, $password_confirmation, $role_id; 
    public $userId;
    #[Url] 
    public $search = '';
    public $selectedLimitPaginate; 
    public $isOpen = 0;
    public $isOpenDelete = 0;

    public function rules()
    {
        return [
            'fullname' => 'required|string',
            'username' => 'required|string|unique:users',
            'phone' => 'required|string|unique:users',
            'password' => 'required|min:4|same:password_confirmation',
            'password_confirmation' => 'required|min:4|same:password',
            'role_id' => 'required|exists:roles,id'
        ];
    }

    public function messages():array
    {
        $messages= [
            'fullname.required' => 'Le nom et prénoms de l\'utilisateur est obligatoire',
            'fullname.string' => 'Le nom et prénoms de l\'utilisateur doît être une chaine de caractères',
            'username.required'=>'le nom d\'utilisateur doit être obligatoire',
            'phone.required'=>'le contact est obligatoire',
            'phone.unique'=>'cet contact appartient déjà a un autre utilisateur',
            'password.required'=>'le mot de passe doit être obligatoire',
            'password.min'=>'le mot de passe doit contenir au minimum 4 caractères',
            'pasword.same'=>'le mot de passe et le mot de passe de confirmation doivent être conforme',
            'password_confirmation.required'=>'le mot de passe de confirmation est obligatoire',
            'password_confirmation.min'=>'le mot de passe de confirmation doit contenir au minimum 4 caractères',
            'password_confirmation.same'=>'le mot de passe et le mot de passe de confirmation doivent être conforme',
            'role_id.required'=>'le role de l\'utilisateur est obligatoire',
            'role_id.exists'=>'l\'utilisateur a déjà ce role'
        ];
        
        return $messages;
    }

    public function __construct()
    {

        $this->selectedLimitPaginate = '10';
    }

    public function create(){
        $this->reset('fullname','username','phone','password','password_confirmation','role_id','userId');
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

    public function saveUser(){
        $user = New User();
        $user->fullname = $this->fullname;
        $user->username = $this->username;
        $user->phone = $this->phone;
        $user->password =  bcrypt($this->password);
        $user->save();

        $user->roles()->sync($this->role_id);
        session()->flash('message','Votre enregistement a été effectué avec success');
        $this->resetInput();
        $this->closeModal();
    }

    public function edit($id)
    {
        
        $this->openModal();
        $user =User::findOrFail($id);
        //dd($agribusiness);
        $this->userId = $id;
        $this->fullname = $user->fullname ;
        $this->username = $user->username;
        $this->phone = $user->phone;
       
    }

    public function update()
    {
        $this->authorize('ADMIN USER UPDATE');

        if ($this->userId) {
            $user =User::findOrFail($this->userId);
            $user->update([
                'fullname' => $this->fullname,
                'username' => $this->username,
                'phone' => $this->phone,
            ]);

            session()->flash('message', 'l\'utilisateur a été modifié avec success');
            $this->closeModal();
            $this->reset('fullname','username','phone','userId');
        }
    }

    public function deleteForm($id){
        $this->openModalDelete();
        $this->userId = $id;
    }

    public function delete($id)
    {
        $this->authorize('ADMIN USER DELETE');

        User::find($id)->delete();
        session()->flash('message', 'la suppression de cet role a été effectué avec success');
        $this->reset('fullname','username','phone','password','password_confirmation','role_id','userId');
        $this->closeModalDelete();
    }

    public function resetInput(){
        $this->fullname = '';
        $this->username = '';
        $this->phone = '';
    }

    public function resetSearch(){
        $this->search='';
    }

    public function updatingSearch(){
        $this->resetPage();
    }

    public function query(){
        
        $query =  User::with('agribusiness', 'roles')
            ->retrievingByUsersType()
            ->orderBy('fullname')
            ->where('fullname','like','%'.$this->search.'%')
            ->orWhere('username','like','%'.$this->search.'%')
            ->orWhere('phone','like','%'.$this->search.'%')
            ->paginate($this->selectedLimitPaginate);
       
        return $query;
    }

    public function redirectToRole($id){
        return redirect(route('users.role.create',['user'=>$id]));
    }

    public function render()
    {
        $roles = Role::retrievingByUsersType()->get();
        $agribusinesses = Agribusiness::retrievingByUsersType()->get();
        return view('livewire.users.user-component',[
            'users' => $this->query(),
            'roles'=>$roles,
            'agribusinesses'=>$agribusinesses
        ]);
    }
}
