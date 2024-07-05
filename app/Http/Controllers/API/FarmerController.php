<?php
/**
 * Created by PhpStorm.
 * User: salioudiabate
 * Date: 16/11/2019
 * Time: 22:33
 */

namespace App\Http\Controllers\API;

use App\Models\Farmer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\API\BaseController;

class FarmerController extends BaseController
{

    /**
     * FarmerController constructor.
     */
    public function __construct()
    {
        
        $this->middleware('auth:api');
    }

    public function rules(){
        $rules = [

            'fullname'=>'required',
            'picture'=>'required|image|max:2048',
            'phone'=>'required',
            'phone_payment'=>'required',
            'born_date'=>'required',
            'born_place'=>'required',
            'region_id'=>'required',
            'departement_id'=>'required',
            'locality'=>'required',
            'activity'=>'required',
            'sexe'=>'required',
            'agribusiness_id'=>'required',
        ];

        return $rules;
    }

    public function messages(){
        $messages = [
            
            'fullname.required'=>'le chmap Nom & prénoms est obligatoire',
            'picture.required'=>'l\'image est obligatoire',
            'picture.image'=>'la photo du producteur doit être une image',
            'picture.max'=>'la photo  ne doit pas être de plus de 2 Mo',
            'phone.required'=>'le numéro de téléphone est obligatoire',
            'phone_payment.required'=>'le numéro de téléphone mobile est obligatoire',
            'born_date.required'=>'la date de naissance est obligatoire',
            'born_place.required'=>'le lieu de naissance est obligatoire',
            'region_id.required'=>'la region est obligatoire',
            'departement_id.required'=>'le departement est obligatoire',
            'locality.required'=>'le lieu de residence est obligatoire',
            'activity.required'=>'le choix de l\'activité est obligatoire',
            'sexe.required'=>'le choix du sexe est obligatoire',
            'agribusiness_id.required'=>'le choix de la coopérative ou Indepant est obligatoire',
        ];
        return $messages;
    }

    public function index(Request $request)
    {
        $total = Farmer::where('agribusiness_id', $request->user()->agribusiness_id)->count();
        return response()->json([
            'status' => 'success',
            'message' => 'Liste des producteurs.',
            'data' =>  $this->getFarmersByAgribusiness($request),
            'meta' => [
                'total' => $total,
                'per_page' => (int) $request->get('per_page', 10),
                'page' => (int) $request->get('page', 1),
                'total_page' => ceil($total / $request->get('per_page', 10))
            ]   
        ]);
    }

    public function store(Request $request){
        $data = Validator::make($request->all(),$this->rules(),$this->messages());
        
        if ($data->fails()) {

            return $this->sendError('une erreur s\'est produite', $data->errors());

        }else{
            $user = Auth::user();
            $data = [
               
                'fullname'=>$request->fullname,
                'picture'=>$request->file('picture')->store('public/farmers'),
                'phone'=>$request->phone,
                'phone_payment'=>$request->phone_payment,
                'born_date'=>$request->born_date,
                'born_place'=>$request->born_place,
                'region_id'=>$request->region_id,
                'departement_id'=>$request->departement_id,
                'locality'=>$request->locality,
                'activity'=>$request->activity,
                'sexe'=>$request->sexe,
                'agribusiness_id'=>$request->agribusiness_id,
                'user_id'=>$user->id
            ];

            $farmer = Farmer::create($data);
            $success['producteur']=$farmer;
            return $this->sendResponse($farmer,'Votre enregistrement a été effectué avec success');
        }
    }

    public function synchronisationFarmer(Request $request)
    {
        
    }

    public function update(Request $request,  Farmer $farmer){
        if(!empty($request->picture)){
            $rules = $this->rules();
        }else{
            $rules = $this->rules()['picture']='';
        }
        $data = Validator::make($request->all(), $rules, $this->messages());
        
        if ($data->fails()) {

            return $this->sendError('une erreur s\'est produite', $data->errors());

        }else{
            $user = Auth::user();
            $data = [
                
                'fullname'=>$request->fullname,
                'picture'=>$request->file('picture')->store('public/farmers'),
                'phone'=>$request->phone,
                'phone_payment'=>$request->phone_payment,
                'born_date'=>$request->born_date,
                'born_place'=>$request->born_place,
                'region_id'=>$request->region_id,
                'departement_id'=>$request->departement_id,
                'locality'=>$request->locality,
                'activity'=>$request->activity,
                'sexe'=>$request->sexe,
                'agribusiness_id'=>$request->agribusiness_id,
                'user_id'=>$user->id
            ];

            $farmer->update($data);
            $success['producteur']=$farmer;
            return $this->sendResponse($farmer,'les informations du producteur ont bien été mis a jour avec success');
        }
    }



    private function getFarmersByAgribusiness($request)
    {
        $skip = $request->get('per_page', 10) * ($request->get('page', 1) - 1);
        return Farmer::query()
            ->with('region','departement')
            //->where('agribusiness_id', $request->user()->agribusiness_id)
            ->orderBy('fullname')
            ->take($request->get('per_page', 10))
            ->skip($skip)
            ->get();
            // ->transform(function ($farmer) {
            //     return [
            //         'id' => $farmer->id,
            //         'identifier' => $farmer->identifier,
            //         'fullname' => $farmer->fullname,
            //         'born_date' => $farmer->born_date,
            //         'born_place' => $farmer->born_place,
            //         'locality' => $farmer->locality,
            //         'phone' => $farmer->phone,
            //         'phone_payment' => $farmer->phone_payment,
            //         'sexe' => $farmer->sexe,
            //         'activity' => $farmer->activity,
            //         'picture' => $farmer->picture,
            //         'region_id' => $farmer->region_id,
            //         'departement_id' => $farmer->departement_id,
            //         'agribusiness_id' => $farmer->agribusiness_id,
            //         'user_id'=> $farmer->user_id,
            //         'created_at' => $farmer->created_at,
            //         'updated_at' => $farmer->updated_at
            //     ];
            // });
    }
}
