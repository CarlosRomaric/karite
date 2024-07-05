<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Password\ResetPasswordRequest;
use App\Models\PasswordReset;
use App\Models\User;
use App\Notifications\Password\PasswordResetNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    public function passwordReset(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);

        $passwordReset = PasswordReset::where("token", request('token'))->first();
        if ($passwordReset != null) {
            if (Carbon::now()->diffInHours(Carbon::parse($passwordReset->created_at)) > 24) {
                return view('auth.password.link-expired');
            }
            $messages = [];
        } else {
            $messages = [
                'message' => 'Le lien a expiré, veuillez effectuer une nouvelle demande
                à partir de votre application.',
                'type' => 'alert-danger'
            ];
        }
        return view('auth.password.password-reset', compact('passwordReset', 'messages'));
    }

    public function changePassword(ResetPasswordRequest $request)
    {
        $passwordReset = PasswordReset::where("token", request('token'))->firstOrFail();
        if (Carbon::now()->diffInHours(Carbon::parse($passwordReset->created_at)) > 24) {
            return back()->with([
                'message' => 'Le lien a expiré, veuillez effectuer une nouvelle demande
                à partir de votre application mobile.',
                'type' => 'alert-danger'
                ]);
        }

        $user = User::where('email', $passwordReset->email)->firstOrFail();
        $user->update(['password' => bcrypt(request('password'))]);

        PasswordReset::where('email', $user->email)->delete();

        $user->notify(new PasswordResetNotification($user));

        return back()->with([
            'message' => 'Votre mot de passe a été réinitialisé avec succès.',
            'type' => 'alert-primary',
            'changed' => 'true'
            ]);
    }
}