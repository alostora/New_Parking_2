<?php

use App\Http\Controllers\AuthViews\AuthController;
use App\Http\Controllers\GuestController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

Route::group([
    'middleware' => 'lang'
], function () {

    Route::get('lang/{lang}', function ($lang) {
        Session::put('locale', $lang);
        return back();
    });

    Route::group([
        'prefix' => 'admin',
    ], function () {

        Route::get('login', [AuthController::class, 'loginView'])->name('login');
        Route::post('login', [AuthController::class, 'login']);

        Route::group([
            'middleware' => [
                'auth:sanctum',
                'is_verified'
            ]
        ], function () {

            Route::any('logout', [AuthController::class, 'logout']);
        });
    });

    Route::get('guest/final-client/registration/{user}', [GuestController::class, 'guestForm']);
    Route::post('guest/final-client/registration', [GuestController::class, 'store']);
    Route::get('guest/final-client/qr-generator/{finalClient}', [GuestController::class, 'QrGenerator']);
});
