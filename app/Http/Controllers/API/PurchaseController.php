<?php

namespace App\Http\Controllers\API;

use App\Models\Purchase;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\API\BaseController;

class PurchaseController extends BaseController
{
    public function __construct(){
        $this->middleware('auth:api');
    }

    public function rules(){
        $rules = [
            'qte'=>'required',
            'weight'=>'required',
            'certification'=>'required',
            'selling_price'=>'required',
            'type_packaging'=>'required',
            'farmer_id'=>'required',
            'user_id'=>'required',
            'agribusiness_id'=>'required'
        ];

        return $rules;
    }


    public function messages(){
        $messages = [
            'weight.required'=>'la poids du produit est obligatoire',
            'qte.required'=>'la quantité du produit est obligatoire',
            'certification.required'=>'le choix de la certification est obligatoire',
            'type_packaging.required'=>'le choix du type de conditionnement est obligatoire',
            'selling_price.required'=>'le prix unitaire est obligatoire',
            'user_id.required'=>'l\'identifiant de l\'utilisateur en cours est obligatoire',
            'farmer_id.required'=>'l\'identifiant du producteur  est obligatoire',
            'agribusiness_id.required'=>'le choix de la cooperative est obligatoire'
            
        ];

        return $messages;
    }

    public function index(){
        $agribusiness_id = Auth::user()->agribusiness_id;
        $purchases = Purchase::orderBy('created_at','DESC')
                            ->where('agribusiness_id', $agribusiness_id)
                            ->get();
        return $this->sendResponse($purchases,'liste des achats de produit');
    }


    public function store(Request $request){
        //dd($request->all());
        $data = Validator::make($request->all(), $this->rules(), $this->messages());

        if($data->fails()){
            return $this->sendError('une erreur s\'est produite', $data->errors());
        }else{
           
            $data = $request->all();
            $purchase = Purchase::create($data);
            $purchase->amount = $purchase->qte * $purchase->selling_price;
            $purchase->save();
            $success['purchases']=  $purchase;
            return $this->sendResponse($purchase,'votre achat a bien été effectué');
        }
    }

}
