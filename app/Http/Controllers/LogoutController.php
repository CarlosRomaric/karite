<?php
/**
 * Created by PhpStorm.
 * User: salioudiabate
 * Date: 26/03/2020
 * Time: 22:33
 */

namespace App\Http\Controllers;


class LogoutController extends Controller
{

    public function __invoke()
    {
        return $this->logout();
    }

    public function logout()
    {
        auth()->logout();

        return redirect()->route('auth.showLoginForm')->with([
            'status' => 'success', 'message' => 'Vous avez été déconnecté avec succès.'
        ]);
    }

}
