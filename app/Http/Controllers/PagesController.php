<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\Region;
use App\Models\Departement;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Certification;

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

    public function offre_detail($id){
        $offre = Offer::where('id',$id)->first();
        $data = [
            'offre'=>$offre
        ];
        
        return view('pages.offreDetail')->with($data);
    }

   

}
