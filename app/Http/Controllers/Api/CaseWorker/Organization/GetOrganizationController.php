<?php

namespace App\Http\Controllers\Api\CaseWorker\Organization;

use App\Actions\Organization\GetOrganizationByIdAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\CaseWorker\Organization\GetOrganizationResource;

class GetOrganizationController extends Controller
{
    public function __construct(private GetOrganizationByIdAction $getOrganizationByIdAction) {}

    public function __invoke(string $organizationId)
    {

        $relationships = ['services'];

        $organization = $this->getOrganizationByIdAction->execute($organizationId, $relationships);

        if (is_null($organization)) {
            return generateErrorApiMessage('Organization record does not exists', 404);
        }

        $mutatedOrganization = new GetOrganizationResource($organization);

        return generateSuccessApiMessage('Fetched list of organizations successfully', 200, $mutatedOrganization);
    }
}
