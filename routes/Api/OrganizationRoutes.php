<?php

use App\Http\Controllers\Api\CaseWorker\Organization\FetchOrganizationsController;
use App\Http\Controllers\Api\CaseWorker\Organization\GetOrganizationController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth:case-worker']], function () {
    Route::get('/get/organization/{organizationId}', GetOrganizationController::class);

    Route::get('/fetch/organizations', FetchOrganizationsController::class);
});
