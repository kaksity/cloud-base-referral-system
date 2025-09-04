<?php

use App\Http\Controllers\Web\SystemAdmin\Authentication\DisplayLoginViewController;
use App\Http\Controllers\Web\SystemAdmin\Authentication\ProcessLoginController;
use App\Http\Controllers\Web\SystemAdmin\Authentication\ProcessLogoutController;
use Illuminate\Support\Facades\Route;

Route::group([], function () {
    Route::get('/process/logout', ProcessLogoutController::class)->name('web.system-admin.organization.process-logout');
    Route::post('/process/login', ProcessLoginController::class)->name('web.system-admin.organization.process-login');
    Route::get('login', DisplayLoginViewController::class)->name('web.system-admin.organization.display-login-view');
});
