<?php

namespace App\Http\Controllers\Api\CaseWorker\Beneficiary;

use App\Actions\BeneficiaryReferral\ListBeneficiaryReferralsAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CaseWorker\Beneficiary\FetchBeneficiaryReferralsRequest;
use App\Http\Resources\Api\CaseWorker\Beneficiary\FetchBeneficiaryReferralsResource;

class FetchBeneficiaryReferralsController extends Controller
{
    public function __construct(
        private ListBeneficiaryReferralsAction $listBeneficiaryReferralsAction
    ) {}

    public function __invoke(FetchBeneficiaryReferralsRequest $request)
    {
        $loggedInCaseWorker = auth('case-worker')->user();

        $validatedRequest = $request->validated();

        $relationships = ['beneficiary', 'organization', 'location'];

        ['beneficiary_referral_payload' => $beneficiaryReferrals, 'pagination_payload' => $paginationPayload] = $this->listBeneficiaryReferralsAction->execute([
            'filter_record_options_payload' => [
                'added_by_case_worker_id' => $loggedInCaseWorker->id,
                'organization_id' => $validatedRequest['organization_id'] ?? null,
                'beneficiary_id' => $validatedRequest['beneficiary_id'] ?? null,
                'location_id' => $validatedRequest['location_id'] ?? null,
            ],
            'pagination_payload' => [
                'page' => $request->page ?? 1,
                'limit' => $request->per_page ?? 100,
            ]
        ], $relationships);

        $mutatedBeneficiaryReferrals = FetchBeneficiaryReferralsResource::collection($beneficiaryReferrals);

        $responsePayload = [
            'beneficiary_referrals' => $mutatedBeneficiaryReferrals,
            'pagination_payload' => $paginationPayload
        ];

        return generateSuccessApiMessage('Fetched beneficiary referrals record successfully', 200, $responsePayload);
    }
}
