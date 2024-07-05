<?php

namespace App\Http\Controllers;

use App\Http\Requests\Users\UserRoleRequest;
use App\Models\Role;
use App\Models\User;

class UserRoleController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create(User $user)
    {
        $this->authorize('ADMIN USER ASSIGN ROLE');

        $roles = Role::retrievingByUsersType()->get();

        return view('users.role', compact('user', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserRoleRequest $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(UserRoleRequest $request, User $user)
    {
        $this->authorize('ADMIN USER ASSIGN ROLE');

        $create = $user->roles()->sync($request->get('role_id'));
        if (!$create) {
            return back()->with([
                'status' => 'error', 'message' => 'Enregistrement echoué'
            ]);
        }
        return back()->with([
            'status' => 'success', 'message' => 'Enregistrement reussi'
        ]);
    }
}
