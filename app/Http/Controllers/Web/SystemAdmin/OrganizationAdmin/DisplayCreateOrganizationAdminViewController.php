<?php

namespace App\Http\Controllers\Web\SystemAdmin\OrganizationAdmin;

use App\Http\Controllers\Controller;

class DisplayCreateOrganizationAdminViewController extends Controller
{
    public function __invoke() {
        return inertia('system-admin/organization-admin/create-organization-admin');
    }
}
