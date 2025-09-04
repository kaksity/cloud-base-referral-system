<?php

namespace App\Actions\BeneficiaryReferral;

use App\Models\BeneficiaryReferral;

class UpdateBeneficiaryReferralAction
{
    public function __construct(
        private BeneficiaryReferral $beneficiaryReferral
    )
    {
        
    }
    public function execute(array $updateBeneficiaryReferralRecordOptions)
    {
        $beneficiaryReferralId = $updateBeneficiaryReferralRecordOptions['id'];
        $data = $updateBeneficiaryReferralRecordOptions['data'];

        return $this->beneficiaryReferral->where([
            'id' => $beneficiaryReferralId
        ])->update($data);
    }
}