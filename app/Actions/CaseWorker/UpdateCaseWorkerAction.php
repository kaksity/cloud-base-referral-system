<?php

namespace App\Actions\CaseWorker;

use App\Models\CaseWorker;

class UpdateCaseWorkerAction
{
    public function __construct(
        private CaseWorker $caseWorker
    )
    {
        
    }
    public function execute(array $updateCaseWorkerRecordOptions)
    {
        $caseWorkerId = $updateCaseWorkerRecordOptions['id'];
        $data = $updateCaseWorkerRecordOptions['data'];

        return $this->caseWorker->where([
            'id' => $caseWorkerId
        ])->update($data);
    }
}