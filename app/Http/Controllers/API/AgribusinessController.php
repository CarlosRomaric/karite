<?php

namespace App\Http\Controllers\API;

use App\Models\Agribusiness;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\API\BaseController;

class AgribusinessController extends BaseController
{
    public function __construct(){

        $this->middleware('auth:api');
    }

    public function index(){

        $agribusinesses = Agribusiness::with('region','departement')->orderBy('created_at')->where('status',1)->get();
        //dd($regions);

        return $this->sendResponse($agribusinesses,'liste des Cooperatives');
    }
}
