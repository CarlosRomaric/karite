<?php

namespace Database\Seeders;

use App\Models\Certification;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CertificationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $certifications = [
            'Bio',
            'Fair For Life ( FFL)',
            'Karcher',
            'Halal',
            'Cosmos',
            'AB',
            'Équitable',
            'Ordinaire'
        ];

        foreach ($certifications as $certification) {

            Certification::create([
                'name' => $certification
            ]);

        }
    }
}
