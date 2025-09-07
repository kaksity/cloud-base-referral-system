<?php

use App\Http\Controllers\Web\SystemAdmin\Settings\Appearance\DisplayAppearanceViewController;
use App\Http\Controllers\Web\SystemAdmin\Settings\Country\DisplayCountriesViewController;
use App\Http\Controllers\Web\SystemAdmin\Settings\Country\ProcessCreateCountryController;
use App\Http\Controllers\Web\SystemAdmin\Settings\Country\ProcessDeleteCountryController;
use App\Http\Controllers\Web\SystemAdmin\Settings\Country\ProcessUpdateCountryController;
use App\Http\Controllers\Web\SystemAdmin\Settings\LocalGovernmentArea\DisplayLocalGovernmentAreasViewController;
use App\Http\Controllers\Web\SystemAdmin\Settings\LocalGovernmentArea\ProcessCreateLocalGovernmentAreaController;
use App\Http\Controllers\Web\SystemAdmin\Settings\LocalGovernmentArea\ProcessDeleteLocalGovernmentAreaController;
use App\Http\Controllers\Web\SystemAdmin\Settings\LocalGovernmentArea\ProcessUpdateLocalGovernmentAreaController;
use App\Http\Controllers\Web\SystemAdmin\Settings\Password\DisplayChangePasswordViewController;
use App\Http\Controllers\Web\SystemAdmin\Settings\Password\ProcessChangePasswordController;
use App\Http\Controllers\Web\SystemAdmin\Settings\Profile\DisplayProfileViewController;
use App\Http\Controllers\Web\SystemAdmin\Settings\Profile\ProcessDeleteProfileController;
use App\Http\Controllers\Web\SystemAdmin\Settings\Profile\ProcessUpdateProfileController;
use App\Http\Controllers\Web\SystemAdmin\Settings\Sector\DisplaySectorsViewController;
use App\Http\Controllers\Web\SystemAdmin\Settings\Sector\ProcessCreateSectorController;
use App\Http\Controllers\Web\SystemAdmin\Settings\Sector\ProcessDeleteSectorController;
use App\Http\Controllers\Web\SystemAdmin\Settings\Sector\ProcessUpdateSectorController;
use App\Http\Controllers\Web\SystemAdmin\Settings\State\DisplayStatesViewController;
use App\Http\Controllers\Web\SystemAdmin\Settings\State\ProcessCreateStateController;
use App\Http\Controllers\Web\SystemAdmin\Settings\State\ProcessDeleteStateController;
use App\Http\Controllers\Web\SystemAdmin\Settings\State\ProcessUpdateStateController;
use App\Http\Controllers\Web\SystemAdmin\Settings\Ward\DisplayWardsViewController;
use App\Http\Controllers\Web\SystemAdmin\Settings\Ward\ProcessCreateWardController;
use App\Http\Controllers\Web\SystemAdmin\Settings\Ward\ProcessDeleteWardController;
use App\Http\Controllers\Web\SystemAdmin\Settings\Ward\ProcessUpdateWardController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth:system-admin']], function () {
    Route::group(['prefix' => 'profile'], function () {
        Route::patch('/process/update/profile', ProcessUpdateProfileController::class)->name('web.system-admin.settings.profile.process-update-profile');
        Route::delete('/process/delete/profile', ProcessDeleteProfileController::class)->name('web.system-admin.settings.profile.process-delete-profile');
        Route::get('/', DisplayProfileViewController::class)->name('web.system-admin.settings.profile.display-profile-view');
    });

    Route::group(['prefix' => 'password'], function () {
        Route::put('/process/update/password', ProcessChangePasswordController::class)->name('web.system-admin.settings.password.process-update-password');
        Route::get('', DisplayChangePasswordViewController::class)->name('web.system-admin.settings.password.display-change-password-view');
    });

    Route::group(['prefix' => 'sector'], function () {
        Route::get('/', DisplaySectorsViewController::class)->name('web.system-admin.settings.sector.display-sectors-view');
        Route::post('/process/create/sector', ProcessCreateSectorController::class)->name('web.system-admin.settings.sector.process-create-sector');
        Route::delete('/process/delete/sector/{sectorId}', ProcessDeleteSectorController::class)->name('web.system-admin.settings.sector.process-delete-sector');
        Route::patch('/process/update/sector/{sectorId}', ProcessUpdateSectorController::class)->name('web.system-admin.settings.sector.process-update-sector');
    });

    Route::group(['prefix' => 'country'], function () {
        Route::get('/', DisplayCountriesViewController::class)->name('web.system-admin.settings.country.display-countries-view');
        Route::post('/process/create/country', ProcessCreateCountryController::class)->name('web.system-admin.settings.country.process-create-country');
        Route::delete('/process/delete/country/{countryId}', ProcessDeleteCountryController::class)->name('web.system-admin.settings.country.process-delete-country');
        Route::patch('/process/update/country/{countryId}', ProcessUpdateCountryController::class)->name('web.system-admin.settings.country.process-update-country');
    });

    Route::group(['prefix' => 'state'], function () {
        Route::get('/', DisplayStatesViewController::class)->name('web.system-admin.settings.state.display-states-view');
        Route::post('/process/create/state', ProcessCreateStateController::class)->name('web.system-admin.settings.state.process-create-state');
        Route::delete('/process/delete/state/{stateId}', ProcessDeleteStateController::class)->name('web.system-admin.settings.state.process-delete-state');
        Route::patch('/process/update/state/{stateId}', ProcessUpdateStateController::class)->name('web.system-admin.settings.state.process-update-state');
    });

    Route::group(['prefix' => 'local-government-area'], function () {
        Route::get('/', DisplayLocalGovernmentAreasViewController::class)->name('web.system-admin.settings.local-government-area.display-local-government-areas-view');
        Route::post('/process/create/local-government-area', ProcessCreateLocalGovernmentAreaController::class)->name('web.system-admin.settings.local-government-area.process-create-local-government-area');
        Route::delete('/process/delete/local-government-area/{localGovernmentAreaId}', ProcessDeleteLocalGovernmentAreaController::class)->name('web.system-admin.settings.local-government-area.process-delete-local-government-area');
        Route::patch('/process/update/local-government-area/{localGovernmentAreaId}', ProcessUpdateLocalGovernmentAreaController::class)->name('web.system-admin.settings.local-government-area.process-update-state');
    });

    Route::group(['prefix' => 'ward'], function () {
        Route::get('/', DisplayWardsViewController::class)->name('web.system-admin.settings.ward.display-wards-view');
        Route::post('/process/create/ward', ProcessCreateWardController::class)->name('web.system-admin.settings.ward.process-create-ward');
        Route::delete('/process/delete/ward/{wardId}', ProcessDeleteWardController::class)->name('web.system-admin.settings.ward.process-delete-ward');
        Route::patch('/process/update/ward/{wardId}', ProcessUpdateWardController::class)->name('web.system-admin.settings.ward.process-update-ward');
    });

    Route::get('appearance', DisplayAppearanceViewController::class)->name('web.system-admin.settings.appearance.display-appearance-view');
});
