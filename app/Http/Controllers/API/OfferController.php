<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\API\BaseController;
use App\Models\Sealed;
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
            'selling_price' => 'required|numeric|min:0',
            'type_package_id'=>'required|exists:type_packages,id',
            'qr_code' => 'required|array|min:1', // Valide si le tableau existe et contient au moins un élément
            'qr_code.*' => 'required|exists:sealeds,code' // Chaque code dans le tableau doit exister dans la table `sealeds`
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
            'type_package_id.exists'=>'Le type de package n\'existe pas',
            'selling_price.required'=>'le prix unitaire est obligatoire',
            'selling_price.numeric' => 'Le prix unitaire doit être un nombre.',
            'selling_price.min' => 'Le prix unitaire doit être supérieur ou égal à 0.',
            'qr_code.required' => 'Les scellés (codes QR) sont obligatoires.',
            'qr_code.array' => 'Les scellés doivent être un tableau.',
            'qr_code.min' => 'Au moins un scellé est requis.',
            'qr_code.*.required' => 'Chaque scellé doit avoir un code valide.',
            'qr_code.*.exists' => 'Le code QR spécifié n\'existe pas dans les scellés.',
        ];

        return $messages;
    }

    public function index(){

        //$offers = Offer::orderBy('created_at','DESC')->get();
        
        $offers = Offer::with('agribusiness','certification','sealed')
                        ->orderBy('created_at','DESC')
                        ->get()
                        ->transform(function($offer){
                            return [
                                "id"=>$offer->id,
                                "selling_price"=>$offer->selling_price,
                                "qte"=>$offer->qte,
                                "weight"=>$offer->weight,
                                "type_package"=>$offer->type_package->name,
                                "agribusiness"=>$offer->agribusiness->denomination,
                                "statut"=>$offer->statut,
                                "certification"=>$offer->certification->name,
                                "code"=>$offer->code,
                                'qr_codes' => $offer->sealed->pluck('code')->toArray()
                            ];
                        });
        return $this->sendResponse($offers,'liste des offres de produit');
    }


    public function store(Request $request){
        $dataOffer = $request->all();
        $dataOffer['statut']=0;
        $user = auth()->user();
       
        $data = Validator::make($dataOffer, $this->rules(), $this->messages());

        if($data->fails()){
            return $this->sendError('une erreur s\'est produite', $data->errors());
        }else{
           
            $data = $request->all();
            $data['user_id']= $user->id;
            $data['code']= 'OFFRE-' . strtoupper(uniqid());
            $data['agribusiness_id'] = $user->agribusiness_id;
            $offer = Offer::create($data);
            return $this->sendResponse($offer,'votre offre a bien été enregistré');
        }

    }

    public function synchronisation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'data' => 'required|array',
        ], [
            'data.required' => 'Les données sont requises',
            'data.array' => 'Les données doivent être un tableau',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Une erreur s\'est produite', $validator->errors());
        }

        $successCount = 0;
        $errorCount = 0;
        $errors = [];  // Tableau pour stocker les erreurs
        $user = Auth::user();
        $dataSave = [];
        foreach ($request->data as $entry) {
            $entryValidator = Validator::make($entry, $this->rules(), $this->messages());

            if ($entryValidator->fails()) {
                $errorCount++;

                // Récupérer toutes les erreurs pour l'entrée actuelle
                $entryErrors = $entryValidator->errors()->toArray();
                
                // Parcourir chaque champ avec une erreur
                foreach ($entryErrors as $field => $messages) {
                    $errors[] = [
                        $field => $entry[$field] ?? 'Non fourni',  // Inclure la valeur qui a échoué
                        'error' => $messages[0]  // Prendre seulement le premier message d'erreur
                    ];
                }

            } else {
                // Enregistrer l'entrée valide
                $validatedEntry = $entryValidator->validated();
                $validatedEntry['user_id'] = $user->id;
                $validatedEntry['code'] = 'OFFRE-' . strtoupper(uniqid());
                $validatedEntry['agribusiness_id'] = $user->agribusiness_id;
                $validatedEntry['statut'] = 'DISPONIBLE';
                unset($validatedEntry['qr_code']);
                // Créer l'offre
                $offer = Offer::create($validatedEntry);

                $successCount++;
                if (!empty($entry['qr_code']) && is_array($entry['qr_code'])) {
                    foreach ($entry['qr_code'] as $qrCode) {
                        // Valider le QR code avant de l'attacher
                        $sealed = Sealed::where('code', $qrCode)->first();

                        if ($sealed && !$offer->sealed()->where('code', $qrCode)->exists()) {
                            // Attacher le scellé à l'offre
                            $offer->sealed()->attach($sealed->id);
                            $sealed->state = 'USED';
                            $sealed->save();
                        } else {
                            $errors[] = [
                                'qr_code' => $qrCode,
                                'error' => 'Le scellé est soit inexistant, soit déjà utilisé.'
                            ];
                            $errorCount++;
                        }
                    }
                } else {
                    $errors[] = [
                        'qr_code' => 'QR codes non fournis ou mal structurés.'
                    ];
                    $errorCount++;
                }
                $offre = Offer::with('certification','sealed','agribusiness')
                              ->where('id',$offer->id)
                              ->first();
                
                if ($offre) {
                    $transformedOffer = [
                        'id' => $offre->id,
                        'code' => $offre->code,
                        'agribusiness' => $offre->agribusiness->denomination,
                        'statut' => $offre->statut,
                        'certification' =>  $offre->certification->name, // Inclure l'objet certification tel quel
                        'qr_codes' => $offer->sealed->pluck('code')->toArray()
                    ];
        
                    $dataSave[] = $transformedOffer;  // Ajouter l'offre transformée à $dataSave
                } else {
                    // Gérer le cas où l'offre n'existe pas
                    $errors[] = [
                        'offer' => 'Offre introuvable pour l\'ID ' . $offer->id,
                    ];
                }
                              
               
            }
        }

        // Préparer la réponse finale
        $response = [
            'success_count' => $successCount,
            'error_count' => $errorCount,
            'dataSave'=>$dataSave,
            'errors' => $errors,  // Inclure les erreurs dans la réponse
        ];

        if ($errorCount > 0) {
            return $this->sendSyncError('Synchronisation échouée', $response);
        }else{
            unset($response['errors']);
            return $this->sendResponse($response, 'Synchronisation des offres réussie');
        }

       
    }

    public function scan(Request $request)
    {
        // Validation des données entrantes
        $validator = Validator::make($request->all(), [
            'data' => 'required|array',
        ], [
            'data.required' => 'Les données sont requises',
            'data.array' => 'Les données doivent être un tableau',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Une erreur s\'est produite', $validator->errors());
        }

        $successCount = 0;
        $errorCount = 0;
        $errors = [];  // Tableau pour stocker les erreurs
        $user = Auth::user(); // Récupérer l'utilisateur authentifié

        // Traiter chaque entrée dans la requête
        foreach ($request->data as $entry) {
            // Valider chaque entrée
            $entryValidator = Validator::make($entry, [
                'offer_id' => 'required|exists:offers,id', // Valider que l'offre existe
                'code' => 'required|exists:sealeds,code', // Valider que le code existe
            ], [
                'offer_id.required' => 'L\'ID de l\'offre est requis',
                'offer_id.exists' => 'L\'offre spécifiée n\'existe pas',
                'code.required' => 'Le code est requis',
                'code.exists' => 'Le code spécifié n\'existe pas dans les scellés',
            ]);

            if ($entryValidator->   fails()) {
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
                // Si l'entrée est valide, rattacher le scellé à l'offre
                $validatedEntry = $entryValidator->validated();
                
                // Récupérer l'offre et rattacher le scellé
                $offer = Offer::find($validatedEntry['offer_id']);
                
                // Vérifier si le scellé est déjà associé à l'offre pour éviter les doublons
                if (!$offer->sealed()->where('code', $validatedEntry['code'])->exists()) {
                    // Attacher le scellé à l'offre
                    $sealed = Sealed::where('code', $validatedEntry['code'])->first();
                    $offer->sealed()->attach($sealed->id);
                    $sealed->state = 'USED';
                    $sealed->save();
                }
                
                $successCount++;
            }
        }

        // Préparer la réponse finale
        $response = [
            'success_count' => $successCount,
            'error_count' => $errorCount,
            'errors' => $errors,  // Inclure les erreurs dans la réponse
        ];

        if ($errorCount > 0) {
            return $this->sendSyncError('Synchronisation échouée', $response);
        } else {
            unset($response['errors']);
            return $this->sendResponse($response, 'Synchronisation des scellés réussie');
        }
    }
    
    
    
}
