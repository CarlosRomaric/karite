<?php

/**
 * Created by PhpStorm.
 * User: salioudiabate
 * Date: 16/11/2019
 * Time: 22:33
 */

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Farmer;
use Illuminate\Http\Request;

class SynchronizationController extends Controller
{
    public $itemsWithErrors;
    public $executedItemsId;

    /**
     * SynchronizationController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:api');

        $this->itemsWithErrors = collect();
        $this->executedItemsId = [];
    }


    public function store(Request $request)
    {
        $data = json_decode($request->get('data'), true);

        $this->createFarmer($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Synchronizations finished.',
            'data' => $this->itemsWithErrors
        ]);
    }

    private function createFarmer($data)
    {
        $currentItem = null;

        try {
            foreach ($data as $item) {

                if (!in_array($item['id'], $this->executedItemsId)) {

                    $farmer = Farmer::where('identifier', $item['identifier'])->first();
                    $currentItem = $item;

                    if ($farmer == null) {
                        Farmer::create($this->formatFarmerData($item));
                    } else {
                        $farmer->update($this->formatFarmerData($item));
                    }

                    array_push($this->executedItemsId, $currentItem['id']);
                }
            }
        } catch (\Exception $e) {
            $this->itemsWithErrors->push((object) [
                'id' => $currentItem['id'],
                'error' => $e->getMessage(),
            ]);

            array_push($this->executedItemsId, $currentItem['id']);

            $items = array_filter($data, function ($item) {
                return !in_array($item['id'], $this->executedItemsId);
            });

            $this->createFarmer($items);
        }
    }

    private function formatFarmerData($row)
    {
        if(array_key_exists('picture', $row) && !is_null($row['picture'])) {
            $filenamePicture = $row('picture')->getClientOriginalName();
            $pathPicture = 'public/farmers/';
            $famerPicture = $row('picture')->storeAs($pathPicture, $filenamePicture);
        }else{
            return null;
        } 
      

        return [
            //'picture' => array_key_exists('picture', $row) && !is_null($row['picture']) ? storeBase64ToImage($row['picture']) : null,
            'picture' => $famerPicture,
            'fullname' => $row['name'],
            'sexe' => $row['gender'],
            'phone' => $row['phone'],
            'born_date' => $row['born_date'],
            'born_place' => $row['born_place'],
            'phone_payment' => $row['phone_payment'],
            'region_id' => $row['region_id'],
            'departement_id' => $row['departement_id'],
            'locality' => $row['locality'],
            'activity' => $row['activity'],
            'agribusiness_id' => \request()->user() ? request()->user()->agribusiness_id : null,
        ];
    }
}
