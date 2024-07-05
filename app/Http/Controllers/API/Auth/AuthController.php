<?php

namespace App\Http\Controllers\API\Auth;

use Carbon\Carbon;
use App\Models\User;
use App\Utilities\NewSmsAPI;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Controllers\API\BaseController as BaseController;

class AuthController extends BaseController
{

    protected $messageSender;

    public function __construct(NewSmsAPI $messageSender)
    {
        $this->messageSender = $messageSender;
    }

    public function index(){
        $user = User::where('id',Auth::user()->id)
                      ->with(['agribusiness' => function($query){
                        $query->select('id','denomination','sigle','matricule');
                      }])
                      ->first();
        //dd($user);
        $success['user'] = collect($user)->except(['created_at','updated_at']);
        return $this->sendResponse($success, 'Connexion effectuer avec success.');
    }

    public function login(LoginRequest $request){
        
        $credentials = ['username' => $request->username, 'password' => $request->password];
        if(Auth::attempt($credentials)){ 
           
            $user = $request->user(); 
            if($user->isMobile()==true || $user->isSupervisorAgribusiness()==true){
                $tokenResult =  $user->createToken('Karite Personal Access Client');
                $success['access_token'] = $tokenResult->accessToken; 
                $success['token_type']='Bearer';
                if($user->isMobile()){
                    $success['roles']='MOBILE';
                }else{
                    $success['roles']='SUPERVISEUR COOPERATIVE';
                }
               
                $success['expires_at']=Carbon::parse(
                    $tokenResult->token->expires_at
                )->toDateString();
                $success['user'] =  collect($user)->except(['created_at','updated_at']);
   
                return $this->sendResponse($success, 'Connexion effectuer avec success.');
            }else{
                return $this->sendError('Non autorisé.', ['error'=>'cet utilisateur n\'a pas les permissions pour se connecter au mobile'],401);
            }
            
        } 
        else{ 
            
            return $this->sendError('Unauthorised.', ['error'=>'le nom d\'utilisateur ou le mot de passe n\'est pas correcte'], 401);
        } 
    
    }


    // public function login()
    // {
       

    //     $requiredPostData = ['login_user', 'password_user'];
    //     foreach ($requiredPostData as $postData) {
    //         if (is_null(request($postData))) {
    //             return response()->json([
    //                 'status' => 'erreur',
    //                 'message' => $postData . " est obligatoire !"
    //             ]);
    //         }
    //     }
    //     $data = ['username' => request('login_user'), 'password' => request('password_user')];
    //     // Verification de la connexion
    //     $user = auth()->attempt($data);

    //     if ($user) {
    //         $data = auth()->user();
    //         $accessToken = $data->createToken('authToken')->accessToken;
    //         return response()->json([
    //             'result' => $data,
    //             'status' => 'success',
    //             'message' => 'Opération effectuée avec succès',
    //             'accessToken' => $accessToken
    //         ]);
    //     } else {
    //         return response()->json([
    //             'status' => 'erreur',
    //             'message' => 'Login ou mot de passe incorrect'
    //         ]);
    //     }
    // }



    // public function updatePassword()
    // {
    //     $requiredPostData = ['old_password', 'new_password', 'confirm_password'];
    //     foreach ($requiredPostData as $postData) {
    //         if (is_null(request($postData))) {
    //             return response()->json([
    //                 'status' => 'erreur',
    //                 'message' => $postData . " est obligatoire !"
    //             ]);
    //         }
    //     }

    //     if (request('new_password') === request('confirm_password')) {
    //         if (Hash::check(request('old_password'), auth()->user()->password)) {
    //             $update = User::where('id', auth()->user()->id)->first()->update([
    //                 'password' => bcrypt(request('new_password'))
    //             ]);
    //             if ($update) {
    //                 return response()->json([
    //                     'status' => 'success',
    //                     'message' => "Opération effectuée avec succès !"
    //                 ]);
    //             } else {
    //                 return response()->json([
    //                     'status' => 'erreur',
    //                     'message' => "Une erreur est survenu lors de l'opération !"
    //                 ]);
    //             }
    //         } else {
    //             return response()->json([
    //                 'status' => 'erreur',
    //                 'message' => "L'ancien mot de passe est incorrect !"
    //             ]);
    //         }
    //     } else {
    //         return response()->json([
    //             'status' => 'erreur',
    //             'message' => 'Mauvaise confirmation du nouveau mot de passe !'
    //         ]);
    //     }
    // }

    public function sendCodeUser(Request $request){
         
        try {
           
            $user = User::where('phone',$request->phone)->firstOrFail();
            
           
           
            $user->code = str_pad(rand(0, 99999), 5, '0', STR_PAD_LEFT);  
            $user->save();

            $message ='le code pour réinitialiser votre mot de passe est le suivant: '.$user->code;
            $this->messageSender->sendSMS([$user->phone], $message);

            $success['code']=$user->code;
            return $this->sendResponse($success,'le code a bien été enregistré');
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Aucun utilisateur avec ce numéro de téléphone n\'a été trouvé.'
            ], 404);
        }
       
    }

    public function checkCodeUser(Request $request){
        try {
            $user = User::where('code',$request->code)->firstOrFail();
            $user->code = NULL;
            $user->save();
            $success['user'] = $user;
             return $this->sendResponse($success,'le code est le bon');
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'le code que vous avez fourni n\'est pas le bon'
            ], 404);
        }
    }

    public function resetPassword(Request $request) {
        //dd($request->all());
       try {
         $user = User::find($request->userId);

         if($request->password == $request->passwordConfirm){

            $user->password = bcrypt($request->password);
            $user->save();
            $success='';
            return $this->sendResponse($success,'le mot de passe a bien été modifié');
         }else{
            return $this->sendError('le mot de passe n\'est pas conforme');
         }

        
       } catch (\Throwable $th) {
            return $this->sendError('l\'utilisateur n\existe pas');
       }
    }


    public function logout(Request $request)
    {
        //dd($request->user());
        $token = $request->user()->token();
        
        $token = $token->revoke();
        // Envoyer une réponse de succès
        $success ='';
        return $this->sendResponse($success, 'Vous êtes déconnecter avec success');
    }
}
