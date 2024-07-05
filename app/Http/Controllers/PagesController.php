<?php

namespace App\Http\Controllers;

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

}
