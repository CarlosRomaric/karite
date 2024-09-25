<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return view('orders.index');
    }
    

    public function create($offerId)
    {
        $offer = Offer::find($offerId);
        $data = [
            'offer'=>$offer
        ];
        return view('pages.order')->with($data);
    }
}
