<?php

use App\Http\Controllers\Api\CaseWorker\Authentication\LoginController;
use App\Http\Controllers\Api\CaseWorker\Authentication\LogoutController;
use Illuminate\Support\Facades\Route;

Route::group([], function () {
    Route::post('/login', LoginController::class);

    Route::post('/logout', LogoutController::class)->middleware('auth:case-worker');
});
