<?php

namespace App\Http\Controllers\Web\SystemAdmin\Authentication;

use App\Http\Controllers\Controller;

class ProcessLogoutController extends Controller
{
    public function __invoke()
    {
        auth('system-admin')->logout();

        return redirect()->route('web.system-admin.organization.display-login-view');
    }
}
