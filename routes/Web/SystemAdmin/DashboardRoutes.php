<?php

use App\Http\Controllers\Web\SystemAdmin\Dashboard\DisplayDashboardViewController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth:system-admin']], function () {
    Route::get('/', DisplayDashboardViewController::class)->name('web.system-admin.dashboard.display-dashboard-view');
});
