<?php

namespace App\Http\Controllers\Web\SystemAdmin\Organization;

use App\Actions\Organization\ListOrganizationsAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\SystemAdmin\Organization\FetchOrganizationsRequest;
use App\Http\Resources\Web\SystemAdmin\Organization\FetchOrganizationsResource;

class DisplayOrganizationsViewController extends Controller
{
    public function __construct(
        private ListOrganizationsAction $listOrganizationsAction
    ) {}
    public function __invoke(FetchOrganizationsRequest $request)
    {
        $relationships = ['addedBySystemAdmin'];

        $validatedRequest = $request->validated();

        ['organization_payload' => $organizations, 'pagination_payload' => $paginationPayload] = $this->listOrganizationsAction->execute([
            'pagination_payload' => [
                'page' => $validatedRequest['page'] ?? 1,
                'limit' => $validatedRequest['per_page'] ?? 100
            ]
        ], $relationships);

        $mutatedOrganizations = FetchOrganizationsResource::collection($organizations)->resolve();


        return inertia('system-admin/organization/view-organizations', [
            'organizations' => $mutatedOrganizations,
            'paginationPayload' => $paginationPayload
        ]);
    }
}
