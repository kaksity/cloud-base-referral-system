<?php

namespace App\Http\Controllers\Web\SystemAdmin\Settings\Password;

use App\Http\Controllers\Controller;


class DisplayChangePasswordViewController extends Controller
{
    /**
     * Show the user's password settings page.
     */
    public function __invoke()
    {
        return inertia('system-admin/settings/password/index');
    }
}
