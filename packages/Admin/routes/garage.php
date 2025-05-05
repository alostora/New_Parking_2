<?php

use Admin\Http\Controllers\GarageController;
use Illuminate\Support\Facades\Route;


Route::group([
    'middleware' => ['auth:sanctum', 'is_verified']
], function () {

    Route::get('garages', [GarageController::class, 'index']);

    Route::get('garages/search', [GarageController::class, 'search']);

    Route::get('garage/create', [GarageController::class, 'create']);

    Route::post('garage', [GarageController::class, 'store']);

    Route::get('garage/{garage}', [GarageController::class, 'show']);

    Route::get('garage/edit/{garage}', [GarageController::class, 'edit']);

    Route::patch('garage/{garage}', [GarageController::class, 'update']);

    Route::delete('garage/{garage}', [GarageController::class, 'destroy']);

    Route::any('garage-active/{garage}', [GarageController::class, 'active']);

    Route::any('garage-inactive/{garage}', [GarageController::class, 'inactive']);
});
