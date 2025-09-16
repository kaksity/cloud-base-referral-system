<?php

namespace App\Actions\CaseWorker;

use App\Models\CaseWorker;

class GetCaseWorkerByEmailAction
{
    public function __construct(
        private CaseWorker $caseWorker
    ) {}

    public function execute(string $email, array $relationships = [])
    {
        return $this->caseWorker->with(
            $relationships
        )->where([
            'email' => $email
        ])->first();
    }
}
