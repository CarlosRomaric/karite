<?php

namespace App\Http\Controllers;

use App\Http\Requests\Agribusinesses\AgribusinessCreateRequest;
use App\Http\Requests\Agribusinesses\AgribusinessUpdateRequest;
use App\Models\Agribusiness;
use App\Utilities\HttpStatus;
use Illuminate\Http\Request;

class AgribusinessController extends Controller
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
        $this->authorize('ADMIN COOPERATIVE LIST');

        $agribusinesses = Agribusiness::orderBy('name')
            ->filter($request->only('search'))
            ->paginate();

        return view('agribusinesses.index', compact('agribusinesses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        $this->authorize('ADMIN COOPERATIVE ADD');

        return view('agribusinesses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AgribusinessCreateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(AgribusinessCreateRequest $request)
    {
        $this->authorize('ADMIN COOPERATIVE ADD');

        $create = Agribusiness::create($request->all());
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
     * @param  \App\Models\Agribusiness $agribusiness
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Agribusiness $agribusiness)
    {
        $this->authorize('ADMIN COOPERATIVE UPDATE');

        return view('agribusinesses.edit', compact('agribusiness'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param AgribusinessUpdateRequest $request
     * @param  \App\Models\Agribusiness $agribusiness
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(AgribusinessUpdateRequest $request, Agribusiness $agribusiness)
    {
        $this->authorize('ADMIN COOPERATIVE UPDATE');

        $update = $agribusiness->update($request->all());
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
     * @param  \App\Models\Agribusiness $agribusiness
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Agribusiness $agribusiness)
    {
        $this->authorize('ADMIN COOPERATIVE DELETE');

        $destroy = $agribusiness->delete();
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
