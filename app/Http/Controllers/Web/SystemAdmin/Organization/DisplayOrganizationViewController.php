<?php

namespace App\Http\Controllers\Web\SystemAdmin\Organization;

use App\Actions\Organization\GetOrganizationByIdAction;
use App\Actions\OrganizationAdmin\ListOrganizationAdminsAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\Web\SystemAdmin\Organization\FetchOrganizationAdminsResource;
use App\Http\Resources\Web\SystemAdmin\Organization\GetOrganizationResource;

class DisplayOrganizationViewController extends Controller
{
    public function __construct(
        private GetOrganizationByIdAction $getOrganizationByIdAction,
        private ListOrganizationAdminsAction $listOrganizationAdminsAction,
    ) {}

    public function __invoke(string $organizationId)
    {
        $organization = $this->getOrganizationByIdAction->execute($organizationId);

        if (is_null($organization)) {
            return redirect()->route('web.system-admin.organization.display-organizations-view');
        }

        $mutatedOrganization = GetOrganizationResource::make($organization)->resolve();

        $pageData = [
            'organization' => $mutatedOrganization
        ];

        if (request('tab') === 'admin') {
            $relationships = ['organization', 'addedBySystemAdmin'];

            ['organization_admin_payload' => $organizationAdmins, 'pagination_payload' => $paginationPayload] = $this->listOrganizationAdminsAction->execute([
                'pagination_payload' => [
                    'page' => request('page') ?? 1,
                    'limit' => request('per_page') ?? 100
                ]
            ], $relationships);

            $mutatedOrganizationAdmins = FetchOrganizationAdminsResource::collection($organizationAdmins)->resolve();

            $pageData += [
                'organizationAdminPayload' => [
                    'organizationAdmins' => $mutatedOrganizationAdmins,
                    'paginationPayload' => $paginationPayload
                ]
            ];
        }

        return inertia('system-admin/organization/view-organization', $pageData);
    }
}
