<?php

namespace App\Actions\BeneficiaryReferral;

use App\Models\BeneficiaryReferral;

class GetBeneficiaryReferralByIdAction
{
    public function __construct(
        private BeneficiaryReferral $beneficiaryReferral
    )
    {
        
    }
    public function execute(string $beneficiaryReferralId, array $relationships = [])
    {
        return $this->beneficiaryReferral->with(
            $relationships
        )->where([
            'id' => $beneficiaryReferralId
        ])->first();
    }
}