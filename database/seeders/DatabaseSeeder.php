<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;

use Database\Seeders\Assign\AssignPermissionsToPlateformAdministratorSeeder;
use Database\Seeders\Assign\AssignPermissionsToGenoticAdministratorSeeder;
use Database\Seeders\Assign\AssignPermissionsToSupervisorSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {   
        $this->call(CooperativeTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
       
        $this->call(UsersTableSeeder::class);

        $this->call(AssignPermissionsToPlateformAdministratorSeeder::class);
        $this->call(AssignPermissionsToSupervisorSeeder::class);
        $this->call(AssignPermissionsToGenoticAdministratorSeeder::class);
        $this->call(RegionDepartementTableSeeder::class);
      
    }
}
