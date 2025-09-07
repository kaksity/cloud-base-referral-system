<?php

use App\Http\Controllers\Web\SystemAdmin\OrganizationAdmin\About\ProcessUpdatePersonalInformationController;
use App\Http\Controllers\Web\SystemAdmin\OrganizationAdmin\DisplayCreateOrganizationAdminViewController;
use App\Http\Controllers\Web\SystemAdmin\OrganizationAdmin\DisplayOrganizationAdminsViewController;
use App\Http\Controllers\Web\SystemAdmin\OrganizationAdmin\DisplayOrganizationAdminViewController;
use App\Http\Controllers\Web\SystemAdmin\OrganizationAdmin\ProcessCreateOrganizationAdminController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth:system-admin']], function () {
    Route::group(['prefix' => 'about'], function () {
        Route::patch('/update/{organizationAdminId}/basic-information', ProcessUpdatePersonalInformationController::class)->name('web.system-admin.organization-admin.about.process-update-organization-admin-basic-information');
    });

    Route::post('/process/create/organization-admin', ProcessCreateOrganizationAdminController::class)->name('web.system-admin.organization-admin.process-create-organization-admin');
    Route::get('create/organization-admin', DisplayCreateOrganizationAdminViewController::class)->name('web.system-admin.organization-admin.display-create-organization-admin-view');
    Route::get('/{organizationAdminId}', DisplayOrganizationAdminViewController::class)->name('web.system-admin.organization-admin.display-organization-admin-view');
    Route::get('/', DisplayOrganizationAdminsViewController::class)->name('web.system-admin.organization-admin.display-organization-admins-view');
});
