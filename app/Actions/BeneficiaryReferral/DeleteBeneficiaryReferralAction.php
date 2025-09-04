<?php

namespace App\Actions\BeneficiaryReferral;

use App\Models\BeneficiaryReferral;

class DeleteBeneficiaryReferralAction
{
    public function __construct(
        private BeneficiaryReferral $beneficiaryReferral
    )
    {
        
    }
    public function execute(string $beneficiaryReferralId)
    {
        return $this->beneficiaryReferral->where([
            'id' => $beneficiaryReferralId
        ])->delete();
    }
}