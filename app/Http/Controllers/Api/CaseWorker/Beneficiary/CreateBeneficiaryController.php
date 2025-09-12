<?php

namespace App\Http\Controllers\Api\CaseWorker\Beneficiary;

use App\Actions\Beneficiary\CreateBeneficiaryAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CaseWorker\Beneficiary\CreateBeneficiaryRequest;

class CreateBeneficiaryController extends Controller
{
    public function __construct(
        private CreateBeneficiaryAction $createBeneficiaryAction
    ) {}

    public function __invoke(CreateBeneficiaryRequest $request)
    {
        $loggedInCaseWorker = auth('case-worker')->user();

        $validatedRequest = $request->validated();

        $this->createBeneficiaryAction->execute(
            $validatedRequest
        );

        return generateSuccessApiMessage('Beneficiary was created successfully', 201);
    }
}
