<?php

namespace Database\Seeders;

use App\Models\Agribusiness;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CooperativeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Agribusiness::create([
            'matricule'=>'MATIDP',
            'denomination' => 'INDEPENDANT',
            'sigle'=>'IDP',
            'status'=> '1',
        ]);

    }
}
