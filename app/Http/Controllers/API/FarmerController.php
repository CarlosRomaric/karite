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
            'phone'=>'required|unique:farmers,phone',
            'phone_payment'=>'required',
            'born_date'=>'required',
            'born_place'=>'required',
            'locality'=>'required',
            'activity'=>'required',
            'sexe'=>'required',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];

        return $rules;
    }

    public function updateRules(){
        $rules = [
            'fullname'=>'required',
            'phone'=>'required|unique:farmers,phone',
            'phone_payment'=>'required',
            'born_date'=>'required',
            'born_place'=>'required',
            'locality'=>'required',
            'activity'=>'required',
            'sexe'=>'required',
            'farmer_id'=>'required',

        ];

        return $rules;
    }

    public function messages(){
        $messages = [
            'fullname.required'=>'le champ Nom & prénoms est obligatoire',
            'phone.required'=>'le numéro de téléphone est obligatoire',
            'phone.unique'=>'le numéro de téléphone existe déjà',
            'phone_payment.required'=>'le numéro de téléphone mobile money est obligatoire',
            'born_date.required'=>'la date de naissance est obligatoire',
            'born_place.required'=>'le lieu de naissance est obligatoire',
            'locality.required'=>'le lieu de residence est obligatoire',
            'activity.required'=>'le choix de l\'activité est obligatoire',
            'sexe.required'=>'le choix du sexe est obligatoire',
            'farmer_id.required'=>'l\'identifiant du producteur est obligatoire',
            'picture.image' => 'Le fichier doit être une image',
            'picture.mimes' => 'L\'image doit avoir une extension valide (jpeg, png, jpg, gif, svg)',
        ];
        return $messages;
    }

    public function index(Request $request)
    {
        
        return response()->json([
            'status' => 'success',
            'message' => 'Liste des producteurs.',
            'data' =>  $this->getFarmersByAgribusiness($request),
           
        ]);
    }

    // public function store(Request $request){
       
    //     $validator = Validator::make($request->all(), 
    //     [
    //         'data'=>'required|array'
    //     ],[
    //         'data.required' => 'Les données sont requises',
    //         'data.array' => 'Les données doivent être un tableau',
    //     ]);

    //     if ($validator->fails()) {
    //         return $this->sendError('Une erreur s\'est produite', $validator->errors());
    //     }

       
    //     $errors = [];
    //     $successCount = 0;
    //     $errorCount = 0;
       
       
    //     foreach ($request->data as $entry) {
    //         $entryValidator = Validator::make($entry, $this->rules(),$this->messages());
           
    //         if ($entryValidator->fails()) {

    //             $errors[] = [
    //                 'entry' => $entry,
    //                 'errors' => $entryValidator->errors(),
    //             ];
    //             $errorCount++;
                
    //         }else{
    //             $user = Auth::user();
                
    //             $validatedEntry = $entryValidator->validated();
    //             $validatedEntry['user_id'] = $user->id;
                
    //             $validatedEntry['region_id'] = $user->agribusiness ? $user->agribusiness->region->id : null;
    //             $validatedEntry['departement_id'] = $user->agribusiness ? $user->agribusiness->departement->id: null;
    //             $validatedEntry['agribusiness_id'] = $user->agribusiness ? $user->agribusiness->id: null;
                
    //             if (isset($entry['picture'])) {
    //                 $image = $entry['picture'];
    //                 if (preg_match('/^data:image\/(?<type>.+);base64,(?<data>.+)$/', $image, $matches)) {
    //                     $imageType = $matches['type'];
    //                     $imageData = base64_decode($matches['data']);
                        
    //                     // Déterminer l'extension du fichier
    //                     $extension = $imageType === 'jpeg' ? 'jpg' : $imageType;
                
    //                     // Définir un nom unique pour l'image
    //                     $imageName = time() . '_' . uniqid() . '.' . $extension;
    //                     // Chemin où l'image sera stockée
    //                     $path = public_path('images/' . $imageName);
    //                     // Enregistrer l'image
    //                     file_put_contents($path, $imageData);
                
    //                     // Optionnel : Vous pouvez enregistrer le nom du fichier dans la base de données
    //                     $validatedEntry['picture'] = $imageName;
    //                 }
    //             }

    //             $farmer = Farmer::create($validatedEntry);
    //             $successCount++;
                
    //         }
            
    //     }

    //     $response = [
    //         'success' => 'Les producteur ont bien été enregistrées',
    //         'success_count' => $successCount,
    //         'error_count' => $errorCount,
    //     ];

    //     if (!empty($errors)) {
    //         $response['errors'] = $errors;
    //     }

    //     return response()->json($response, 200);

    // }
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
                $user = Auth::user();

                $validatedEntry = $entryValidator->validated();
                $validatedEntry['user_id'] = $user->id;
                $validatedEntry['region_id'] = $user->agribusiness ? $user->agribusiness->region->id : null;
                $validatedEntry['departement_id'] = $user->agribusiness ? $user->agribusiness->departement->id : null;
                $validatedEntry['agribusiness_id'] = $user->agribusiness ? $user->agribusiness->id : null;

                // Gestion de l'image (upload)
                if (isset($entry['picture']) && $entry['picture'] instanceof \Illuminate\Http\UploadedFile) {
                    $image = $entry['picture'];
                    $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

                    // Déplacer l'image dans le dossier 'public/images'
                    $image->move(public_path('images'), $imageName);

                    // Enregistrer le nom de l'image dans la base de données
                    $validatedEntry['picture'] = $imageName;
                }

               
                //dd($validatedEntry);
                // Créer l'entrée pour le producteur
                Farmer::create($validatedEntry);
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

        return $this->sendResponse($response, 'Les producteurs ont bien été enregistrés');
    }


    public function update(Request $request){
          
        $entryValidator = Validator::make($request->all(), $this->updateRules(), $this->messages());
        
        if ($entryValidator->fails()) {

            return $this->sendError('une erreur s\'est produite', $entryValidator->errors());

        }else{
            $farmer = Farmer::find($request->farmer_id);
            $validatedEntry = Auth::user();
            $validatedEntry = $entryValidator->validated();;

            unset($validatedEntry['farmer_id']);
            $farmer->update($validatedEntry);
           
            return $this->sendResponse($farmer,'les informations du producteur ont bien été mis a jour avec success');
        }

    }

    public function updatePicture(Request $request)
    {
        $entryValidator = Validator::make($request->all(), 
        [
            'picture' => 'required|file|image|mimes:jpeg,png,jpg|max:2048', // validation pour un fichier image
            'farmer_id' => 'required',
        ], [
            'picture.required' => "L'image à modifier est obligatoire",
            'farmer_id.required' => "L'identifiant du producteur est obligatoire",
        ]);
    
        if ($entryValidator->fails()) {
            return $this->sendError('Une erreur s\'est produite', $entryValidator->errors());
        }
    
        $validatedEntry = $entryValidator->validated();
    
        $farmer = Farmer::find($validatedEntry['farmer_id']);
        if (!$farmer) {
            return $this->sendError('Fermier non trouvé', 404);
        }
    
        // Si un fichier image est présent, le traiter
        if ($request->hasFile('picture')) {
            $image = $request->file('picture');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
    
            // Déplacer l'image dans le dossier 'public/images'
            $image->move(public_path('images'), $imageName);
    
            // Mettre à jour l'image du producteur dans la base de données
            $farmer->update(['picture' => $imageName]);
        }
    
        return $this->sendResponse($farmer, 'L\'image du producteur a bien été mise à jour');
    }
    

    

    public function getFarmerByPhone(Request $request){
        
        $rules = ['phone'=>"required"]; 
        $messages = ['phone.required'=>'le numéro de téléphone est obligatoire'];

        $this->validate($request, $rules, $messages);

        return Farmer::where('phone', $request->phone)->first();
    }

    public function getFarmerByRegions(Request $request)
    {
        return Farmer::query()
        ->with('region')
        ->where('region_id', $request->user()->region_id)
        ->orderBy('created_at')
        ->get();
    }


    private function getFarmersByAgribusiness($request)
    {
       $user = Auth::user();
        return Farmer::query()
            //->with('region','departement')
            ->where('agribusiness_id', $user->agribusiness_id)
            ->orderBy('fullname')
            
            ->get()
            ->transform(function ($farmer) {
                return [
                    'id' => $farmer->id,
                    'identifier' => $farmer->identifier,
                    'fullname' => $farmer->fullname,
                    'born_date' => $farmer->born_date,
                    'born_place' => $farmer->born_place,
                    'locality' => $farmer->locality,
                    'phone' => $farmer->phone,
                    'phone_payment' => $farmer->phone_payment,
                    'sexe' => $farmer->sexe,
                    'activity' => $farmer->activity,
                    'picture' =>asset('images/'.$farmer->picture),
                    'region_id' => $farmer->region_id,
                    'departement_id' => $farmer->departement_id,
                    'agribusiness_id' => $farmer->agribusiness_id,
                    'user_id'=> $farmer->user_id,
                    'created_at' => $farmer->created_at,
                    'updated_at' => $farmer->updated_at
                ];
            });
    }
}
