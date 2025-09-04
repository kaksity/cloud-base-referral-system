<?php

namespace App\Http\Controllers\Web\SystemAdmin\Organization;

use App\Actions\Organization\GetOrganizationByIdAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\Web\SystemAdmin\Organization\GetOrganizationResource;

class DisplayOrganizationViewController extends Controller
{
    public function __construct(
        private GetOrganizationByIdAction $getOrganizationByIdAction
    ) {}

    public function __invoke(string $organizationId)
    {
        $organization = $this->getOrganizationByIdAction->execute($organizationId);

        if (is_null($organization)) {
            return redirect()->route('web.system-admin.organization.display-organizations-view');
        }

        $mutatedOrganization = GetOrganizationResource::make($organization)->resolve();

        return inertia('system-admin/organization/view-organization', [
            'organization' => $mutatedOrganization
        ]);
    }
}
