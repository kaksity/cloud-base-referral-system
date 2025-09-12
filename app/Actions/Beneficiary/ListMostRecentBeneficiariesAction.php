<?php

namespace App\Actions\Beneficiary;

use App\Models\Beneficiary;

class ListMostRecentBeneficiariesAction
{
    public function __construct(
        private Beneficiary $beneficiary
    ) {}

    public function execute(array $listMostRecentBeneficiariesRecordOptions, array $relationships = [])
    {
        $caseWorkerId = $listMostRecentBeneficiariesRecordOptions['case_worker_id']; 

        return $this->beneficiary->query()
            ->with($relationships)
            ->where('added_by_case_worker_id', $caseWorkerId)
            ->orderBy('created_at', 'desc')->limit(10)->get();
    }
}
