<?php

namespace App\Actions\CaseWorker;

use App\Models\CaseWorker;

class GetCaseWorkerByIdAction
{
    public function __construct(
        private CaseWorker $caseWorker
    )
    {
        
    }
    public function execute(string $caseWorkerId, array $relationships = [])
    {
        return $this->caseWorker->with(
            $relationships
        )->where([
            'id' => $caseWorkerId
        ])->first();
    }
}