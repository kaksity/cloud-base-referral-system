<?php

use App\Http\Controllers\Web\SystemAdmin\Settings\Appearance\DisplayAppearanceViewController;
use App\Http\Controllers\Web\SystemAdmin\Settings\Password\DisplayChangePasswordViewController;
use App\Http\Controllers\Web\SystemAdmin\Settings\Password\ProcessChangePasswordController;
use App\Http\Controllers\Web\SystemAdmin\Settings\Profile\DisplayProfileViewController;
use App\Http\Controllers\Web\SystemAdmin\Settings\Profile\ProcessDeleteProfileController;
use App\Http\Controllers\Web\SystemAdmin\Settings\Profile\ProcessUpdateProfileController;
use App\Http\Controllers\Web\SystemAdmin\Settings\Sector\DisplaySectorsViewController;
use App\Http\Controllers\Web\SystemAdmin\Settings\Sector\ProcessCreateSectorController;
use App\Http\Controllers\Web\SystemAdmin\Settings\Sector\ProcessDeleteSectorController;
use App\Http\Controllers\Web\SystemAdmin\Settings\Sector\ProcessUpdateSectorController;
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
    Route::get('appearance', DisplayAppearanceViewController::class)->name('web.system-admin.settings.appearance.display-appearance-view');
});
