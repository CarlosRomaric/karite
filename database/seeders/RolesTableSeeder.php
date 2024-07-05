<?php
namespace Database\Seeders;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            'ADMINISTRATEUR COOPERATIVE',
            'SUPERVISEUR COOPERATIVE',
            'ADMINISTRATEUR PLATEFORME',
            'MOBILE'
        ];

        foreach ($roles as $role) {
            Role::create([
                'name' => $role
            ]);
        }
    }
}
