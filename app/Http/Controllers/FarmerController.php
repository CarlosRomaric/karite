<?php
/**
 * Created by PhpStorm.
 * User: salioudiabate
 * Date: 16/11/2019
 * Time: 22:33
 */

namespace App\Http\Controllers;

use App\Http\Requests\Farmers\FarmerCreateRequest;
use App\Http\Requests\Farmers\FarmerUpdateRequest;
use App\Models\Agribusiness;
use App\Models\Farmer;
use App\Utilities\HttpStatus;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FarmerController extends Controller
{
    const ISNEWLINE = "NEW_LINE";

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function index(Request $request)
    {
        $this->authorize('ADMIN PRODUCTEUR LIST');
        $this->authorize('ADMIN PRODUCTEUR ADD');

        $agribusinesses = Agribusiness::retrievingByUsersType()->get();

        $users = Farmer::with('agribusiness')
            ->retrievingByUsersType()
            ->orderBy('fullname')
            ->filter($request->only('search'))
            ->paginate();

        return  view('farmers.index', compact('users','agribusinesses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     * @throws AuthorizationException
     */
    public function create()
    {
        $this->authorize('ADMIN PRODUCTEUR ADD');

        $agribusinesses = Agribusiness::retrievingByUsersType()->get();

        return view('farmers.create', compact('agribusinesses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param FarmerCreateRequest $request
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function store(FarmerCreateRequest $request)
    {
        $this->authorize('ADMIN PRODUCTEUR ADD');

        $farmer = Farmer::create(
            array_merge(
                $request->except('born_date', 'gps_code', 'total_area', 'latitude', 'longitude', 'gps_track'), [
                    'gps_code' => $request->get('_gps_code'),
                    'born_date' => custom_date_format('Y-m-d', 'd/m/Y', $request->get('born_date')),
                    'picture' => $request->file('picture') ? $request->file('picture')->store('farmers') : null
                ]
            )
        );

        $superficies = $request->get('total_area');
        foreach ($superficies as $key => $superficie) {

            $gpsTrack = null;
            if ($request->file('gps_track') && $request->file('gps_track')[$key]) {
                $path = Agribusiness::find($request->get('agribusiness_id'))->acronym."/".$farmer->id;
                $filename = $request->file('gps_track')[$key]->getClientOriginalName();
                $gpsTrack = $request->file('gps_track')[$key]->storeAs($path, $filename);
            }

            $farmer->plots()->create([
                'gps_code' => $request->get('gps_code')[$key],
                'total_area' => $request->get('total_area')[$key],
                'gps_track' => $gpsTrack,
                'latitude' => $request->get('latitude')[$key],
                'longitude' => $request->get('longitude')[$key],
            ]);
        }

        if (!$farmer) {
            return back()->with([
                'status' => 'error', 'message' => 'Enregistrement echoué'
            ]);
        }

        return back()->with([
            'status' => 'success', 'message' => 'Enregistrement reussi'
        ]);
    }

    /**
     * Show the specified resource.
     *
     * @param Farmer $farmer
     * @return Application|Factory|View
     * @throws AuthorizationException
     */
    public function show(Farmer $farmer)
    {
        $this->authorize('ADMIN PRODUCTEUR SHOW');

        return view('farmers.show', compact('farmer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Farmer $farmer
     * @return Application|Factory|View
     * @throws AuthorizationException
     */
    public function edit(Farmer $farmer)
    {
        $this->authorize('ADMIN PRODUCTEUR UPDATE');

        $agribusinesses = Agribusiness::retrievingByUsersType()->get();

        return view('farmers.edit', compact('farmer', 'agribusinesses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param FarmerUpdateRequest $request
     * @param Farmer $farmer
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function update(FarmerUpdateRequest $request, Farmer $farmer)
    {
        $this->authorize('ADMIN PRODUCTEUR UPDATE');

        $update = $farmer->update(
            array_merge(
                $request->except('born_date', 'gps_code', 'total_area', 'latitude', 'longitude', 'plotId', 'gps_track', 'number_of_plots'), [
                    'number_of_plots' => count($request->get('gps_code')),
                    'gps_code' => $request->get('_gps_code'),
                    'born_date' => custom_date_format('Y-m-d', 'd/m/Y', $request->get('born_date')),
                    'picture' => $request->file('picture') ? $request->file('picture')->store('farmers') : $farmer->picture
                ]
            )
        );

        $superficies = $request->get('total_area');
        foreach ($superficies as $key => $superficie) {

            $gpsTrack = null;
            if ($request->file('gps_track') && $request->file('gps_track')[$key]) {
                $path = "Tracks/".Agribusiness::find($request->get('agribusiness_id'))->acronym;
                $filename = $request->file('gps_track')[$key]->getClientOriginalName();
                $gpsTrack = $request->file('gps_track')[$key]->storeAs($path, $filename);
            }

            $data = [
                'gps_code' => $request->get('gps_code')[$key],
                'total_area' => $request->get('total_area')[$key],
                'latitude' => $request->get('latitude')[$key],
                'longitude' => $request->get('longitude')[$key],
            ];

            $data = array_merge($data,
                ($request->get('plotId')[$key] !== self::ISNEWLINE && is_null($gpsTrack)) ? [] : ['gps_track' => $gpsTrack]);
            $farmer->plots()->updateOrCreate(['id' => $request->get('plotId')[$key]], $data);
        }

        if (!$update) {
            return back()->with([
                'status' => 'error', 'message' => 'La modification a échouée'
            ]);
        }
        return back()->with([
            'status' => 'success', 'message' => 'La modification a reussie'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Farmer $farmer
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(Farmer $farmer)
    {
        $this->authorize('ADMIN PRODUCTEUR DELETE');

        $farmer->plots()->delete();
        $destroy = $farmer->delete();
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
