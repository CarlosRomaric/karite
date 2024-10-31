<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use Illuminate\Http\Request;

class AlmondController extends Controller
{
    public function index(){
        return view('almond.index');
    }

    public function show($id)
    {
        $almond = Purchase::find($id);
        return view('almond.show', ['almond'=>$almond]);
    }
}
