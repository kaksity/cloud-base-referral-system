<?php

namespace App\Actions\CaseWorker;

use App\Models\CaseWorker;

class DeleteCaseWorkerAction
{
    public function __construct(
        private CaseWorker $caseWorker
    )
    {
        
    }
    public function execute(string $caseWorkerId)
    {
        return $this->caseWorker->where([
            'id' => $caseWorkerId
        ])->delete();
    }
}