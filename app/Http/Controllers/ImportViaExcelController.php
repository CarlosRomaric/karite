<?php

namespace App\Http\Controllers;

use App\Http\Requests\Import\FileImportRequest;
use App\Models\Agribusiness;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Artisan;
use Illuminate\View\View;

class ImportViaExcelController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     * @throws AuthorizationException
     */
    public function create()
    {
        $this->authorize('ADMIN IMPORT EXCEL ADD');
        $agribusinesses = Agribusiness::orderBy('name')->get();

        return view('import.create', compact('agribusinesses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param FileImportRequest $request
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function store(FileImportRequest $request)
    {
        $this->authorize('ADMIN IMPORT EXCEL ADD');

        Artisan::queue('import:farmers', [
           '--filePath' => $request->file('data')->store('farmer-import-temp')
        ]);

        return back()->with([
            'status' => 'success', 'message' => 'Le fichier est en cours d\'importation.'
        ]);
    }

}
