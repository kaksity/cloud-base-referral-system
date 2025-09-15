<?php

use Illuminate\Support\Facades\Route;

Route::prefix('beneficiary')->group(__DIR__ . '/BeneficiaryRoutes.php');
Route::prefix('organization')->group(__DIR__ . '/OrganizationRoutes.php');
Route::prefix('service')->group(__DIR__ . '/ServiceRoutes.php');
Route::prefix('common')->group(__DIR__ . '/CommonRoutes.php');
