<?php

use App\Http\Controllers\Web\SystemAdmin\Settings\Appearance\DisplayAppearanceViewController;
use App\Http\Controllers\Web\SystemAdmin\Settings\Password\DisplayChangePasswordViewController;
use App\Http\Controllers\Web\SystemAdmin\Settings\Password\ProcessChangePasswordController;
use App\Http\Controllers\Web\SystemAdmin\Settings\Profile\DisplayProfileViewController;
use App\Http\Controllers\Web\SystemAdmin\Settings\Profile\ProcessDeleteProfileController;
use App\Http\Controllers\Web\SystemAdmin\Settings\Profile\ProcessUpdateProfileController;
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

    Route::get('appearance', DisplayAppearanceViewController::class)->name('web.system-admin.settings.appearance.display-appearance-view');
});
