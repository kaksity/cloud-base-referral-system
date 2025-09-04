<?php

namespace App\Http\Controllers\Web\SystemAdmin\Authentication;

use App\Http\Controllers\Controller;

class DisplayLoginViewController extends Controller
{
    public function __invoke()
    {
        return inertia('system-admin/authentication/login');
    }
}