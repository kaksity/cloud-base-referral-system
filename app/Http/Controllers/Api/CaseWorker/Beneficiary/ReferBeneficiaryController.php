<?php

namespace App\Http\Controllers\Api\CaseWorker\Beneficiary;

use App\Actions\BeneficiaryReferral\ConfirmBeneficiaryReferralAction;
use App\Actions\BeneficiaryReferral\CreateBeneficiaryReferralAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CaseWorker\Organization\ReferBeneficiaryRequest;

class ReferBeneficiaryController extends Controller
{
    public function __construct(
        private ConfirmBeneficiaryReferralAction $confirmBeneficiaryReferralAction,
        private CreateBeneficiaryReferralAction $createBeneficiaryReferralAction
    ) {}

    public function __invoke(ReferBeneficiaryRequest $request)
    {
        $validatedRequest =  $request->validated();
        $beneficiaryReferral = $this->confirmBeneficiaryReferralAction->execute(
            $validatedRequest
        );

        if ($beneficiaryReferral) {
            return generateSuccessApiMessage('Beneficiary has already been referred to this organization');
        }

        $this->createBeneficiaryReferralAction->execute(
            $validatedRequest
        );


        return generateSuccessApiMessage('Beneficiary was referred to the organization successfully');
    }
}
