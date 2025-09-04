<?php

namespace App\Actions\Beneficiary;

use App\Models\Beneficiary;

class GetBeneficiaryByIdAction
{
    public function __construct(
        private Beneficiary $beneficiary
    )
    {
        
    }
    public function execute(string $beneficiaryId, array $relationships = [])
    {
        return $this->beneficiary->with(
            $relationships
        )->where([
            'id' => $beneficiaryId
        ])->first();
    }
}