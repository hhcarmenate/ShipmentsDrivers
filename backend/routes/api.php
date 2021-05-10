<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Shipments\ShipmentsByDatesApiController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 * Shipments routes
 */
Route::middleware('auth:sanctum')->prefix('shipments')->group(function(){
    Route::post('/',[ShipmentsByDatesApiController::class, 'index'])->name('api.shipments.index');
    Route::post('/checkFile',[ShipmentsByDatesApiController::class, 'checkFile'])->name('api.shipments.check_file');
});
