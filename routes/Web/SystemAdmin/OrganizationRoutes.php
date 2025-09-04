<?php

use App\Http\Controllers\Web\SystemAdmin\Organization\DisplayCreateOrganizationViewController;
use App\Http\Controllers\Web\SystemAdmin\Organization\ProcessCreateOrganizationController;
use Illuminate\Support\Facades\Route;

Route::group([], function () {
    Route::get('/process/create/organization', ProcessCreateOrganizationController::class)->name('web.system-admin.organization.process-create-organization');
    Route::get('create/organization', DisplayCreateOrganizationViewController::class)->name('web.system-admin.organization.display-create-organization-view');
});
