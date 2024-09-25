<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\API\BaseController;
use App\Models\Offer;
use Illuminate\Support\Facades\Log;

class OfferController extends BaseController
{
    public function __construct(){
        $this->middleware('auth:api');
    }

    public function rules(){
        $rules = [
            'qte'=>'required',
            'weight'=>'required',
            'certification_id'=>'required|exists:certifications,id',
            'selling_price'=>'required',
            'type_package_id'=>'required|exists:type_packages,id',
            'agribusiness_id'=>'required|exists:agribusinesses,id',
        ];

        return $rules;
    }


    public function messages(){
        $messages = [
            'weight.required'=>'la poids du produit est obligatoire',
            'qte.required'=>'la quantité du produit est obligatoire',
            'certification_id.required'=>'le choix de la certification est obligatoire',
            'certification_id.exists'=>'cette certification n\'existe pas',
            'type_package_id.required'=>'le choix du type de conditionnement est obligatoire',
            'selling_price.required'=>'le prix unitaire est obligatoire',
        ];

        return $messages;
    }

    public function index(){

        $offers = Offer::orderBy('created_at','DESC')->get();
        return $this->sendResponse($offers,'liste des offres de produit');
    }


    public function store(Request $request){
        $dataOffer = $request->all();
        $dataOffer['statut']=0;
        $data = Validator::make($dataOffer, $this->rules(), $this->messages());

        if($data->fails()){
            return $this->sendError('une erreur s\'est produite', $data->errors());
        }else{
           
            $data = $request->all();
            $data['user_id']= auth()->user()->id;
            $data['code']= 'OFFRE-' . strtoupper(uniqid());
            $offer = Offer::create($data);
            $success['offers']=  $offer;
            return $this->sendResponse($offer,'votre offre a bien été enregistré');
        }

    }

    public function synchronisation(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'data'=>'required|array',
        ],[
            'data.required' => 'Les données sont requises',
            'data.array' => 'Les données doivent être un tableau',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Une erreur s\'est produite', $validator->errors());
        }

        $errors = [];
        $successCount = 0;
        $errorCount = 0;

        foreach ($request->data as $entry) {
            $entryValidator = Validator::make($entry,$this->rules(), $this->messages());
    
            if ($entryValidator->fails()) {
                $errors[] = [
                    'entry' => $entry,
                    'errors' => $entryValidator->errors(),
                ];
                $errorCount++;
            } else {

                $validatedEntry = $entryValidator->validated();
                $validatedEntry['user_id'] = Auth::user()->id;
                Offer::create($validatedEntry);
                $successCount++;
                 
            }
        }
    
        $response = [
            'success' => 'Les récoltes ont bien été enregistrées',
            'success_count' => $successCount,
            'error_count' => $errorCount,
        ];
    
        if (!empty($errors)) {
            $response['errors'] = $errors;
        }
    
        return response()->json($response, 200);
        

    }
}
