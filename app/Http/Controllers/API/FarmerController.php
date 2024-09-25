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
       
        $validator = Validator::make($request->all(), 
        [
            'data'=>'required|array'
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
            $entryValidator = Validator::make($entry, $this->rules(),$this->messages());
           
            if ($entryValidator->fails()) {

                $errors[] = [
                    'entry' => $entry,
                    'errors' => $entryValidator->errors(),
                ];
                $errorCount++;
                
            }else{
                $user = Auth::user();
                //dd($user->agribusiness);
                $validatedEntry = $entryValidator->validated();
                $validatedEntry['user_id'] = $user->id;
                $validatedEntry['region_id'] = $user->agribusiness->region->id;
                $validatedEntry['departement_id'] = $user->agribusiness->departement->id;
                $validatedEntry['agribusiness_id'] = $user->agribusiness->id;
                
                if (isset($entry['picture'])) {
                    $image = $entry['picture'];
                    if (preg_match('/^data:image\/(?<type>.+);base64,(?<data>.+)$/', $image, $matches)) {
                        $imageType = $matches['type'];
                        $imageData = base64_decode($matches['data']);
                        
                        // Déterminer l'extension du fichier
                        $extension = $imageType === 'jpeg' ? 'jpg' : $imageType;
                
                        // Définir un nom unique pour l'image
                        $imageName = time() . '_' . uniqid() . '.' . $extension;
                        // Chemin où l'image sera stockée
                        $path = public_path('images/' . $imageName);
                        // Enregistrer l'image
                        file_put_contents($path, $imageData);
                
                        // Optionnel : Vous pouvez enregistrer le nom du fichier dans la base de données
                        $validatedEntry['picture'] = $imageName;
                    }
                }

                $farmer = Farmer::create($validatedEntry);
                $successCount++;
                
            }
            
        }

        $response = [
            'success' => 'Les producteur ont bien été enregistrées',
            'success_count' => $successCount,
            'error_count' => $errorCount,
        ];

        if (!empty($errors)) {
            $response['errors'] = $errors;
        }

        return response()->json($response, 200);

    }

    public function update(Request $request,  Farmer $farmer){
       

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
