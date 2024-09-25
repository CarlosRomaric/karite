<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController;
use App\Models\TypePackage;

class TypePackageController extends BaseController
{
    public function __construct(){

        $this->middleware('auth:api');
    }


    public function index()
    {
        $typePackages = TypePackage::orderBy('created_at')->get();

        return $this->sendResponse($typePackages,'liste des type de packages');
    }

    public function store(Request $request)
    {
        $data = [
            'nom'=>$request->nom
        ];

        foreach ($data as $row) {
            
        }
    }
}
