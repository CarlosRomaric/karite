<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'ADMIN PERMISSION LIST', 'ADMIN PERMISSION ADD', 'ADMIN PERMISSION UPDATE', 'ADMIN PERMISSION DELETE',
            'ADMIN ROLE LIST', 'ADMIN ROLE ADD', 'ADMIN ROLE UPDATE', 'ADMIN ROLE DELETE', 'ADMIN ROLE ASSIGN PERMISSION',
            'ADMIN USER LIST', 'ADMIN USER ADD', 'ADMIN USER UPDATE', 'ADMIN USER DELETE', 'ADMIN USER ASSIGN ROLE',
            'ADMIN COOPERATIVE LIST', 'ADMIN COOPERATIVE ADD', 'ADMIN COOPERATIVE UPDATE', 'ADMIN COOPERATIVE DELETE',
            'ADMIN TABLEAU DE BORD', 'ADMIN PRODUCTEUR LIST', 'ADMIN PRODUCTEUR ADD', 'ADMIN PRODUCTEUR SHOW',
            'ADMIN PRODUCTEUR UPDATE', 'ADMIN PRODUCTEUR DELETE', 'ADMIN IMPORT EXCEL ADD', 'ADMIN EXPORT EXCEL',
            'MOBILE LISTE DES PRODUCTEURS', 'MOBILE SYNCHRONISATIONS', 'ADD OFFRES', 'LISTE OFFRES'
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission
            ],[
                'name' => $permission
            ]);
        }
    }
}
