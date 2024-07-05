<?php

namespace App\Http\Controllers\API;

use App\Models\Region;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\API\BaseController;

class RegionController extends BaseController
{
    public function __construct(){

        $this->middleware('auth:api');
    }

    public function index(){

        $regions = Region::with('departements')->orderBy('created_at')->get();
        //dd($regions);

        return $this->sendResponse($regions,'liste des regions');
    }
}
