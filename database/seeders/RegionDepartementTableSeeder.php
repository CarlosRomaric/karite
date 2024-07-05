<?php

namespace Database\Seeders;

use App\Models\Region;
use App\Models\Departement;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RegionDepartementTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $regionDepartement= [
            [
              "region"=> "Région du Folon",
              "code"=>"03",
              "departement"=> ["Kaniasso", "Minignan"],
              "latitude" => 10.104917,
              "longitude" => -7.4514106
            ],
            [
              "region"=> "Région du Bagoué",
              "code"=>"02",
              "departement"=> ["Boundiali", "Kouto", "Tengréla"],
              "latitude" => 9.896245,
              "longitude" => -6.448633
            ],
            [
              "region"=> "Région du Poro",
              "code"=>"07",
              "departement"=> ["Dikodougou", "Korhogo", "M’Bengué", "Sinématiali"],
              "latitude" => 9.476081,
              "longitude" => -5.7310859
            ],
            [
              "region"=> "Région du Tchologo",
              "code"=>"08",
              "departement"=> ["Ferkessédougou", "Kong", "Ouangolodougou"],
              "latitude" => 9.5466024,
              "longitude" => -4.7845119
            ],
            [
              "region"=> "Région du Worodougou",
              "code"=>"09",
              "departement"=> ["Kani", "Séguéla"],
              "latitude" => 8.3977175,
              "longitude" => -6.7575757
            ],
            [
              "region"=> "Région du Hambol",
              "code"=>"06",
              "departement"=> ["Dabakala", "Katiola", "Niakaramadougou"],
              "latitude" => 8.6201989,
              "longitude" => -4.8136527
            ],
            [
              "region"=> "Région du Gbêkê",
              "code"=>"04",
              "departement"=> ["Béoumi", "Botro", "Bouaké", "Sakassou"],
              "latitude" => 7.7003988,
              "longitude" => -5.0982175
            ],
            [
              "region"=> "Région de Bounkani",
              "code"=>"01",
              "departement"=> ["Bouna", "Doropo", "Nassian", "Téhini"],
              "latitude" => 9.0799571,
              "longitude" => -3.3293652
            ],
            [
              "region"=> "Région du Gontougo",
              "code"=>"05",
              "departement"=> ["Bondoukou", "Koun-Fao", "Sandégué", "Tanda", "Transua"],
              "latitude" => 7.92343941,
              "longitude" => -3.369677
            ]
        ];
         //dd($regionDepartement);
        //$regions = json_decode($regionDepartement, true);
        $regions = $regionDepartement;

        foreach ($regions as $regionData) {
            
            $region = new Region([ 
                'name' => $regionData['region'],
                'code' => $regionData['code'],
                'latitude' => $regionData['latitude'],
                'longitude' => $regionData['longitude'],
            ]);
            $region->save();
            
            foreach ($regionData['departement'] as $departementName) {
                $departement = new Departement([
                    'name' => $departementName,
                    'region_id' => $region->id
                ]);
                $departement->save();
            }
        }
    }
}
