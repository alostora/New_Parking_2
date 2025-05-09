<?php

use Client\Http\Controllers\FinalClientController;
use Illuminate\Support\Facades\Route;


Route::group([
    'middleware' => ['auth:sanctum', 'is_verified']
], function () {

    Route::get('final-clients/search', [FinalClientController::class, 'index']);
});
