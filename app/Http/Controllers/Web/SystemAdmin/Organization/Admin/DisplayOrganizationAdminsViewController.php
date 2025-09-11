<?php

namespace App\Http\Controllers\Web\SystemAdmin\Organization\Admin;

use App\Actions\Organization\GetOrganizationByIdAction;
use App\Actions\OrganizationAdmin\ListOrganizationAdminsAction;
use App\Http\Requests\Web\SystemAdmin\Organization\Admin\FetchOrganizationAdminsRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\Web\SystemAdmin\Organization\Admin\FetchOrganizationAdminsResource;
use App\Http\Resources\Web\SystemAdmin\Organization\GetOrganizationResource;

class DisplayOrganizationAdminsViewController extends Controller
{
    public function __construct(
        private GetOrganizationByIdAction $getOrganizationByIdAction,
        private ListOrganizationAdminsAction $listOrganizationAdminsAction,
    ) {}

    public function __invoke(FetchOrganizationAdminsRequest $request, string $organizationId)
    {
        $organization = $this->getOrganizationByIdAction->execute($organizationId);

        if (is_null($organization)) {
            return redirect()->route('web.system-admin.organization.display-organizations-view');
        }

        $relationships = ['organization', 'addedBySystemAdmin'];

        $validatedRequest = $request->validated();

        ['organization_admin_payload' => $organizationAdmins, 'pagination_payload' => $paginationPayload] = $this->listOrganizationAdminsAction->execute([
            'filter_record_options_payload' => [
                'organization_id' => $organizationId
            ],
            'pagination_payload' => [
                'page' => $validatedRequest['page'] ?? 1,
                'limit' => $validatedRequest['per_page'] ?? 100
            ]
        ], $relationships);

        $mutatedOrganization = GetOrganizationResource::make($organization)->resolve();

        $mutatedOrganizationAdmins = FetchOrganizationAdminsResource::collection($organizationAdmins)->resolve();

        return inertia('system-admin/organization/admin/index', [
            'organization' => $mutatedOrganization,
            'organizationAdmins' => $mutatedOrganizationAdmins,
            'paginationPayload' => $paginationPayload
        ]);
    }
}
