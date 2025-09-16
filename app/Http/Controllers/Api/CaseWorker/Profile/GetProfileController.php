<?php

namespace App\Http\Controllers\Api\CaseWorker\Profile;

use App\Actions\CaseWorker\GetCaseWorkerByIdAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\CaseWorker\Profile\GetProfileResource;

class GetProfileController extends Controller
{
    public function __construct(
        private GetCaseWorkerByIdAction $getCaseWorkerByIdAction
    ) {}
    public function __invoke()
    {
        $loggedInUser = auth('case-worker')->user();

        $relationships = ['currentOrganization',  'currentLocation.localGovernmentArea', 'currentLocation.state'];

        $caseWorker = $this->getCaseWorkerByIdAction->execute($loggedInUser->id, $relationships);

        $responsePayload = new GetProfileResource($caseWorker);

        return generateSuccessApiMessage('Fetch case worker information successfully', 200, $responsePayload);
    }
}
