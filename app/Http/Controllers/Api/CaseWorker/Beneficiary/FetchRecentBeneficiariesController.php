<?php

namespace App\Http\Controllers\Api\CaseWorker\Beneficiary;

use App\Actions\Beneficiary\ListMostRecentBeneficiariesAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\CaseWorker\Beneficiary\FetchRecentBeneficiariesResource;

class FetchRecentBeneficiariesController extends Controller
{
    public function __construct(
        private ListMostRecentBeneficiariesAction $listMostRecentBeneficiariesAction
    )
    {
        
    }

    public function __invoke()
    {
        
        $loggedInCaseWorker = auth('case-worker')->user();
        $mostRecentBeneficiaries = $this->listMostRecentBeneficiariesAction->execute([
            'case_worker_id' => $loggedInCaseWorker->id
        ]);

        $mutatedCaseWorkers = FetchRecentBeneficiariesResource::collection($mostRecentBeneficiaries);

        return generateSuccessApiMessage('Fetched most recent case workers successfully', $mutatedCaseWorkers);
    }
}