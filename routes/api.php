<?php

use App\Models\Agribusiness;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\OfferController;
use App\Http\Controllers\API\FarmerController;
use App\Http\Controllers\API\RegionController;
use App\Http\Controllers\API\Auth\AuthController;
use App\Http\Controllers\API\Auth\LoginController;
use App\Http\Controllers\API\Auth\LogoutController;
use App\Http\Controllers\API\AgribusinessController;
use App\Http\Controllers\API\PurchaseController;
use App\Http\Controllers\API\SynchronizationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::prefix('authenticate')->group(function () {
    Route::post('login', [AuthController::class, 'login']);
});

Route::prefix('user')->group(function () {

    Route::middleware('auth:api')->group(function () {
        Route::post('update-password', [AuthController::class, 'updatePassword']);
    });
});


/**
 * API Namespace
 */
Route::namespace('API')->name('api.')->group(function () {
    /**
     * Auth routes
     */
    Route::prefix('auth')->namespace('Auth')->name('auth.')->group(function () {
        // Login
        Route::post('login', [LoginController::class])
            ->name('login');

        Route::post('login', [LoginController::class])
            ->name('login');

        Route::post('connexion', [AuthController::class, 'login'])
              ->name('connexion');

        Route::get('index', [AuthController::class, 'index'])
              ->name('index')
              ->middleware('auth:api');

        // Logout
        Route::post('logout', [AuthController::class, 'logout'])
            ->name('logout')
            ->middleware('auth:api');
        
        Route::post('sendCodeUser',[AuthController::class, 'sendCodeUser'])
            ->name('sendCodeUser');

        Route::post('checkCodeUser',[AuthController::class, 'checkCodeUser'])
            ->name('checkCodeUser');

        Route::post('resetPassword',[AuthController::class, 'resetPassword'])
            ->name('resetPassword');


    });
    /*
    * Agribusiness routes
    */
   Route::prefix('agribusinesses')->name('agribusinesses.')->group(function () {
       Route::get('/', [AgribusinessController::class, 'index'])->name('index');
   });

    /**
     * Regions routes
     */
    Route::prefix('regions')->name('regions.')->group(function () {
        Route::get('/', [RegionController::class, 'index'])->name('index');
    });

    /**
     * Farmer routes
     */
    Route::prefix('farmers')->name('farmers.')->group(function () {
        Route::get('/', [FarmerController::class, 'index'])->name('index');
        Route::post('/store', [FarmerController::class, 'store'])->name('store');
    });

    /**
     * Offers routes
     */
    Route::prefix('offers')->name('offers.')->group(function () {
        Route::get('/', [OfferController::class, 'index'])->name('index');
        Route::post('/store', [OfferController::class, 'store'])->name('store');
    });

     /**
     * Achat routes
     */
    Route::prefix('purchases')->name('purchases.')->group(function () {
        Route::get('/', [PurchaseController::class, 'index'])->name('index');
        Route::post('/store', [PurchaseController::class, 'store'])->name('store');
    });

    /**
     * Synchronization routes
     */
    Route::prefix('synchronizations')->name('synchronizations.')->group(function () {
        Route::post('/store', [SynchronizationController::class, 'store'])->name('store');
    });
});
