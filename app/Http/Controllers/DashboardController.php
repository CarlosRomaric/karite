<?php

namespace App\Http\Controllers;

use App\Models\Plot;
use App\Models\User;
use App\Models\Offer;
use App\Models\Farmer;
use App\Models\Region;
use App\Models\Agribusiness;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index()
    {
        $user = auth()->user();
       
        $this->authorize('ADMIN TABLEAU DE BORD');

        $users = User::retrievingByUsersType()->get();
        $farmers = Farmer::retrievingByUsersType()->get();
        $agribusinesses = Agribusiness::orderBy('denomination')->paginate(10);
        $regions = Region::with(['agribusinesses.offers' => function ($query) {
            $query->select('agribusiness_id', 'certification', DB::raw('SUM(weight) as total_weight'))
                  ->groupBy('agribusiness_id','certification');
        }])
        ->get();
        //dump($regions);
        $offers = Offer::orderBy('created_at','desc')->get();

        return view('dashboard.index', compact('farmers', 'agribusinesses', 'users', 'regions', 'offers'));
    }
    
}
