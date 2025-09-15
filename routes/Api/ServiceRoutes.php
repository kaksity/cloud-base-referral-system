<?php

use App\Http\Controllers\Api\CaseWorker\Service\FetchServicesController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth:case-worker']], function () {
    Route::get('/fetch/services', FetchServicesController::class);
});
