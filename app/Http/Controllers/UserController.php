<?php

namespace App\Http\Controllers;

use App\Http\Requests\Users\UserCreateRequest;
use App\Http\Requests\Users\UserUpdateRequest;
use App\Models\Agribusiness;
use App\Models\Role;
use App\Models\User;
use App\Utilities\HttpStatus;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(Request $request)
    {
        $this->authorize('ADMIN USER LIST');

        $users = User::with('agribusiness', 'roles')
            ->retrievingByUsersType()
            ->orderBy('fullname')
            ->filter($request->only('search'))
            ->paginate();

        return view('users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        $this->authorize('ADMIN USER ADD');

        $roles = Role::retrievingByUsersType()->get();
        $agribusinesses = Agribusiness::retrievingByUsersType()->get();

        return view('users.create', compact('agribusinesses', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserCreateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(UserCreateRequest $request)
    {
        $this->authorize('ADMIN USER ADD');

        $user = User::create(
            array_merge($request->except('password'), ['password' => bcrypt($request->get('password'))])
        );

        $user->roles()->sync($request->get('role_id'));

        if (!$user) {
            return back()->with([
                'status' => 'error', 'message' => 'Enregistrement echoué'
            ]);
        }
        return back()->with([
            'status' => 'success', 'message' => 'Enregistrement reussi'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(User $user)
    {
        $this->authorize('ADMIN USER UPDATE');
        $agribusinesses = Agribusiness::retrievingByUsersType()->get();

        return view('users.edit', compact('user', 'agribusinesses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserUpdateRequest $request
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        $this->authorize('ADMIN USER UPDATE');

        $data = $request->except('password');
        if (!is_null($request->get('password')) && !is_null($request->get('password_confirmation'))) {
            if ($request->get('password') != $request->get('password_confirmation')) {
                return back()->withInput($request->all())->with([
                    'status' => 'error', 'message' => 'Les deux mot de passe ne correspondent pas'
                ]);
            } else {
                $data = array_merge($request->except('password'), [
                    'password' => bcrypt($request->get('password'))
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(User $user)
    {
        $this->authorize('ADMIN USER DELETE');

        $destroy = $user->delete();
        if (!$destroy) {
            return response()->json([
                'success' => false, 'message' => 'Suppression a échouée'
            ],
                HttpStatus::HTTP_BAD_REQUEST
            );
        }

        sessionFlash([
            'status' => 'success', 'message' => 'Suppression reussie'
        ]);

        return response()->json([
            'success' => true, 'message' => 'Suppression reussie'
        ],
            HttpStatus::HTTP_OK
        );
    }
}
