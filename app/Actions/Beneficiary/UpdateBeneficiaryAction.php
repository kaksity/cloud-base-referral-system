<?php

namespace App\Actions\Beneficiary;

use App\Models\Beneficiary;

class UpdateBeneficiaryAction
{
    public function __construct(
        private Beneficiary $beneficiary
    )
    {
        
    }
    public function execute(array $updateBeneficiaryRecordOptions)
    {
        $beneficiaryId = $updateBeneficiaryRecordOptions['id'];
        $data = $updateBeneficiaryRecordOptions['data'];

        return $this->beneficiary->where([
            'id' => $beneficiaryId
        ])->update($data);
    }
}