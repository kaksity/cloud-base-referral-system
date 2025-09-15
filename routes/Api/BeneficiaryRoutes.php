<?php

use App\Http\Controllers\Api\CaseWorker\Beneficiary\CreateBeneficiaryController;
use App\Http\Controllers\Api\CaseWorker\Beneficiary\FetchBeneficiariesController;
use App\Http\Controllers\Api\CaseWorker\Beneficiary\FetchRecentBeneficiariesController;
use App\Http\Controllers\Api\CaseWorker\Beneficiary\GetBeneficiaryController;
use App\Http\Controllers\Api\CaseWorker\Beneficiary\ReferBeneficiaryController;
use App\Http\Controllers\Api\CaseWorker\Beneficiary\UpdateBeneficiaryController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth:case-worker']], function () {
    Route::put('/update/beneficiary/{beneficiaryId}', UpdateBeneficiaryController::class);

    Route::get('/fetch/recent/beneficiaries', FetchRecentBeneficiariesController::class);

    Route::get('/get/beneficiary/{beneficiaryId}', GetBeneficiaryController::class);

    Route::get('/fetch/beneficiaries', FetchBeneficiariesController::class);

    Route::post('/create/beneficiary', CreateBeneficiaryController::class);

    Route::post('/refer/beneficiary', ReferBeneficiaryController::class);
});
