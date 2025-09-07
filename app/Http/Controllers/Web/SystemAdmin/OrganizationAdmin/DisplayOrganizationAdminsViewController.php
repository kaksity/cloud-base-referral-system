<?php

namespace App\Http\Controllers\Web\SystemAdmin\OrganizationAdmin;

use App\Actions\OrganizationAdmin\ListOrganizationAdminsAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\SystemAdmin\OrganizationAdmin\FetchOrganizationAdminsRequest;
use App\Http\Resources\Web\SystemAdmin\OrganizationAdmin\FetchOrganizationAdminsResource;

class DisplayOrganizationAdminsViewController extends Controller
{
    public function __construct(
        private ListOrganizationAdminsAction $listOrganizationAdminsAction
    ) {}
    public function __invoke(FetchOrganizationAdminsRequest $request)
    {
        $relationships = ['organization', 'addedBySystemAdmin'];

        $validatedRequest = $request->validated();

        ['organization_admin_payload' => $organizationAdmins, 'pagination_payload' => $paginationPayload] = $this->listOrganizationAdminsAction->execute([
            'pagination_payload' => [
                'page' => $validatedRequest['page'] ?? 1,
                'limit' => $validatedRequest['per_page'] ?? 100
            ]
        ], $relationships);

        $mutatedOrganizationAdmins = FetchOrganizationAdminsResource::collection($organizationAdmins)->resolve();

        return inertia('system-admin/organization-admin/view-organization-admins', [
            'organizationAdmins' => $mutatedOrganizationAdmins,
            'paginationPayload' => $paginationPayload
        ]);
    }
}
