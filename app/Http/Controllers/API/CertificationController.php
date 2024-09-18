<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\Certification;
use App\Http\Controllers\Controller;
use App\Http\Controllers\API\BaseController;

class CertificationController extends BaseController
{
    public function __construct(){

        $this->middleware('auth:api');
    }

    public function index(){

        $certifications = Certification::orderBy('created_at')->get()->makeHidden(['created_at','updated_at']);

        return $this->sendResponse($certifications,'liste des certifications');
    }
}
