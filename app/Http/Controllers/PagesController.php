<?php

namespace App\Http\Controllers;

use App\Models\Certification;
use App\Models\Region;
use App\Models\Departement;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        return view('pages.index');
    }

    public function createCoop(){

        return view('pages.createCoop');
    }

    public function offres(){
        return view('pages.offres');
    }

   

}
