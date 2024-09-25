<?php

namespace Database\Seeders;

use App\Models\TypePackage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypePackageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $typepackages = [
            'Fut',
            'Carton',
            'Bol'
        ];

        foreach ($typepackages as $typepackage) {
            TypePackage::create([
                'name' => $typepackage
            ]);
        }
    }
}
