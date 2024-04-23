<?php

use App\Http\Controllers\CargoController;
use App\Http\Controllers\CargoTypeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(
    [
        'prefix' => '/cargos',
        'namespace' => 'Cargos',
        'middleware' => ['api']
    ],
    static function () {
        Route::get('/', [CargoController::class, 'getAll'])
            ->name('cargo.get-all');
        Route::get('/price', [CargoController::class, 'getCargoPrice'])
            ->name('cargo.get-price');
        Route::get('/types', [CargoTypeController::class, 'getAll'])
            ->name('cargo-types.get-all');
        Route::post('/types/new', [CargoTypeController::class, 'store'])
            ->name('cargo-types.store');
        Route::post('/new', [CargoController::class, 'store'])
            ->name('cargo.store');
    }
);
