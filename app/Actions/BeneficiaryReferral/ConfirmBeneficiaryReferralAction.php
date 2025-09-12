<?php

namespace App\Actions\BeneficiaryReferral;

use App\Models\BeneficiaryReferral;

class ConfirmBeneficiaryReferralAction
{
    public function __construct(
        private BeneficiaryReferral $beneficiaryReferral
    ) {}

    public function execute(array $confirmBeneficiaryReferralRecordOptions)
    {
        $beneficiaryId = $confirmBeneficiaryReferralRecordOptions['beneficiary_id'];
        $organizationId = $confirmBeneficiaryReferralRecordOptions['organization_id'];

        return $this->beneficiaryReferral->where([
            'beneficiary_id' => $beneficiaryId,
            'organization_id' => $organizationId,
        ])->first();
    }
}
