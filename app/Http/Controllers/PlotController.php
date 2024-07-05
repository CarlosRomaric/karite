<?php

namespace App\Http\Controllers;

use App\Utilities\HttpStatus;
use Illuminate\Support\Facades\DB;

class PlotController extends Controller
{

    /**
     * Remove the specified resource from storage.
     *
     * @param $plot
     * @return \Illuminate\Http\Response
     */
    public function destroy($plot)
    {
        $destroy = DB::table('plots')
            ->where('id', $plot)
            ->delete();

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
