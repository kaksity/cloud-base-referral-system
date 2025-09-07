<?php

namespace App\Http\Controllers\Web\SystemAdmin\OrganizationAdmin;

use App\Actions\OrganizationAdmin\GetOrganizationAdminByIdAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\Web\SystemAdmin\OrganizationAdmin\GetOrganizationAdminResource;

class DisplayOrganizationAdminViewController extends Controller
{
    public function __construct(
        private GetOrganizationAdminByIdAction $getOrganizationAdminByIdAction,
    ) {}

    public function __invoke(string $organizationAdminId)
    {
        $relationships = ['organization.addedBySystemAdmin'];
        $organizationAdmin = $this->getOrganizationAdminByIdAction->execute($organizationAdminId, $relationships);

        if (is_null($organizationAdmin)) {
            return redirect()->route('web.system-admin.organization-admin.display-organization-admins-view');
        }

        $mutatedOrganizationAdmin = GetOrganizationAdminResource::make($organizationAdmin)->resolve();

        $pageData = [
            'organizationAdmin' => $mutatedOrganizationAdmin
        ];

        return inertia('system-admin/organization-admin/view-organization-admin', $pageData);
    }
}
