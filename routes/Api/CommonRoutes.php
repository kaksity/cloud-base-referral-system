<?php

use App\Http\Controllers\Api\CaseWorker\Common\FetchCountriesController;
use App\Http\Controllers\Api\CaseWorker\Common\FetchLocalGovernmentAreasController;
use App\Http\Controllers\Api\CaseWorker\Common\FetchSectorsController;
use App\Http\Controllers\Api\CaseWorker\Common\FetchStatesController;
use App\Http\Controllers\Api\CaseWorker\Common\FetchWardsController;
use App\Http\Controllers\Api\CaseWorker\Common\UploadPhotoController;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => ['auth:case-worker']], function () {
    Route::post('/upload/photo', UploadPhotoController::class);
    Route::get('/fetch/countries', FetchCountriesController::class);
    Route::get('/fetch/states', FetchStatesController::class);
    Route::get('/fetch/local-government-areas', FetchLocalGovernmentAreasController::class);
    Route::get('/fetch/wards', FetchWardsController::class);
    Route::get('/fetch/sectors', FetchSectorsController::class);
});
