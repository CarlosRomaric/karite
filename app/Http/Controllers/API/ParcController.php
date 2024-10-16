<?php

namespace App\Http\Controllers\API;

use App\Models\Parc;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\API\BaseController;

class ParcController extends BaseController
{
    public function __construct()
    {
        
        $this->middleware('auth:api');
    }
    
    public function rules()
    {
       $rules = [
            "name"=>"required",
            "description"=>"required",
            "longitude"=>"required",
            "latitude"=>"required",
            "picture"=>"required"
       ];

       return $rules;
    }

    public function messages(){
        return [
            "name.required"=>"le nom du parc  est obligatoire",
            "description.required"=>"la description du parc est obligatoire",
            "description.required"=>"la description du parc est obligatoire",
            "latitude.required"=>"la latitude du parc est obligatoire",
            "longitude.required"=>"la latitude du parc est obligatoire",
            "picture.required"=>"l'image du parc est obligatoire"
        ];
    }

    public function index(){
        $historyParc= Parc::orderBy('created_at','DESC')
                            ->get()
                            ->map(function($item){
                                $parc = collect($item)->except(['created_at','updated_at','deleted_at']);
                                return $parc;
                            });
                                                    
       
        return $this->sendResponse($historyParc, 'historique des parcs a karité');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), 
        [
            'data' => 'required|array'
        ], [
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
            $entryValidator = Validator::make($entry, $this->rules(), $this->messages());

            if ($entryValidator->fails()) {
                // Collecter les erreurs avec la valeur correspondante
                $errorCount++;
                $entryErrors = $entryValidator->errors()->toArray();
                foreach ($entryErrors as $field => $messages) {
                    $errors[] = [
                        $field => $entry[$field],  // Inclure la valeur qui a échoué
                        'error' => $messages[0]    // Prendre seulement le premier message d'erreur
                    ];
                }
            } else {
                $validatedEntry = $entryValidator->validated();

                 // Gestion de l'image (upload)
                 if (isset($entry['picture']) && $entry['picture'] instanceof \Illuminate\Http\UploadedFile) {
                    $image = $entry['picture'];
                    $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

                    // Déplacer l'image dans le dossier 'public/images'
                    $image->move(public_path('images'), $imageName);

                    // Enregistrer le nom de l'image dans la base de données
                    $validatedEntry['picture'] = $imageName;
                }

                // Créer l'entrée pour le parc
                Parc::create($validatedEntry);
                $successCount++;
            }
        }

        // Préparer la réponse finale
        $response = [
            'success_count' => $successCount,
            'error_count' => $errorCount,
        ];

        if ($errorCount > 0) {
            $response['errors'] = $errors;  // Inclure les erreurs dans la réponse
            return $this->sendError('Synchronisation échouée', $response);
        }

        return $this->sendResponse($response, 'Les parcs à karité ont bien été enregistrés');
    }

}
