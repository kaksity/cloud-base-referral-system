<?php

use Illuminate\Support\Facades\Route;

Route::prefix('authentication')->group(__DIR__.'/AuthenticationRoutes.php');
Route::prefix('dashboard')->group(__DIR__.'/DashboardRoutes.php');
Route::prefix('organization')->group(__DIR__.'/OrganizationRoutes.php');
Route::prefix('organization-admin')->group(__DIR__.'/OrganizationAdminRoutes.php');

Route::prefix('settings')->group(__DIR__.'/SettingsRoutes.php');