<?php

namespace App\Http\Controllers\Web\SystemAdmin\Organization;

use App\Http\Controllers\Controller;

class DisplayCreateOrganizationViewController extends Controller
{
    public function __invoke() {
        return inertia('system-admin/organization/create-organization');
    }
}
