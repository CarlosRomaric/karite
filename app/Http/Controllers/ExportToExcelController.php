<?php


namespace App\Http\Controllers;


use App\Exports\FarmerDataExport;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ExportToExcelController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return Response|BinaryFileResponse
     * @throws AuthorizationException
     */
    public function create()
    {
        $this->authorize('ADMIN EXPORT EXCEL');

        return (new FarmerDataExport)->download("Liste-des-producteurs-".date("d-m-Y H:i:s").".xlsx");
    }

}
