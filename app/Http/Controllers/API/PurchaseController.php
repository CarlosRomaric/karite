<?php

namespace App\Http\Controllers\API;

use App\Models\Farmer;
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
          
            'weight'=>'required',
            'quality'=>'required',
            'selling_price'=>'required',
            'type_purchase'=>'required',
            'farmer_id'=>'required|exists:farmers,id',
           
        ];

        return $rules;
    }


    public function messages(){
        $messages = [
            'weight.required'=>'la poids du produit est obligatoire',
            'quality.required'=>'la qualité du produit est obligatoire',
            'selling_price.required'=>'le prix unitaire est obligatoire',
            'farmer_id.required'=>'l\'identifiant du producteur  est obligatoire',
            'farmer_id.exists'=>'ce producteur  est n\'existe pas sur notre plateforme',
        ];

        return $messages;
    }

    public function index(){
        $agribusiness_id = Auth::user()->agribusiness_id;
        $purchases = Purchase::with('farmer')
                             ->where('agribusiness_id', $agribusiness_id)
                             ->orderBy('created_at','DESC')
                             ->get()
                             ->transform(function($purchase){
                                return [
                                    "id"=>$purchase->id,
                                    "weight"=>$purchase->weight,
                                    "quality"=>$purchase->quality,
                                    "type_purchase"=>$purchase->type_purchase,
                                    "selling_price"=>$purchase->selling_price,
                                    "amount"=>$purchase->amount,
                                    "cash"=>$purchase->cash,
                                    "mobile_money"=>$purchase->mobile_money,
                                    "fullname"=>$purchase->farmer->fullname,
                                    "picture"=>asset('images/'.$purchase->farmer->picture),
                                    "phone"=>$purchase->farmer->phone,
                                    "phone_payment"=>$purchase->farmer->phone_payment,
                                ];
                             });
        return $this->sendResponse($purchases,'liste des achats de produit');
    }


    public function store(Request $request)
        {
            // Validation du tableau 'data'
            $validator = Validator::make($request->all(), [
                'data' => 'required|array',
            ], [
                'data.required' => 'Les données sont requises',
                'data.array' => 'Les données doivent être un tableau',
            ]);
        
            // Si la validation échoue, retourner une erreur
            if ($validator->fails()) {
                return $this->sendError('Une erreur s\'est produite', $validator->errors());
            }
        
            $successCount = 0;
            $errorCount = 0;
            $errors = [];  // Tableau pour stocker les erreurs
            $user = Auth::user();
            
            // Parcourir chaque entrée dans 'data'
            foreach ($request->data as $entry) {
                // Validation spécifique de chaque entrée
                $entryValidator = Validator::make($entry, $this->rules(), $this->messages());
        
                if ($entryValidator->fails()) {
                    $errorCount++;
        
                    // Récupérer toutes les erreurs pour l'entrée actuelle
                    $entryErrors = $entryValidator->errors()->toArray();
        
                    // Parcourir chaque champ avec une erreur
                    foreach ($entryErrors as $field => $messages) {
                        $errors[] = [
                            $field => $entry[$field],  // Inclure la valeur qui a échoué
                            'error' => $messages[0]  // Prendre seulement le premier message d'erreur
                        ];
                    }
        
                } else {
                    // Enregistrer l'entrée valide
                    $validatedEntry = $entryValidator->validated();
        
                    // Trouver le fermier correspondant
                    $farmer = Farmer::find($validatedEntry['farmer_id']);
        
                    // Ajout des informations supplémentaires
                    $validatedEntry['user_id'] = $user->id;
                    $validatedEntry['agribusiness_id'] = $farmer->agribusiness ? $farmer->agribusiness->id : null;
                    $validatedEntry['amount'] = $validatedEntry['selling_price'] * $validatedEntry['weight']; 
                    $validatedEntry['cash'] = $entry['cash'];
                    $validatedEntry['mobile_money'] = $entry['mobile_money'];

        
                    // Créer un nouvel achat (Purchase)
                    Purchase::create($validatedEntry);
        
                    // Incrémenter le compteur de succès
                    $successCount++;
                }
            }
        
            // Préparer la réponse finale
            $response = [
                'success_count' => $successCount,
                'error_count' => $errorCount,
                'errors' => $errors,  // Inclure les erreurs dans la réponse
            ];
        
            // Si des erreurs sont présentes, retourner un message d'erreur
            if ($errorCount > 0) {
                return $this->sendError('Enregistrement des achats échoué', $response);
            } else {
                // Si tout s'est bien passé, retourner la réponse avec succès
                unset($response['errors']);
                return $this->sendResponse($response, 'Enregistrement des achats réussi');
            }
        }
    
}
