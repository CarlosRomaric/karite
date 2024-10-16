<?php

namespace App\Livewire\Users;

use App\Models\Role;
use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Agribusiness;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Url;
use Livewire\WithPagination;

class UserComponent extends Component
{
    use WithPagination;
    public $fullname, $username, $phone, $password, $password_confirmation, $role_id, $agribusiness_id; 
    public $userId;
    #[Url] 
    public $search = '';
    public $selectedLimitPaginate; 
    public $isOpen = 0;
    public $isOpenDelete = 0;

    public function rules()
    {
        $data = [
            'fullname' => 'required|string|max:255',
            'username' => 'required|string|unique:users,username|max:255',
            'phone' => 'required|string|unique:users,phone|max:15',
            'password' => 'required|min:4|same:password_confirmation',
            'password_confirmation' => 'required|min:4|same:password',
            'role_id' => 'required|exists:roles,id',
            'agribusiness_id' => 'nullable|exists:agribusinesses,id|required_if:role_id,' . $this->getRoleIdForMobile(),
        ];

        return $data;


    }

    protected function getRoleIdForMobile()
    {
        // Remplace par la logique pour obtenir l'ID du rôle "MOBILE"
        // Par exemple, si le rôle "MOBILE" a un ID de 2, retourne simplement 2
        return Role::where('name', 'MOBILE')->first()->id;
    }

    public function updateRules($userId)
    {
        return [
            'fullname' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $userId,
            'phone' => 'required|string|max:15|unique:users,phone,' . $userId,
            'password' => 'nullable|min:4|same:password_confirmation',
            'password_confirmation' => 'nullable|min:4|same:password',
            'role_id' => 'required|exists:roles,id',
            'agribusiness_id' => 'nullable|exists:agribusinesses,id|required_if:role_id,' . $this->getRoleIdForMobile(),
        ];
    }

    public function messages(): array
    {
        return [
            'fullname.required' => 'Le nom et prénoms est obligatoire.',
            'fullname.string' => 'Le nom et prénoms doit être une chaîne de caractères.',
            'username.required' => 'Le nom d\'utilisateur est obligatoire.',
            'username.unique' => 'Ce nom d\'utilisateur est déjà pris.',
            'phone.required' => 'Le numéro de téléphone est obligatoire.',
            'phone.unique' => 'Ce numéro de téléphone est déjà utilisé.',
            'password.required' => 'Le mot de passe est obligatoire.',
            'password.min' => 'Le mot de passe doit contenir au moins 4 caractères.',
            'password.same' => 'Les mots de passe ne correspondent pas.',
            'password_confirmation.required' => 'La confirmation du mot de passe est obligatoire.',
            'role_id.required' => 'Le rôle de l\'utilisateur est obligatoire.',
            'role_id.exists' => 'Le rôle sélectionné n\'existe pas.',
            'agribusiness_id.exists' => 'La coopérative sélectionnée n\'existe pas.',
            'agribusiness_id.required_if'=>'si l\'utilisateur est un agent vous devez choisir une coopérative'
        ];
    }

    public function __construct()
    {

        $this->selectedLimitPaginate = '10';
    }

    public function create(){
        $this->reset('fullname','username','phone','password','password_confirmation','role_id','userId','agribusiness_id');
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
       
        $this->validate();
        //dd($this->password);
        $user = New User();
        $user->fullname = $this->fullname;
        $user->username = $this->username;
        $user->phone = $this->phone;
        $user->password =  Hash::make($this->password);
        $user->agribusiness_id = !empty($this->agribusiness_id) ? $this->agribusiness_id :'NULL';
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
        $this->agribusiness_id = $user->agribusiness_id;
        $this->phone = $user->phone;
        
    }

    public function update()
    {
        $this->authorize('ADMIN USER UPDATE');
        $this->validate($this->updateRules($this->userId));

       
       
        if ($this->userId) {

            $user =User::findOrFail($this->userId);
            $user->fullname = $this->fullname;
            $user->username = $this->username;

            $user->phone = $this->phone;
            if ($this->password) {
                $user->password = Hash::make($this->password);
            }
            $user->agribusiness_id = $this->agribusiness_id;
            
           
            $user->save();
            // $user->roles()->sync($this->role_id);

            session()->flash('message', 'l\'utilisateur a été modifié avec success');
            $this->reset('fullname','username','phone','userId','agribusiness_id');
            $this->closeModal();
           
        }
    }

    public function deleteForm($id){
        $this->openModalDelete();
        $this->userId = $id;
    }

    public function delete($id)
    {
        $this->authorize('ADMIN USER DELETE');
        
        $user = User::find($id);
         // Supprimer les relations dans la table pivot 'role_user'
        $user->roles()->detach();

        // Ensuite, supprimer l'utilisateur
        $user->delete();

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
        $roles = Role::orderBy('created_at')->get();
        
        $agribusinesses = Agribusiness::retrievingByUsersType()->get();
        return view('livewire.users.user-component',[
            'users' => $this->query(),
            'roles'=>$roles,
            'agribusinesses'=>$agribusinesses
        ]);
    }
}
