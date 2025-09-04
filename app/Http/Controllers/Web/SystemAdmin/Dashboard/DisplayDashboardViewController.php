<?php

namespace App\Http\Controllers\Web\SystemAdmin\Dashboard;

use App\Http\Controllers\Controller;

class DisplayDashboardViewController extends Controller
{
    public function __invoke()
    {
        return inertia('system-admin/dashboard/index', []);
    }
}
