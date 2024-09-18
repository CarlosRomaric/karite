<?php

namespace App\Http\Controllers;

use App\Jobs\StoreSealedJob;
use App\Models\Region;
use App\Models\Agribusiness;
use App\Models\Batch;
use App\Models\Lot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class SealedController extends Controller
{

    public function index()
    {
        return view('sealeds.index');
    }

    public function create()
    {
        $regions = Region::orderBy('name', 'asc')->get();
        return view('sealeds.create', compact('regions'));
    }

    public function sealed_agribusiness()
    {
        $agribusinesses = Agribusiness::orderBy('matricule', 'asc')->get();
        $lots = Lot::where('agribusiness_id',null)->orderBy('code', 'asc')->get();
        return view('sealeds.sealed-agribusiness', compact('agribusinesses','lots'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'number' => 'required|integer|min:100|max:1000|in:100,200,300,400,500,600,700,800,900,1000',
            'region_id' => 'required|uuid',
            'type' => 'required|string',
        ]);


        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        
        StoreSealedJob::dispatch($data);

        return back()->with([
            'status' => 'success', 'message' => 'Enregistrement en cours de traitement.'
        ]);
    }

    public function set_agribusiness(Request $request)
    {
        $request->validate([
            'agribusiness_id' => 'required|uuid',
            'lot_id' => 'required|uuid',
        ]);

        $lot = Lot::find($request->lot_id);
        $lot->agribusiness_id = $request->agribusiness_id;
        $lot->user_id = Auth::user()->id;
        $lot->save();

        return back()->with([
            'status' => 'success', 'message' => 'Lot assigner à la coopérative avec succès'
        ]);
    }

    public function print($id){

        $lot = Lot::find($id);

        if($lot->batch->type=="QR-CODE"){
            $pdf = PDF::loadView('sealeds.print', compact('lot'))->set_option("enable_php", true);
        }else{
            $pdf = PDF::loadView('sealeds.print-bar-code', compact('lot'))->set_option("enable_php", true);
        }
        
        return $pdf->stream();
    }
}
