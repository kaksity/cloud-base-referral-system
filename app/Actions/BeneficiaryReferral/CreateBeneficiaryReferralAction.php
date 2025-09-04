<?php

namespace App\Actions\BeneficiaryReferral;

use App\Models\BeneficiaryReferral;

class CreateBeneficiaryReferralAction
{
    public function __construct(
        private BeneficiaryReferral $beneficiaryReferral
    )
    {}

    public function execute(array $createBeneficiaryReferralRecordOptions)
    {
        return $this->beneficiaryReferral->create(
            $createBeneficiaryReferralRecordOptions
        );
    }
}