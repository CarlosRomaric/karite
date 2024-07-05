<?php
/**
 * Created by PhpStorm.
 * User: salioudiabate
 * Date: 27/03/2020
 * Time: 08:02
 */

namespace App\Http\Controllers;

use App\Http\Requests\Users\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{

    public function edit(User $user)
    {
        return view('auth.profile', compact('user'));
    }

    public function update(ProfileUpdateRequest $request, User $user)
    {
        $data = $request->except('password', 'agribusiness_id');
        if (!is_null($request->get('current_password')) &&
            !is_null($request->get('password')) && !is_null($request->get('password_confirmation'))) {

            if (Hash::check($request->get('current_password'), $user->password)) {

                if ($request->get('password') != $request->get('password_confirmation')) {
                    return back()->withInput($request->all())->with([
                        'status' => 'error', 'message' => 'Les deux mot de passe ne correspondent pas'
                    ]);
                }

                $data = array_merge(
                    $request->except('password', 'agribusiness_id'),
                    ['password' => bcrypt($request->get('password'))]
                );

            } else {
                return back()->withInput($request->all())->with([
                    'status' => 'error', 'message' => 'Votre ancien mot de passe n\'est pas correct.'
                ]);
            }
        }

        $update = $user->update($data);
        if (!$update) {
            return back()->with([
                'status' => 'error', 'message' => 'Echec de modification'
            ]);
        }
        return back()->with([
            'status' => 'success', 'message' => 'Modification reussie'
        ]);
    }

}
