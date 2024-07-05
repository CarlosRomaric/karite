<?php

namespace App\Http\Controllers;

use App\Http\Requests\Roles\RoleCreateRequest;
use App\Http\Requests\Roles\RolePermissionAssignmentRequest;
use App\Http\Requests\Roles\RoleUpdateRequest;
use App\Models\Permission;
use App\Models\Role;
use App\Utilities\HttpStatus;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(Request $request)
    {
        $this->authorize('ADMIN ROLE LIST');

        $roles = Role::retrievingByUsersType()
            ->orderBy('name')
            ->filter($request->only('search'))
            ->paginate();

        return view('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        $this->authorize('ADMIN ROLE ADD');

        return view('roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param RoleCreateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(RoleCreateRequest $request)
    {
        $this->authorize('ADMIN ROLE ADD');

        $data = array_merge(
            $request->only('name'),
            ['agribusiness_id' => auth()->user()->isTraceAgriAdmin() || auth()->user()->isPlateformAdmin() ? null : auth()->user()->agribusiness->id]
        );
        $create = Role::create($data);
        if (!$create) {
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
     * @param  \App\Models\Role $role
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Role $role)
    {
        $this->authorize('ADMIN ROLE UPDATE');

        return view('roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param RoleUpdateRequest $request
     * @param  \App\Models\Role $role
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(RoleUpdateRequest $request, Role $role)
    {
        $this->authorize('ADMIN ROLE UPDATE');

        $data = array_merge(
            $request->only('name'),
            ['agribusiness_id' => auth()->user()->isTraceAgriAdmin() || auth()->user()->isPlateformAdmin() ? null : auth()->user()->agribusiness->id]
        );
        $update = $role->update($data);
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
     * @param  \App\Models\Role $role
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Role $role)
    {
        $this->authorize('ADMIN ROLE DELETE');

        $destroy = $role->delete();
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

    /**
     * @param Role $role
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function showAssignPermissionForm(Role $role)
    {
        $this->authorize('ADMIN ROLE ASSIGN PERMISSION');

        $permissions = Permission::retrievingByUsersType()
            ->orderBy('name')
            ->get();
        $perPage = intdiv(count($permissions), 4);

        return view('roles.permission', compact('role', 'permissions', 'perPage'));
    }

    /**
     * @param RolePermissionAssignmentRequest $request
     * @param Role $role
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function assignPermission(RolePermissionAssignmentRequest $request, Role $role)
    {
        $this->authorize('ADMIN ROLE ASSIGN PERMISSION');

        $assign = $role->permissions()->sync($request->get('permission_id'));

        if (!$assign) {
            return back()->with([
                'status' => 'error', 'message' => 'L\'assignation des permissions a echouée'
            ]);
        }
        return back()->with([
            'status' => 'success', 'message' => 'L\'assignation des permissions a reussie'
        ]);
    }
}
