<?php


namespace App\Exports;


use App\Models\Farmer;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;

class FarmerDataExport implements FromCollection
{

    use Exportable;

    public function collection()
    {
        $header = [
            'name' => 'NAME',
            'gps_code' => 'Code_GPS',
            'identifier' => 'Identifian',
            'fullname' => 'Nom_et_Pr',
            'sexe' => 'Sexe',
            'phone' => 'Tel',
            'manager_fullname' => 'Nom_gestio',
            'manager_sexe' => 'Sexe_Gest',
            'manager_phone' => 'Tel_Gest',
            'agribusiness' => 'Coopérati',
            'site' => 'Site',
            'plot_number' => 'N°Parcell',
            'number_of_children' => 'Nbre_enfan',
            'number_of_dependants' => 'pers_charg',
            'marital_status' => 'Statut',
            'number_of_women' => 'Nbre_conjo',
            'born_date' => 'Date_naiss',
            'born_place' => 'Lieu_naiss',
            'link' => 'Liens',
            'date_track' => 'Date_mappi',
            'total_area' => 'Aire_hecta',
            'longitude' => 'Long',
            'latitude' => 'Lat',
        ];

        return Farmer::retrievingByUsersType()->get()->map(function ($farmer) {
            foreach ($farmer->plots as $key => $plot) {
                return [
                    'name' => ($key === 0) ? "{$farmer->gps_code}" :  "{$farmer->gps_code}P".($key + 1),
                    'gps_code' => $farmer->gps_code,
                    'identifier' => $farmer->identifier,
                    'fullname' => $farmer->fullname,
                    'sexe' => $farmer->sexe,
                    'phone' => $farmer->phone,
                    'manager_fullname' => $farmer->manager_fullname,
                    'manager_sexe' => $farmer->manager_sexe,
                    'manager_phone' => $farmer->manager_phone,
                    'agribusiness' => $farmer->agribusiness ? $farmer->agribusiness->acronym : "",
                    'site' => $farmer->locality,
                    'plot_number' => $key + 1,
                    'number_of_children' => $farmer->number_of_children,
                    'number_of_dependants' => $farmer->number_of_dependants,
                    'marital_status' => $farmer->marital_status,
                    'number_of_women' => $farmer->number_of_women,
                    'born_date' => $farmer->born_date,
                    'born_place' => $farmer->born_place,
                    'link' => '',
                    'date_track' => $plot->date_track,
                    'total_area' => $plot->total_area,
                    'longitude' => $plot->longitude,
                    'latitude' => $plot->latitude,
                ];
            }

            if (count($farmer->plots) < 1) {
                return [
                    'name' =>$farmer->gps_code,
                    'gps_code' => $farmer->gps_code,
                    'identifier' => $farmer->identifier,
                    'fullname' => $farmer->fullname,
                    'sexe' => $farmer->sexe,
                    'phone' => $farmer->phone,
                    'manager_fullname' => $farmer->manager_fullname,
                    'manager_sexe' => $farmer->manager_sexe,
                    'manager_phone' => $farmer->manager_phone,
                    'agribusiness' => $farmer->agribusiness ? $farmer->agribusiness->acronym : "",
                    'site' => $farmer->locality,
                    'plot_number' => 1,
                    'number_of_children' => $farmer->number_of_children,
                    'number_of_dependants' => $farmer->number_of_dependants,
                    'marital_status' => $farmer->marital_status,
                    'number_of_women' => $farmer->number_of_women,
                    'born_date' => $farmer->born_date,
                    'born_place' => $farmer->born_place,
                    'link' => '',
                    'date_track' => '',
                    'total_area' => '',
                    'longitude' => '',
                    'latitude' => '',
                ];
            }
        })->prepend($header);
    }
}
