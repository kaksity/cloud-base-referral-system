<?php

namespace App\Actions\Beneficiary;

use App\Models\Beneficiary;

class CreateBeneficiaryAction
{
    public function __construct(
        private Beneficiary $beneficiary
    )
    {}

    public function execute(array $createBeneficiaryRecordOptions)
    {
        return $this->beneficiary->create(
            $createBeneficiaryRecordOptions
        );
    }
}