<?php

namespace App\Http\Controllers\API;

use App\Models\Sealed;
use App\Models\Agribusiness;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\API\BaseController;

class SealedController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $user = Auth::user();
       
        $agribusiness = Agribusiness::find($user->agribusiness_id);
        $sealeds = [];
        foreach ($agribusiness->lots as $lots) {
            foreach ($lots->sealeds as $sealed) {
               $sealeds[] = $sealed->code;
            }
        }

        //return $sealeds;
        return $this->sendResponse($sealeds,'liste des scellé de la coopératives');
    }

    // public function scan(Request $request)
    // {
    //     $rules = [
    //         'code'=>'required',
    //         'longitude'=>'required',
    //         'latitude'=>'required'
    //     ];

    //     $messages = [
    //         'code.required'=>'le code est obligatoire',
    //         'longitude.required'=>'la longitude est obligatoire',
    //         'latitude.required'=>'la latitude est obligatoire',
    //     ];
    //     $this->validate($request, $rules, $messages);
    //     $user = Auth::user();
    //     $sealed = Sealed::whereIn('code', [$request->code])->first();
        
    //     if($sealed->state=='USED')
    //     {
    //         return $this->sendResponse($sealed,'scéllé déjà utilisé');
    //     }else{
    //         $sealed->state = 'USED';
    //         $sealed->user_id = $user->id;
            
    //         $sealed->logitude = $request->longitude;
    //         $sealed->latitude = $request->latitude;
    //         $sealed->save();
    //         return $this->sendResponse($sealed,'scéllé scanner');
    //     }
       
    // }
}
