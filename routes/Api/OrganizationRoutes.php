<?php

use App\Http\Controllers\Api\CaseWorker\Organization\FetchOrganizationsController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth:case-worker']], function () {
    Route::get('/fetch/organizations', FetchOrganizationsController::class);
});
