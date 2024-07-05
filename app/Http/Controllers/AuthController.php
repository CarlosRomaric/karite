<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\PasswordReset;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Password\ForgotPasswordRequest;
use App\Notifications\Password\PasswordResetNotification;
use App\Notifications\Password\PasswordForgotNotification;

class AuthController extends Controller
{
    public function showLoginForm(){
        return view('auth.login');
    }


    public function login(LoginRequest $request){

        // $credentials = [
        //     'username' => $request->get('username'),
        //     'password' => $request->get('password'),
        // ];

        $credentials = $request->validated();
       

        if (Auth::attempt($credentials, $request->has('remember_me')))
        {
            
            if (auth()->user()->isMobile()) {
                auth()->logout();

                return back()->withInput($request->input())->with([
                    'status' => 'error', 'message' => 'Echec de connexion, vous n\'êtes pas autoriser à vous connecter à cet espace.'
                ]);
            }
          
            return redirect()->route('dashboard');
        }

        return back()->withInput($request->input())->with([
            'status' => 'error', 'message' => 'Echec de connexion, veuillez vérifier vos informations.'
        ]);
    }

    public function showForgetForm()
    {
        return view('auth.forget');
    }

    public function forget(ForgotPasswordRequest $request)
    {
        $user = User::where('email', '=', request('email'))->first();

        if ($user == null) {
            return back()->withInput($request->input())->with([
                'status' => 'error',
                'message' => 'Compte introuvable, veuillez vérifier votre adresse mail ou inscrivez-vous.'
            ]);
            return redirect()->route('backend.auth.forget');
        }

        $passwordReset = PasswordReset::updateOrCreate($request->only('email'), [
            'token' => Str::random(60),
            'created_at' => Carbon::now()
        ]);

        $user->notify(new PasswordForgotNotification($user, $passwordReset));
    
    	return redirect('/')->with([
            'status' => 'success',
            'message' => "Un email a été envoyé à {$request->get('email')}, veuillez suivre les instructions
            pour la réinitialisation de votre mot de passe."
        ]);  
    }

    public function restore()
    {	
    	$uppercase = preg_match('@[A-Z]@', request('password'));
        $lowercase = preg_match('@[a-z]@', request('password'));
        $number    = preg_match('@[0-9]@', request('password'));

        if(!$uppercase || !$lowercase || !$number || strlen( request('password')) < 8) {
        	return redirect()->back()->with([
                'status' => 'error',
                'message' => 'Le mot de passe doit comporter au moins 8 caractères et doit inclure au moins une lettre majuscule et un chiffre.'
                ]);
        	exit();
        }
                                
    	if(request('password')!=request('password_confirmation')){
        
            return back()->with([
                'status' => 'error',
                'message' => 'Les mot de passe sont differents.'
                ]);
        }
    
        $passwordReset = PasswordReset::where("token", request('token'))->firstOrFail();
        if (Carbon::now()->diffInHours(Carbon::parse($passwordReset->created_at)) > 24) {
            return back()->with([
                'status' => 'error',
                'message' => 'Compte introuvable, veuillez vérifier votre adresse mail ou inscrivez-vous.'
                ]);
        }
    

        $user = User::where('email', $passwordReset->email)->firstOrFail();
        $user->update(['password' => bcrypt(request('password'))]);

        PasswordReset::where('email', $user->email)->delete();

        $user->notify(new PasswordResetNotification($user));

    	return redirect('/')->with([
            'message' => 'Votre mot de passe a été réinitialisé avec succès.',
            'status' => 'success'
            ]);  
    }

}
