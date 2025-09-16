<?php

namespace App\Http\Controllers\Api\CaseWorker\Beneficiary;

use App\Actions\Beneficiary\ListBeneficiariesAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CaseWorker\Beneficiary\FetchBeneficiariesRequest;
use App\Http\Resources\Api\CaseWorker\Beneficiary\FetchBeneficiariesResource;

class FetchBeneficiariesController extends Controller
{
    public function __construct(
        private ListBeneficiariesAction $listBeneficiariesAction
    ) {}

    public function __invoke(FetchBeneficiariesRequest $request)
    {
        $loggedInCaseWorker = auth('case-worker')->user();

        $validatedRequest = $request->validated();

        ['beneficiary_payload' => $beneficiaries, 'pagination_payload' => $paginationPayload] = $this->listBeneficiariesAction->execute([
            'filter_record_options_payload' => [
                'added_by_case_worker_id' => $loggedInCaseWorker->id,
                'status' => $validatedRequest['status'] ?? null,
            ],
            'pagination_payload' => [
                'page' => $request->page ?? 1,
                'limit' => $request->per_page ?? 100,
            ]
        ]);

        $mutatedBeneficiaries = FetchBeneficiariesResource::collection($beneficiaries);

        $responsePayload = [
            'beneficiaries' => $mutatedBeneficiaries,
            'pagination_payload' => $paginationPayload
        ];

        return generateSuccessApiMessage('Fetched beneficiaries record successfully', 200, $responsePayload);
    }
}
