<?php

namespace Database\Seeders\Assign;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AssignPermissionsToSupervisorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'ADD OFFRES','LISTE OFFRES'
        ];

        foreach ($permissions as $permission) {
            Role::whereName('SUPERVISEUR COOPERATIVE')->first()->givePermissionTo(
              Permission::whereName($permission)->first()
            );
        }
    }
}
