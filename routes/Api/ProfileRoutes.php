<?php

use App\Http\Controllers\Api\CaseWorker\Profile\ChangePasswordController;
use App\Http\Controllers\Api\CaseWorker\Profile\GetProfileController;
use App\Http\Controllers\Api\CaseWorker\Profile\UpdateFullNameController;
use App\Http\Controllers\Api\CaseWorker\Profile\UpdateMobileNumberController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth:case-worker']], function () {
    Route::post('/change-password', ChangePasswordController::class);
    Route::get('/get/profile', GetProfileController::class);
    Route::put('/update/full-name', UpdateFullNameController::class);
    Route::put('/update/mobile-number', UpdateMobileNumberController::class);
});
