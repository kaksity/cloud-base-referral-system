<?php

namespace App\Http\Controllers\Api\CaseWorker\Organization;

use App\Actions\Organization\ListOrganizationsAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CaseWorker\Organization\FetchOrganizationsRequest;
use App\Http\Resources\Api\CaseWorker\Organization\FetchOrganizationsResource;

class FetchOrganizationsController extends Controller
{
    public function __construct(private ListOrganizationsAction $listOrganizationsAction) {}

    public function __invoke(FetchOrganizationsRequest $request)
    {
        $relationships = [];

        ['organization_payload' => $organizations, 'pagination_payload' => $paginationPayload] = $this->listOrganizationsAction->execute([
            'filter_record_options_payload' => [
                'status' => 'active'
            ],
            'pagination_payload' => [
                'page' => $request->page ?? 1,
                'per_page' => $request->per_page ?? 100,
            ]
        ], $relationships);

        $mutatedOrganizations = FetchOrganizationsResource::collection($organizations);

        $responsePayload = [
            'organizations' => $mutatedOrganizations,
            'pagination_payload' => $paginationPayload
        ];

        return generateSuccessApiMessage('Fetched list of organizations successfully', 200, $responsePayload);
    }
}
