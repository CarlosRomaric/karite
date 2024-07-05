<?php

namespace App\Http\Controllers;

use App\Http\Requests\Permissions\PermissionCreateRequest;
use App\Http\Requests\Permissions\PermissionUpdateRequest;
use App\Models\Permission;
use App\Utilities\HttpStatus;
use Illuminate\Http\Request;

class PermissionController extends Controller
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
        $this->authorize('ADMIN PERMISSION LIST');

        $permissions = Permission::orderBy('name')
            ->filter($request->only('search'))
            ->paginate();

        return view('permissions.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        $this->authorize('ADMIN PERMISSION ADD');

        return view('permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PermissionCreateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(PermissionCreateRequest $request)
    {
        $this->authorize('ADMIN PERMISSION ADD');

        $create = Permission::create($request->all());
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
     * @param  \App\Models\Permission $permission
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Permission $permission)
    {
        $this->authorize('ADMIN PERMISSION UPDATE');

        return view('permissions.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PermissionUpdateRequest $request
     * @param  \App\Models\Permission $permission
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(PermissionUpdateRequest $request, Permission $permission)
    {
        $this->authorize('ADMIN PERMISSION UPDATE');

        $update = $permission->update($request->all());
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
     * @param  \App\Models\Permission $permission
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Permission $permission)
    {
        $this->authorize('ADMIN PERMISSION DELETE');

        $destroy = $permission->delete();
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
