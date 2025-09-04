<?php

namespace App\Actions\Beneficiary;

use App\Models\Beneficiary;

class DeleteBeneficiaryAction
{
    public function __construct(
        private Beneficiary $beneficiary
    )
    {
        
    }
    public function execute(string $beneficiaryId)
    {
        return $this->beneficiary->where([
            'id' => $beneficiaryId
        ])->delete();
    }
}