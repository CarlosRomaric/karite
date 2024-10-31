<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function index()
    {
        return view('offers.index');
    }

    public function show($id)
    {
        $data = [
            'offer'=>Offer::find($id)
        ];
        
        return view('offers.show')->with($data);
    }
}
