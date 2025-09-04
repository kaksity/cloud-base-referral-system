<?php

namespace App\Actions\CaseWorker;

use App\Models\CaseWorker;

class CreateCaseWorkerAction
{
    public function __construct(
        private CaseWorker $caseWorker
    )
    {}

    public function execute(array $createCaseWorkerRecordOptions)
    {
        return $this->caseWorker->create(
            $createCaseWorkerRecordOptions
        );
    }
}