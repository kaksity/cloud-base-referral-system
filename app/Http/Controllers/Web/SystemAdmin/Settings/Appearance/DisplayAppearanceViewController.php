<?php

namespace App\Http\Controllers\Web\SystemAdmin\Settings\Appearance;

use App\Http\Controllers\Controller;

class DisplayAppearanceViewController extends Controller
{
    public function __invoke()
    {
        return inertia('system-admin/settings/appearance/index');
    }
}