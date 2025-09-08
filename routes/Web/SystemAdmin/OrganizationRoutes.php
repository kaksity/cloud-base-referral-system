<?php

use App\Http\Controllers\Web\SystemAdmin\Organization\About\ProcessUpdateOrganizationBasicInformationController;
use App\Http\Controllers\Web\SystemAdmin\Organization\DisplayCreateOrganizationViewController;
use App\Http\Controllers\Web\SystemAdmin\Organization\DisplayOrganizationsViewController;
use App\Http\Controllers\Web\SystemAdmin\Organization\DisplayOrganizationViewController;
use App\Http\Controllers\Web\SystemAdmin\Organization\ProcessCreateOrganizationController;
use App\Http\Controllers\Web\SystemAdmin\Organization\Admin\DisplayOrganizationAdminsViewController;
use App\Http\Controllers\Web\SystemAdmin\Organization\Admin\ProcessCreateOrganizationAdminController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth:system-admin']], function () {
    Route::group(['prefix' => 'about'], function () {
        Route::patch('/update/{organizationId}/basic-information', ProcessUpdateOrganizationBasicInformationController::class)->name('web.system-admin.organization.about.process-update-organization-basic-information');
    });

    Route::group(['prefix' => 'admin'], function () {
        Route::post('/{organizationId}/process/create/organization-admin', ProcessCreateOrganizationAdminController::class)->name('web.system-admin.organization.admin.process-create-organization-admin');
        Route::get('/{organizationId}', DisplayOrganizationAdminsViewController::class)->name('web.system-admin.organization.admin.display-organization-admins-view');
    });
    Route::post('/process/create/organization', ProcessCreateOrganizationController::class)->name('web.system-admin.organization.process-create-organization');
    Route::get('create/organization', DisplayCreateOrganizationViewController::class)->name('web.system-admin.organization.display-create-organization-view');
    Route::get('/{organizationId}', DisplayOrganizationViewController::class)->name('web.system-admin.organization.display-organization-view');
    Route::get('/', DisplayOrganizationsViewController::class)->name('web.system-admin.organization.display-organizations-view');
});
