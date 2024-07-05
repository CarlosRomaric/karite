<?php

namespace App\Livewire\Roles;

use Livewire\Component;
use App\Models\Permission;

class AssignPermissionComponent extends Component
{
    public $role;


    public function render()
    {
        $this->authorize('ADMIN ROLE ASSIGN PERMISSION');

        $permissions = Permission::retrievingByUsersType()
            ->orderBy('name')
            ->get();
        $perPage = intdiv(count($permissions), 4);
       
        return view('livewire.roles.assign-permission-component',[
            'permissions'=>$permissions,
            'perPage'=>$perPage,
            'role'=>$this->role
        ]);
    }


}
